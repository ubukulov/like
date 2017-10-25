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
                            ->select('business_orders.*', 'business_customers.client_phone', 'partners.name', 'partners.mphone', 'partners.address AS p_address', 'business_customers.client_name')
                            ->orderBy('id', 'DESC')
                            ->paginate(20);
        return view('admin/orders', compact('orders'));
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
        return view('admin/order-show', compact('order'));
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
        $order = DB::table('business_orders')->where(['id' => $id])->first();
        if($order){
            $cert = Cert::findOrFail($order->id_cert);
            if($cert){
                $price = $cert->special2;
                DB::update("UPDATE business_orders SET address='$customer_address', qty='$qty', price='$price', payment_type='$payment_type' WHERE id='$id'");
                return 0;
            }else{
                return 101;
            }
        }else{
            return 101; // ошибка! попробуйте позже
        }
    }
}
