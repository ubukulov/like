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

    public function get_transliterator($string) {
        $converter = array(
            'а' => 'a',   'б' => 'b',   'в' => 'v',
            'г' => 'g',   'д' => 'd',   'е' => 'e',
            'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
            'и' => 'i',   'й' => 'y',   'к' => 'k',
            'л' => 'l',   'м' => 'm',   'н' => 'n',
            'о' => 'o',   'п' => 'p',   'р' => 'r',
            'с' => 's',   'т' => 't',   'у' => 'u',
            'ф' => 'f',   'х' => 'h',   'ц' => 'c',
            'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
            'ь' => '\'',  'ы' => 'y',   'ъ' => '\'',
            'э' => 'e',   'ю' => 'yu',  'я' => 'ya',

            'А' => 'A',   'Б' => 'B',   'В' => 'V',
            'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
            'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',
            'И' => 'I',   'Й' => 'Y',   'К' => 'K',
            'Л' => 'L',   'М' => 'M',   'Н' => 'N',
            'О' => 'O',   'П' => 'P',   'Р' => 'R',
            'С' => 'S',   'Т' => 'T',   'У' => 'U',
            'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
            'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',
            'Ь' => '\'',  'Ы' => 'Y',   'Ъ' => '\'',
            'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
        );
        return strtr($string, $converter);
    }
    public function set_transliterator($str) {
        // переводим в транслит
        $str = $this->get_transliterator($str);
        // в нижний регистр
        //$str = strtolower($str);
        // заменям все ненужное нам на "-"
        $str = preg_replace('~[^-a-zA-Z0-9_.]+~u', ' ', $str);
        // удаляем начальные и конечные '-'
        $str = trim($str, "-");
        return ucfirst($str);
    }
}
