<?php

namespace App\Http\Requests;

use App\Rules\MaxWordsRule;
use Illuminate\Foundation\Http\FormRequest;

class SIngUpSignUnPagesesRequest extends FormRequest
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

            'sign_up_title' => new MaxWordsRule(10),
            'why_sign_up' => new MaxWordsRule(32),

            'sign_in_title' => new MaxWordsRule(10),
            'welcome_message' => new MaxWordsRule(32),
            'agree_for' => new MaxWordsRule(32),
        ];
    }
}
