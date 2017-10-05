<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Cache;

class NewsController extends Controller
{
    public function index(){
        $news = DB::table('news')
            ->select(DB::raw('id, title, description, image, DATE_FORMAT(created_at, "%e.%m.%Y") AS dt'))
            ->orderBy('created_at', 'DESC')->paginate(20);
        return view('news/news-index', compact('news', 'cat_menu'));
    }

    public function show($id){
        $id = (int) $id;
        $news = News::find($id);
        return view('news/news-show', compact('news'));
    }
}
