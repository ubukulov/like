<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Cache;
use App\Cert;
use App\CertView;
use App\CertSub;
use App\Partner;

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
        $email = $request->input('email');
        $phone = $request->input('phone');
        $address = $request->input('address');
        $status = $request->input('status');
        $url = $_SERVER["SERVER_NAME"];
        $domain = explode(".",$url);
        $sub_domain = $domain[0];
        
    }
}
