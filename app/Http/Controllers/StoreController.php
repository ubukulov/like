<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Cache;

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
}
