<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class BaseController extends Controller
{
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
        if($category['parent'] == 0){
            $menu .= '<a href="/cat/'. $category['id'] .'" title="'. $category['title'] .'">'.
                $category['title'].'</a>';
        }else{
            $menu .= '<a href="/pod_cat/'. $category['id'] .'" title="'. $category['title'] .'">'.
                $category['title'].'</a>';
        }


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

    public function getCat(){
        //$result = DB::table('cats')->get();
        $result = DB::select("SELECT CC.*, (SELECT COUNT(*) FROM certs CT WHERE CT.cert_type=2 AND CT.pod_cat=CC.id) AS cnt FROM cats CC");
        $result = collect($result)->map(function($x){ return (array) $x; })->toArray();
        $cat = array();

        foreach($result as $val){
//            if($val['cnt'] != 0){
//                $cat[$val['id']] = $val;
//            }
            $cat[$val['id']] = $val;
        }

        return $cat;
    }
}
