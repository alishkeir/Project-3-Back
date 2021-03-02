<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudent extends FormRequest
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
            'first_name' => 'min:1|max:55',
            'last_name' => 'min:1|max:55',
            'email' => 'bail|email|unique:students',
            'password' => 'string|bail|min:6',
            'phone_number' => 'min:5|max:20',
            'whatsapp_number' => 'min:5|max:20',
            'image' => 'bail|mimes:jpeg,png,jpg,gif,svg|max:10240',
        ];
    }

    public function messages()
    {
        return [

            'first_name.min' => 'Name should be 1 or more characters',

            'last_name.min' => 'Name should be 1 or more characters',

            'email.unique' => 'Email already in use.',
            'email.email' => 'Email must be a valid email address',

            'password.min' => 'Password should 6 characters or more',

            'phone_number.min' => 'Phone Number must be 5 or more numbers',
            'phone_number.max' => 'Phone Number must be less than 20 numbers',

            'whatsapp_number.min' => 'Whatsapp Number must be 5 or more numbers',
            'whatsapp_number.max' => 'Whatsapp Number must be less than 20 numbers',

            'image.mimes' => 'Image should be of type jpeg, png, jpg, gif or svg',
            'image.max' => 'Image size should be 10MB or less',

        ];
    }
}
