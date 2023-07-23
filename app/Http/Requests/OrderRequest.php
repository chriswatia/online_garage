<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
        $rules = [
            'order_number' => 'required|unique:orders,order_number',
            'order_date' => 'required',
            'user_id' => 'required',
            'mechanic_id' => 'required',
            'supervisor' => 'required',
            'vehicle_type' => 'required',
            'sub_total' => 'required',
            'vat' => 'nullable',
            'total_amount' => 'required',
            'discount' => 'nullable',
            'grand_total' => 'required',
            'paid' => 'nullable',
            'due' => 'nullable',
            'payment_type' => 'nullable',
            'payment_status' => 'nullable',
            'created_by' => 'required',
            'order_status' => 'nullable'
        ];

        return $rules;
    }
}
