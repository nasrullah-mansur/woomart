<?php

namespace App\Http\Services;

use App\Models\Banner;

class BannerService
{
    /*
     *  * Add and Update Banner
     */

    public function store($request)
    {
        $data = ['success' => false, 'message' => 'Something went wrong', 'data' => []];

        if (!empty($request->offer_banner1)) {

            $old_img = '';
            $banData['offer_banner1'] = fileUpload($request['offer_banner1'], path_banner_image(), $old_img); // upload file
        }

        if (!empty($request->offer_banner2)) {

            $old_img = '';
            $banData['offer_banner2'] = fileUpload($request['offer_banner2'], path_banner_image(), $old_img); // upload file
        }


        if (!empty($request->offer_banner3)) {

            $old_img = '';
            $banData['offer_banner3'] = fileUpload($request['offer_banner3'], path_banner_image(), $old_img); // upload file
        }
        if (!empty($request->trend_banner1)) {

            $old_img = '';
            $banData['trend_banner1'] = fileUpload($request['trend_banner1'], path_banner_image(), $old_img); // upload file
        }
        if (!empty($request->trend_banner2)) {

            $old_img = '';
            $banData['trend_banner2'] = fileUpload($request['trend_banner2'], path_banner_image(), $old_img); // upload file
        }

        $existingBanner = Banner::first();

        if ($existingBanner) {
            $data['message'] = 'Banner already exists, you can edit but not more create';
            return $data;
        }
        $banner = Banner::create($banData);

        if ($banner) {

            $data['success'] = true;
            $data['message'] = 'Banner Successfully created';
            $data['data'] = $banner;

            return $data;
        }
        return $data;

    }


    /*
     *  Update Banner
     */

    public function update($request)
    {
        $data = ['success' => false, 'message' => 'Something went wrong', 'data' => []];

        $banner = Banner::where('id', $request->edit_id)->first();
        if ($banner) {

            if (!empty($request->offer_banner1)) {

                $old_img = $banner->offer_banner1;
                $banData['offer_banner1'] = fileUpload($request['offer_banner1'], path_banner_image(), $old_img); // upload file
            }

            if (!empty($request->offer_banner2)) {

                $old_img = $banner->offer_banner2;
                $banData['offer_banner2'] = fileUpload($request['offer_banner2'], path_banner_image(), $old_img); // upload file
            }

            if (!empty($request->offer_banner3)) {

                $old_img = $banner->offer_banner3;
                $banData['offer_banner3'] = fileUpload($request['offer_banner3'], path_banner_image(), $old_img); // upload file
            }
            if (!empty($request->trend_banner1)) {

                $old_img = $banner->trend_banner1;
                $banData['trend_banner1'] = fileUpload($request['trend_banner1'], path_banner_image(), $old_img); // upload file
            }


            if (!empty($request->trend_banner2)) {

                $old_img = $banner->trend_banner2;
                $banData['trend_banner2'] = fileUpload($request['trend_banner2'], path_banner_image(), $old_img); // upload file
            }

            if (!isset($banData)) {
                $data['message'] = "There are no change data";
                return $data;
            }

            $success = $banner->update($banData);

            if ($success) {

                $data['success'] = true;
                $data['message'] = 'Banner Successfully updated';
                $data['data'] = $banner;

                return $data;
            }
            return $data;
        }

        $data['message'] = "Banner doesn't exists";
        return $data;

    }


    /*
     *  Delete Banner
     */

    public function delete($id)
    {
        $data = ['success' => false, 'message' => 'Something went wrong', 'data' => []];

        $banner = Banner::where('id', decrypt($id))->first();
        if ($banner) {

            removeImage(path_banner_image(), $banner->offer_banner1);
            removeImage(path_banner_image(), $banner->offer_banner2);
            removeImage(path_banner_image(), $banner->offer_banner3);
            removeImage(path_banner_image(), $banner->trend_banner1);
            removeImage(path_banner_image(), $banner->trend_banner2);

            $delete = $banner->delete();

            if ($delete) {

                $data['success'] = true;
                $data['message'] = 'Banner Successfully deleted';

                return $data;
            }
            return $data;
        }

        $data['message'] = "Banner doesn't exists";
        return $data;

    }

//    ********************** End Banner Delete  **********************
}
