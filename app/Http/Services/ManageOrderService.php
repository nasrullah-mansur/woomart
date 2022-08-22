<?php

namespace App\Http\Services;


use App\Model\Attribute;
use App\Model\AttributeSet;
use App\Model\AttributeValue;
use App\Model\AttributeCategory;
use App\Model\Order;

class ManageOrderService
{
    /*
     *  * Add and Update Attribute Set
     */


    public function orders($key)
    {
        $data = ['success' => false, 'code'=>404, 'message' => 'Something went wrong', 'data' => []];
        if ($key == null)
        {
            $orders = Order::with('order_details')->select('*');
        }
        else{
            $orders = Order::where('order_status' , decrypt($key))->with('order_details')->select('*');

        }
        return $orders;
    }

    //    ***************** End add and Update Attribute Set *******************

    /*
     *  * Attribute Set
     */

    public function delete($id)
    {
        $data = ['status' => false, 'data' => '', 'message' => __('Something went wrong, please try again, Thanks')];

        $attribute = Attribute::where(['id' => decrypt($id)])->first();

        $success = $attribute->delete();
        if ($success) {
            $data['success'] = true;
            $data['message'] = __('Attribute successfully deleted');

            return $data;
        }
        return $data;
    }

}
