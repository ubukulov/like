<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OptMain extends Model
{
    protected $table = 'opt_price_main';

    protected $fillable = [
        'id', 'title', 'count_type', 'id_partner', 'file', 'created_at'
    ];
}
