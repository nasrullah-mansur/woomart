<?php

namespace App\Http\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthenticationService
{

    # User Registration

    public function signUp($request)
    {
        $data = ['success' => false, 'code' => 404, 'data' => '', 'message' => __('return.something.wrong')];

        $userData['name'] = $request->name;
        $userData['email'] = $request->email;
        $userData['password'] = Hash::make($request->password);

        $user = User::create($userData);

        if ($user) {

            $data = [
                'success' => true,
                'code' => 200,
                'data' => $user,
                'message' => __('Sign successfully completed')
            ];

            return $data;
        }

        return $data;

    }

    #  User Login

    public function signIn($request)
    {
        $data = ['success' => false, 'data' => '', 'message' => __('Email or password not match')];

        $remember_me = $request->has('remember') ? true : false;

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember_me)) {

            $data['success'] = true;
            $data['data'] = Auth::user();
            $data['message'] = __('Welcome to woomart');

            return $data;

        }

        return $data;

    }

    # ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ Admin ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~


    public function login($request, $guard)
    {
        $data = ['success' => false, 'data' => '', 'message' => __('Email or Password not match')];

        $remember_me = $request->has('remember') ? true : false ;

        if (Auth::guard($guard)->attempt(['email' => $request->email, 'password' => $request->password], $remember_me)) {

            $data['success'] = true;
            $data['data'] = Auth::guard($guard)->user();
            $data['message'] = __('Welcome to ShopStick');

            return $data;

        }

        return $data;

    }

    # ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ logout ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    public function logout($guard)
    {
        $data = ['success' => false, 'data' => '', 'message' => __('Email or Password not match')];

        if (Auth::guard($guard)->check()) {

            Auth::guard($guard)->logout();
            return [
                'success' => true,
                'message' => 'Successfully Logout, Thanks !',
            ];
        }
        return $data;
    }


}

