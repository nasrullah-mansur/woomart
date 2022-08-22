<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TalentTeamRequest extends FormRequest
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
        if ($this->request->get('edit_id'))
        {
            return [
                'name' => 'required | max: 64',
                'designation' => 'required | max: 128',
                'image' => 'mimes: jpg,png,jpeg'
            ];

        } else{
            return [
                'name' => 'required | max: 64',
                'designation' => 'required | max: 128',
                'image' => 'required | mimes: jpg,png,jpeg'
            ];
        }

    }
}
