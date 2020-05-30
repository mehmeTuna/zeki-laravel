<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RezervasyonRegisterRequest extends FormRequest
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
            'attendents' => 'required',
            'date' => 'required',
            'email' => 'required|email',
            'message' => 'required|min:3',
            'name' => 'required|min:3',
            'phone' => 'required|min:3'
        ];
    }
}
