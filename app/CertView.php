<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CertView extends Model
{
    public $table = 'cert_views';

    protected $fillable = [
        'id', 'ip', 'id_cert', 'created_at', 'updated_at'
    ];

    public static function exists($ip){
        $result = CertView::where('ip', '=', $ip)->get();
        if(count($result) > 0){
            return true;
        }else{
            return false;
        }
    }

    public static function limit($current_date){
        $updated_at = CertView::where('ip', '=', $_SERVER['REMOTE_ADDR'])->get();
        $sec1 = strtotime($updated_at[0]->updated_at);
        $sec2 = strtotime($current_date);
        $sec = (int) round($sec2-$sec1);
        return $sec;
    }
}
