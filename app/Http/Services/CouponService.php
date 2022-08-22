<?php

namespace App\Http\Services;

use App\Model\Coupon;
use App\Model\CouponCategory;
use Carbon\Carbon;

class CouponService
{
    //    ****************Add Edit************************

    public function addEdit($request)
    {

        $data = ['status' => false, 'message' => 'Something went wrong', 'data' => []];

        $couponData['name'] = $request->name;
        $couponData['code'] = $request->code;
        $couponData['is_percentage'] = $request->is_percentage;
        $couponData['usage_limit_per_coupon'] = $request->usage_limit_per_coupon ? $request->usage_limit_per_coupon : 0;
        $couponData['value'] = $request->value ? $request->value : 0;
        $couponData['free_shipping'] = $request->free_shipping == 'on' ? true : false;
        $couponData['start_date'] = $request->start_date ? Carbon::parse($request->start_date)->toDateString() : Carbon::now()->toDateString();
        $couponData['end_date'] = $request->end_date;
        $couponData['active_status'] = $request->active_status;
        $couponData['min_spend'] = $request->min_spend ? $request->min_spend : 0;

        if ($couponData['end_date']  <= $couponData['start_date'] || $couponData['end_date'] <= Carbon::now()->toDateString())
        {
            $data['message'] = ('Ending date must be greater than toady and stat day');

            return $data;
        }
        if ($couponData['free_shipping'] == false && (float)$request->value < 0) {
            $data['message'] = ('Coupon value or Free shipping needed');

            return $data;
        }

        $edit_id = $request->edit_id;

        try {

            if ($edit_id) {

                $success = $this->update($edit_id, $couponData);

                $couponCategoryDelete = CouponCategory::where('coupon_id', $edit_id)->delete();

                if (isset($request->category_id)) {

                    for ($i = 0; $i < count($request->category_id); $i++) {
                        $cateData['coupon_id'] = $edit_id;
                        $cateData['category_id'] = $request->category_id[$i];
                        $cateData['is_exclude'] = false;

                        CouponCategory::create($cateData);
                    }

                }


                if ($success) {

                    return [
                        'status' => true,
                        'message' => __('Coupon successfully updated'),
                        'data' => $edit_id,
                    ];
                }

                return $data;
            }

            # create

            $coupon = Coupon::create($couponData);

            # Category

            if (isset($request->category_id)) {

                for ($i = 0; $i < count($request->category_id); $i++) {
                    $cateData['coupon_id'] = $coupon->id;
                    $cateData['category_id'] = $request->category_id[$i];
                    $cateData['is_exclude'] = false;

                    CouponCategory::create($cateData);
                }
            }

            #exclude category
//                    for ($i = 0; $i< count(is_countable($request->exclude_category_id)?$request->exclude_category_id:[]); $i++)
//                    {
//                        $cateData['coupon_id'] = $coupon->id;
//                        $cateData['category_id'] = $request->exclude_category_id[$i];
//                        $cateData['is_exclude'] = true;
//
//                        CouponCategory::create($cateData);
//                    }

            if ($coupon) {

                return [
                    'status' => true,
                    'message' => __('Coupon successfully added'),
                    'data' => $coupon,
                ];
            }

            return $data;


        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

//    ***************** Delete *******************

    public function update($edit_id, $data)
    {
        $coupon = Coupon::where('id', $edit_id)->first();

        return $coupon->update($data);
    }

    public function delete($id)
    {
        return [
            'status' => false,
            'message' => __('it is not possible to delete coupon'),
        ];
    }


}
