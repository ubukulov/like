<?php

namespace App\Http\Controllers;

use App\CertSub;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\DB;

class CartController extends BaseController
{
    protected $id_user;

    public function __construct(){
        if(Auth::check()){
            $this->id_user = Auth::user()->id;
        }
    }

    # корзина
    public function index(){
//        dd($_SERVER['REQUEST_URI']);
        //print_array($_SESSION['cart']);
        return view('cart/index');
    }

    # добавляем товар и переходим к оформление
    public function add($offer_id){
        $this->set($offer_id);
        return redirect('cart');
    }

    # удаление товара из корзины
    public function delete($offer_id){
        if(array_key_exists($offer_id, $_SESSION['cart'])){
            $_SESSION['total_sum'] -= $_SESSION['cart'][$offer_id]['qty'] * $_SESSION['cart'][$offer_id]['price'];
            $_SESSION['total_quantity'] -= $_SESSION['cart'][$offer_id]['qty'];
            unset($_SESSION['cart'][$offer_id]);
            return redirect()->back();
        }
    }

    # пересчитать корзину
    public function count($offer_id, $qty){
        $result = CertSub::counted_cart_bus($offer_id, $qty);
        return json_encode($result);
    }

    # положить товар в корзину
    public function set($offer_id){
        $offer_id = (int) $offer_id;
        if($offer_id != 0){
            if(isset($_SESSION['cart'][$offer_id])){

                $_SESSION['cart'][$offer_id]['qty'] += 1;
            }else{
                $_SESSION['cart'][$offer_id]['qty'] = 1;
            }
        }
        $arr = $_SESSION['cart'];
        foreach($arr as $key => $val){
            if(empty($key)){
                unset($arr[$key]);
            }
        }
        $_SESSION['total_sum'] = CertSub::get_offer($arr);
        $_SESSION['total_quantity'] = 0;
        foreach($_SESSION['cart'] as $key=>$val){
            if(isset($val['price'])){
                $_SESSION['total_quantity'] += $val['qty'];
            }else{
                unset($_SESSION['cart'][$key]);
            }
        }
    }

    public function add_to_cart($offer_id){
        $this->set($offer_id);
        return 1;
    }

    public function order(Request $request){
        $data = $request->all();
        $customer_id = $this->setBusinessCustomers($data);
        if($customer_id){
            $this->setBusinessCustomerOrder($_SESSION['cart'], $customer_id, $data);
            unset($_SESSION['cart']);
            return redirect('/cart')->with('message', 'Поздравляем! Ваш заказ оформлен!');
        }
    }

    # Сохраняем данные клиента cart
    public function setBusinessCustomers($data){
        if($this->business_check_user_balance($this->id_user, $_SESSION['total_sum'])){
            $email  = $data['email'];
            $phone  = $data['phone'];
            $current_date = date("Y-m-d H:i:s");
            $customer = $this->is_business_customer($phone);
            if($customer){
                return $customer;
            }else {
                $lastInsertId = DB::table('business_customers')->insertGetId([
                    'client_email' => $email, 'client_phone' => $phone, 'created_at' => $current_date, 'updated_at' => $current_date
                ]);
                if($lastInsertId){
                    return $lastInsertId;
                }else{
                    dd("По каким то причинам не удалось сохранить");
                    exit();
                }
            }
        }else{
            dd("У пользователя не достаточно баланс.");
        }
    }

    # Проверяем баланс агента
    public function business_check_user_balance($user_id, $sum){
        $user = getUserData($user_id);
        $fm = __decode($user->fm, env('KEY'));
        if($fm >= $sum){
            return true;
        }else{
            return false;
        }
    }

    # Определить клиента на предыдующего обращение. Если клиент уже есть в базе возращаем его идентификатора
    # Проверка осуществляется по телефон номеру
    public function is_business_customer($phone){
        $result = DB::select("SELECT * FROM business_customers WHERE client_phone='$phone'");
        if(count($result) > 0){
            return $result[0]->id;
        }else{
            return false;
        }
    }

    # Сохраняем заказы клиента
    public function setBusinessCustomerOrder($cert, $customer_id, $data){
        $client_ip = $_SERVER['REMOTE_ADDR'];
        $sms_code = strtoupper(generateCode(6));
        $current_date = date("Y-m-d H:i:s");
        $total_sum = $_SESSION['total_sum'];
        $payment_type = $data['status'];
        $address = $data['address'];
        $customer = $this->getBusinessCustomerData($customer_id);
        foreach($cert as $key=>$val){
            $title = $val['name'];
            $qty   = $val['qty'];
            $price = $val['price'];
            // Отнимаем кол-во предложение
            CertSub::setCertSubCount($key, $qty);
            // Отправляем смс клиенту
            $cert_id = CertSub::getTaskByOffer($key);
            $name_sms = CertSub::getPartnerByOffer($key);
            $sms_text = "SC-code: ".$sms_code.". ".$name_sms." (".parent::set_transliterator($title)."). Podrobnee: likemoney.me/cert/".$cert_id;
            sendSms($customer[0]->client_phone, $sms_text);

            $sql = "INSERT INTO business_sell_offers(customer_id,offer_id,agent_id,title,qty,price,payment_type,ip,sms_code,address,created_at,updated_at)
                              VALUES('$customer_id','$key','$this->id_user','$title','$qty','$price','$payment_type','$client_ip','$sms_code','$address','$current_date','$current_date')";
            DB::insert($sql);
        }
        // Снимаем деньги со счета агента
        $desc = "Снятие денег на сумму: ".$total_sum." тг";
        User::user_fm_minus($this->id_user,$total_sum,$desc);

        // Деньги положим на счет компании и фиксируем движение
        $text = "Покупка предложение";
        $this->setBusinessAccount($total_sum);
        $this->setBusinessAccountHistory($this->id_user,$text,$total_sum);
    }

    # По ид клиента получаем его сотовый номер
    public function getBusinessCustomerData($id){
        $result = DB::select("SELECT * FROM business_customers WHERE id='$id'");
        if(count($result) > 0){
            return $result;
        }else{
            dd("Не удалось получить данные клиента");
        }
    }

    # Фиксируем движение
    public function setBusinessAccountHistory($id,$title,$sum,$type=1){
        $current_date = date("Y-m-d H:i:s");
        if($type == 1){
            // агент
            $sql = "INSERT INTO business_account_history(agent_id, title, summ, created_at) VALUES('$id', '$title', '$sum','$current_date')";
            DB::insert($sql);
        }
        if($type == 2){
            // партнер
            $sql1 = "INSERT INTO business_account_history(partner_id, title, summ, created_at) VALUES('$id', '$title', '$sum','$current_date')";
            DB::insert($sql1);
        }

    }
    # Положим деньги на счет компании
    public function setBusinessAccount($sum){
        $result = DB::select("SELECT * FROM business_account WHERE id=1");
        $balance = $result[0]->balance + $sum;
        DB::update("UPDATE business_account SET `balance` = '$balance' WHERE id=1");
    }

    # оформление заказа
    public function checkout(){
        return view('cart/checkout');
    }
}
