<?php

namespace App\Http\Services;

use App\Models\Shop;

class ShopService
{
    /*
     *  * store Shop Banner
     */

    public function store($request)
    {
        $data = ['success' => false, 'message' => 'Something went wrong', 'data' => []];

        $shopData['active_status'] = $request->active_status;


        if (!empty($request->banner)) {

            $old_img = '';
            $shopData['banner'] = fileUpload($request['banner'], path_shop_banner_image(), $old_img);  // upload image/file
        }

        $shop = Shop::create($shopData);

        if ($shop) {

            $data['success'] = true;
            $data['message'] = __('The Shop banner successfully added');
            $data['data'] = $shop;

            return $data;
        }
        return $data;

    }

    //    ***************** End add  Shop Banner *******************

    /*
     *  * update Shop Banner
     */

    public function update($request)
    {
        $data = ['success' => false, 'message' => 'Something went wrong', 'data' => []];

        $shopData['active_status'] = $request->active_status;

        $shop = Shop::where('id', $request->edit_id)->first();

        if ($shop) {

            if (!empty($request->banner)) {

                $old_img = isset($shop) ? $shop->banner : '';

                $shopData['banner'] = fileUpload($request['banner'], path_shop_banner_image(), $old_img);  // upload image/file
            }

            $success = $shop->update($shopData);

            if ($success) {

                $data['success'] = true;
                $data['message'] = __('The Shop banner successfully updated');
                $data['data'] = $shop;

                return $data;
            }

            return $data;
        }

        $data['message'] = "The shop banner doesn't exists";
        return $data;
    }

    //    ***************** End update  Shop Banner *******************


    public function delete($id)
    {
        $data = ['success' => false, 'data' => '', 'message' => __('Something went wrong, please try again, Thanks')];

        $shop = Shop::where(['id' => decrypt($id)])->first();

        if ($shop) {

            removeImage(path_shop_banner_image(),$shop->banner);
            $success = $shop->delete();

            if ($success) {

                $data['success'] = true;
                $data['message'] = __('The Shop banner successfully deleted');

                return $data;
            }
            return $data;
        }

        $data['message'] = "The shop banner doesn't exists";
        return $data;

    }

}
