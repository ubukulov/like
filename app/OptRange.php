<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OptRange extends Model
{
    protected $table = 'opt_price_range';

    protected $fillable = [
        'id', 'title', 'price_range', 'price_range_val', 'photo', 'id_partner', 'created_at'
    ];
}
