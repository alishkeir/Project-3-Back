<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdminRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:5|max:55|regex:/[a-z]/',
            'email' => 'required|bail|email|unique:admins',
            'password' => 'required|string|bail|min:6',
            'school_id' => 'required',

        ];
    }

    public function messages()
    {
        return [

            'name.min' => 'Name should be 5 or more characters',
            'name.required' => "Name can't be empty",

            'email.unique' => 'Email already in use.',
            'email.required' => 'Email is required',
            'email.email' => 'Email must be a valid email address',

            'password.required' => 'Password is required',
            'password.min' => 'Password should 6 characters or more',

            'school_id.required' => 'School ID is Required',
        ];
    }
}
