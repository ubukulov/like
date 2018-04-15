<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OptCat extends Model
{
    protected $table = 'opt_cat';

    protected $fillable = [
        'id', 'title', 'position', 'parent_id'
    ];
}
