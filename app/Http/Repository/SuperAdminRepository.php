<?php

namespace App\Repository;

use App\Model\SuperAdmin;

use Illuminate\Support\Facades\Hash;

class SuperAdminRepository
{


    public function getAllSuperAdmin()
    {
        return SuperAdmin::get();
    }

    public function getSuperAdminForDatatable()
    {
//        return Admin::with('adminPackage')->select('id','first_name', 'last_name', 'email', 'status');
        return SuperAdmin::select('*');

    }


    public function store($data)
    {
        return SuperAdmin::create($data);
    }


    public function update($data)
    {
        $superAdmin = SuperAdmin::where('id', $data['edit_id'])->first();

        $superAdmin->update($data);

        return $superAdmin;
    }


    public function delete($id)
    {

        $superAdmin = SuperAdmin::where('id', decrypt($id))->first();
        return $superAdmin->delete();

    }

    public function first($condition)
    {

        return  SuperAdmin::where($condition)->first();

    }


    public function get($condition)
    {

        return  SuperAdmin::where($condition)->get();

    }

    public function changeStatus($id, $status)
    {
        $superAdmin = SuperAdmin::where('id', decrypt($id))->first();

        if (!empty($superAdmin)) {

            $superAdmin->update(['status' => decrypt($status)]);

            return true;
        }

        return false;
    }

    public function getTotalSuperAdmin()
    {
        return  SuperAdmin::count('id');
    }


}
