<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Cert;
use App\Category;
use App\Partner;
use Illuminate\Support\Facades\DB;
use App\SimpleImage;

class CertController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $certs = Cert::getNotWhere();
        return view('admin/cert/cert-index', compact('certs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cat = Category::get();
        $partner = Partner::all();
        $pod_cat = DB::select("SELECT * FROM pod_cat");
        return view('admin/cert/cert-create', compact('cat','partner','pod_cat'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [
            'title' => $request->input('title'), 'category_id' => $request->input('id_main_cat'),
            'pod_cat' => $request->input('id_pod_cat'), 'conditions' => $request->input('conditions'),
            'description' => $request->input('description'), 'features' => $request->input('features'),
            'special1' => $request->input('special1'), 'special2' => $request->input('special2'),
            'special3' => $request->input('special3'), 'special4' => $request->input('special4'),
            'old_price' => $request->input('old_price'), 'economy' => $request->input('economy'),
            'image' => $request->input('photo1'), 'image2' => $request->input('photo2'),
            'image3' => $request->input('photo3'),
            'partner_id' => $request->input('id_partner'), 'date_start' => strtotime($request->input('date_start')),
            'date_end' => strtotime($request->input('date_end')), 'meta_description' => $request->input('meta_description'),
            'meta_keywords' => $request->input('meta_keywords'), 'sort' => $request->input('sort'),
            'cert_type' => $request->input('cert_type')
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
        Cert::create($data);
        return redirect('admin/certs')->with('message', "Задания успешно добавлен");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cert = Cert::findOrFail($id);
        $cat = Category::get();
        $partner = Partner::all();
        $pod_cat = DB::select("SELECT * FROM pod_cat");
        return view('admin/cert/cert-show', compact('cert', 'cat', 'partner', 'pod_cat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = [
            'title' => $request->input('title'), 'category_id' => $request->input('id_main_cat'),
            'pod_cat' => $request->input('id_pod_cat'), 'conditions' => $request->input('conditions'),
            'description' => $request->input('description'), 'features' => $request->input('features'),
            'special1' => $request->input('special1'), 'special2' => $request->input('special2'),
            'special3' => $request->input('special3'), 'special4' => $request->input('special4'),
            'old_price' => $request->input('old_price'), 'economy' => $request->input('economy'),
            'image' => $request->input('photo1'), 'image2' => $request->input('photo2'),
            'image3' => $request->input('photo3'),
            'partner_id' => $request->input('id_partner'), 'date_start' => strtotime($request->input('date_start')),
            'date_end' => strtotime($request->input('date_end')), 'meta_description' => $request->input('meta_description'),
            'meta_keywords' => $request->input('meta_keywords'), 'sort' => $request->input('sort'),
            'cert_type' => $request->input('cert_type')
        ];

        $from = $_SERVER['DOCUMENT_ROOT'] . '/temp/';

        if(!empty($data['image'])){
            if(file_exists($from.$data['image'])){
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
        }
        if(!empty($data['image2'])){
            if(file_exists($from.$data['image2'])){
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
        }
        if(!empty($data['image3'])){
            if(file_exists($from.$data['image3'])){
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
        }
        $cert = Cert::find($id);
        $cert->update($data);
        return redirect('admin/certs')->with('message', 'Задания успешно обновлен');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cert = Cert::find($id);
        $path = $_SERVER['DOCUMENT_ROOT'] . '/uploads/certs/';
        $path_mini = $_SERVER['DOCUMENT_ROOT'] . '/uploads/certs/small/';
        if(!empty($cert->image)){
            if(file_exists($path.$cert->image)){
                $image = $path.$cert->image;
                unlink($image);
            }
            if(file_exists($path_mini.$cert->image)){
                $image_m = $path_mini.$cert->image;
                unlink($image_m);
            }
        }
        if(!empty($cert->image2)){
            if(file_exists($path.$cert->image2)){
                $image2 = $path.$cert->image2;
                unlink($image2);
            }
            if(file_exists($path_mini.$cert->image2)){
                $image2_m = $path_mini.$cert->image2;
                unlink($image2_m);
            }
        }
        if(!empty($cert->image3)){
            if(file_exists($path.$cert->image3)){
                $image3 = $path.$cert->image3;
                unlink($image3);
            }
            if(file_exists($path_mini.$cert->image3)){
                $image3_m = $path_mini.$cert->image3;
                unlink($image3_m);
            }
        }
        Cert::destroy($id);
        return redirect()->back()->with('message', 'Задания удален успешно');
    }
}
