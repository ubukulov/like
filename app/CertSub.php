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

    //выбираем все предложения
    public static function get_cert_subs($cert_id) {
        $result = CertSub::where(['cert_id' => $cert_id])->get();
        return $result;
    }

    // Подсчитываем общую сумму
    public static function get_offer($arr){
        $total_sum = 0;
        $str = implode(",", array_keys($arr));
        $sql = "SELECT * FROM certs_sub WHERE id IN($str)";
        $result = DB::select($sql);
        if(count($result) > 0){
            foreach($result as $key=>$val){
                $_SESSION['cart'][$result[$key]->id]['name'] = $result[$key]->title;
                $_SESSION['cart'][$result[$key]->id]['price'] = $result[$key]->price;
                $total_sum += $_SESSION['cart'][$result[$key]->id]['qty'] * $result[$key]->price;
            }
            return $total_sum;
        }
    }

    # пересчитаем корзину
    public static function counted_cart_bus($offer, $qty){
        $qty = $qty - $_SESSION['cart'][$offer]['qty'];
        if(array_key_exists($offer, $_SESSION['cart'])){
            $_SESSION['cart'][$offer]['qty'] += $qty;
        }else{
            $_SESSION['cart'][$offer]['qty'] = 1;
        }
        self::total_quantity();
        $_SESSION['total_sum'] = self::get_offer($_SESSION['cart']);
        return 1;
    }

    # Кол-во товаров в корзине
    public static function total_quantity(){
        $_SESSION['total_quantity'] = 0;
        foreach($_SESSION['cart'] as $key=>$value){
            if(isset($value['price'])){
                $_SESSION['total_quantity'] += $value['qty'];
            }else{
                unset($_SESSION['cart'][$key]);
            }
        }
    }

    # После покупка пересчитываем кол-во предложение
    public static function setCertSubCount($id, $qty){
        $result = DB::select("SELECT * FROM certs_sub WHERE id='$id'");
        $count = $result[0]->limit - $qty;
        $purchased = $result[0]->purchased + $qty;
        DB::insert("UPDATE certs_sub SET `limit` = '$count', `purchased` = '$purchased' WHERE id='$id'");
    }

    # По оффер ид получить акции партнера
    public static function getTaskByOffer($offer_id){
        $result = DB::select("SELECT cert_id FROM certs_sub WHERE id='$offer_id'");
        return $result[0]->cert_id;
    }

    # По ид оффера получить название партнера
    public static function getPartnerByOffer($offer_id){
        $result = DB::select("SELECT P.name_sms FROM certs C
                    LEFT JOIN certs_sub CS ON CS.cert_id=C.id
                    LEFT JOIN partners P ON P.id=C.partner_id
                    WHERE CS.id='$offer_id'");
        return $result[0]->name_sms;
    }
}