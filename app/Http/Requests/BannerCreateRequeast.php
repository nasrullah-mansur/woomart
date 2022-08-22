<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BannerCreateRequeast extends FormRequest
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
        if ($this->get('edit_id'))
        {
            return [
                'offer_banner1' => 'mimes:jpeg,jpg,png',
                'offer_banner2' => 'mimes:jpeg,jpg,png',
                'offer_banner3' => 'mimes:jpeg,jpg,png',
                'trend_banner1' => 'mimes:jpeg,jpg,png',
                'trend_banner2' => 'mimes:jpeg,jpg,png',
            ];
        }

        else{
            return [
                'offer_banner1' => 'required | mimes:jpeg,jpg,png',
                'offer_banner2' => 'required | mimes:jpeg,jpg,png',
                'offer_banner3' => 'required | mimes:jpeg,jpg,png',
                'trend_banner1' => 'required | mimes:jpeg,jpg,png',
                'trend_banner2' => 'required | mimes:jpeg,jpg,png',
            ];
        }

    }

    public function messages()
    {
        return [
            'offer_banner1.required' => 'Offer banner1 field must not be empty',
            'offer_banner2.required' => 'Offer banner2 field must not be empty',
            'offer_banner3.required' => 'Offer banner3 field must not be empty',
            'trend_banner1.required' => 'Trend banner1 field must not be empty',
            'trend_banner2.required' => 'Trend banner2 field must not be empty',


            'offer_banner1.mimes' => 'Offer banner1 image must be a jpeg, jpg or png type',
            'offer_banner2.mimes' => 'Offer banner2 image must be a jpeg, jpg or png type',
            'offer_banner3.mimes' => 'Offer banner3 image must be a jpeg, jpg or png type',
            'trend_banner1.mimes' => 'Trend banner1 image must be a jpeg, jpg or png type',
            'trend_banner2.mimes' => 'Trend banner2 image must be a jpeg, jpg or png type',
        ];
    }
}
