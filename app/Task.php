<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'id', 'title', 'text', 'id_cat', 'related_works', 'image', 'id_partner', 'created_at', 'updated_at'
    ];
}
