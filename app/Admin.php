<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;

class Admin extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'username', 'password', 'fio', 'role', 'hash', 'id_tochka', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function role($role){
        $id_user = Auth::guard('admin')->user()->id;
        $result = Admin::where(['id' => $id_user, 'role' => $role])->first();
        if($result){
            return true;
        }
    }
}
