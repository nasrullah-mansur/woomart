<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogRrequest extends FormRequest
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
        if ($this->request->get('edit_id')) {
            return [
                'title' => 'required',
                'description' => 'required',
                'image' => 'mimes:jpg, jpeg, png, svg',
            ];
        } else {
            return [
                'title' => 'required',
                'description' => 'required',
                'image' => 'required | mimes:jpg, jpeg, png, svg',
            ];
        }

    }
}
