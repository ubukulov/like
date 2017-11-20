<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cert extends Model
{
    protected $fillable = [
        'id', 'title', 'category_id', 'pod_cat', 'conditions', 'description', 'features', 'special1', 'special2',
        'special3', 'special4', 'old_price', 'economy', 'image', 'image2', 'image3', 'purchased', 'partner_id',
        'partner', 'partner_email', 'partner_address', 'partner_hours', 'partner_phone', 'date_start', 'date_end',
        'periodicity', 'period_start', 'period_end', 'period_count', 'coords', 'zoom', 'meta_description',
        'meta_keywords', 'sort', 'views', 'cert_type', 'created_at', 'updated_at', 'article_code', 'b1', 'b2', 'b3', 'prime_cost',
        'count'
    ];

    # Получить список задании по условии срока
    public static function get(){
        $mk_date = time();
        $result = DB::select("SELECT * FROM certs WHERE conditions <> '' AND image <> '' ORDER BY sort,id DESC");
        return $result;
    }

    # Получить список задании без условия
    public static function getNotWhere(){
        $result = DB::table('certs')->orderBy("id", 'DESC')->paginate(30);
        return $result;
    }
    
    # Получить данные по ид
    public static function getByIdCertData($id){
        $cert = Cert::find($id);
        return $cert;
    }

    # Получить список задании определенного партнера
    public static function getCertOfPartner($id_partner){
        $result = DB::table('certs')->where(['partner_id' => $id_partner])->paginate(10);
        return $result;
    }
    
    # Посчитать кол-во задании партнера
    public static function countCertOfPartner($id_partner){
        return count(Cert::where(['partner_id' => $id_partner])->get());
    }

    // Подсчитываем общую сумму
    public static function get_offer($arr){
        $total_sum = 0;
        $str = implode(",", array_keys($arr));
        $sql = "SELECT * FROM certs WHERE id IN($str)";
        $result = DB::select($sql);
        if(count($result) > 0){
            foreach($result as $key=>$val){
                $_SESSION['cart'][$result[$key]->id]['title'] = $result[$key]->title;
                $_SESSION['cart'][$result[$key]->id]['price'] = $result[$key]->special2;
                $_SESSION['cart'][$result[$key]->id]['img']   = $result[$key]->image;
                $_SESSION['cart'][$result[$key]->id]['id']    = $result[$key]->id;
                if(isset($_SESSION['cart'][$result[$key]->id]['opt_price'])){
                    $total_sum += $_SESSION['cart'][$result[$key]->id]['qty'] * $_SESSION['cart'][$result[$key]->id]['opt_price'];
                }else{
                    $total_sum += $_SESSION['cart'][$result[$key]->id]['qty'] * $result[$key]->special2;
                }
            }
            return $total_sum;
        }
    }

    # пересчитаем корзину
    public static function counted_cart_bus($id_item, $qty){
        $qty = $qty - $_SESSION['cart'][$id_item]['qty'];
        if(array_key_exists($id_item, $_SESSION['cart'])){
            $_SESSION['cart'][$id_item]['qty'] += $qty;
        }else{
            $_SESSION['cart'][$id_item]['qty'] = 1;
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
}
