<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactUsRequest;
use App\Http\Requests\ContactUsSettingsRequest;
use App\Http\Services\SettingsService;
use App\Models\ContactUs;
use App\Models\ContactUsSetting;
use Illuminate\Http\Request;

class ContactUsSettingsController extends Controller
{

    private $settingsService;

    public function __construct(SettingsService $settingsService)
    {
        $this->settingsService = $settingsService;
    }

    public function contactUs(Request $request)
    {
        if ($request->isMethod('POST')) {
            app(ContactUsSettingsRequest::class);

            $contact_us = $this->settingsService->contactUs($request);

            if ($contact_us['success'] == true) {

                toast($contact_us['message'], 'success');
                return redirect()->back();

            } else {

                toast($contact_us['message'], 'success');
                return redirect()->back();
            }

        }
        $contact_us = ContactUsSetting::first();
        return view('admin.pages.contact_us', ['menu' => 'Pages','contact_us' => $contact_us,'page_title' => 'Contact us']);
    }
}
