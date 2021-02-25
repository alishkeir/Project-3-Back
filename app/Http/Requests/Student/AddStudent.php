<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;

class AddStudent extends FormRequest
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
            'first_name' => 'required|min:1|max:55',
            'last_name' => 'required|min:1|max:55',
            'email' => 'required|bail|email|unique:students',
            'password' => 'required|string|bail|min:6',
            'school_id' => 'required',
            'phone_number' => 'required|min:5|max:20',
            'whatsapp_number' => 'required|min:5|max:20',
            'nationality' => 'required',
            'image' => 'bail|required|mimes:jpeg,png,jpg,gif,svg|max:10240',
            'status' => 'required',
        ];
    }

    public function messages()
    {
        return [

            'first_name.min' => 'Name should be 1 or more characters',
            'name.required' => "Name can't be empty",

            'last_name.min' => 'Name should be 1 or more characters',
            'name.required' => "Name can't be empty",

            'email.unique' => 'Email already in use.',
            'email.required' => 'Email is required',
            'email.email' => 'Email must be a valid email address',

            'password.required' => 'Password is required',
            'password.min' => 'Password should 6 characters or more',

            'school_id.required' => 'School ID is Required',

            'phone_number.required' => 'Phone Number is required',
            'phone_number.min' => 'Phone Number must be 5 or more numbers',
            'phone_number.max' => 'Phone Number must be less than 20 numbers',

            'whatsapp_number.required' => 'Whatsapp Number is required',
            'whatsapp_number.min' => 'Whatsapp Number must be 5 or more numbers',
            'whatsapp_number.max' => 'Whatsapp Number must be less than 20 numbers',

            'nationality.required' => 'Nationality is Required',

            'image.required' => 'Image is Required',
            'image.mimes' => 'Image should be of type jpeg, png, jpg, gif or svg',
            'image.max' => 'Image size should be 10MB or less',

        ];
    }
}
