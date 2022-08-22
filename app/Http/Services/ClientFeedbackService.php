<?php

namespace App\Http\Services;


use App\Models\ClientFeedback;
class ClientFeedbackService
{


    /*
     *  * update Tfeedback
     */

    public function update($request)
    {
        $data = ['success' => false, 'message' => 'Something went wrong', 'data' => []];

        $feedbackData['name'] = $request->name;
        $feedbackData['profession'] = $request->profession;
        $feedbackData['feedback'] = $request->feedback;
        $feedbackData['active_status'] = $request->active_status;

        $feedback = ClientFeedback::where('id', $request->edit_id)->first();


        if ($feedback) {

            if (!empty($request->image)) {

                $old_img = isset($feedback) ? $feedback->image : '';

                $feedbackData['image'] = fileUpload($request['image'], path_user_image(), $old_img);  // upload image/file
            }

            $success = $feedback->update($feedbackData);

            if ($success) {

                $data['success'] = true;
                $data['message'] = __('Client feedback successfully updated');
                $data['data'] = $feedback;

                return $data;
            }

            return $data;
        }

        $data['message'] = "Client feedback doesn't exists";
        return $data;
    }

    //    ***************** End update  feedback *******************

}
