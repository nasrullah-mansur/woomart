<?php

namespace App\Repository;

use App\Model\Admin;

use Illuminate\Support\Facades\Hash;

class AdminRepository
{


    public function getAllAdmin()
    {
        return Admin::get();
    }

    public function getAllAdminForDatatable()
    {
//        return Admin::with('adminPackage')->select('id','first_name', 'last_name', 'email', 'status');
        return Admin::select('*');

    }


    public function store($data)
    {
        return  Admin::create($data);
    }


    public function update($data)
    {
        $admin = Admin::where('id', $data['edit_id'])->first();

        $admin->update($data);

        return $admin;
    }


    public function delete($id)
    {

        $admin = Admin::where('id', decrypt($id))->first();
        return $admin->delete();

    }

    public function first($condition)
    {

        return  Admin::where($condition)->first();

    }


    public function get($condition)
    {

        return  Admin::where($condition)->get();

    }

    public function changeStatus($id, $status)
    {
        $admin = Admin::where('id', decrypt($id))->first();

        if (!empty($admin)) {

            $admin->update(['status' => decrypt($status)]);

            return true;
        }

        return false;
    }

    public function getTotalAdmin()
    {
        return  Admin::count('id');
    }


}
