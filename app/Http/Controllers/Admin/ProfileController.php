<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminPasswordUpdateRequest;
use App\Model\District;
use App\Model\User;
use App\Http\Services\ProfileServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    private $profileService, $pageSettings;

    public function __construct(ProfileServices $profileService, Request $request)
    {
        $this->profileService = $profileService;

        $this->route = $request->route()->getAction();
        $this->page_title = isset($this->route['page_title']) ? $this->route['page_title'] : null;
        $this->task = isset($this->route['task']) ? $this->route['task'] : null;
        $this->pageSettings = array('page_title' => $this->page_title, 'task' => $this->task);
    }


    /*
     * * Find Auth profile
    */

    public function profile()
    {
        $admin = Auth::guard('admin')->user();
//        $districts = District::orderBy('name', 'asc')->get();       // Get all districts from Database
        $districts = null;
        return view('admin.profile.profile', ['admin' => $admin, 'districts' => $districts, 'menu' => 'Settings', 'page_title' => 'Profile']);
    }

    // ************************** End find Profile ******************

    /*
     * * Update Profile
     */

    public function updateProfile(Request $request)
    {
        $profile = $this->profileService->profileUpdate($request);       // call ProfileUpdate function from ProfileServoce class

        if ($profile['success'] == true) {
            return redirect()->route('admin.profile')->with('success', $profile['message']);
        }
        return redirect()->route('admin.profile')->with('dismiss', $profile['message']);

    }

    // ************************** End Update Profile ******************

    /*
     * * Update Password
     */


    public function updatePassword(Request $request)
    {

        app(AdminPasswordUpdateRequest::class);                      // input Password validation
        $user = $this->profileService->passwordUpdate($request);  // call PasswordUpdate function from ProfileServoce class

        if ($user['success'] == true) {
            return redirect()->route('admin.profile')->with('success', $user['message']);
        }
        return redirect()->route('admin.profile')->with('dismiss', $user['message']);
    }

    // ************************** End Update Profile ******************

}
