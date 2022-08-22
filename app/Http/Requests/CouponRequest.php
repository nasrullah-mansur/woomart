<?php

namespace App\Http\Requests;

use App\Model\Coupon;
use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
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
            $coupon = Coupon::where('id', $this->request->get('edit_id'))->first();


            if ($coupon->code == $this->request->get('code'))
                return [
                    'name' => 'required ',
                    'code' => 'required',
                    'is_percentage' => 'required',
                    'end_date' => 'required',
                    'active_status' => 'required',

                    'min_spend' => 'numeric',
                    'max_spend' => 'numeric',
                ];
        }


        return [
            'name' => 'required ',
            'code' => 'required | unique:coupons',
            'is_percentage' => 'required',
            'end_date' => 'required',
            'active_status' => 'required',

            'min_spend' => 'numeric',
            'max_spend' => 'numeric',
        ];
    }

}
