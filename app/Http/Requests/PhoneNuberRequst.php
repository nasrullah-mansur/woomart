<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PhoneNuberRequst extends FormRequest
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
        return [
            'phone_number' => 'required | phone_number'
        ];
    }
    public function messages()
    {
        return [
            'phone_number.required' => 'The phone number field can not be empty',
            'phone_number.phone_number' => 'The phone number is invalid',
        ];
    }
}
