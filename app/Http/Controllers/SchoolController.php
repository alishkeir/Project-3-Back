<?php

namespace App\Http\Controllers;
use App\school;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schools=school::all();
        return $schools;
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
    
 
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $school = school::where('id',$id)->first();
        return $school;
        
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
        //
        $data=$request->all();
        $school=school::where('id',$id)->first();
        $school->fill($data);
        $school->save();
        return response()->
        json([
            'status'=>200,
            'school'=>$school

        ]);
    }
    
    public function store(Request $request)
    {
        
        $data=$request->all();
        $school=new school();
        $school->name=$data['name'];
        $school->students_no=$data['students_no'];
        $school->save();
        return response()->
        json([
            'status'=>200,
            'school'=>$school

        ]);}
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function destroy($id)
    {
            //
            $school        =       school::find($id);
            if(!is_null($school)) {
                $delete_status      =       school::with("id", $id)->delete();
                if($delete_status == 1) {
                    return response()->json(["status" => 200, "success" => true, "message" => "school record deleted successfully"]);
                }
                else{
                    return response()->json(["status" => "failed", "message" => "failed to delete, please try again"]);
                }
            }
            else {
                return response()->json(["status" => "failed", "message" => "Whoops! no school found with this id"]);
            }
        }

    }
   

