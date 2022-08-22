<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AboutUsPageRequest;
use App\Http\Requests\Error404Request;
use App\Http\Requests\GeneralSettingRequest;
use App\Http\Requests\HomePagesesRequest;
use App\Http\Requests\SIngUpSignUnPagesesRequest;
use App\Http\Requests\TermAndConditionRequest;
use App\Http\Services\PagesService;
use App\Models\AboutUs;
use App\Models\Error404;
use App\Models\GeneralSettings;
use App\Models\TermsAndCondition;
use Illuminate\Http\Request;

class PagesController extends Controller

{

    private $pageService;

    public function __construct(PagesService $pageService)
    {
        $this->pageService = $pageService;
    }

    public function aboutUs(Request $request)
    {
        if ($request->isMethod('POST')) {

//            app(AboutUsPageRequest::class);

            $about_us = $this->pageService->aboutUs($request);

            if ($about_us['success'] == true) {

                toast($about_us['message'], 'success');
                return redirect()->back();

            } else {

                toast($about_us['message'], 'success');
                return redirect()->back();
            }

        }
        $about_us = AboutUs::first();
        return view('admin.pages.about_us', ['about_us' => $about_us, 'menu' => 'Pages', 'page_title' => 'About Us']);
    }


    public function termAndConditions(Request $request)
    {
        if ($request->isMethod('POST')) {

            app(TermAndConditionRequest::class);

            $about_us = $this->pageService->termsAndCondition($request);

            if ($about_us['success'] == true) {

                toast($about_us['message'], 'success');
                return redirect()->back();

            } else {

                toast($about_us['message'], 'success');
                return redirect()->back();
            }

        }

        $terms_and_conditions = TermsAndCondition::first();
        return view('admin.pages.terms_and_conditions', ['terms_and_conditions' => $terms_and_conditions, 'menu' => 'Pages', 'page_title' => 'Terms and Conditions']);
    }


    public function error404(Request $request)
    {
        if ($request->isMethod('POST')) {

            app(Error404Request::class);

            $error = $this->pageService->error404($request);

            if ($error['success'] == true) {

                toast($error['message'], 'success');
                return redirect()->back();

            } else {

                toast($error['message'], 'success');
                return redirect()->back();
            }

        }

        $error404 = Error404::first();
        return view('admin.pages.error404', ['error404' => $error404, 'menu' => 'Pages', 'page_title' => 'Error 404']);
    }


    public function signUpSignIn(Request $request)

    {
        if ($request->isMethod('POST')) {

            app(SIngUpSignUnPagesesRequest::class);
            $data = GeneralSettings::get();

            foreach ($data as $item) {

                if ($item->slug == 'sign_up_title' && $item->value != $request->sign_up_title) {
                    GeneralSettings::where('slug', '=', 'sign_up_title')->update(['value' => $request->sign_up_title]);

                } elseif ($item->slug == 'why_sign_up' && $item->value != $request->why_sign_up) {
                    GeneralSettings::where('slug', '=', 'why_sign_up')->update(['value' => $request->why_sign_up]);

                } elseif ($item->slug == 'agree_for' && $item->value != $request->agree_for) {
                    GeneralSettings::where('slug', '=', 'agree_for')->update(['value' => $request->agree_for]);

                } elseif ($item->slug == 'sign_in_title' && $item->value != $request->sign_in_title) {
                    GeneralSettings::where('slug', '=', 'sign_in_title')->update(['value' => $request->sign_in_title]);

                } elseif ($item->slug == 'welcome_message' && $item->value != $request->welcome_message) {
                    GeneralSettings::where('slug', '=', 'welcome_message')->update(['value' => $request->welcome_message]);

                } elseif ($item->slug == 'sign_in_image' && $item->value != $request->sign_in_image) {

                    if (!empty($request->sign_in_image)) {

                        $old_image = allSettings('sign_in_image');
                        $new_image = $request->sign_in_image;
                        $sign_in_image = fileUpload($new_image, path_general_settings_image(), $old_image);
                        GeneralSettings::where('slug', '=', 'sign_in_image')->update(['value' => asset(path_general_settings_image() . $sign_in_image)]);
                    }


                } elseif ($item->slug == 'sign_up_image' && $item->value != $request->sign_up_image) {

                    if (!empty($request->sign_up_image)) {

                        $old_image = allSettings('sign_up_image');
                        $new_image = $request->sign_up_image;
                        $sign_up_image = fileUpload($new_image, path_general_settings_image(), $old_image);
                        GeneralSettings::where('slug', '=', 'sign_up_image')->update(['value' => asset(path_general_settings_image() . $sign_up_image)]);
                    }

                }
            }

            toast('SIng Up & Sing In page successfully updated', 'success');
            return redirect()->back();
        }

        $settings = allSettings();
        return view('admin.pages.sign_up_sign_in', ['menu' => 'Pages', 'page_title' => 'Sign Up & Sign In', 'settings' => $settings]);
    }

    public function home(Request $request)

    {
        if ($request->isMethod('POST')) {

            app(HomePagesesRequest::class);
            $data = GeneralSettings::get();

            foreach ($data as $item) {

                if ($item->slug == 'first_section' && $item->value != $request->first_section) {
                    GeneralSettings::where('slug', '=', 'first_section')->update(['value' => $request->first_section]);

                } elseif ($item->slug == 'second_section' && $item->value != $request->second_section) {
                    GeneralSettings::where('slug', '=', 'second_section')->update(['value' => $request->second_section]);

                } elseif ($item->slug == 'third_section' && $item->value != $request->third_section) {
                    GeneralSettings::where('slug', '=', 'third_section')->update(['value' => $request->third_section]);

                } elseif ($item->slug == 'category_section' && $item->value != $request->category_section) {
                    GeneralSettings::where('slug', '=', 'category_section')->update(['value' => $request->category_section]);

                }
            }

            toast('Home page successfully updated', 'success');
            return redirect()->back();
        }

        $settings = allSettings();
        return view('admin.pages.home', ['menu' => 'Pages', 'page_title' => 'Home', 'settings' => $settings]);
    }


}
