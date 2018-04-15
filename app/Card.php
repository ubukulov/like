<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Card extends Model
{
    protected $fillable = [
        'id', 'user_id', 'number', 'code', 'protection_code', 'date', 'blocked', 'exported', 'price', 'vip', 'count_error'
    ];

    # Получить вес список карт
    public static function get(){
        $result = DB::table('cards')->orderBy("user_id", 'DESC')->paginate(30);
        return $result;
    }

    # Получить список вип карт
    public static function getVipCard(){
        $result = DB::table('cards')->where(['vip' => 1])->orderBy("user_id", 'DESC')->paginate(30);
        return $result;
    }

    # Если к пользователю не привязано карто то генерируется карта и привязывается автоматический
    public static function setCard($id_user){
        $card_number = rand(10000000,90000000);
        if(self::checkCardForUser($id_user)){
            if(self::checkCard($card_number)){
                Card::create([
                    'user_id' => $id_user, 'code' => $card_number, 'protection_code' => 0, 'blocked' => 0,
                    'exported' => 0, 'price' => 0, 'vip' => 0, 'count_error' => 0
                ]);
            }else{
                self::setCard($id_user);
            }
        }
    }

    #
    public static function checkCard($card_number){
        $result = DB::select("SELECT * FROM cards WHERE code='$card_number' AND exported = 0");
        $count = count($result);
        if($count == 0){
            return true;
        }else{
            return false;
        }
    }

    #
    public static function checkCardForUser($id_user){
        $result = Card::where(['user_id' => $id_user])->get();
        if(count($result) == 0){
            return true;
        }else{
            return false;
        }
    }
}
