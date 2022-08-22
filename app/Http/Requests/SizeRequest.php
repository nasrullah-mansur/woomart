<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SizeRequest extends FormRequest
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
                'size' => 'required | max:7',
                'chest' => 'required | max:7',
                'length' => 'required | max:7'
            ];
        } else
        {
            return [
                'size' => 'required | max:7',
                'chest' => 'required | max:7',
                'length' => 'required | max:7'
            ];
        }

    }
}
