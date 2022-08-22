<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignUpRequest;
use App\Http\Requests\UserLoginRequest;
use App\Model\Upazila;
use App\Http\Services\AuthenticationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

session()->regenerate();

class AuthController extends Controller

{

    private $authenticationService;

    public function __construct(AuthenticationService $authenticationService)
    {
        $this->authenticationService = $authenticationService;
    }

# ********************** user Register Process ****************************


    public function signUp(Request $request)
    {
        if ($request->isMethod('POST')) {

            if ($request->has('agree')){

                app(SignUpRequest::class);

                $signUp = $this->authenticationService->signUp($request);

                if ($signUp['success'] == true) {

                    return redirect()->route('sign.in');
                }

                toast($signUp['message'], 'warning');
                return redirect()->route('sign.up');
            }

            toast('please select term and policy', 'warning');
            return  \redirect()->back();

        }

        return view('front.auth.sign_up',['page_title' => 'sign up']);
    }


# ********************** User   LogIn Process ****************************

    public function signIn(Request $request)
    {
        if ($request->isMethod('POST')) {

            $validator = app(UserLoginRequest::class);

            $auth = $this->authenticationService->signIn($request);

            if ($auth['success'] == true) {

                toast($auth['message'], 'success');
                return \redirect()->route('home');
            }

            toast($auth['message'], 'warning');
            return \redirect()->route('sign.in');

        }

//        if (Auth::check()) {
//
//            return \redirect()->route('user.dashboard', app()->getLocale());
//        }

        return view('front.auth.sign_in',['page_title' => 'sign in']);

    }


    public function adminLogout()
    {
        $auth = $this->authenticationService->logout(GUARD_ADMIN);

        if ($auth['success'] = true) {
            return \redirect()->route('home', app()->getLocale())->with('success', $auth['message']);
        }
        return \redirect()->route('home', app()->getLocale())->withErrors('success', $auth['message']);
    }


# ****************************Reset Password**************************

    public function resetPassword(Request $request)
    {
        $current_url = session::get('current_url');

        if ($request->isMethod('POST')) {

            $success = app(CommonService::class)->sendPasswordResetLink($request);  // send email to reset password

            if ($success['status'] == true) {

                return redirect::to($current_url)->with('success', __($success['message']));
            }
            return redirect()->back()->with('dismiss', __($success['message']));

        }

        return view('Auth.reset_password');
    }


    public function passwordResetView($token)
    {
        return view('Auth.reset-pass')->with('token', $token);
    }

    public function updatePassword(Request $request)
    {
        $current_url = session::get('current_url');

//        app(ResetPasswordRequest::class);

        $update = app(CommonService::class)->updatePassword($request);      // update password

        if ($update['status'] == true) {
            return redirect::to($current_url)->with('success', $update['message']);
        }
        return redirect()->route('home')->with('dismiss', $update['message']);
    }

# get Upazila list
    public function getUpazila(Request $request)
    {
        $upazilas = Upazila::select('id', 'name')->where('district_id', $request->district_id)->get();

        return json_encode($upazilas);
    }

# get area list
    public function getArea(Request $request)
    {

        $areas = Union::select('id', 'name')->where('upazila_id', $request->upazila_id)->get();

        return json_encode($areas);
    }

}
