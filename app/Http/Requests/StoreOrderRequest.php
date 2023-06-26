<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'cart_id'      => 'required|numeric|exists:carts,id',
            'first_name'   => 'required|string|min:3|max:191',
            'last_name'    => 'required|string|min:3|max:191',
            'company_name' => 'nullable|string|min:3|max:191',
            'email'        => 'required|email',
            'address'      => 'required|string|min:3|max:191',
            'city'         => 'required|string|min:3|max:191',
            'zip_code'     => 'nullable|numeric|digits:4',
            'phone_number' => 'required|string|min:6|max:191',
            'comment'      => 'nullable|string|min:10',
        ];
    }
}
