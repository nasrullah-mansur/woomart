<?php

namespace App\Http\Services;

use App\Models\AboutUs;
use App\Models\ContactUsSetting;
use App\Models\Error404;
use App\Models\TermsAndCondition;

class PagesService
{

    public function aboutUs($request)
    {
        $data = ['success' => false, 'message' => 'Something went wrong', 'data' => ''];

        $aboutData['about_us'] = $request->about_us;

        $aboutData['middle_section_title'] = $request->middle_section_title;
        $aboutData['middle_section_description'] = $request->middle_section_description;

        $aboutData['middle_section_content1_title'] = $request->middle_section_content1_title;
        $aboutData['middle_section_content2_title'] = $request->middle_section_content2_title;
        $aboutData['middle_section_content3_title'] = $request->middle_section_content3_title;

        $aboutData['middle_section_content1_description'] = $request->middle_section_content1_description;
        $aboutData['middle_section_content2_description'] = $request->middle_section_content2_description;
        $aboutData['middle_section_content3_description'] = $request->middle_section_content3_description;


        $aboutUs  = AboutUs::first();

        if (!empty($request->image)) {

            $old_img = isset($aboutUs) ? $aboutUs->image : '';
            $aboutData['image'] = fileUpload($request['image'], path_about_us_image(), $old_img);
        }


        if (!empty($request->middle_section_content1_icon)) {

            $old_img = isset($aboutUs) ? $aboutUs->middle_section_content1_icon : '';
            $aboutData['middle_section_content1_icon'] = fileUpload($request['middle_section_content1_icon'], path_about_us_image(), $old_img);
        }

        if (!empty($request->middle_section_content2_icon)) {

            $old_img = isset($aboutUs) ? $aboutUs->middle_section_content2_icon : '';
            $aboutData['middle_section_content2_icon'] = fileUpload($request['middle_section_content2_icon'], path_about_us_image(), $old_img);
        }

        if (!empty($request->middle_section_content3_icon)) {

            $old_img = isset($aboutUs) ? $aboutUs->middle_section_content3_icon : '';
            $aboutData['middle_section_content3_icon'] = fileUpload($request['middle_section_content3_icon'], path_about_us_image(), $old_img);
        }


        if ($aboutUs) {

            $aboutUs->update($aboutData);
            $message = 'Contact address successfully updated';

        } else {
            $aboutUs = AboutUs::create($aboutData);
            $message = 'Contact address successfully created';

        }

        if (isset($aboutUs)) {

            $data['success'] = true;
            $data['message'] = $message;
            $data['data'] = $aboutUs;

            return $data;
        }

        return $data;


    }

    public function termsAndCondition($request)

    {
        $data = ['success' => false, 'message' => 'Something went wrong', 'data' => ''];

        $termConData['terms_and_condition'] = $request->terms_and_condition;

        $termAndCond = TermsAndCondition::first();

        if ($termAndCond) {

            $termAndCond->update($termConData);
            $message = 'Terms and Condition successfully updated';

        } else {

            $termAndCond = TermsAndCondition::create($termConData);
            $message = 'Terms and Condition successfully created';

        }

        if (isset($termAndCond)) {

            $data['success'] = true;
            $data['message'] = $message;
            $data['data'] = $termAndCond;

            return $data;
        }

        return $data;


    }

    public function error404($request)

    {
        $data = ['success' => false, 'message' => 'Something went wrong', 'data' => ''];

        $error = Error404::first();

        if (!empty($request->image)) {

            $old_img = isset($error) ? $error->image : '';
            $errorData['image'] = fileUpload($request['image'], path_error404_image(), $old_img);
        }


        if ($error) {

            $error->update($errorData);
            $message = 'Error 404 page successfully updated';

        } else {

            $error = Error404::create($errorData);
            $message = 'Error 404 page successfully created';

        }

        if (isset($error)) {

            $data['success'] = true;
            $data['message'] = $message;
            $data['data'] = $error;

            return $data;
        }

        return $data;


    }

}
