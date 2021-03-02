<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\classes;
class ClassController extends Controller
{
    public function index()
    {
        //
        $classes=classes::all();
        return $classes;
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
        $data=$request->all();
        $classes=new classes();
        $classes->name=$data['name'];
        
        $classes->save();
        return response()->
        json([
            'status'=>200,
            'classes'=>$classes

        ]);}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $classes = classes::where('id',$id)->first();
        return $classes;
        
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
        $data=$request->all();
        $classes=classes::where('id',$id)->first();
        $classes->fill($data);
        $classes->save();
        return response()->
        json([
            'status'=>200,
            'classes'=>$classes

        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
            //
            $classes        =       classes::find($id);
            if(!is_null($classes)) {
                $delete_status      =       classes::with("id", $id)->delete();
                if($delete_status == 1) {
                    return response()->json(["status" => 200, "success" => true, "message" => "classes record deleted successfully"]);
                }
                else{
                    return response()->json(["status" => "failed", "message" => "failed to delete, please try again"]);
                }
            }
            else {
                return response()->json(["status" => "failed", "message" => "Whoops! no classes found with this id"]);
            }
        }
}


