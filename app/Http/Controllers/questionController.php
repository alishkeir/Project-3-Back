<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\question;
class questionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $questions=question::all();
        return $questions;
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
        $question=new question();
        $question->question=$data['question'];
        $question->class_id=$data['class_id'];
        $question->save();
        return response()->
        json([
            'status'=>200,
            'question'=>$question

        ]);}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     //
    //     $question = question::where('id',$id)->first();
    //     return $question;
        
    // }

    public function show($id)
    {
        //
        $question = question::where('class_id',$id)->get('question');
        return $question;
        
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
        $question=question::where('id',$id)->first();
        $question->fill($data);
        $question->save();
        return response()->
        json([
            'status'=>200,
            'question'=>$question

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
            $question=question::find($id);
            if(!is_null($question)) {
                $delete_status      =       question::with("id", $id)->delete();
                if($delete_status == 1) {
                    return response()->json(["status" => 200, "success" => true, "message" => "question record deleted successfully"]);
                }
                else{
                    return response()->json(["status" => "failed", "message" => "failed to delete, please try again"]);
                }
            }
            else {
                return response()->json(["status" => "failed", "message" => "Whoops! no question found with this id"]);
            }
        }
}
