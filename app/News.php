<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class News extends Model
{
    protected $fillable = [
        'id', 'title', 'keywords', 'description', 'content', 'publish', 'image','created_at', 'updated_at'
    ];
}