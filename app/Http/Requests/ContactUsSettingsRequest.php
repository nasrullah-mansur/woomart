<?php

namespace App\Http\Requests;

use App\Rules\MaxWordsRule;
use Illuminate\Foundation\Http\FormRequest;

class ContactUsSettingsRequest extends FormRequest
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
            'contact_title' => ['required', new MaxWordsRule(7)],
            'why_contact' =>['required', new MaxWordsRule(32)],
            'form_title' => ['required', new MaxWordsRule(7)],
            'address' => 'required',
            'phone' => 'required | max: 191',
            'email' => 'required | email | max: 191',
        ];
    }
}
