<?php

namespace App\Http\Controllers\Usr;

use App\Http\Controllers\Controller;
use App\Category;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Partner;
use App\SimpleImage;
use App\Cert;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{

    public function index(){
        $products = Cert::where(['user_id' => Auth::id()])->orderBy('created_at', 'DESC')->paginate(10);
        return view('user/product/index', compact('products'));
    }

    public function create(){
        $cat = Category::get();
        $pod_cat = DB::select("SELECT * FROM pod_cat");
        $cats = DB::table('cats')->where(['parent' => 0])->get();
        return view('user/product/create', compact('cat','pod_cat', 'cats'));
    }

    public function store(Request $request)
    {

        $data = [
            'title' => $request->input('title'), 'category_id' => $request->input('id_main_cat'),
            'pod_cat' => $request->input('id_pod_cat'), 'conditions' => $request->input('conditions'),
            /*'description' => $request->input('description'),*/ 'features' => $request->input('features'),
            /*'special1' => $request->input('special1'),*/ 'special2' => $request->input('special2'),
            'special3' => $request->input('special3'), /*'special4' => $request->input('special4'),*/
            'com_agent' => $request->input('com_agent'), /*'economy' => $request->input('economy'),*/
            'image' => $request->input('photo1'), 'image2' => $request->input('photo2'),
            'image3' => $request->input('photo3'),
            'partner_id' => 568, 'user_id' => Auth::id(),
            /*'date_start' => strtotime($request->input('date_start')),'date_end' => strtotime($request->input('date_end')),*/
            /*'meta_description' => $request->input('meta_description'),
            'meta_keywords' => $request->input('meta_keywords'), 'sort' => $request->input('sort'),*/
            'cert_type' => $request->input('cert_type'), 'article_code' => $request->input('article_code'),
            /*'b1' => $request->input('b1'), 'b2' => $request->input('b2'), 'b3' => $request->input('b3'),
            'prime_cost' => $request->input('prime_cost'),*/ 'count' => $request->input('count')
            /*'section_type' => $request->input('section_type'), 'label_type' => $request->input('label_type')*/
        ];
        if(!empty($data['image'])){
            $from = $_SERVER['DOCUMENT_ROOT'] . '/temp/'.$data['image'];
            $to = $_SERVER['DOCUMENT_ROOT'] . '/uploads/certs/'.$data['image'];
            $to_mini = $_SERVER['DOCUMENT_ROOT'] . '/uploads/certs/small/'.$data['image'];

            // Вызываем класс
            $img = new SimpleImage();
            $img->load($from);
            $img->fit_to_width(900); // В аргумент ширину картинки, которая нужна(Она пропорц. уменьш.)
            $img->save($to);
            $img->adaptive_resize(227, 140);
            $img->save($to_mini);
            unlink($from);
        }
        if(!empty($data['image2'])){
            $from = $_SERVER['DOCUMENT_ROOT'] . '/temp/'.$data['image2'];
            $to = $_SERVER['DOCUMENT_ROOT'] . '/uploads/certs/'.$data['image2'];
            $to_mini = $_SERVER['DOCUMENT_ROOT'] . '/uploads/certs/small/'.$data['image2'];

            // Вызываем класс
            $img = new SimpleImage();
            $img->load($from);
            $img->fit_to_width(900); // В аргумент ширину картинки, которая нужна(Она пропорц. уменьш.)
            $img->save($to);
            $img->adaptive_resize(227, 140);
            $img->save($to_mini);
            unlink($from);
        }
        if(!empty($data['image3'])){
            $from = $_SERVER['DOCUMENT_ROOT'] . '/temp/'.$data['image3'];
            $to = $_SERVER['DOCUMENT_ROOT'] . '/uploads/certs/'.$data['image3'];
            $to_mini = $_SERVER['DOCUMENT_ROOT'] . '/uploads/certs/small/'.$data['image3'];

            // Вызываем класс
            $img = new SimpleImage();
            $img->load($from);
            $img->fit_to_width(900); // В аргумент ширину картинки, которая нужна(Она пропорц. уменьш.)
            $img->save($to);
            $img->adaptive_resize(227, 140);
            $img->save($to_mini);
            unlink($from);
        }
        $lastInsertId = Cert::create($data)->id;
        $count = $request->input('cnt');
        if ($count >= 1 AND !empty($request->get('from1')) AND !empty($request->get('to1'))) {
            for ($i = 1; $i <= $count; $i++) {
                $from = $request->get('from' . $i);
                $to   = $request->get('to' . $i);
                $sum   = $request->get('sum' . $i);
                $current_time = date("Y-m-d H:i:s");
                DB::insert("INSERT INTO cert_opt (id_cert,nach,kon,summa,created_at) VALUES('$lastInsertId','$from','$to', '$sum', '$current_time')");
            }
        }

        return redirect('user/account')->with('message', "Задания успешно добавлен");
    }

    public function edit($id){
        $cert = Cert::find($id);
        $cat = Category::get();
        $partner = Partner::all();
        $pod_cat = DB::select("SELECT * FROM pod_cat");
        $cats = DB::table('cats')->where(['parent' => 0])->get();
        $opt = DB::table('cert_opt')->where(['id_cert' => $id])->get();
        return view('user/product/edit', compact('cert', 'cat', 'partner', 'pod_cat', 'cats', 'opt'));
    }
}