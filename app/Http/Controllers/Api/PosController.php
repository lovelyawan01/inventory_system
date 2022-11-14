<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class PosController extends Controller
{
    public function GetProducts($id)
    {
    	$product = DB::table('products')->where('category_id', $id)->get();
    	return Response()->json($product);
    }

    public function orderdone(Request $request)
    {
    	$validateData = $request->validate([
            'customer_id' => 'required',  
            'pay_by' => 'required',  
    	]);
    	$data = array();
    	$data['customer_id'] = $request->customer_id;
    	$data['qty'] = $request->qty;
    	$data['subtotal'] = $request->subtotal;
    	$data['vat'] = $request->vat;
    	$data['total'] = $request->total;
    	$data['pay'] = $request->pay;
    	$data['due'] = $request->due;
    	$data['pay_by'] = $request->pay_by;
    	$data['order_date'] = date('d/m/y');
    	$data['order_month'] = date('F');
    	$data['order_year'] = date('Y');

    	$order_id = DB::table('orders')->insertGetId($data);

    	$contents = DB::table('pos')->get();
    	$odata = array();
    	foreach ($contents as $content) {
    		$odata['order_id'] =  $order_id;
    		$odata['product_id'] =  $content->pro_id;
    		$odata['pro_quantity'] =  $content->pro_quantity;
    		$odata['product_price'] =  $content->product_price;
    		$odata['sub_total'] =  $content->sub_total;
    		DB::table('order_detail')->insert($odata);

           DB::table('products')->where('id', $content->pro_id)->update(['product_quantity' => DB::raw('product_quantity -' . $content->pro_quantity)]);
    	}

    	DB::table('pos')->delete();
    	return response('Done');

    }

    // Admin panel 
    public function todaysale()
    {
        $date = date('d/m/y');
        $sell = DB::table('orders')->where('order_date', $date)->sum('total');
        return response()->json($sell);
    }

    public function todayincome()
    {
        $date = date('d/m/y');
        $income = DB::table('orders')->where('order_date', $date)->sum('pay');
        return response()->json($income);
    }

    public function todaydue()
    {
        $date = date('d/m/y');
        $due = DB::table('orders')->where('order_date', $date)->sum('due');
        return response()->json($due);
    }

    public function todayexpense()
    {
        // $date = date('Y-m-d', strtotime('31-10-2022'));
        $date = date('Y-m-d');
        $expense = DB::table('expenses')->where('epense_date', $date)->sum('amount');
        return response()->json($expense);   
    }

    public function stockout()
    {
        $product = DB::table('products')->where('product_quantity', '<', '1')->get();
        return response()->json($product);
    }
}
