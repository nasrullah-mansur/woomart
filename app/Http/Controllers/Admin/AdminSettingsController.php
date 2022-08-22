<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GeneralSettingRequest;
use App\Models\GeneralSettings;
use Illuminate\Http\Request;

class AdminSettingsController extends Controller
{
    public function generalSettings(Request $request)
    {
        if ($request->isMethod('POST')) {

            app(GeneralSettingRequest::class);
            $data = GeneralSettings::get();

            foreach ($data as $item) {

                if ($item->slug == 'title' && $item->value != $request->title) {
                    GeneralSettings::where('slug', '=', 'title')->update(['value' => $request->title]);

                } elseif ($item->slug == 'about_us' && $item->value != $request->about_us) {
                    GeneralSettings::where('slug', '=', 'about_us')->update(['value' => $request->about_us]);

                } elseif ($item->slug == 'company_name' && $item->value != $request->company_name) {
                    GeneralSettings::where('slug', '=', 'company_name')->update(['value' => $request->company_name]);

                } elseif ($item->slug == 'meta_keywords' && $item->value != $request->meta_keywords) {
                    GeneralSettings::where('slug', '=', 'meta_keywords')->update(['value' => $request->meta_keywords]);

                } elseif ($item->slug == 'meta_author' && $item->value != $request->meta_author) {
                    GeneralSettings::where('slug', '=', 'meta_author')->update(['value' => $request->meta_author]);

                } elseif ($item->slug == 'meta_description' && $item->value != $request->meta_description) {
                    GeneralSettings::where('slug', '=', 'meta_description')->update(['value' => $request->meta_description]);

                } elseif ($item->slug == 'currency' && $item->value != $request->currency) {
                    GeneralSettings::where('slug', '=', 'currency')->update(['value' => $request->currency]);

                } elseif ($item->slug == 'first_section' && $item->value != $request->first_section) {

                    GeneralSettings::where('slug', '=', 'first_section')->update(['value' => $request->first_section]);

                } elseif ($item->slug == 'second_section' && $item->value != $request->second_section) {
                    GeneralSettings::where('slug', '=', 'second_section')->update(['value' => $request->second_section]);

                } elseif ($item->slug == 'third_section' && $item->value != $request->third_section) {
                    GeneralSettings::where('slug', '=', 'third_section')->update(['value' => $request->third_section]);

                }elseif ($item->slug == 'facebook' && $item->value != $request->facebook) {
                    GeneralSettings::where('slug', '=', 'facebook')->update(['value' => $request->facebook]);

                } elseif ($item->slug == 'twitter' && $item->value != $request->twitter) {
                    GeneralSettings::where('slug', '=', 'twitter')->update(['value' => $request->twitter]);

                } elseif ($item->slug == 'linkedin' && $item->value != $request->linkedin) {
                    GeneralSettings::where('slug', '=', 'linkedin')->update(['value' => $request->linkedin]);

                } elseif ($item->slug == 'pinterest' && $item->value != $request->pinterest) {
                    GeneralSettings::where('slug', '=', 'pinterest')->update(['value' => $request->pinterest]);

                } elseif ($item->slug == 'logo' && $item->value != $request->logo) {

                    if (!empty($request->logo)) {

                        $old_image = allSettings('logo');
                        $new_image = $request->logo;
                        $logo = fileUpload($new_image, path_general_settings_image(), $old_image);
                        GeneralSettings::where('slug', '=', 'logo')->update(['value' => asset(path_general_settings_image().$logo)]);
                    }


                } elseif ($item->slug == 'fav_icon' && $item->value != $request->fav_icon) {

                    if (!empty($request->fav_icon)) {

                        $old_image = $item->value;
                        $new_image = $request->fav_icon;
                        $fav_icon = fileUpload($new_image, path_general_settings_image(), $old_image);
                        GeneralSettings::where('slug', '=', 'fav_icon')->update(['value' => asset(path_general_settings_image().$fav_icon)]);
                    }

                }
            }

            toast('General settings successfully updated', 'success');
            return redirect()->back();
        }
        $settings = allSettings();
        return view('admin.settings.general_settings', ['settings' => $settings, 'page_title' => 'General Settings']);
    }


    public function settings()
    {
        $data['adm_setting'] = allsettings();

        return view('admin.layouts.admin_settings.settings', $data);
    }

    public function asettingProcess(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        } else {
            if ($user->role == 1) {
                $data = AdminSetting::get();
                foreach ($data as $item) {
                    if ($item->slug == 'lang' && $item->value != $request->lang) {
                        AdminSetting::where('slug', '=', 'lang')->update(['value' => $request->lang]);
                    } elseif ($item->slug == 'company' && $item->value != $request->company) {
                        AdminSetting::where('slug', '=', 'company')->update(['value' => $request->company]);
                    } elseif ($item->slug == 'from' && $item->value != $request->from) {
                        AdminSetting::where('slug', '=', 'from')->update(['value' => $request->from]);
                    } elseif ($item->slug == 'primaryemail' && $item->primaryemail != $request->primaryemail) {
                        AdminSetting::where('slug', '=', 'primaryemail')->update(['value' => $request->primaryemail]);
                    } elseif ($item->slug == 'sid' && $item->sid != $request->sid) {
                        AdminSetting::where('slug', '=', 'sid')->update(['value' => $request->sid]);
                    } elseif ($item->slug == 'token' && $item->token != $request->token) {
                        AdminSetting::where('slug', '=', 'token')->update(['value' => $request->token]);

                    } elseif ($item->slug == 'about_us' && $item->about_us != $request->about_us) {
                        AdminSetting::where('slug', '=', 'about_us')->update(['value' => $request->about_us]);
                    }
                }
                return redirect()->back()->with(['success' => __('Setting Data has been saved successfully')])->withInput(['tabdetector' => $request->tabdetector]);
            } else {
                return redirect()->route('user.dashboard');
            }
        }
    }

    /*
     * start section naming settings
     */
    public function sectionNamingSettings(Request $request)
    {
        if ($request->isMethod('POST')) {
            $data = General_setting::get();
            foreach ($data as $item) {
                if ($item->slug == 'first_section' && $item->value != $request->first_section) {
                    General_setting::where('slug', '=', 'first_section')->update(['value' => $request->first_section]);
                } elseif ($item->slug == 'second_section' && $item->value != $request->second_section) {
                    General_setting::where('slug', '=', 'second_section')->update(['value' => $request->second_section]);
                } elseif ($item->slug == 'third_section' && $item->value != $request->third_section) {
                    General_setting::where('slug', '=', 'third_section')->update(['value' => $request->third_section]);
                }
            }
            return redirect()->back()->with(['success' => __('Section naming saved successfully')]);
        }

        $settings = allSettings();
        return view('admin.settings.section_naming_settings', ['settings' => $settings]);
    }
    /*
     * end section naming settings
     */
}
