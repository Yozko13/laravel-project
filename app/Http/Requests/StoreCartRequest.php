<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCartRequest extends FormRequest
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
            'product_id'  => 'required|numeric|exists:products,id',
            'color'       => 'required|numeric',
            'quantity'    => 'required|numeric|min:1',
            'custom_text' => 'nullable|string|min:3|max:191',
        ];
    }
}
