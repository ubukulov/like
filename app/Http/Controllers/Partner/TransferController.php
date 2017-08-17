<?php

namespace App\Http\Controllers\Partner;

use App\Partner;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\CertSub;
use Auth;
use App\User;
use App\PG_Signature;

class TransferController extends Controller
{
    protected $id_partner;
    protected $partner;

    public function __construct(){
        if(!$this->id_partner){
            $this->id_partner = Auth::guard('partner')->user()->id;
        }
        if(!$this->partner){
            $this->partner = Auth::guard('partner')->user();
        }
    }

    public function index(){
        $certs_sub = CertSub::getCertSub($this->id_partner, 2);
        $transactions = CertSub::getTransactions($this->id_partner);
//        print_array($transactions);
        return view('partner/transfer/index', compact('certs_sub', 'transactions'));
    }

    public function card($card_number){
        $card = check_card_by_number($card_number);
        $res = [];
        if($card){
            // если такая карта есть
            $user = getUserData($card[0]->user_id);
            if ($user->firstname) {
                $user_name = $user->firstname;
            }
            if ($user->lastname) {
                $user_name = $user->firstname. ' ' . $user->lastname;
            }
            $res['user_name'] = $user_name;
            $res['avatar'] = $user->avatar;
            $res['mphone'] = '************'.substr($user->mphone, 13, 5);
            if(is_tariff($user->id)){
                $res['is_active'] = 1;
                $res['active'] = "Активирован";
                $res['active_time'] = date("d-m-Y",get_deadline_tariff($user->id));
            }else{
                $res['is_active'] = 0;
                $res['active'] = "Неавтивирован";
                $res['active_time'] = "Срок истек";
            }
        }else {
            $res['message'] = 'Карта не найдена!';
        }

        echo json_encode($res);
    }

    # начисление процента к испольнителю
    public function transfer_percent(){
        $res = [];
        $card_number = $_POST['card_code'];
        //получаем данные карты
        $card = check_card_by_number($card_number);

        //получаем данные партнера
        $partner = $this->partner;
        //если есть карта
        if ($card) {
            $user = getUserData($card[0]->user_id);
            //проверяем прикрепленали карта к какомуто пользлвателю
            if ($user->id) {
                //проверяем не заблокированали карта
                if (!$card[0]->blocked) {
                    if ($user->firstname) {
                        $user_name = $user->firstname . ' ' . $user->lastname;
                    }
                    $res['user_name'] = $user_name;
//                    $fm = (int) __decode($user->fm, env('KEY'));
//                    $total = (int) $_POST['total'];
//                    //$limit = (int) $partner['limit'];
//                    $max_sum = (int) $partner->max_sum;
                    $sum_total = 0;

                    foreach ($_POST['sub'] as $key => $sub) {

                        if ($sub['sum_vvod']) {
                            $cert_sub = CertSub::getCertSubOne($sub['id']);
                            //сумма каторая показывается
                            $sum = $sub['sum_vvod'] - ($sub['sum_vvod'] * $cert_sub[$key]->percent / 100);

                            $sum_nachislen = $sum * $cert_sub[$key]->price / 100;

                            $sum_minus = $sum * $cert_sub[$key]->price_minus / 100;
                            //Добавляем в статистику
                            User::add_pay_to_user($partner->id, $cert_sub[$key]->cert_id, $sub['id'], $card[0]->code, $card[0]->user_id, $sum_nachislen, $sum_minus, 1, $cert_sub[$key]->type);
//                            //прибавляем бонус
//                            if ($user['referral']) {
//                                // $CMS->add_bonus_user_add_sum($cert_sub['cert_id'], $sum, $user['referral'], $user['id']);
//                            }
                            $sum_total = $sum_nachislen + $sum_total;
                        }
                    }
                    $fm = (int) __decode($user->fm, env('KEY'));
                    $date = date("d.m.Y");

                    $sms_text = "Voznagrazhdenie $sum_total tg ot $partner->name_sms. Data postupleniya: $date g. Ostatok na shete: $fm tg.";

                    //$sms_text = "Vy oplatili za $sub[quantity] $type: $sum KZT. Kompania: $partner[name]. Ostatok na karte: $fm KZT";

//                    sendSms($user->mphone, $sms_text);

                    $res['code'] = 0;
                    $res['message'] = 'Вознаграждение успешно начислено!';
                    //$res['fm'] = $fm;
                    //$res['id'] = $user['id'];
//                    $res['total'] = CertSub::count_total($_POST['sub']);
//                    $res['all_quantity'] = CertSub::count_all_quantity($_POST['sub']);
                } else {
                    //карта заблокирована
                    $res['code'] = 3;
                    $res['message'] = 'Карта заблокирована администрацией Kipacard';
                }
            } else {
                //Карта не принадлежит никакому пользователю
                $res['code'] = 3;
                $res['message'] = 'Карта не принадлежит никакому пользователю';
            }
        } else {
            $res['code'] = 3;
            $res['message'] = 'Карта указана неверно';
        }
        
        echo json_encode($res);
    }
    
    # форма пополнение счета
    public function payment(){
        return view('partner/payment');
    }

    # оплата
    public function replenish(Request $request){
        //
    }
}