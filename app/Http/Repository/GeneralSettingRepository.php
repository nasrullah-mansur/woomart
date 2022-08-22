<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 15-Oct-17
 * Time: 12:40 PM
 */


namespace App\Repository;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class GeneralSettingRepository
{
    public function create(Request $request)
    {
        $user = [
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'fname' => $request->get('fname'),
            'lname' => $request->get('lname'),
            'logcode' => md5($request->get('email').uniqid().randomString(5)),
            'vfcode' => md5($request->get('email').uniqid().randomString(5)),
            'activestatus' => $request->get('activestatus',3),
            'role' => $request->get('role',2),
            'level' => $request->get('level',1),
        ];

        return User::create($user);
    }

    public function update($where,$data)
    {
        return User::where($where)->update($data);
    }

    public function updateRole($id,$role)
    {
        return User::where('id',$id)->update(['role'=>$role]);
    }

    public function get($id)
    {
        return User::where(['id' => $id])->first();
    }

    public function getAll()
    {
        return User::get();
    }

    public function getPagination($perPage=20,$pageName = 'page')
    {
        return User::paginate($perPage,['*'], $pageName);
    }

    public function delete($id)
    {
        return User::where(['id' => $id])->update(['activestatus'=>1]);
    }

    public function deleteAll()
    {
        return User::update(['activestatus'=>1]);
    }

    public function suspend($id)
    {
        return User::where('id',$id)->update(['activestatus'=>2]);
    }

    public function suspendAll()
    {
        return User::update(['activestatus'=>2]);
    }

    public function reactive($id)
    {
        return User::where('id',$id)->update(['activestatus'=>3]);
    }

}
