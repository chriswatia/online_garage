<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceBookingRequest extends FormRequest
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
            'vehicle_id' => 'required',
            'service_id' => 'required',
            'notes' => 'required',
            'date' => 'required',
            'status' > 'nullable',
            'created_by' => 'nullable',
        ];

        return $rules;
    }
}
