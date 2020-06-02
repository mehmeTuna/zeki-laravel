<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWorkerRequest extends FormRequest
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
            'email' => 'sometimes|email',
            'password' => 'sometimes|min:5',
            'name' => 'sometimes|min:3',
            'authority' => 'sometimes',
            'storeId' => 'sometimes'
        ];
    }
}
