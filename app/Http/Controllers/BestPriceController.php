<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Cache;
use Illuminate\Support\Facades\DB;

class BestPriceController extends BaseController
{
    public function index(){
        if(Cache::has('cat_menu')){
            $cat_menu = Cache::get('cat_menu');
        }else{
            $tree = parent::getTree(parent::getCat());
            $cat_menu = parent::showCat($tree);
            Cache::put('cat_menu', $cat_menu, 30);
        }
        $certs = DB::select("SELECT * FROM certs WHERE is_best_price=1 AND conditions <> '' AND image <> '' ORDER BY updated_at DESC LIMIT 32");
        return view('best_price', compact('certs', 'cat_menu'));
    }
}
