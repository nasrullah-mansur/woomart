<?php

namespace App\Http\Requests;

use App\Model\Brand;
use Illuminate\Foundation\Http\FormRequest;

class CouponEditRequest extends FormRequest
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
        if ($this->request->get('form') == GENERAL) {

            if ($this->request->get('edit_id')) {

                $coupon = Brand::where('id', $this->request->get('edit_id'))->first();


                if ($coupon->code == $this->request->get('code'))
                    return [
                        'name' => 'required ',
                        'code' => 'required',
                        'value' => 'required',
                        'is_percentage' => 'required',
//                    'free_shipping' => 'required',
                        'start_date' => 'required',
                        'end_date' => 'required',
                        'active_status' => 'required',

                        'min_spend' => 'numeric',
                        'max_spend' => 'numeric',

                    ];
            }


            return [
                'name' => 'required ',
                'code' => 'required | unique:coupons',
                'value' => 'required',
                'is_percentage' => 'required',
//            'free_shipping' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
                'active_status' => 'required',

                'min_spend' => 'numeric',
                'max_spend' => 'numeric',


            ];
        }else {
            return [
                'usage_limit_per_coupon' => 'numeric',
                'usage_limit_per_customer' => 'numeric',
            ];
        }
    }

}
