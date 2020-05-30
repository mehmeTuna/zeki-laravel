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
            'features' => 'sometimes',
            'price' => 'required',
            'name' => 'required|min:3',
            'numberOfProduct' => 'required',
            'categoryId' => 'required',
            'card_text' => 'required|min:3',
            'long_text' => 'sometimes|min:3',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'img_1' => 'sometimes|nullable',
            'img_2' => 'sometimes|nullable',
            'img_3' => 'sometimes|nullable',
        ];
    }
}
