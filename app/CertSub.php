<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CertSub extends Model
{
    public $table = 'certs_sub';

    protected $fillable = [
        'id', 'cert_id', 'title', 'price', 'type', 'price_minus', 'purchased', 'limit', 'percent', 'com_service', 'com_agent', 'com_partner',
        'deadline', 'created_at', 'updated_at'
    ];

    public static function getCertSub($id_partner, $type){
        $result = DB::select("SELECT certs_sub.*
                FROM certs_sub
                LEFT JOIN certs
                ON certs.id = certs_sub.cert_id
                WHERE certs.partner_id = '$id_partner' AND type='$type'");
        return $result;
    }

    public static function getTransactions($id_partner){
        $result = DB::table('pay_to_user')
            ->select('pay_to_user.*', 'certs_sub.title')
            ->leftJoin('certs_sub', 'certs_sub.id', '=', 'pay_to_user.cert_sub_id')
            ->where('pay_to_user.partner_id', '=', $id_partner)
            ->orderBy('pay_to_user.id', 'DESC')
            ->paginate(10);
        return $result;
    }

    # получить по ид данные
    public static function getCertSubOne($cert_sub_id){
        $result = DB::table('certs_sub')->where(['id' => $cert_sub_id])->get();
        return $result;
    }

    public static function count_total($subs = array()) {
        $total = 0;
        foreach ($subs as $key => $sub) {
            $price_sub = self::getCertSubOne($sub['id']);
            $total += $price_sub[$key]->price * $sub['quantity'];
        }
        return $total;
    }

    public static function count_all_quantity($subs = array()) {
        $quantity = 0;
        foreach ($subs as $key => $sub) {
            $quantity += $sub['quantity'];
        }
        return $quantity;
    }
}