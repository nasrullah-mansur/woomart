<?php

namespace  App\Http\Services;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use App\Model\User;
use Illuminate\Support\Facades\Hash;


class ProfileServices
{
    /*
     * * Profile Update
     */

    public function profileUpdate($request)
    {
        $data = ['success' =>false, 'data'=>'', 'message'=> 'Something went wrong, please try again, Thanks!'];

        $admin = Admin:: where('id', Auth::guard('admin')->user()->id)->first();

        $adminData['name'] = $request->get('name');
        $adminData['email'] = $request->get('email');
        $adminData['phone'] = $request->get('phone');
//        $userData['about'] = $request->get('about');
        $adminData['country'] = $request->get('country');
        $adminData['city'] = $request->get('city');

        if (!empty($request->image)) {

            if ($admin->image != $request->image) {
                $adminData['image'] = fileUpload($request['image'], path_user_image(), $admin->image);

            } else {
                $old_img = '';
                $adminData['image'] = fileUpload($request['image'], path_user_image(), $old_img);
            }
        }

            $update = $admin->update($adminData);

        if ($update)
        {
            $data['success'] = true;
            $data['message'] = 'Profile successfully updated';
            $data['data'] = '';

            return $data;
        }

        return $data;

    }

    //    ******************* End Profile update ******************

    /*
     * Password Update
     */

    public function passwordUpdate($request)
    {
        $data = ['success' =>false, 'data'=>'', 'message'=> 'Something went wrong, please try again, Thanks!'];

        $admin = Admin:: where('id', Auth::guard('admin')->user()->id)->first();
        $adminData['password'] =Hash::make( $request->get('password'));

            $update = $admin->update($adminData);

            if ($update)
            {
                $data['success'] = true;
                $data['message'] = 'Password successfully updated';
                $data['data'] = '';

                return $data;
            }

            return $data;
    }
    //    ******************* End Password update ******************
}
