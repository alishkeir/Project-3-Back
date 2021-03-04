<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins_info = [];
        $admins = Admin::all();
        foreach ($admins as $admin) {
            //return $students;
            $admin_info = [];
            $admin_info["id"] = $admin->id;
            $admin_info["name"] = $admin->name;
            $admin_info["password"] = $admin->password;
            $admin_info['school_id'] = $admin->school_id;
            array_push($admins_info, $admin_info);
        }
        return response()->json([
            'status' => 200,
            'message' => $admins_info,
        ], 200);

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
    public function store(request $request)
    {
        $data=$request->all();
        $admin=new Admin();
        $admin->name=$data['name'];
        $admin->email=$data['email'];
        $admin->password=$data['password'];
        $admin->school_id=$data['school_id'];
        $admin->save();
        return response()->
        json([
            'status'=>200,
            'admin'=>$admin
            ]);

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(request $request, $id)
    {
        $data=$request->all();
        $admin=Admin::where('id',$id)->first();
        $admin->fill($data);
        // $admin->admin_name=$data['admin_name'];
        // $admin->description=$data['description'];

        $admin->save();
        return response()->
        json([
            'status'=>200,
            'admin'=>$admin

        ]);
    }
    public function getAdminById($id)
    {

        $admin = Admin::where('id', $id)->first();

        return response()->json([
            'status' => 200,
            'message' => $admin,
        ], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
            $admin=Admin::find($id);
            if(!is_null($admin)) {
                $delete_status=Admin::where("id", $id)->delete();
                if($delete_status == 1) {
                    return response()->json(["status" => 200, "success" => true, "message" => "admin record deleted successfully"]);
                }
                else{
                    return response()->json(["status" => "failed", "message" => "failed to delete, please try again"]);
                }
            }
            else {
                return response()->json(["status" => "failed", "message" => "Whoops! no admin found with this id"]);
            }
        }
    }


