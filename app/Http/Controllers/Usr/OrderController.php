<?php

namespace App\Http\Controllers\Usr;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index(){
        $orders = DB::table('business_orders')
            ->leftJoin('business_customers', 'business_customers.id', '=', 'business_orders.id_customer')
            ->leftJoin('certs', 'certs.id', '=', 'business_orders.id_cert')
            ->select('business_orders.*', 'business_customers.client_phone', 'business_customers.client_name', 'certs.title', 'certs.com_agent')
            ->orderBy('id', 'DESC')
            ->where('certs.user_id', '=', Auth::id())
            ->paginate(10);
        return view('user/order/index', compact('orders'));
    }

    public function update($id){
        DB::update("UPDATE business_orders SET status='3' WHERE id='$id'");
        return redirect()->back()->with('message', 'Заказ успешно обработан');
    }
}
