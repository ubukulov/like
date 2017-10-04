<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\News;
use Illuminate\Support\Facades\DB;
use App\SimpleImage;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = DB::table('news')->orderBy('created_at', 'DESC')->paginate(20);
        return view('admin/news/news-index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/news/news-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['image'] = $request->input('photo1');
        if(!empty($data['image'])){
            $from = $_SERVER['DOCUMENT_ROOT'] . '/temp/'.$data['image'];
            $to = $_SERVER['DOCUMENT_ROOT'] . '/uploads/news/'.$data['image'];

            // Вызываем класс
            $img = new SimpleImage();
            $img->load($from);
//            $img->fit_to_width(220); // В аргумент ширину картинки, которая нужна(Она пропорц. уменьш.)
//            $img->save($to);
            $img->adaptive_resize(220, 160);
            $img->save($to);
            unlink($from);
        }
        $data['created_at'] = date("Y-m-d H:i:s");
        News::create($data);
        return redirect('admin/news')->with('message', 'Успешно создано!');
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
        $news = News::find($id);
        return view('admin/news/news-edit', compact('news'));
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
        $data = $request->all();
        $data['image'] = $request->input('photo1');
        if(!empty($data['image']) AND file_exists($_SERVER['DOCUMENT_ROOT'] . '/temp/'.$data['image'])){
            $from = $_SERVER['DOCUMENT_ROOT'] . '/temp/'.$data['image'];
            $to = $_SERVER['DOCUMENT_ROOT'] . '/uploads/news/'.$data['image'];

            // Вызываем класс
            $img = new SimpleImage();
            $img->load($from);
//            $img->fit_to_width(220); // В аргумент ширину картинки, которая нужна(Она пропорц. уменьш.)
//            $img->save($to);
            $img->adaptive_resize(220, 160);
            $img->save($to);
            unlink($from);
        }
        $data['created_at'] = date("Y-m-d H:i:s");
        $news = News::find($id);
        $news->update($data);
        return redirect('admin/news')->with('message', 'Успешно обновлен!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $news = News::find($id);
        $path = $_SERVER['DOCUMENT_ROOT'] . '/uploads/news/';
        if(!empty($news->image)){
            if(file_exists($path.$news->image)){
                $image = $path.$news->image;
                unlink($image);
            }
        }
        News::destroy($id);
        return redirect()->back()->with('message', 'Новости удален успешно');
    }
}
