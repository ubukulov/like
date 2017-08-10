<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OptPartner extends Model
{
    protected $table = 'opt_price_partners';

    protected $fillable = [
        'id', 'title', 'date_start', 'date_end', 'assortment', 'sort', 'conditions', 'features', 'description',
        'views', 'address', 'site', 'work_time', 'email', 'phone', 'logo', 'image1', 'image2', 'image3', 'created_at',
        'updated_at', 'username', 'password', 'fm', 'token'
    ];
}
