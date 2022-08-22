<?php

namespace App\Http\Services;

use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductSize;
use Illuminate\Support\Str;

class ProductService
{
    /*
     *  * store Products
     */


    public function store($request)
    {
        $data = ['success' => false, 'message' => 'Something went wrong', 'data' => []];

        $productData = $this->getData($request);

        try {

            $product = Product::create($productData);

            if ($product) {

                if (isset($request->color[0])) {

                    $length = count($request->color);


                    $colorData['product_id'] = $product->id;

                    for ($i = 0; $i < $length; $i++) {

                        $colorsArray = explode('-', $request->color[$i]);

                        $colorData['color_id'] = $colorsArray[0];
                        $colorData['name'] = $colorsArray[1];
                        $colorData['color_code'] = $colorsArray[2];

                        ProductColor::create($colorData);

                    }
                }

                if (isset($request->size[0])) {

                    $length = count($request->size);
                    $sizeData['product_id'] = $product->id;

                    for ($i = 0; $i < $length; $i++) {

                        $sizeArray = explode('-', $request->size[$i]);

                        $sizeData['size_id'] = $sizeArray[0];
                        $sizeData['size'] = $sizeArray[1];

                        ProductSize::create($sizeData);
                    }
                }

                $data['success'] = true;
                $data['message'] = 'Product successfully created';
                $data['data'] = $product;

                return $data;
            }
            return $data;

        } catch (\Exception $e) {
            dd($e->getMessage());
            return $data;
        }

    }


//    update

    public function update($request)
    {
        $data = ['success' => false, 'message' => 'Something went wrong', 'data' => []];

        $productData = $this->getData($request);

        try {

            $product = Product::where('id', $request->edit_id)->first();

            if ($product) {

                $product->update($productData);

                // product color update

                ProductColor::where('product_id', $product->id)->delete();

                if (isset($request->color[0])) {

                    $length = count($request->color);
                    $colorData['product_id'] = $product->id;

                    for ($i = 0; $i < $length; $i++) {

                        $colorsArray = explode('-', $request->color[$i]);

                        $colorData['color_id'] = $colorsArray[0];
                        $colorData['name'] = $colorsArray[1];
                        $colorData['color_code'] = $colorsArray[2];

                        $existProductColor = ProductColor::where(['product_id' => $product->id, 'color_id' => $colorData['color_id'] ])->exists();
                        if ($existProductColor)
                        {
                            continue;
                        }

                        ProductColor::create($colorData);

                    }
                }


                // product size update

                ProductSize::where('product_id', $product->id)->delete();

                if (isset($request->size[0])) {

                    $length = count($request->size);
                    $sizeData['product_id'] = $product->id;

                    for ($i = 0; $i < $length; $i++) {
                        $sizeArray = explode('-', $request->size[$i]);

                        $sizeData['size_id'] = $sizeArray[0];
                        $sizeData['size'] = $sizeArray[1];

                        $existProductSize = ProductSize::where(['product_id' => $product->id, 'size' => $sizeData['size'] ])->exists();
                        if ($existProductSize)
                        {
                            continue;
                        }
                        ProductSize::create($sizeData);

                    }
                }

                $data['success'] = true;
                $data['message'] = 'Product successfully updated';
                $data['data'] = $product;

                return $data;
            }
            $data['message'] = "Product doesn't exists";
            return $data;

        } catch (\Exception $e) {
//            dd($e->getMessage());
            return $data;
        }

    }


//    processing Data for store or update

    public function getData($request)
    {
        if ($request->edit_id) {
            $product = Product::where('id', $request->edit_id)->first();
        }

        $productData['name'] = $request->name;
        $productData['category_id'] = $request->category_id;
        $productData['sub_category_id'] = $request->sub_category_id;
        $productData['brand'] = $request->brand;
        $productData['slug'] = isset($request->slug) ? Str::slug($request->slug, '-') : (isset($productData['brand']) ? Str::slug(time() . '-' . $request->name . '-' . $productData['brand'], '-') : Str::slug(time() . '-' . $request->name, '-'));
        $productData['quantity'] = isset($request->quantity) ? $request->quantity : 0;

        $productData['price'] = $request->price ? $request->price : 0;
        $productData['discount'] = $request->discount ? $request->discount : 0;
        $productData['discount_price'] = offerPrice($productData['price'], $productData['discount']);
        $productData['about_product'] = $request->about_product;
        $productData['description'] = $request->description;

        $productData['active_status'] = $request->active_status;
        $productData['first_section'] = $request->has('first_section') ? true : false;
        $productData['second_section'] = $request->has('second_section') ? true : false;
        $productData['third_section'] = $request->has('third_section') ? true : false;
        $productData['is_new'] = $request->has('is_new') ? true : false;
        $productData['is_trending'] = $request->has('is_trending') ? true : false;


        if (!empty($request->primary_image)) {

            $old_img = isset($product) ? $product->primary_image : '';
            $productData['primary_image'] = fileUpload($request['primary_image'], path_product_image(), $old_img);
        }

        if (!empty($request->image2)) {

            $old_img = isset($product) ? $product->image2 : '';
            $productData['image2'] = fileUpload($request['image2'], path_product_image(), $old_img);
        }

        if (!empty($request->image3)) {

            $old_img = isset($product) ? $product->image3 : '';
            $productData['image3'] = fileUpload($request['image3'], path_product_image(), $old_img);
        }

        if (!empty($request->image4)) {

            $old_img = isset($product) ? $product->image4 : '';
            $productData['image4'] = fileUpload($request['image4'], path_product_image(), $old_img);
        }

        return $productData;
    }

}
