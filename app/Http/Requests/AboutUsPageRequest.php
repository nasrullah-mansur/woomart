<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AboutUsPageRequest extends FormRequest
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

            'about_us' => 'required',
            'middle_section_title' => 'required | max: 112',
            'middle_section_description' => 'required',

            'middle_section_content1_title' => 'required | max: 112',
            'middle_section_content2_title' => 'required | max: 112',
            'middle_section_content23_title' => 'required | max: 112',

            'middle_section_content1_description' => 'required',
            'middle_section_content2_description' => 'required',
            'middle_section_content3_description' => 'required',

            'image' => 'required | mimes:jpeg,jpg,png',
            'middle_section_content1_icon' => 'required | mimes:jpeg,jpg,png',
            'middle_section_content2_icon' => 'required | mimes:jpeg,jpg,png',
            'middle_section_content3_icon' => 'required | mimes:jpeg,jpg,png',

        ];


    }

}
