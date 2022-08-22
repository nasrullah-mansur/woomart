<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use phpDocumentor\Reflection\Element;

class BLogCommentRequest extends FormRequest
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
        if ($this->request->get('user_id'))
        {
            return [
                'comment' => 'required',
            ];

        } else {
            return [
                'first_name' => 'required | max:191',
                'email' => 'required | max:191',
                'comment' => 'required',
            ];
        }


    }
}
