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
use App\User;

class IndexController extends BaseController
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
            $tree = parent::getTree(parent::getCat());
            $cat_menu = parent::showCat($tree);
            Cache::put('cat_menu', $cat_menu, 30);
        }

        //$certs = Cert::get();
        $certs = DB::select("SELECT * FROM certs WHERE cert_type='2' AND conditions <> '' AND image <> '' ORDER BY updated_at DESC LIMIT 32");
        //$cats = $this->cats;
        return view('welcome', compact('certs', 'cat_menu'));
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

    public function market(){
        if(Cache::has('cat_menu')){
            $cat_menu = Cache::get('cat_menu');
        }else{
            $tree = $this->getTree($this->getCat());
            $cat_menu = $this->showCat($tree);
            Cache::put('cat_menu', $cat_menu, 30);
        }
        $url = $_SERVER["SERVER_NAME"];
        $domain = explode(".",$url);
        $sub_domain = $domain[0];
        $certs = DB::select("SELECT * FROM certs WHERE cert_type='2' AND conditions <> '' AND image <> '' ORDER BY updated_at DESC  LIMIT 32");
        $cats = $this->cats;
        return view('store/index', compact('certs', 'cats', 'cat_menu', 'sub_domain'));
    }

    public function list_by_pod_cat($id){
        if(Cache::has('cat_menu')){
            $cat_menu = Cache::get('cat_menu');
        }else{
            $tree = $this->getTree($this->getCat());
            $cat_menu = $this->showCat($tree);
            Cache::put('cat_menu', $cat_menu, 30);
        }
        $certs = DB::select("SELECT * FROM certs WHERE cert_type='2' AND pod_cat='$id'  AND conditions <> '' AND image <> '' ORDER BY id DESC");
        $cats = $this->cats;
        return view('store/cat', compact('certs', 'cats', 'cat_menu'));
    }

    public function list_by_cat($id){
        if(Cache::has('cat_menu')){
            $cat_menu = Cache::get('cat_menu');
        }else{
            $tree = $this->getTree($this->getCat());
            $cat_menu = $this->showCat($tree);
            Cache::put('cat_menu', $cat_menu, 30);
        }
        if($id != 888){
            $certs = DB::select("SELECT * FROM certs WHERE cert_type='2' AND category_id='$id'  AND conditions <> '' AND image <> '' ORDER BY id DESC");
        }else{
            $certs = DB::select("SELECT * FROM certs WHERE cert_type='2' AND is_best_price=1 AND conditions <> '' AND image <> '' ORDER BY id DESC");
        }

        $cats = $this->cats;
        return view('store/cat', compact('certs', 'cats', 'cat_menu'));
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

    # Показать еще
    public function show_more($first_row,$last_row){
        $first_row = (int) $first_row;
        $last_row  = (int) $last_row;
        $result    = DB::select("SELECT * FROM certs WHERE cert_type='2' AND conditions<>'' AND image<>'' LIMIT $first_row, $last_row");
        return json_encode($result);
    }

    public function get_information_about_store($store_name){
        $result = DB::table('business_store')->where(['store_name' => $store_name, 'status' => 1])->first();
        if($result){
            $user = User::find($result->id_user);
            return json_encode($user->mphone);
        }
        return 0;
    }
}
