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
     */
    public function rules()
    {
        return [
            'name_customer' => 'required|max:100',
            'address_customer' => 'required|max:150',
            'email_customer' => 'required|email|max:100',
            'phone_number' => 'required|max:30',
            'total_price' => 'required|numeric|between:0.00,999.99',
            'delivery_date' => 'required|date|after:now'
        ];
    }
}
