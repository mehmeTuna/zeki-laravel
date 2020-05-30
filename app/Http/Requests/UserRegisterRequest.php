<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
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
            'adress' => 'required|min:3',
            'date' => 'required',
            'name' => 'required|min:3',
            'password' => 'required|min:5',
            'phone' => 'required|min:3',
            'politics' => 'required',
            'rePassword' => 'required',
            'surname' => 'required',
            'username' => 'required',
        ];
    }
}
