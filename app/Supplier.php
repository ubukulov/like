<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'id', 'title', 'phone', 'email', 'address', 'address', 'created_at', 'updated_at'
    ];
}
