<?php

namespace App\Http\Services;

use App\Model\Order;
use App\Model\Order_detail;
use App\Model\Shipping;
use Darryldecode\Cart\Cart;
use Illuminate\Support\Facades\Auth;

use App\Model\Customer;
use App\Model\User;
use Illuminate\Support\Facades\Hash;

class CheckoutService
{

    public function addNew($request)
    {
        $data = ['status' => false, 'message' => __('Something went wrong, please try again, Thanks!!'), 'data' => null];

        try {

            $customer = User::create([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' => Hash::make($request->get('password')),
                'mobile' => $request->get('mobile'),
                'active_status' =>1,
                'role' => 3
            ]);

            return [
                'status' => true,
                'message' => '',
                'data' => $customer,
            ];

        } catch (\Exception $e) {
            return [

                'status' => false,
                'message' => 'Something went wrong, please try again, Thanks',
                'data' => null
            ];

        }
    }

//    ************************* Shipping *********************

    public function shipping($request)
    {
        $data = ['status' => false, 'message' => __('Something went wrong, please try again, Thanks!!'), 'data' => null];
        try {                                                   //Shipping
            $shipping = Shipping::create([

                'user_id' => Auth::user()->id,
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'mobile' => $request->get('mobile'),
                'city' => $request->get('city'),
                'area' => $request->get('area'),
                'address' => $request->get('address'),

            ]);


            try {                                               // order create
                $orders = Order::create([

                    'user_id' => Auth::user()->id,
                    'shipping_id' => $shipping->id,
//                    'payment_id' => 0,
                    'coupon_code' => $request->coupon_code,
                    'coupon_discount' => $request->coupon_code,
                    'delivery_type' => 1,
                    'delivery_charge' => $request->delivery_charge,
                    'payment_status' => 5,
                    'order_status' => 5,
                    'order_total' => \Cart::getSubTotal()

                ]);

//                $shipping->update(['order_id',$orders->id]);

            } catch (\Exception $e) {
                $shipping->delete();
//                dd($e->getMessage());

                return $data;
            }


            try {                                           //order Details create

                $contents = \Cart::getContent();

                foreach ($contents as $v_contents) {
                    $order_details = Order_detail:: create([

                        'order_id' => $orders->id,
                        'product_id' => $v_contents->id,
                        'product_price' => $v_contents->price,
                        'quantity' => $v_contents->quantity,

                    ]);
                }

//                \Cart::clear();

                return [
                    'status' => true,
                    'message' => '',
                    'data' => $orders->id,
                ];

            } catch (\Exception $e) {

                $shipping->delete();
                $orders->delete();

                dd($e->getMessage());


                return $data;

            }


        } catch (\Exception $e) {

            return $data;
        }
    }
}
