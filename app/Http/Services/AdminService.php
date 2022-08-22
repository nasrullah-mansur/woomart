<?php

namespace App\Http\Services;

use App\Http\Repository\AdminPackageRepository;
use App\Http\Repository\AdminRepository;
use App\Http\Repository\PackageRepository;
use App\Services\PromoterService;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminService
{
    /*
     * * Admin Create Or Update
     */

    private $adminRepository, $commonService;

    public function __constructor(AdminRepository $adminRepository, CommonService $commonService)
    {
        $this->adminRepository = $adminRepository;
        $this->commonService = $commonService;
    }


    public function getAllAdminForDatatable()
    {
        return App::make(AdminRepository::class)->getAllAdminForDatatable();

    }

    /*
     * * Admin Create and update with package
     */
    public function storeOrUpdate($request)
    {

        $data = ['success' => false,'code' =>404,  'data' => '', 'message' => __('Something went wrong, please try again, Thanks')];

        $adminData['name'] = $request->get('name');
        $adminData['email'] = $request->get('email');
        $adminData['phone'] = $request->get('phone');
        $adminData['status'] = $request->get('status') ? $request->get('status') : STATUS_TRIAL_FACE;

//******************************** Image upload **********************

        if (!empty($request->image)) {
            $old_img = '';

            if (!empty($request->edit_id)) {
                $admin = \app(AdminRepository::class)->first(['id' => $request->edit_id]);
                if ($admin) {
                    $old_img = $admin->image;
                }
            }

            $adminData['image'] = fileUpload($request['image'], path_profile_image(), $old_img); // image/file upload
        }
//        ******************* Admin Update **************

        if ($request->get('edit_id')) {

            $adminData['edit_id'] = $request->get('edit_id');
            $admin = app(AdminRepository::class)->update($adminData);

            if ($admin) {

                $data['success'] = true;
                $data['code'] = 200;
                $data['data'] = $admin;

                $data['message'] = __('successfully updated');
                return $data;
            }
            return $data;
        }

//            ************** Admin Create ****************

        $adminData['package_id'] = $request->get('package_id');
        $adminData['password'] = Hash::make($request->get('password'));
        $adminData['email_verification_code'] = randomString(32);
        $adminData['password_reset_code'] = randomString(32);
        $adminData['email_verified'] = true;
        $password = $request->get('password');

        $admin = app(AdminRepository::class)->store($adminData);
        if ($admin) {

            $package_id = $adminData['package_id'];
            if (empty($package_id)) {

                $data['success'] = true;
                $data['code'] = 200;
                $data['data'] = $admin;
                $data['message'] = __('Admin successfully created without package');
            }

            $assignPackage = $this->assignPackage($admin->id, $package_id);

            if ($assignPackage['success'] == true) {

                $data['success'] = true;
                $data['code'] = 200;
                $data['data'] = $admin;
                $data['message'] = __('Admin successfully created with ' . $assignPackage['data']->title . ' Package');
            }

            app(CommonService::class)->accountInformationEmail($admin, $password);

            return $data;
        }
        return $data;
    }

    /*
     * * show profile
    */

    public function profile($admin_id)
    {
        $data = ['success' => false, 'data' => '', 'message' => __('Something went wrong, please try again, Thanks')];

        $admin = app(AdminRepository::class)->first(['id' => $admin_id]);

        if ($admin) {

            $data['success'] = true;
            $data['data'] = $admin;
            $data['message'] = __('Profile successfully updated');

            return $data;
        }

        return $data;
    }

    /*
     * * Password Update
     */

    public function passwordUpdate($request)
    {
        $data = ['success' => false, 'data' => '', 'message' => __('Something went wrong, please try again, Thanks')];

        $adminData['edit_id'] = $request->get('edit_id');
        $adminData['password'] = Hash::make($request->get('password'));
        $admin = app(AdminRepository::class)->update($adminData);

        if ($admin) {
            $data['success'] = true;
            $data['data'] = $admin;
            $data['message'] = __('password successfully updated');

            return $data;
        }
        return $data;
    }


    /*
     * * Delete
     */

    public function delete($id)
    {
        $data = ['success' => false, 'data' => '', 'message' => __('Something went wrong, please try again, Thanks')];

        $admin = app(AdminRepository::class)->delete($id);

        if ($admin) {

            $data['success'] = true;
            $data['message'] = __('Admin successfully deleted');

            return $data;
        }

        return $data;
    }

    /*
 * * Delete
 */

    public function changeStatus($id, $status)
    {

        $data = ['success' => false, 'data' => '', 'message' => __('Something went wrong, please try again, Thanks')];

        $admin = app(AdminRepository::class)->changeStatus($id, $status);

        if ($admin) {

            $data['success'] = true;
            $data['data'] = $admin;
            $data['message'] = __('Admin Status successfully Updated');

            return $data;
        }

        $data['message'] = __('Admin not found');
        return $data;
    }

    /*
     *  * Admin Package Assign
     */

    public function assignPackage($admin_id, $package_id)
    {

        $data = ['success' => false, 'data' => '', 'message' => __('Something went wrong, please try again, Thanks')];

        $package = app(PackageRepository::class)->first(['id' => $package_id]);

        if (!empty($package)) {

            $adminPackage = \app(AdminPackageRepository::class)->first(['admin_id' => $admin_id]);

            if ($adminPackage) {
                $adminPackage = app(AdminPackageRepository::class)->delete(['id' => $adminPackage->id]);

                if (($adminPackage == false)) {

                    return $data;
                }
            }

            $dataPackage = [
                'admin_id' => $admin_id,
                'package_id' => $package->id,
                'title' => $package->title,
                'type' => $package->type,
                'price' => $package->price,
                'no_of_managers' => $package->no_of_managers,
                'no_of_chefs' => $package->no_of_chefs,
                'no_of_waiters' => $package->no_of_waiters,
                'valid_period' => $package->valid_period,
                'status' => true,
            ];

            $assignPackage = app(AdminPackageRepository::class)->store($dataPackage);

            if ($assignPackage) {

                $data['success'] = true;
                $data['data'] = $assignPackage;
                $data['message'] = __('Package successfully assigned');

                return $data;
            }
            return $data;

        }
        $data['message'] = __('Package not found');
        return $data;
    }


    public function getTotalAdmin()
    {
        return app(AdminRepository::class)->getTotalAdmin();
    }


}
