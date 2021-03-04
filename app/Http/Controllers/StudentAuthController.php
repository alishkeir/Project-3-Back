<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Student\StudentRegisterRequest;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentAuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth:api', ['except' => ['login', 'register']]);
    // }

    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(StudentRegisterRequest $request)
    {

        // $student = $request->all();

        // Student::create($student);

        $data = $request->all();
        $request->validated();
        $student = new Student();
        $image = $request->file('image');
        $name = time() . '_' . $image->getClientOriginalName();
        $path = $request->file('image')->storeAs('/SStudent', $name, 'public');
        $data['image'] = $name; 
        $student->fill($data);

        if ($name) {
            $student->save();
            return response()->json([
                'message' => 'Successfully registered',
                'student' => $student,
            ], 201);
        } else {
            return response()->json(['staus' => 500, 'error' => "couldnt upload image"]);

        }

        // $token = auth()->login($admin);

        // return $this->respondWithToken($token);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $login = request(["email", "password"]);

        if (!$token = auth("student")->attempt($login)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->createNewToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function profile()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth("api")->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    // public function refresh()
    // {
    //     return $this->createNewToken(auth()->refresh());
    // }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            // 'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
