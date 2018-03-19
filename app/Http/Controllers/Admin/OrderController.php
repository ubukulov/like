<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Cert;

class OrderController extends Controller
{
    public function index(){
        $orders = DB::table('business_orders')
                            ->join('business_customers', 'business_customers.id', '=', 'business_orders.id_customer')
                            ->join('certs', 'certs.id', '=', 'business_orders.id_cert')
                            ->join('partners', 'partners.id', '=', 'certs.partner_id')
                            ->select('business_orders.*', 'business_customers.client_phone', 'partners.name', 'partners.mphone', 'partners.address AS p_address', 'business_customers.client_name', 'certs.title')
                            ->orderBy('id', 'DESC')
                            ->paginate(20);
        return view('admin/order/orders', compact('orders'));
    }

    public function setStatus($id_order, $status){
        DB::update("UPDATE business_orders SET status='$status' WHERE id='$id_order'");
        return redirect('admin/orders')->with('message', 'Статус успешно изменен');
    }

    public function show($id){
        $order = DB::table('business_orders')
            ->join('business_customers', 'business_customers.id', '=', 'business_orders.id_customer')
            ->join('certs', 'certs.id', '=', 'business_orders.id_cert')
            ->join('partners', 'partners.id', '=', 'certs.partner_id')
            ->select('business_orders.*', 'business_customers.client_phone', 'partners.name', 'partners.mphone', 'partners.address AS p_address', 'business_customers.client_name', 'certs.prime_cost', 'certs.title')
            ->where(['business_orders.id' => $id])
            ->first();
        return view('admin/order/order-show', compact('order'));
    }

    # стоимость доставки
    public function cost_delivery($id_order, $cost_delivery){
        $order = DB::table('business_orders')->where(['id' => $id_order])->first();
        if($order){
            DB::update("UPDATE business_orders SET cost_delivery='$cost_delivery', id_delivery='1' WHERE id='$id_order'");
            return 0;
        }else{
            return 400;
        }
    }

    public function delivery($id_order){
        $order = DB::table('business_orders')->where(['id' => $id_order])->first();
        if($order){
            DB::update("UPDATE business_orders SET cost_delivery=NULL, id_delivery='0' WHERE id='$id_order'");
            return 0;
        }else{
            return 400;
        }
    }

    public function setOrderData(Request $request){
        $qty = $request->input('count');
        $payment_type = $request->input('pay');
        $id = $request->input('id_item');
        $customer_address = $request->input('customer_address');
        $firstname_customer = $request->input('firstname_customer');
        $order = DB::table('business_orders')->where(['id' => $id])->first();
        if($order){
            $cert = Cert::findOrFail($order->id_cert);
            if($cert){
                $price = $cert->special2;
                $id_customer = $order->id_customer;
                DB::update("UPDATE business_orders SET address='$customer_address', qty='$qty', price='$price', payment_type='$payment_type' WHERE id='$id'");
                DB::update("UPDATE business_customers SET client_name='$firstname_customer' WHERE id='$id_customer'");
                return 0;
            }else{
                return 101;
            }
        }else{
            return 101; // ошибка! попробуйте позже
        }
    }

    public function statistics(){
        $result = DB::select("SELECT COUNT(*) AS cnt, BO.store_name FROM business_orders BO
                                INNER JOIN business_store BS ON BS.id_user=BO.id_agent
                                WHERE BO.`status`='3' GROUP BY BO.store_name ORDER BY cnt DESC LIMIT 5");
        if(isset($result[0])){
            $_SESSION['cnt1'] = $result[0]->cnt;
            $_SESSION['store_name1'] = $result[0]->store_name;
        }
        if(isset($result[1])){
            $_SESSION['cnt2'] = $result[1]->cnt;
            $_SESSION['store_name2'] = $result[1]->store_name;
        }
        return view('admin/order/statistics', compact('result'));
    }

    public function setSellChannel($id, $type_channel){
        DB::update("UPDATE business_orders SET channel_sells=$type_channel WHERE id=$id");
        return 0;
    }
}
