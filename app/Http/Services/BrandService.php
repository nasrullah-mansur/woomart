<?php

namespace App\Http\Services;


use App\Models\Brand;

class BrandService
{
    /*
     *  * store Brand
     */

    public function store($request)
    {
        $data = ['success' => false, 'message' => 'Something went wrong', 'data' => []];

        $brandData['name'] = $request->name;
        $brandData['active_status'] = $request->active_status;


        if (!empty($request->image)) {

            $old_img = '';
            $brandData['image'] = fileUpload($request['image'], path_brand_image(), $old_img);  // upload image/file
        }

        $brand = Brand::create($brandData);

        if ($brand) {

            $data['success'] = true;
            $data['message'] = __('Brand Successfully Added');
            $data['data'] = $brand;

            return $data;
        }
        return $data;

    }

    //    ***************** End add  Brand *******************

    /*
     *  * update Brand
     */

    public function update($request)
    {
        $data = ['success' => false, 'message' => 'Something went wrong', 'data' => []];

        $brandData['name'] = $request->name;
        $brandData['active_status'] = $request->active_status;

        $brand = Brand::where('id', $request->edit_id)->first();

        if ($brand) {

            if (!empty($request->image)) {

                $old_img = $brand->image;
                $brandData['image'] = fileUpload($request['image'], path_brand_image(), $old_img);  // upload image/file
            }

            $success = $brand->update($brandData);

            if ($success) {

                $data['success'] = true;
                $data['message'] = __('Brand Successfully updated');
                $data['data'] = $brand;

                return $data;
            }

            return $data;
        }

        $data['message'] = "Brand doesn't exists";
        return $data;
    }

    //    ***************** End update  Brand *******************


    public function delete($id)
    {
        $data = ['success' => false, 'data' => '', 'message' => __('Something went wrong, please try again, Thanks')];

        $brand = Brand::where(['id' => decrypt($id)])->first();
        if ($brand) {
            $success = $brand->delete();
            if ($success) {

                $data['success'] = true;
                $data['message'] = __('Brand successfully deleted');

                return $data;
            }
            return $data;
        }

        $data['message'] = "Brand doesn't exists";
        return $data;

    }

}
