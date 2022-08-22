<?php

namespace App\Http\Controllers;

use App\Http\Requests\PhoneNuberRequst;
use App\Http\Requests\SignUpRequest;
use App\Http\Requests\VendorRegisterRequest;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\VendorUpdatePasswordRequest;
use App\Http\Services\AuthenticationService;
use App\Model\User;
use App\Model\Upazila;
use App\Model\District;
use App\Model\Vendor;
use App\Services\CommonService;
use App\Services\VendorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use function GuzzleHttp\Promise\all;

session()->regenerate();

class AuthController extends Controller
{

    private $authenticationService;

    function __construct(AuthenticationService $authenticationService)
    {
        return $this->authenticationService = $authenticationService;
    }

# **********************Admin  LogIn Process ****************************
    public function adminLogin(Request $request)
    {
        if ($request->isMethod('POST')) {
            app(UserLoginRequest::class);

            $auth = $this->authenticationService->login($request, GUARD_ADMIN);

            if ($auth['success'] == true) {
                return \redirect()->route('admin.dashboard')->with('success', $auth['message']);
            }

            return \redirect()->route('admin.login')->with('warning', $auth['message']);
        }

        if (Auth::guard(GUARD_ADMIN)->check()) {
            return \redirect()->route('admin.dashboard');
        }
        return view('admin.auth.login');
    }


    public function adminLogout()
    {
        $auth = $this->authenticationService->logout(GUARD_ADMIN);

        if ($auth['success'] = true) {
            return \redirect()->route('admin.login')->with('success', $auth['message']);
        }
        return \redirect()->route('admin.login')->with('errors', $auth['message']);
    }


#********************** vendor  LogIn Process ****************************

    public function vendorLogin(Request $request)
    {

        if ($request->isMethod('POST')) {

            app(UserLoginRequest::class);

            $auth = $this->authenticationService->login($request, GUARD_VENDOR);

            if ($auth['success'] == true) {

                if ($auth['data']->status == STATUS_ACTIVE) {

                    return \redirect()->route('vendor.dashboard')->with('success','Welcome to Shopstick Seller Center');

                } else {

                    Auth::guard('vendor')->logout();

                    return \redirect()->route('vendor.login')->with('errors', 'You are not authorized, please contact with Shopstick');

                }
            }
            return \redirect()->route('vendor.login')->with('errors', $auth['message']);

        }

        if (Auth::guard(GUARD_VENDOR)->check()) {

            $vendor = Vendor::where('id',Auth::guard(GUARD_VENDOR)->id() )->first();

            if ($vendor->status == STATUS_ACTIVE) {

                return \redirect()->route('vendor.dashboard')->with('success', 'Welcome to Shopstick Seller Center');

            } else {
                Auth::guard('vendor')->logout();

                return \redirect()->route('vendor.login')->with('errors', 'You are not authorized, please contact with Shopstick');

            }
        }

        return view('vendor.auth.login');
    }


    public function vendorLogout()
    {
        $auth = $this->authenticationService->logout(GUARD_VENDOR);

        if ($auth['success'] == true) {
            return \redirect()->route('vendor.login')->with('success', $auth['message']);
        }
        return \redirect()->route('vendor.login')->with('errors', $auth['message']);
    }

    public function register(Request $request)
    {

        if ($request->isMethod('POST')) {
            app(VendorRegisterRequest::class);

            $result = app(VendorService::class)->create($request);
            if ($result['status'] == true) {
                return \redirect()->route('vendor.login')->with('success', $result['message']);
            }
            return \redirect()->route('vendor.register')->with('errors', $result['message']);

        }

        $city = District::select('id', 'name', 'bn_name')->orderBy('name', 'asc')->get();
        return view('vendor.auth.register', ['cities' => $city]);
    }

    # ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ Vendor forget password ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    public function vendorForgetPassword(Request $request)
    {
        if ($request->isMethod('post')) {
            app(PhoneNuberRequst::class);

            $vendor = Vendor::where(['phone' => $request->phone_number])->first();

            if ($vendor) {

                do {
                    $reset_token = randomNumber(6);
                    $exist_vendor = Vendor::where('reset_token', $reset_token)->first();

                } while ($exist_vendor);


                $update = $vendor->update([

                    'reset_token' => $reset_token,
                ]);

                if ($update) {

                    $sendSms = send_sms($request->phone_number, 'Dear Seller, your OTP for Reset password to SHOPSTICK is ' . $reset_token . ' Use this OTP to reset password.');

                    return \redirect()->route('vendor.update.password');
                }

                return \redirect()->back()->with('errors', 'Something went wrong, please try again');

            }
            return \redirect()->back()->with('errors', 'Phone number not found');

        }

        return view('vendor.auth.forget_password');
    }


