<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'date' => 'sometimes',
            'name' => 'sometimes|min:3',
            'oldPassword' => 'sometimes|min:5',
            'newPassword' => 'sometimes|min:5',
            'phone' => 'sometimes|min:3',
            'surname' => 'sometimes',
            'email' => 'sometimes|email',
        ];
    }
}
