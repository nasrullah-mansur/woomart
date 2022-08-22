<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ColorRequest extends FormRequest
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
                'name' => 'required | max: 31',
                'color_code' => 'required | max: 128'
            ];
        }
        else
        {
            return [
                'name' => 'required | max: 31 | unique:colors',
                'color_code' => 'required | max: 128'
            ];
        }

    }
}
