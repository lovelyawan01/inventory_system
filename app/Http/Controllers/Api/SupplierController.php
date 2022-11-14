<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Supplier;
use DB;
use Image;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $suppliers = Supplier::all();
        return response()->json($suppliers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
          'name' => 'required|unique:suppliers|max:255',
          'email' => 'required',
          'phone' => 'required|integer|unique:suppliers'
        ]);

        if ($request->photo) {
            $position = strpos($request->photo, ';');
            $sub =  substr($request->photo, 0, $position);
            $ext = explode('/', $sub)[1];

              
            $name = time().".".$ext;
            $img = Image::make($request->photo)->resize(240, 200);
            $upload_path = 'admin/img/supplier/';
           $img_url = $upload_path.$name;
           $img->save($img_url);

           $supplier = new Supplier;
           $supplier->name = $request->name;
           $supplier->email = $request->email;
           $supplier->phone = $request->phone;
           $supplier->address = $request->address;
           $supplier->photo = $img_url;
           $supplier->shopname = $request->shopname;
           $supplier->save();
        }
        else{
            $supplier = new Supplier;
           $supplier->name = $request->name;
           $supplier->email = $request->email;
           $supplier->phone = $request->phone;
           $supplier->address = $request->address;
           $supplier->shopname = $request->shopname;
           $supplier->save();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $supplier = DB::table('suppliers')->where('id', $id)->first();
        return response()->json($supplier);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data =  array();
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['address'] = $request->address;
        $data['shopname'] = $request->shopname;

        $image = $request->newphoto;
        if ($image) {
            $position = strpos($image, ';');
            $sub =  substr($image, 0, $position);
            $ext = explode('/', $sub)[1];

              
            $name = time().".".$ext;
            $img = Image::make($image)->resize(240, 200);
            $upload_path = 'admin/img/supplier/';
           $img_url = $upload_path.$name;
           $success = $img->save($img_url);

          if ($success) {
              $data['photo'] = $img_url;
              $img = DB::table('suppliers')->where('id', $id)->first();
               $img_path = $img->photo;
               $done = unlink($img_path);
               $user = DB::table('suppliers')->where('id', $id)->update($data);
 
          }
        }
        else{
            $oldphoto = $request->photo;
            $data['photo'] = $oldphoto;

            $user = DB::table('suppliers')->where('id', $id)->update($data);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $supplier = DB::table('suppliers')->where('id', $id)->first();
        $photo = $supplier->photo;
       if ($photo) {
           unlink($photo);
           DB::table('suppliers')->where('id', $id)->delete();
       }
       else{
        DB::table('suppliers')->where('id', $id)->delete();
       }

    
     }
}
