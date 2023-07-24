<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VehicleRequest extends FormRequest
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
            'registration_number' => 'required|unique:vehicles,registration_number',
            'brand_id' => 'required',
            'model' => 'required',
            'year' => 'nullable',
            'color' => 'required',
            'mileage' => 'nullable',
            'fuel_type' => 'nullable',
            'status' => 'nullable',
            'created_by' => 'nullable',
        ];

        return $rules;
    }
}
