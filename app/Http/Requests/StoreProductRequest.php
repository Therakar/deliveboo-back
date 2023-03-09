<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'name' => 'required|string|max:50',
            'is_available' => 'required|boolean',
            'image' => 'nullable|image|max:2048',
            'typology' => 'required|exists:products,typology',
            'description' => 'required|string|max:500|min:10',
            'ingredients' => 'required|string|max:500|min:10',
            'price' => 'required|numeric|between:0.00,99.99'
        ];
    }
}
