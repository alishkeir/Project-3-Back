<?php

namespace App\Http\Controllers;

use App\Http\Requests\Student\AddStudent;
use App\Http\Requests\Student\UpdateStudent;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{

    // protected $user;

    // public function __construct()
    // {
    //     $this->user = JWTAuth::parseToken()->authenticate();

    // }

    // public function __construct()
    // {
    //     $this->middleware('auth:api');
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = $request->all();
        if ($data['school'] == "all") {
            return Student::with("school")->paginate(5);
        } else {
            return Student::where("school", $data["school"]);
        }
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
    public function store(AddStudent $request)
    {
        $data = $request->all();
        $request->validated();
        $student = new Student();
        $image = $request->file('image');
        $name = time() . '_' . $image->getClientOriginalName();
        $path = $request->file('image')->storeAs('/Student', $name, 'public');
        // return $path;
        $data['image'] = $name;

        if ($name) {
            $student->fill($data);
            $student->save();
            return response()->json(['status' => 200, 'student' => $student]);

        } else {
            return response()->json(['staus' => 500, 'error' => "couldnt upload image"]);

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
        return Student::where("id", $id)->first();

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
    public function update(UpdateStudent $request, $id)
    {
        $data = $request->all();
        $student = Student::where("id", $id)->first();
        $image = $request->file('image');
        if ($image) {
            $name = time() . '_' . $image->getClientOriginalName();
            $path = $request->file('image')->storeAs('/Student', $name, 'public');
            $data['image'] = $name;

        }
        $student->update($data);

        if ($request->first_name) {
            $student->first_name = $data['first_name'];
        }
        if ($request->last_name) {
            $student->last_name = $data['last_name'];
        }
        if ($request->email) {
            $student->email = $data['email'];
        }
        if ($request->password) {
            $student->password = $data['password'];
        }
        if ($request->school_id) {
            $student->school_id = $data['school_id'];
        }
        if ($request->phone_number) {
            $student->phone_number = $data['phone_number'];
        }
        if ($request->whatsapp_number) {
            $student->whatsapp_number = $data['whatsapp_number'];
        }
        if ($request->image) {
            if ($name) {
                $student->image = $name;
            }
        }

        $student->save();
        return response()->json(['status' => 200, 'student' => $student]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();
        return response("Student  deleted successfully");

    }
}
