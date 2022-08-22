<?php

namespace App\Http\Requests;

use App\Model\Manager;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
class ManagerCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::guard('admin')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->request->get('edit_id') != null) {

            $request_manager = $this->request->get('email');
            $manager = Manager::where('id', $this->request->get('edit_id'))->first();

            if ($manager->email != $request_manager) {
                return [
                    'name' => 'required | min: 3',
                    'email' => 'required | email | unique:managers',
                    'image' => 'mimes:jpeg,jpg,png',
                    'status' => 'required',
                ];

            } else {
                return [
                    'name' => 'required | min: 3',
                    'email' => 'required | email',
                    'image' => 'mimes:jpeg,jpg,png',
                    'status' => 'required',
                ];
            }

        } else {
            return [
                'name' => 'required | min: 3',
                'email' => 'required | email | unique:managers',
                'image' => 'mimes:jpeg,jpg,png',
                'password' => 'required | min : 6 | confirmed',
                'status' => 'required',
            ];
        }
    }
}
