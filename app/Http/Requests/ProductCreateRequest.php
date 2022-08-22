<?php

namespace App\Http\Requests;

use App\Rules\MaxWordsRule;
use Illuminate\Foundation\Http\FormRequest;
use App\Model\Product;
use Illuminate\Support\Facades\Auth;

class ProductCreateRequest extends FormRequest
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

                'name' => 'required | max:255',
                'category_id' => 'required',
                'price' => 'required',
                'about_product' => new MaxWordsRule(32),

//                'quantity' => 'required | not_in:0',

//                'primary_image' => 'mimes:jpeg,jpg,png',
//                'image2' => ' mimes:jpeg,jpg,png',
//                'image3' => ' mimes:jpeg,jpg,png',
//                'image4' => ' mimes:jpeg,jpg,png',
//                'image5' => ' mimes:jpeg,jpg,png',

                'active_status' => 'required'
            ];

        } else {
            return [
                'name' => 'required | max:255',
                'category_id' => 'required',
                'price' => 'required',
                'about_product' => new MaxWordsRule(32),

                'primary_image' => 'required ',
//                'image2' => ' mimes:jpeg,jpg,png',
//                'image3' => ' mimes:jpeg,jpg,png',
//                'image4' => ' mimes:jpeg,jpg,png',
//                'image5' => ' mimes:jpeg,jpg,png',
//                'price' => 'required',

                'active_status' => 'required'

            ];
        }


    }

    public function messages()
    {
        return [
            'category_id.required' => __('The Category field is required.'),
            'sub_category_id.required' => __('The SubCategory field is required.'),

            'quantity.required' => __('The Quantity field is required.'),
            'quantity.not_in' => __('The Quantity can not be 0'),
            'price.required' => __('The Price field is required .'),
            'primary_image.required' => __('The Primary Image field is required .')
        ];
    }
}
