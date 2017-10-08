<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

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
            ->select('business_orders.*', 'business_customers.client_phone', 'partners.name', 'partners.mphone', 'partners.address AS p_address', 'business_customers.client_name')
            ->where(['business_orders.id' => $id])
            ->first();
        return view('admin/order-show', compact('order'));
    }
}
