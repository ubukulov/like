<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Cache;
use App\Cert;
use App\CertView;
use App\CertSub;
use App\Partner;
use Illuminate\Support\Facades\DB;
use Auth;

class StoreController extends Controller
{
    protected $clientId = "d9cd15eaac63b4a47ef568dd268717";
    protected $clientSecret = "d850e7fae59786b948dc1c777d3ba3";

    protected $website_likemoney_id = 479947;
    # protected $website_admotionz_id = 525788;

    public function index(){
        if(Cache::has('ad_offers')){
            $ad_offers = Cache::get('ad_offers');
        }else{
            $api = new \Admitad\Api\Api();
            $scope = 'advcampaigns_for_website';

            $authorizeResult = $api->authorizeClient($this->clientId, $this->clientSecret, $scope)->getArrayResult();
            $api = new \Admitad\Api\Api($authorizeResult['access_token']);

            $ad_offers = $api->get("/advcampaigns/website/{$this->website_likemoney_id}/", array(
                'connection_status' => 'active', 'limit' => 500
            ))->getArrayResult();
            $offers = array();
            if(Cache::has('country_code')){
                foreach($ad_offers['results'] as $key=>$value){
                    foreach($value['regions'] as $k=>$v){
                        if($v['region'] == Cache::get('country_code')){
                            $offers['results'][] = $value;
                        }
                    }
                }
                Cache::put('ad_offers', $offers, 30);
                $ad_offers = $offers;
            }else{
                Cache::put('ad_offers', $ad_offers, 30);
            }
        }
        $title = $this->title." Магазин";
        return view('store/index', compact('ad_offers','title'));
    }

    # Список купонов по выбранного оффера
    public function coupon($id_offer){
        $id_offer = (int) $id_offer;
        $api = new \Admitad\Api\Api();
        $scope = 'coupons_for_website advcampaigns advcampaigns_for_website';
        $authorizeResult = $api->authorizeClient($this->clientId, $this->clientSecret, $scope)->getArrayResult();
        $api = new \Admitad\Api\Api($authorizeResult['access_token']);
        $ad_coupons = $api->get("/coupons/website/{$this->website_likemoney_id}/", array(
            'status' => 'active', 'limit' => 100, 'campaign' => $id_offer
        ))->getArrayResult();
        $offer = $api->get("/advcampaigns/{$id_offer}/website/{$this->website_likemoney_id}/", array(
            'status' => 'active'
        ))->getArrayResult();
        return view('store/coupon', compact('ad_coupons', 'offer'));
    }

    # Отделная страница офлайн задании
    public function item($id){
        $id = (int) $id;
        if(!$id){
            $id = 3;
        }
        $_SESSION['REQUEST_URI'] = $_SERVER['REQUEST_URI'];
        $cert = Cert::getByIdCertData($id);
        $ip = $_SERVER['REMOTE_ADDR']; // Ип адрес пользователя
        $current_date = date("Y-m-d H:i:s"); // текущая время
        // просмотр данного страницы
        if(!CertView::exists($ip)){
            // пользователь первый раз заходит к нам
            CertView::create([
                'ip' => $ip, 'id_cert' => $id, 'created_at' => $current_date
            ]);
            $cert->views += 1;
            $cert->save();
        }
        if(CertView::limit($current_date) >= 86400){
            // прошел 1 день
            $cert_view = CertView::findOrFail(get_id_wrapping($ip));
            $cert_view->updated_at = $current_date;
            $cert_view->save();
            $cert->views += 1;
            $cert->save();
        }
        $certs_sub = CertSub::get_cert_subs($id);
        $partner = Partner::getByIdPartnerData($cert->partner_id);
        return view('store/content', compact('cert', 'partner', 'certs_sub'));
    }

    # добавляем товар и переходим к оформление
    public function add($offer_id){
        $this->set($offer_id);
        return redirect('cart');
    }

    # пересчитать корзину
    public function count($id_item, $qty){
        if(isset($_SESSION['cart'][$id_item]['opt_price'])){
            $this->check_interval($id_item, $qty);
        }
        $result = Cert::counted_cart_bus($id_item, $qty);
        return json_encode($result);
    }

    # положить товар в корзину
    public function set($id_item){
        $id_item = (int) $id_item;
        if($id_item != 0){
            if(isset($_SESSION['cart'][$id_item])){

                $_SESSION['cart'][$id_item]['qty'] += 1;
            }else{
                $_SESSION['cart'][$id_item]['qty'] = 1;
            }
        }
        $arr = $_SESSION['cart'];
        foreach($arr as $key => $val){
            if(empty($key)){
                unset($arr[$key]);
            }
        }
        $_SESSION['total_sum'] = Cert::get_offer($arr);
        $_SESSION['total_quantity'] = 0;
        foreach($_SESSION['cart'] as $key=>$val){
            if(isset($val['price'])){
                $_SESSION['total_quantity'] += $val['qty'];
            }else{
                unset($_SESSION['cart'][$key]);
            }
        }
    }

    public function add_to_cart($id_item){
        $this->set($id_item);
        return $_SESSION['total_quantity'];
    }

