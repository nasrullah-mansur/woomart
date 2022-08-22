<?php

namespace App\Http\Services;

use App\Models\AttributeSet;

class AttributeSetService
{
    /*
     *  * Store attribute set
     */

    public function store($request)
    {
        $data = ['success' => false, 'message' => 'Something went wrong', 'data' => []];

        $attSetData['name'] = $request->name;

        $attSet = AttributeSet::create($attSetData);

        if ($attSet) {

            $data['success'] = true;
            $data['message'] = 'Attribute set successfully created';
            $data['data'] = $attSet;

            return $data;
        }

        return $data;
    }

    /*
    *  * update attribute set
    */

    public function update($request)
    {
        $data = ['success' => false, 'message' => 'Something went wrong', 'data' => []];

        $attSet = AttributeSet::where('id', $request->edit_id)->findOrfail();
        if ($attSet) {
            $attSetData['name'] = $request->name;

            $success = $attSet->update($attSetData);

            if ($success) {

                $data['success'] = true;
                $data['message'] = 'Attribute set successfully created';
                $data['data'] = $attSet;

                return $data;
            }

            return $data;
        }

        $data['message'] = "Attribute set doesn't exists";
        return $data;

    }


    /*
     *  Delete Banner
     */

    public function delete($id)
    {
        $data = ['success' => false, 'message' => 'Something went wrong', 'data' => []];

        $attSet = AttributeSet::where('id', decrypt($id))->first();
        if ($attSet) {

            $delete = $attSet->delete();

            if ($delete) {

                $data['success'] = true;
                $data['message'] = 'Attribute set successfully deleted';

                return $data;
            }
            return $data;
        }

        $data['message'] = "Attribute set doesn't exists";
        return $data;

    }

}
