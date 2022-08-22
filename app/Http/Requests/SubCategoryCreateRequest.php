<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Model\Sub_Category;
class SubCategoryCreateRequest extends FormRequest
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
        if($this->request->get('edit_id')!=null)
        {
             $requestsubcategory = $this->request->get('name');
            $subcategory = Sub_Category::where('id', $this->request->get('edit_id'))->first();

            if ($subcategory->name != $requestsubcategory ) {

                return [
                    'category_id'=>'required',
                    'name' => 'required | unique:sub__categories',
                    'active_status' => 'required'
                ];
            }
            else
            {
                 return [
                    'category_id'=>'required',
                    'name' => 'required',
                    'active_status' => 'required'
                ];
            }
        }
        else
        {
             return [
                    'category_id'=>'required',
                    'name' => 'required | unique:sub__categories',
                    'active_status' => 'required'
                ];
        }

        
    }

    public function message()
    {
         return [
            'category_id.required' => __('The Category field must be requireed'),
            'name.unique' => __('The Name field must be unique'),
            'active_status.required' => __('The Status field must be required')
        ];

    }
}
