<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = [
        'id', 'title', 'type', 'sort', 'meta_description', 'meta_keywords'
    ];
    
    public static function get(){
        $result = Category::all();
        return $result;
    }
}
