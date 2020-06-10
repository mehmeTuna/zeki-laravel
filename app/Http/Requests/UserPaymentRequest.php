<?php

namespace App\Http\Requests;
use App\Site ;

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
        $site = Site::where('id', 1)->first();
        return $site->site_online;
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
