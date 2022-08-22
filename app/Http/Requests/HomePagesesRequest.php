<?php

namespace App\Http\Requests;

use App\Rules\MaxWordsRule;
use Illuminate\Foundation\Http\FormRequest;

class HomePagesesRequest extends FormRequest
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
            'first_section' => ['required', new MaxWordsRule(7)],
            'second_section' => ['required', new MaxWordsRule(7)],
            'third_section' => ['required', new MaxWordsRule(7)],
        ];
    }
}
