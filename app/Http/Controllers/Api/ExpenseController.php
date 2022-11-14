<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Expense;
use DB;


class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses = Expense::all();
        return response()->json($expenses);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $validateData = $request->validate([
          'amount' => 'required|max:255',
          'details' => 'required'
        ]);


            $category = new Expense;
           $category->details = $request->details;
           $category->amount = $request->amount;
           $category->epense_date = $request->epense_date; 
           $category->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $expense = DB::table('expenses')->where('id', $id)->first();
        return response()->json($expense);
    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
          'amount' => 'required|max:255',
          'details' => 'required'
        ]);


       $data =  array();
       $data['details'] = $request->details;
       $data['amount'] = $request->amount;
       $data['epense_date'] = $request->epense_date;

        $user = DB::table('expenses')->where('id', $id)->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('expenses')->where('id', $id)->delete();
    }
}
