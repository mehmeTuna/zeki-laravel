<?php

namespace App\Http\Requests;

use App\Products;
use App\Users;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class UserSepetUpdate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @param Request $request
     * @return bool
     */
    public function authorize(Request $request)
    {
        $user = Users::where('id', session('userId'))->with(['address.address'])->first();
        $product = Products::where('id', $request['id'])->first();

        return $user->address->address->id === $product->location_id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
