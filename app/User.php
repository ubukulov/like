<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use App\Partner;

class User extends Authenticatable
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        # 'name', 'email', 'password',
        'id', 'role', 'firstname', 'lastname', 'sms_code', 'sms_date', 'hash', 'fio', 'city', 'sex', 'reg_date',
        'pass', 'email', 'card', 'mphone', 'avatar', 'bonuses', 'fm', 'bonus', 'birthday', 'private_key',
        'actived', 'banned', 'export_to_xls', 'referral', 'mini_ofis', 'cards_count'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    # Список всех пользователей
    public static function get(){
        $result = DB::table('users')->orderBy("id", 'DESC')->paginate(30);
        return $result;
    }

    # метод по работе с балансом
    public static function user_fm_plus($id_user, $amount, $desc = '',$is_task = 0){
        $user = User::find($id_user);
        $mktime = time();
        global $money;
        $money = $amount;
        if(!empty($user->referral)){
            $id_referral = $user->referral;
            $referral = User::find($id_referral);
            if($referral){
                $ten = $amount*0.1;
                $referral_balance = __decode($referral->fm, env('KEY')) + $ten;
                $referral->fm = __encode($referral_balance, env('KEY'));
                $referral->save();
                DB::insert("INSERT INTO user_fm_history (id_user, type, amount, description, date, is_task)
                VALUES('$id_referral','+','$ten','10% от реферала $id_user','$mktime', '$is_task')");
                $money = $money - $ten;
            }
        }
        DB::insert("INSERT INTO user_fm_history (id_user, type, amount, description, date, is_task)
                VALUES('$id_user','+','$money','$desc','$mktime', '$is_task')");
        
        $user_balance = __decode($user->fm, env('KEY')) + (int) $money;
        $user->fm = __encode($user_balance, env('KEY'));
        $user->save();
    }

    public static function user_fm_minus($id_user, $amount, $desc = ''){
        $user = User::find($id_user);
        $mktime = time();
        DB::insert("INSERT INTO user_fm_history (id_user, type, amount, description, date)
                VALUES('$id_user','-','$amount','$desc','$mktime')");

        $user_balance = __decode($user->fm, env('KEY')) - (int) $amount;
        $user->fm = __encode($user_balance, env('KEY'));
        $user->save();
    }

    # Подсчитаем кол-во доход агента за сегодня, неделю и месяц
    public static function get_count_sum_agent($id_user, $param=1){
        switch ($param){
            // за сегодня
            case 1:
                $result = DB::select("SELECT SUM(amount) AS summ FROM user_fm_history WHERE id_user='$id_user' AND type='+' AND DATE_FORMAT(FROM_UNIXTIME(date),'%Y-%m-%d')=CURDATE()");
                if($result[0]->summ != NULL){
                    return $result[0]->summ;
                }else{
                    return 0;
                }
                break;
            // за неделю
            case 2:
                $result = DB::select("SELECT SUM(amount) AS summ FROM user_fm_history WHERE id_user='$id_user' AND type='+' AND YEAR(FROM_UNIXTIME(date))=YEAR(NOW()) AND WEEK(FROM_UNIXTIME(date),1)=WEEK(NOW(),1)");
                if($result[0]->summ != NULL){
                    return $result[0]->summ;
                }else{
                    return 0;
                }
                break;
            // за текующее месяц
            case 3:
                $result = DB::select("SELECT SUM(amount) AS summ FROM user_fm_history WHERE id_user='$id_user' AND type='+' AND MONTH(FROM_UNIXTIME(date))=MONTH(NOW()) AND YEAR(FROM_UNIXTIME(date))=YEAR(NOW())");
                if($result[0]->summ != NULL){
                    return $result[0]->summ;
                }else{
                    return 0;
                }
                break;
        }
    }

    # определяем по номер телефону существует ли пользователь или нет
    public static function check_user_by_phone($phone){
        $result = User::where(['mphone' => $phone])->first();
        if($result){
            return false;
        }else{
            return true;
        }
    }

    # добавляем начисление пользователю
    public static function add_pay_to_user($partner_id, $cert_id, $cert_sub_id, $card, $user_id, $sum, $sum_minus, $count, $status,$sms_code = 0) {
        $cert_id = (int) $cert_id;
        $cert_sub_id = (int) $cert_sub_id;
        $sum = (int) $sum;
        $sum_minus = (int) $sum_minus;
        $count = (int) $count;
        $status = (int) $status;
        $date = time();
        $user_id = (int) $user_id;

        //добавляем в статистику
        $sql = "INSERT INTO pay_to_user (partner_id, cert_id, cert_sub_id, card, user_id, sum, sum_minus, count, status, date, sms_code)
                VALUES('$partner_id','$cert_id','$cert_sub_id','$card','$user_id','$sum', '$sum_minus', '$count','$status','$date','$sms_code')";
        DB::insert($sql);


        $partner = getPartner($partner_id);
        $partner_balance = __decode($partner->fm, env('KEY'));
        //если у партнера достаточно средств то начисляем
        if($partner_balance >= $sum_minus){
            // снимаем с баланса партнера
            Partner::partner_fm_minus($partner_id,$sum_minus, "Начисление вознаграждение");
            User::user_fm_plus($user_id,$sum, "Начислиние вознаграждения");
        }else{
            // если не достаточна баланс у партнера, то деньги будут в ожидании у испольнителя
            self::user_fm_plus_v_ojidanii($user_id, $partner_id, $sum, 'Начислиние вознаграждения. В ожидании.');
        }

        return TRUE;
    }

    # метод
    public static function user_fm_plus_v_ojidanii($id_user, $id_partner_from, $amount, $description = '', $offer_id=0) {
        $id_user = (int) $id_user;
        $amount = (int) $amount;
        $mktime = time();
        $sql = "INSERT INTO user_fm_history (id_user, id_partner_from, type, amount, description, date, offer_id)
                VALUES('$id_user','$id_partner_from','?','$amount','$description','$mktime','$offer_id')";
        DB::insert($sql);
    }

    # посчитаем суммы которые стоит в ожидании
    public static function count_user_balanse_v_ojidanii($id_user) {
        $sql = "SELECT SUM(amount) as all_amount FROM user_fm_history WHERE id_user = '$id_user' AND type='?'";
        $result = DB::select($sql);
        return (int) $result[0]->all_amount;
    }
}
