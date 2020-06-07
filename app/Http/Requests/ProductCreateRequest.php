<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductCreateRequest extends FormRequest
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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'img_1' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg',
            'img_2' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg',
            'img_3' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg',
        ];
    }
}
