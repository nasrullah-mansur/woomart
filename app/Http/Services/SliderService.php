<?php

namespace App\Http\Services;


use App\Models\Slider;
use Illuminate\Support\Facades\Auth;

class SliderService
{
    /*
     *  * store slider
     */

    public function store($request)
    {
        $data = ['success' => false, 'message' => 'Something went wrong', 'data' => []];

        $sliderData['title'] = $request->title;
        $sliderData['active_status'] = $request->active_status ? $request->active_status : true;

        // file upload

        if (!empty($request->image)) {

            $old_img = '';
            $sliderData['image'] = fileUpload($request['image'], path_slider_image(), $old_img); // upload file
        }

        $slider = Slider::create($sliderData);

        if ($slider) {

            $data['success'] = true;
            $data['message'] = 'Slider Successfully created';
            $data['data'] = $slider;

            return $data;
        }

        return $data;
    }


    /*
        *  update Slider
    */

    public function update($request)
    {
        $data = ['success' => false, 'message' => 'Something went wrong', 'data' => []];

        $sliderData['title'] = $request->title;
        $sliderData['active_status'] = $request->active_status ? $request->active_status : true;

        $slider = Slider::where('id', $request->edit_id)->first();

        if ($slider) {

            if (!empty($request->image)) {

                $old_img = $slider->image;
                $sliderData['image'] = fileUpload($request['image'], path_slider_image(), $old_img); // upload file
            }

            $success = $slider->update($sliderData);
            if ($success) {

                $data['success'] = true;
                $data['message'] = 'Slider Successfully updated';
                $data['data'] = $slider;

                return $data;
            }
            return $data;
        }

        $data['message'] = "Slider doesn't exists";
        return $data;
    }


    /*
     *  Delete Slider
     */

    public function delete($id)
    {
        $data = ['success' => false, 'message' => 'Something went wrong', 'data' => []];

        $slider = Slider::where('id', decrypt($id))->first();

        if ($slider) {

            removeImage(path_slider_image(), $slider->image);

            $success = $slider->delete();

            if ($success) {

                $data['success'] = true;
                $data['message'] = 'Slider Successfully deleted';
                $data['data'] = '';

                return $data;
            }
            return $data;
        }

        $data['message'] = "Slider doesn't exists";
        return $data;

    }

//    ********************** End Banner Delete  **********************
}
