<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskType extends Model
{
    protected $fillable = [
        'id', 'name_ru', 'created_at', 'updated_at'
    ];
}
