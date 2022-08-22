<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminProfileUpdate;
use App\Http\Requests\LoginRequest;
use App\Http\Services\AdminService;
use App\Services\AuthenticationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\PasswordRequest;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{
    private $adminService, $pageSettings;
    public function __construct(AdminService $adminService, Request $request)
    {
        $this->adminService = $adminService;

        $this->route = $request->route()->getAction();
        $this->page_title = isset($this->route['page_title']) ? $this->route['page_title'] : null;
        $this->task = isset($this->route['task']) ? $this->route['task'] : null;
        $this->pageSettings = array('page_title' => $this->page_title, 'task' => $this->task);
    }


    /*
     * * Login
     */

    public function login(Request $request)
    {
        // if (Auth::guard('admin')->check()) {
        //     return redirect()->route('admin.dashboard', app()->getLocale());
        // }

        if ($request->isMethod('POST')) {
            app(LoginRequest::class);

            $auth = app(AuthenticationService::class)->login($request, $guard = 'admin');

            if ($auth['success'] == true) {
                return redirect()->route('admin.dashboard', app()->getLocale());
            }
            Alert::error('Oofs',$auth['message'] );
            return \redirect()->route('admin.login',app()->getLocale());
        }


        return view('admin.auth.login');

    }


    /*
     * * Admin Profile
     */

    public function profile(Request $request)
    {
        if ($request->isMethod('post')) {

            app(AdminProfileUpdate::class);
            $admin = $this->adminService->storeOrUpdate($request);

            if ($admin['success'] == true) {
                return \redirect()->route('admin.profile', app()->getLocale())->with('success', $admin['message']);
            }

            Alert::error('ops', $admin['message']);
            return \redirect()->route('admin.profile', app()->getLocale());
        }

        $admin_id = Auth::guard('admin')->id();
        $admin = $this->adminService->profile($admin_id);

        if ($admin['success'] == true) {
            return view('admin.profile.profile', ['admin' => $admin['data']]);
        }

        Alert::error('oops !', 'Something went wrong');
        return redirect()->route('admin.dashboard', app()->getLocale());
    }


    /*
     * * Update password
     */

    public function passwordUpdate(Request $request)
    {
        app(PasswordRequest::class);
        $admin = $this->adminService->passwordUpdate($request);

        if ($admin['success'] == true) {
            return \redirect()->route('admin.profile', app()->getLocale())->withSuccess('', $admin['message']);
        }
        return redirect()->route('admin.dashboard,app()->getLocale()')->withErrors('oops !', 'Something went wrong');

    }

    public function logout()
    {
        $logout = app(AuthenticationService::class)->logout($guard = 'admin');

        if ($logout['success'] == true) {
            return redirect()->route('admin.login', app()->getLocale())->with('success', $logout['message']);
        }
        return redirect()->route('admin.login', app()->getLocale())->with('success', $logout['message']);
    }


}
