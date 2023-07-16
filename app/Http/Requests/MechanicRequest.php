<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MechanicRequest extends FormRequest
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
            'user_id' => 'required|unique:mechanics,user_id',
            'specialization' => 'required',
            'created_by' => 'nullable',
            'status' => 'nullable'
        ];

        return $rules;
    }
}
