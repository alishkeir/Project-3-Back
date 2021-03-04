<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
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
}
