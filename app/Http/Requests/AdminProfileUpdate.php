<?php

namespace App\Http\Requests;

use App\Model\Admin;
use Illuminate\Foundation\Http\FormRequest;

class AdminProfileUpdate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()

    {
        if ($this->request->get('edit_id') != null) {

            $request_admin = $this->request->get('email');
            $admin = Admin::where('id', $this->request->get('edit_id'))->first();

            if ($admin->email != $request_admin) {
                return [
                    'first_name' => 'required | min: 3',
                    'last_name' => 'required | min: 3',
                    'email' => 'required | email | unique:admins',
                    'image' => 'mimes:jpeg,jpg,png',
                ];

            } else {
                return [
                    'first_name' => 'required | min: 3',
                    'last_name' => 'required | min: 3',
                    'email' => 'required | email',
                    'image' => 'mimes:jpeg,jpg,png',
                ];
            }

        } else {
            return [
                'first_name' => 'required | min: 3',
                'last_name' => 'required | min: 3',
                'email' => 'required | email | unique:admins',
                'image' => 'mimes:jpeg,jpg,png',
                'password' => 'required | min : 6 | confirmed',
                'status' => 'required',
            ];
        }
    }
}
