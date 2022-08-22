<?php

namespace App\Http\Services;

use App\Model\User;
use App\Repository\CommonRepository;
use App\Services\Mail\ResetPasswordMail;
use App\Services\Mail\VerifyMail;
use function Couchbase\defaultDecoder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class CommonService
{
    public function userRegistration($request)
    {
        $data = ['status' => false, 'data' => '', 'message' => __('Something went wrong, please try again, Thanks')];

        try {
            $user = User::create([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'mobile' => $request->get('mobile'),
//            'logcode' => md5( $request->email . uniqid() . str_random( 5 ) ),
                'password' => Hash::make($request->get('password')),
                'role' => $request->get('role'),
                'active_status' => 1,
                'email_verification' => randomNumber(32),
            ]);
            return [
                'status' => true,
                'data' => $user,
                'message' => __('Registration completed, Please login.!'),
            ];

        } catch (\Exception $e) {
            dd($e->getMessage());
            return $data;
        }
    }


    public function userLogin($request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return $userResults = Auth::user();
        }
    }

//**********************Reset Password*******************

    public function sendPasswordResetLink($request)
    {
        $data = ['status' => false, 'data' => '', 'message' => __('Something went wrong, please try again, Thanks')];

        $user = User::where('email', '=', $request->email)->first();

        if ($user) {
            $token = Str::random(32);

            $updateToken = User::where('email', '=', $user->email)
                ->update(['reset_token' => $token]);

            if ($updateToken) {
                $tokenUser = User::where(['reset_token' => $token])->where(['email' => $user->email])->first();
                $mailTemplet = 'email.verify';

                $this->sendPasswordResetEmail($tokenUser, $mailTemplet);

                return [
                    'status' => true,
                    'message' => __('Reset password link sent to your email, please check'),
                    'data' => ''
                ];
            }
        }
        return [
            'status' => true,
            'message' => __('Account not found'),
            'data' => ''
        ];

    }

    public function updatePassword($request)
    {
        $data = ['status' => false, 'data' => '', 'message' => __('Something went wrong, please try again, Thanks')];

        $pass = Hash::make($request->password);
        try {
            $user = User::where('reset_token', '=', $request->reset_token)
                ->update(['password' => $pass]);

            return [
                'status' => true,
                'message' => __('Password successfully updated, please login with new password, Thanks'),
                'data' => $user,

            ];
        } catch (\Exception $e) {
            return $data;
        }
    }

//    ******************************* Send Mail ****************

    public function sendPasswordResetEmail($user, $mailTemplet, $mail_key = '')
    {
        $mailService = app(\App\Http\Services\MailService::class);

        $userName = $user->name;
        $userEmail = $user->email;
        $companyName = isset(allSettings()['company_name']) && !empty(allSettings()['company_name']) ? allSettings()['company_name'] : __('Company Name');
        $subject = __('Reset Password | :companyName', ['companyName' => $companyName]);
        $data['data'] = $user;
//        $data['key'] = $mail_key;
        $data['key'] = $user->reset_token;
       $sendMail =  $mailService->send($mailTemplet, $data, $userEmail, $userName, $subject);
    }

//    *************** sendEmailVerification **************

    public function sendEmailVerificationEmail($user, $mailTemplet, $mail_key = '')
    {
        $mailService = app(\App\Services\MailService::class);

        $userName = $user->name;
        $userEmail = $user->email;
        $companyName = isset(allSettings()['company_name']) && !empty(allSettings()['company_name']) ? allSettings()['company_name'] : __('Company Name');
        $subject = __('Email Verification | :companyName', ['companyName' => $companyName]);
        $data['data'] = $user;
        $data['key'] = $user->email_verification;
       $sendMail =  $mailService->send($mailTemplet, $data, $userEmail, $userName, $subject);
    }


    //    public function sendPasswordResetEmail($user)
//    {
//        try {
//
//            Mail::to($user->email)->send(new ResetPasswordMail($user));
//
//        } catch (\Exception $e) {
//            dd($e);
//
//            return __('Something went wrong, email can not sent..!!');
//        }
//    }


    //    *************** sendEmailVerification **************

    public function supplierPaymentInformation($supplier)
    {
        $mailService = app(MailService::class);

        $userName = $supplier->supplier->name;
        $userEmail = $supplier->supplier->email;

        $mailTemplate =   'email.supplier_payment_information';


        $companyName = isset(allSettings()['company_name']) && !empty(allSettings()['company_name']) ? allSettings()['company_name'] : __('FoodStick');

        $subject = __('Account Information | :companyName', ['companyName' => $companyName]);
        $data['data'] = $supplier;

        $sendMail =  $mailService->send($mailTemplate, $data, $userEmail, $userName, $subject);
    }

}
