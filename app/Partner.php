<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;

class Partner extends Authenticatable
{
    protected $fillable = [
        'id', 'name', 'name_sms', 'phone', 'mphone', 'address', 'username', 'password', 'email', 'hours', 'coords', 'token',
        'type', 'max_sum', 'percent_proizvol_sum', 'image', 'percent_bonus', 'fm', 'referral', 'remember_token',
        'created_at', 'updated_at'
    ];

    public static function get(){
        $result = DB::table('partners')->orderBy("id", 'DESC')->paginate(30);
        return $result;
    }
    
    # По ид партнера получить данные
    public static function getByIdPartnerData($id){
        $partner = Partner::findOrFail($id);
        return $partner;
    }

    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function partner_fm_plus($id_partner, $amount, $description = '') {

        $id_partner = (int) $id_partner;
        $mktime = time();
        $partner = Partner::find($id_partner);
        $partner_fm = __decode($partner->fm, env('KEY')) + (int) $amount;
        $partner->fm = __encode($partner_fm, env('KEY'));
        $partner->save();
        
        DB::insert("INSERT INTO partner_fm_history (id_partner, type, amount, description, date)
                VALUES('$id_partner','+','$amount','$description','$mktime')");
    }

    public static function partner_fm_minus($id_partner, $amount, $description = '') {

        $id_partner = (int) $id_partner;
        $amount = (int) $amount;
        $mktime = time();

        $partner = Partner::find($id_partner);

        $partner_fm = __decode($partner->fm, env('KEY'));
        if($partner_fm == 0){
            // баланс равно 0
            $partner_fm = -$amount;
            $partner_fm = __encode($partner_fm, env('KEY'));
            DB::update("UPDATE partners SET fm='$partner_fm' WHERE id='$id_partner'");
        }
        if($partner_fm>=$amount){
            $partner_fm -= $amount;
            $partner_fm = __encode($partner_fm, env('KEY'));
            DB::update("UPDATE partners SET fm='$partner_fm' WHERE id='$id_partner'");
        }
        if($partner_fm < 0){
            $partner_fm -= $amount;
            $partner_fm = __encode($partner_fm, env('KEY'));
            DB::update("UPDATE partners SET fm='$partner_fm' WHERE id='$id_partner'");
        }

        DB::insert("INSERT INTO partner_fm_history (id_partner, type, amount, description, date)
                VALUES('$id_partner','-','$amount','$description','$mktime')");
    }

    public static function partner_gift_history($id_partner,$id_user,$gift_name,$sms_code){
        DB::insert("INSERT INTO task_gift_history(id_user,id_partner,name_ru,sms_code,created_at)
        VALUES('$id_user','$id_partner','$gift_name','$sms_code', CURRENT_TIMESTAMP())");
    }

    # paybox
    public static function paybox_set_order($amount) {
        $partner = Auth::guard('partner')->user();
        $id_partner = $partner->id;

        if ($id_partner) {
            $amount = (int) $amount;
            $mktime = time();
//            $sql = "INSERT INTO partner_paybox_payment (amount, date, id_partner)
//                VALUES('$amount','$mktime','$id_partner')";
            $lastInsertId = DB::table('partner_paybox_payment')->insertGetId([
                'amount' => $amount, 'date' => $mktime, 'id_partner' => $id_partner
            ]);

            return $lastInsertId;
        } else {
            die('partner_token error');
        }
    }
}
