<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use Mockery\Exception;

class CartController extends Controller
{

    public function index()
    {
        return view('front.cart.index');
    }


    public function add(Request $request)
    {
        $data = ['success' => false, 'data' => [], 'message' => 'something went wrong'];


        $cartItem['items'] = \Cart::getContent();
        $cartItem['item_number'] = \Cart::getTotalQuantity();
        $cartItem['total_price'] = \Cart::getTotal();

        $product = Product::where('id', $request->product_id)->first();

        if ($product) {

            $cartData['id'] = $product->id;
            $cartData['name'] = $product->name;
            $cartData['price'] = $product->discount_price > 0 ? $product->discount_price : $product->price;
            $cartData['quantity'] = $request->quantity;

            $cartData['image'] = $product->primary_image;
            $cartData['size'] = $request->size;
            $cartData['color'] = $request->color;

            $existsCart = \Cart::get($cartData['id']);

            if ($existsCart) {
                $data['success'] = true;
                $data['message'] = 'product already added to cart';

                toast($data['message'], 'success');
                $data['data'] = $cartItem;

                return $data;
            }

            $cart = \Cart::add($cartData);

            if ($cart) {

                $data['success'] = true;
                $data['message'] = 'add to cart successfully';

                toast($data['message'], 'success');
                $data['data'] = $cartItem;

                return $data;
            }
            $data['data'] = $cartItem;
            return $data;
        }

        $data['message'] = "product doesn't exists";

        $data['data'] = $cartItem;
        return $data;


    }

    public function remove($lang, $id)
    {
        $cart = \Cart::remove($id);

        if ($cart) {
            toast('product successfully remove from cart', 'success');
            return redirect()->back();
        }

        toast('something went wrong', 'waning');
        return redirect()->back();

    }

}
