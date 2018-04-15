<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Page;

class PageController extends Controller
{

    public function get($id){
        $id = (int) $id;
        $page = Page::findOrFail($id);
        return view('page/want_store', compact('page'));
    }
}
