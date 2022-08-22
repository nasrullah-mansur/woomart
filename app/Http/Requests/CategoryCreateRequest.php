<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Model\Category;

class CategoryCreateRequest extends FormRequest
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
            'name' => 'required',
            'image' => 'mimes:jpeg,jpg,png',
            'active_status' => 'required',
        ];

    }

    public function message()
    {
        return [
            'name.required' => __('The name field must be required'),
            'active_status.required' => __('The Status field must be required')
        ];

    }
}