    public function vendorUpdatePassword(Request $request)
    {
        if ($request->isMethod('post')) {

            app(VendorUpdatePasswordRequest::class);

            $vendor = Vendor::where(['reset_token' => $request->otp])->first();

            if ($vendor) {

                $vendorData['password'] = Hash::make($request->password);
                $vendorData['reset_token'] = null;

                $update = $vendor->update($vendorData);

                if ($update) {

                    return \redirect()->route('vendor.login')->with('success', 'Password updated successfully');

                }
                return \redirect()->route('vendor.update.password')->with('errors', 'Something went wrong, please try again');

            }

            return \redirect()->route('vendor.update.password')->with('errors', 'OTP does not match');
        }

        return view('vendor.auth.update_password');

    }

//********************** User LogIn Process ****************************

    public function login(Request $request)

    {
        if ($request->isMethod('POST')) {

            $current_url = session::get('current_url');             // get current url from front end to redirect this urlafter login
            app(UserLoginRequest::class);

            $userResults = app(CommonService::class)->userLogin($request);

            if ($userResults) {
                if ($userResults['active_status'] == 0) {
                    return redirect()->route('home')->with('dismiss', __('User Disable, please contact us'));
                }
                if ($userResults->role == 1) {
                    return redirect()->route('admin.dashboard');

                } elseif ($userResults->role == 2) {

                    return redirect()->route('admin.dashboard');

                } elseif ($userResults->role == 3) {

                    return redirect::to($current_url);
                }
            }

            return redirect()->route('login')->with('dismiss', __('email or password not match!!'));
        }

        return view('Auth.login');
    }

    //***************************** Social Login ****************************

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        $current_url = session::get('current_url');

        try {
            $user = Socialite::driver($provider)->user();
            $existingUser = User::where('email', $user->getEmail())->first();

            if ($existingUser) {
                if ($existingUser['active_status'] == 0) {
                    return redirect()->route('home')->with('dismiss', __('User Disable, please contact us'));
                }

                auth()->login($existingUser);
                $user = Auth::user();

                if ($user->role == 1) {          // login as Super Admin
                    return redirect()->route('admin.dashboard');

                } elseif ($user->role == 2) {        // login as vendor
                    return redirect()->route('admin.dashboard');

                } elseif ($user->role == 3) {           // logn  as user

                    return redirect::to($current_url);

                }

            } else {
                $newUser = User::create([
                    'name' => $user->getName(),
                    'email' => $user->getEmail(),
                    'password' => Hash::make('%az_za%'),
                    'role' => 3,            // login as a user
                    'active_status' => 1,
                ]);

                auth()->login($newUser);

                $user = Auth::user();

                if ($user->role == 1) {          // login as a SuperAdmin
                    return redirect()->route('admin.dashboard');

                } elseif ($user->role == 2) {        // login as a vendor
                    return redirect()->route('admin.dashboard');

                } elseif ($user->role == 3) {        // login as a user

                    return redirect::to($current_url);
                }
            }

        } catch (\Exception $e) {

            return redirect('login');
        }
    }

//****************************Reset Password**************************

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

//    ********************** Registration **************************

    public function registration(Request $request)
    {
        $current_url = session::get('current_url');

        if ($request->isMethod('POST')) {
            app(SignUpRequest::class);

            $userData = app(CommonService::class)->userRegistration($request);      // new user create

            if ($userData) {
                return redirect::to('login')->with('success', $userData['message']);
            } else {
                return redirect()->route('register')->with('dismiss', $userData['message']);
            }
        }

        return view('Auth.login');
    }


//    *****************Logout***************

    public function logout()
    {
//        \Cart::clear();

        Auth::logout();
        return redirect()->route('home');
    }


// get area list
    public function areaList(Request $request)
    {

        $district = District::select('id')->where('name', $request->city)->first();
        $areas = Upazila::select('id', 'name')->where('district_id', $district->id)->orderBy('name', 'asc')->get();
        return json_encode($areas);
    }

}
