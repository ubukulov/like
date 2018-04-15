<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskWork extends Model
{
    protected $fillable = [
        'id', 'id_user', 'id_task', 'title', 'text', 'link_to_work', 'status', 'created_at', 'image'
    ];
}
