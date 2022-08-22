<?php

namespace App\Repository;

use App\Model\Manager;

class ManagerRepository
{


    public function getAllManager()
    {
        return Manager::get();
    }

    public function getManagerForDatatable($condition)
    {
//        return Admin::with('adminPackage')->select('id','first_name', 'last_name', 'email', 'status');
        return Manager::where($condition)->select('id', 'name', 'email', 'phone', 'status');

    }


    public function store($data)
    {
        return $manager = Manager::create($data);
    }


    public function update($data)
    {
        $manager = Manager::where('id', $data['edit_id'])->first();

        $manager->update($data);

        return $manager;
    }


    public function first($condition)
    {

        return Manager::where($condition)->first();

    }


    public function get($condition)
    {
        return Manager::where($condition)->get();
    }


    public function delete($id)
    {
        $manager = Manager::where('id', decrypt($id))->first();
        return $manager->delete();
    }


    public function changeStatus($id, $status)
    {
        $manager = Manager::where('id', decrypt($id))->first();

        if (!empty($manager)) {

            $manager->update(['status' => decrypt($status)]);

            return true;
        }

        return false;
    }

    public function totalManager($condition)
    {
        return Manager::where($condition)->count('id');
    }


}
