<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserPaymentRequest extends FormRequest
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
            'adress' => 'required',
            'cardNumber' => 'sometimes',
            'content' => 'sometimes',
            'cvv' => 'sometimes',
            'month' => 'sometimes',
            'name' => 'sometimes',
            'picked' => 'required',
            'selected' => 'sometimes',
            'year' => 'sometimes',
        ];
    }
}
