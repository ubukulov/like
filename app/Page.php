<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'id', 'name_kz', 'name_ru', 'name_en', 'keywords', 'description', 'text', 'created_at', 'updated_at'
    ];
}
