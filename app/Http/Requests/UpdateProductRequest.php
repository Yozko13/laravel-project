<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'slug'        => "required|string|min:3|max:191|unique:products,slug,$this->id,id",
            'category_id' => 'required|numeric|exists:categories,id',
            'name'        => 'required|string|min:3|max:191',
            'description' => 'nullable|string|min:10',
            'price'       => 'required|numeric',
            'colors'      => 'required|array',
            'colors.*'    => 'required|numeric',
        ];
    }
}
