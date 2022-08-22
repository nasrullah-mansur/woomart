<?php

namespace App\Http\Services;


use App\Model\Category;
use App\Model\ContactUs;

class ContactService
{
    /*
     *  * Add and Update Category
     */

    public function getAllContactForDatatable()
    {
        return ContactUs::select('*');
    }


    public function sendReply($request)
    {
        $data = ['success' => false, 'message' => 'Something went wrong', 'data' => []];

        $contactData['user_id'] = $request->user_id;
        $contactData['message'] = $request->message;
        $contactData['is_question'] = false;

        $contact = ContactUs::create($contactData);        // add/create new category
        if ($contact) {
            return [
                'success' => true,
                'message' => __('Message Successfully sent'),
                'data' => $contact,
            ];
        }
        return $data;
    }

    //    ***************** End add and Update Category *******************

}
