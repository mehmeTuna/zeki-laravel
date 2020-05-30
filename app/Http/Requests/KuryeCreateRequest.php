<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KuryeCreateRequest extends FormRequest
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
            'username' => 'required|email|unique:kurye,username',
            'firstname' => 'required|min:3',
            'lastname' => 'required|min:3',
            'password' => 'required|min:3'
        ];
    }
}
