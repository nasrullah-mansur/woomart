<?php

namespace App\Http\Requests;

use App\Models\Brand;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\VarDumper\Dumper\DataDumperInterface;

class BrandRequest extends FormRequest
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
        # edit

        if ($this->request->get('edit_id')) {

            $brand = Brand::where('id', $this->request->get('edit_id'))->first();

            if (isset($brand) && $brand->name != $this->request->get('name'))
            {
                return [
                    'name' => 'required | max:32 | unique:brands',
                    'active_status' => 'required',
                ];

            } else{
                return [
                    'name' => 'required',
                    'active_status' => 'required',
                ];
            }
        }

        # create

        else{

            return [
                'name' => 'required| max:32 | unique:brands',
                'active_status' => 'required',
            ];
        }

    }
}
