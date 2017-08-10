<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Cert;
use App\Category;
use App\Partner;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    protected $cats;

    public function __construct()
    {
        $this->cats = Category::orderBy('sort', 'ASC')->get();
    }

    public function welcome(){
        $certs = Cert::get();
        $cats = $this->cats;
        return view('welcome', compact('certs', 'cats'));
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
        //$d1 = $cert->date_end - time();
        //dd($d1);
        $partner = Partner::getByIdPartnerData($cert->partner_id);
        return view('cert-index', compact('cert', 'partner'));
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
}
