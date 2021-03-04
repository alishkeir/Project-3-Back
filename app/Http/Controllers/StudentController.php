<?php

namespace App\Http\Controllers;

use App\Http\Requests\Student\AddStudent;
use App\Http\Requests\Student\UpdateStudent;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use JWTAuth;

class StudentController extends Controller
{

    protected $student;

    public function __construct()
    {
        // $this->student = JWTAuth::parseToken()->authenticate();

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = $request->all();
        // if ($data['school'] == "all") {
        //     return Student::paginate(5);
        // } else {
        //     return Student::where("school", $data["school"]);
        // }
        $students_info = [];
        $students = Student::all();
        foreach ($students as $student) {
         
            $student_info = [];
            $student_info["id"] = $student->id;
            $student_info["first_name"] = $student->first_name;
            $student_info["last_name"] = $student->last_name;
            $student_info["email"] = $student->email;
            $student_info["password"] = $student->password;
            $student_info["phone_number"] = $student->last_name;
            $student_info["whatsapp_number"] = $student->last_name;
            $student_info["nationality"] = $student->nationality;
            $student_info["image"] = $student->image;
            $student_info["status"] = $student->status;
            $student_info['school_id'] = $student->school_id;
            array_push($students_info, $student_info);
        }
        return response()->json([
            'status' => 200,
            'message' => $students_info,
        ], 200);
    }
    // public function getStudentById ($id) {
    //     $student = Students::where('id', $id)->first();
    //     console.log($student);
    //     return response()->json([
    //         'status' => 200,
    //         'message' => $student,
    //     ], 200);
    // }
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
        $first_name = time() . '_' . $image->getClientOriginalfirst_name();
        $path = $request->file('image')->storeAs('/Student', $first_name, 'public');
        $student->fill($data);
        if ($path) {
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
        $student=Student::where("id", $id)->first();
        return response()->json([
            'status' => 200,
            'message' => $student,
        ], 200);

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
            $first_name = time() . '_' . $image->getClientOriginalfirst_name();
            $path = $request->file('image')->storeAs('/Student', $first_name, 'public');
        }
        $student->update($data);

        if ($request->first_first_name) {
            $student->first_first_name = $data['first_first_name'];
        }
        if ($request->last_first_name) {
            $student->last_first_name = $data['last_first_name'];
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
            if ($path) {
                $student->image = $path;
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
