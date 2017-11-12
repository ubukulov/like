<?php

namespace App\Http\Controllers;

use App\CertSub;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Cert;
use App\Category;
use App\Partner;
use Illuminate\Support\Facades\DB;
use App\CertView;
use Cache;
use SSH;
use App\Page;

class IndexController extends Controller
{
    protected $cats;

    public function __construct()
    {
        $this->cats = Category::orderBy('sort', 'ASC')->get();
    }

    public function welcome(){
        if(Cache::has('cat_menu')){
            $cat_menu = Cache::get('cat_menu');
        }else{
            $tree = $this->getTree($this->getCat());
            $cat_menu = $this->showCat($tree);
            Cache::put('cat_menu', $cat_menu, 30);
        }

        $certs = Cert::get();
        $cats = $this->cats;
        return view('welcome', compact('certs', 'cats', 'cat_menu'));
    }

    # Кэшбэк
    public function cashback(){
        $mk_date = time();
        $cash = DB::select("SELECT * FROM cashback_partners WHERE date_end > '$mk_date' ORDER BY id");
        $title = $this->title."онлайн кэшбэк";
        return view('cashback', compact('cash','title'));
    }

    # Отделная страница офлайн задании
    public function cert($id){
        $id = (int) $id;
        if(!$id){
            $id = 3;
        }
        
        $cert = Cert::getByIdCertData($id);
        $ip = $_SERVER['REMOTE_ADDR']; // Ип адрес пользователя
        $current_date = date("Y-m-d H:i:s"); // текущая время
        // просмотр данного страницы
        if(!CertView::exists($ip)){
            // пользователь первый раз заходит к нам
            CertView::create([
                'ip' => $ip, 'id_cert' => $id, 'created_at' => $current_date
            ]);
            $cert->views += 1;
            $cert->save();
        }
        if(CertView::limit($current_date) >= 86400){
            // прошел 1 день
            $cert_view = CertView::findOrFail(get_id_wrapping($ip));
            $cert_view->updated_at = $current_date;
            $cert_view->save();
            $cert->views += 1;
            $cert->save();
        }
        $certs_sub = CertSub::get_cert_subs($id);
        $partner = Partner::getByIdPartnerData($cert->partner_id);
        return view('cert-index', compact('cert', 'partner', 'certs_sub'));
    }

    # По ип адресу определить местоположение пользователя
    public function getLocation(){
        if(!Cache::has('country_code')){
            $file = $_SERVER['DOCUMENT_ROOT'] . "/lib/SxGeo.dat";
            $SxGeo = new \App\SxGeo($file);
            $country_code = $SxGeo->getCountry($_SERVER['REMOTE_ADDR']);
            switch ($country_code){
                case "KZ":
                    Cache::put('country_first_name',"КАЗАХСТАН",60);
                    Cache::put('country_second_name',"РОССИЯ",60);
                    Cache::put('country_first_code',"KZ",60);
                    Cache::put('country_second_code',"RU",60);
                    break;
                case "RU":
                    Cache::put('country_first_name',"РОССИЯ",60);
                    Cache::put('country_second_name',"КАЗАХСТАН",60);
                    Cache::put('country_first_code',"RU",60);
                    Cache::put('country_second_code',"KZ",60);
                    break;
                default:
                    Cache::put('country_first_name',"КАЗАХСТАН",60);
                    Cache::put('country_second_name',"РОССИЯ",60);
                    Cache::put('country_first_code',"KZ",60);
                    Cache::put('country_second_code',"RU",60);
                    break;
            }
        }
    }
    # Установливаем местоположение пользователя по его выбору
    public function setLocation(Request $request){
        $data = $request->all();
        if(array_key_exists('KZ',$data)){
            Cache::put('country_code',"KZ",60);
        }else{
            Cache::put('country_code',"RU",60);
        }
        return redirect()->back();
    }

    # По ид категории получить список задании
    public function cert_cat($id){
        $mk_date = time();
        $certs = Cert::where(['category_id' => $id])->where('date_end', '>', $mk_date)->orderBy('sort', 'DESC')->orderBy('sort', 'DESC')->get();
        //title = $this->title."Главная страница";
        $cats = $this->cats;
        return view('welcome', compact('certs','title', 'cats'));
    }

    # task
    public function tasks(){
        $title = $this->title."Главная страница";
        return view('task', compact('title'));
    }

    public function task_content(){
        return view('task-content');
    }

    public function getCat(){
        $result = DB::table('cats')->get();
        $result = collect($result)->map(function($x){ return (array) $x; })->toArray();
        $cat = array();

        foreach($result as $val){
            $cat[$val['id']] = $val;
        }

        return $cat;
    }

    public function getTree($data){
        $tree = array();

        foreach ($data as $id => &$node) {
            //Если нет вложений
            if (!$node['parent']){
                $tree[$id] = &$node;
            }else{
                //Если есть потомки то перебераем массив
                $data[$node['parent']]['childs'][$id] = &$node;
            }
        }
        return $tree;
    }

    //Шаблон для вывода меню в виде дерева
    public function tplMenu($category){
        $menu = '<li';
        $menu .= (isset($category['childs'])) ? ' class="parent">' : '>';
		$menu .= '<a href="#" title="'. $category['title'] .'">'.
            $category['title'].'</a>';

        if(isset($category['childs'])){
            $menu .= '<ul>'. $this->showCat($category['childs']) .'</ul>';
        }
        $menu .= '</li>';

        return $menu;
    }

    /**
     * Рекурсивно считываем наш шаблон
     **/
    public function showCat($data){
        $string = '';
        foreach($data as $item){
            $string .= $this->tplMenu($item);
        }
        return $string;
    }

    public function market(){
        if(Cache::has('cat_menu')){
            $cat_menu = Cache::get('cat_menu');
        }else{
            $tree = $this->getTree($this->getCat());
            $cat_menu = $this->showCat($tree);
            Cache::put('cat_menu', $cat_menu, 30);
        }
        $certs = DB::select("SELECT * FROM certs WHERE cert_type='2' AND conditions <> '' AND image <> '' ORDER BY id DESC");
        $cats = $this->cats;
        return view('store/index', compact('certs', 'cats', 'cat_menu'));
    }

    public function partner(){
        $for_partner = Page::find(13)->text;
        return view('for-partner', compact('for_partner'));
    }

    # Предложить свой товар - страница
    public function suggest(){
        return view('suggest');
    }
    # Предложить свой товар - сохранение
    public function suggest_store(Request $request){
        if($request->input('captcha') == 43){
            $lastInsertID = DB::table('suggests')->insertGetId([
                'name' => $request->input('name'), 'phone' => $request->input('phone'), 'suggest' => $request->input('suggest'),
                'created_at' => date('Y-m-d H:i:s')
            ]);
            if($lastInsertID){
                return redirect('/suggest')->with('message', 'Успешно отправлено!');
            }else{
                return redirect('/suggest')->with('message', 'Ошибка! Попробуйте еще раз!')->withInput();
            }
        }else{
            return redirect('/suggest')->with('message', 'Ошибка! Вы не правильно посчитали!')->withInput();
        }
    }
}