    public function order(Request $request){
        $delivery = $request->input('delivery');
        $client_name = $request->input('client_name');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $address = $request->input('address');
        $status = $request->input('status');
        $url = $_SERVER["SERVER_NAME"];
        $domain = explode(".",$url);
        $sub_domain = $domain[0].".likemoney.me";

        DB::transaction(function() use ($email, $phone, $status, $address, $delivery, $sub_domain, $client_name){
            $customer_id = $this->setBusinessCustomers($email, $phone, $client_name);
            $client_ip = $_SERVER['REMOTE_ADDR'];
            $current_date = date("Y-m-d H:i:s");
            if($customer_id){
                foreach($_SESSION['cart'] as $key=>$val){
                    $id_cert = $val['id'];
                    $title = rtrim($val['title']);
                    $qty   = $val['qty'];
                    $price = $val['price'];

                    DB::table('business_orders')->insertGetId([
                        'id_customer' => $customer_id, 'id_agent' => Auth::id(), 'id_cert' => $id_cert, 'title' => $title,
                        'qty' => $qty, 'price' => $price, 'payment_type' => $status, 'ip' => $client_ip, 'address' => $address,
                        'delivery' => $delivery, 'store_name' => $sub_domain, 'status' => '0', 'created_at' => $current_date
                    ]);
                }
            }
        });
        unset($_SESSION['total_quantity']);
        unset($_SESSION['cart']);
        return redirect('/cart')->with('message', 'Заявка оформлено.');
    }

    # Сохраняем данные клиента cart
    public function setBusinessCustomers($email, $phone, $client_name){
        $current_date = date("Y-m-d H:i:s");
        $customer = $this->is_business_customer($phone);
        if($customer){
            return $customer;
        }else {
            $lastInsertId = DB::table('business_customers')->insertGetId([
                'client_email' => $email, 'client_phone' => $phone, 'created_at' => $current_date, 'updated_at' => $current_date,
                'client_name' => $client_name
            ]);
            if($lastInsertId){
                return $lastInsertId;
            }else{
                dd("По каким то причинам не удалось сохранить");
            }
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

    # купить в 1 клик
    public function buy_one_click(Request $request){
        $phone = $request->input('phone');
        $id_item = $request->input('id_item');
//        $result = DB::table('buy_1_click')->where(['phone' => $phone, 'id_item' => $id_item])->first();
//        if($result){
//            return 101; // уже отправили
//        }else{
//            $lastInsertId = DB::table('buy_1_click')->insertGetId([
//                'phone' => $phone, 'id_item' => $id_item, 'created_at' => date('Y-m-d H:i:s')
//            ]);
//            if($lastInsertId){
//                return 0; // успешно
//            }else{
//                return 100; // не успешно
//            }
//        }
        $customer_id = $this->setBusinessCustomers('', $phone, '');
        if($customer_id){
            $result = DB::table('business_orders')->where(['id_cert' => $id_item, 'id_customer' => $customer_id])->first();
            if($result){
                return 101;
            }else{
                $url = $_SERVER["SERVER_NAME"];
                $domain = explode(".",$url);
                $sub_domain = $domain[0].".likemoney.me";

                $client_ip = $_SERVER['REMOTE_ADDR'];
                $current_date = date("Y-m-d H:i:s");
                DB::table('business_orders')->insertGetId([
                    'id_customer' => $customer_id, 'id_agent' => Auth::id(), 'id_cert' => $id_item, 'ip' => $client_ip,
                    'store_name' => $sub_domain, 'status' => '0', 'created_at' => $current_date
                ]);
                return 0;
            }
        }
        return 100;
    }

    public function op_tom($id){
        if(array_key_exists($id, $_SESSION['cart'])){
            // если товар есть в корзине
            if($this->is_interval($id,$_SESSION['cart'][$id]['qty'])){
                // подходить к оптовом ценам, пересчитаем сумму
                return $this->count($id, $_SESSION['cart'][$id]['qty']);
            }else{
                // кол-во товара не подходить к оптовом ценам
                return 402;
            }
        }else{
            return 401; // такой товар в корзине не существует
        }
    }

    public function is_interval($id, $count){
        $result = DB::select("SELECT OP.summa FROM cert_opt OP WHERE OP.id_cert='$id' AND OP.nach<='$count' AND OP.kon>='$count' LIMIT 1");
        if($result){
            $_SESSION['cart'][$id]['opt_price'] = $result[0]->summa;
            return true;
        }else{
            return false; // кол-во не входит в интервал
        }
    }

    public function op_tom_down($id){
        if(array_key_exists($id, $_SESSION['cart'])){
            if(isset($_SESSION['cart'][$id]['opt_price'])){
                unset($_SESSION['cart'][$id]['opt_price']);
                return $this->count($id, $_SESSION['cart'][$id]['qty']);
            }else{
                return 403;
            }
        }else{
            return 401; // такой товар в корзине не существует
        }
    }


    public function check_interval($id, $count){
        $result = DB::select("SELECT OP.summa FROM cert_opt OP WHERE OP.id_cert='$id' AND OP.nach<='$count' AND OP.kon>='$count' LIMIT 1");
        if($result){
            unset($_SESSION['cart'][$id]['opt_price']);
            $_SESSION['cart'][$id]['opt_price'] = $result[0]->summa;
        }else{
            unset($_SESSION['cart'][$id]['opt_price']);
        }
    }
}
