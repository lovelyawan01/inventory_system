<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DateTime;
use DB;

class OrderController extends Controller
{
    public function todayOrder()
    {
    	$data = date('d/m/y');
    	$order = DB::table('orders')->join('customers','orders.customer_id','customers.id')->where('order_date', $data)->select('customers.name','orders.*')->orderBy('orders.id', 'DESC')->get();
    	return response()->json($order);
    }

    public function orderDeatils($id)
    {
    	$order = DB::table('orders')->join('customers','orders.customer_id','customers.id')->select('customers.name','customers.phone','customers.address','orders.*')->where('orders.id', $id)->first();
    	return response()->json($order);
    }

    public function OrderDeatilAll($id)
    {
    	$details = DB::table('order_detail')->join('products', 'order_detail.product_id', 'products.id')->where('order_detail.order_id', $id)->select('products.product_name','products.product_code', 'products.image', 'order_detail.*')->get();
    	return response()->json($details);
    }


    public function searchDateOrder(Request $request)
    {
        $orderdate = $request->date;
        $newDate = new DateTime($orderdate);
        $done = $newDate->format('d/m/y');


        $order = DB::table('orders')->join('customers', 'orders.customer_id', 'customers.id')->select('customers.name', 'orders.*')->where('orders.order_date', $done)->get();
        return response()->json($order);


    }
}
