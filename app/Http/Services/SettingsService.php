<?php

namespace App\Http\Services;

use App\Models\ContactUsSetting;

class SettingsService
{

    public function contactUs($request)
    {
        $data = ['success' => false, 'message' => 'Something went wrong', 'data' => ''];

        $data['contact_title'] = $request->contact_title;
        $data['why_contact'] = $request->why_contact;
        $data['form_title'] = $request->form_title;

        $data['address'] = $request->address;
        $data['phone'] = $request->phone;
        $data['email'] = $request->email;
        $data['site_url'] = $request->site_url;

        $contactUs = ContactUsSetting::first();
        if ($contactUs) {
            $contactUs->update($data);
            $message = 'Contact address successfully updated';

        } else {
            $contactUs = ContactUsSetting::create($data);
            $message = 'Contact address successfully created';

        }

        if (isset($contactUs)) {
            $data['success'] = true;
            $data['message'] = $message;
            $data['data'] = $contactUs;

            return $data;
        }

        return $data;


    }
}
