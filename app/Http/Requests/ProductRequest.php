<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'required|unique:products,name',
            'image' => 'nullable',
            'brand_id' => 'required',
            'category_id' => 'required',
            'quantity' => 'required',
            'rate' => 'required',
            'created_by' => 'nullable',
            'status' => 'nullable'
        ];

        return $rules;
    }
}
