<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Employee;
use DB;
use Image;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $employees = Employee::all();
        return response()->json($employees);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
          'name' => 'required|unique:employees|max:255',
          'email' => 'required',
          'phone' => 'required|integer|unique:employees',
          'sallery' => 'integer',
          'nid' => 'integer'
        ]);

        if ($request->photo) {
            $position = strpos($request->photo, ';');
            $sub =  substr($request->photo, 0, $position);
            $ext = explode('/', $sub)[1];

              
            $name = time().".".$ext;
            $img = Image::make($request->photo)->resize(240, 200);
            $upload_path = 'admin/img/employee/';
           $img_url = $upload_path.$name;
           $img->save($img_url);

           $employee = new Employee;
           $employee->name = $request->name;
           $employee->email = $request->email;
           $employee->phone = $request->phone;
           $employee->sallery = $request->sallery;
           $employee->address = $request->address;
           $employee->photo = $img_url;
           $employee->nid = $request->nid;
           $employee->joining_date = $request->joining_date;
           $employee->save();
        }
        else{
            $employee = new Employee;
           $employee->name = $request->name;
           $employee->email = $request->email;
           $employee->phone = $request->phone;
           $employee->sallery = $request->sallery;
           $employee->address = $request->address;
           $employee->nid = $request->nid;
           $employee->joining_date = $request->joining_date;
           $employee->save();
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
        $employee = DB::table('employees')->where('id', $id)->first();
        return response()->json($employee);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $data =  array();
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['sallery'] = $request->sallery;
        $data['address'] = $request->address;
        $data['nid'] = $request->nid;
        $data['joining_date'] = $request->joining_date;

        $image = $request->newphoto;
        if ($image) {
            $position = strpos($image, ';');
            $sub =  substr($image, 0, $position);
            $ext = explode('/', $sub)[1];

              
            $name = time().".".$ext;
            $img = Image::make($image)->resize(240, 200);
            $upload_path = 'admin/img/employee/';
           $img_url = $upload_path.$name;
           $success = $img->save($img_url);

          if ($success) {
              $data['photo'] = $img_url;
              $img = DB::table('employees')->where('id', $id)->first();
               $img_path = $img->photo;
               $done = unlink($img_path);
               $user = DB::table('employees')->where('id', $id)->update($data);
 
          }
        }
        else{
            $oldphoto = $request->photo;
            $data['photo'] = $oldphoto;

            $user = DB::table('employees')->where('id', $id)->update($data);

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
        $employee = DB::table('employees')->where('id', $id)->first();
        $photo = $employee->photo;
       if ($photo) {
           unlink($photo);
           DB::table('employees')->where('id', $id)->delete();
       }
       else{
        DB::table('employees')->where('id', $id)->delete();
       }

    }
}
