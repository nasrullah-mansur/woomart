<?php

namespace App\Http\Services;

use App\Models\Attribute;

class AttributeService
{
    /*
     *  * Store attribute set
     */

    public function store($request)
    {
        $data = ['success' => false, 'message' => 'Something went wrong', 'data' => []];

        $attData['attribute_set_id'] = $request->attribute_set_id;
        $attData['value'] = $request->value;
        $attData['color_code'] = $request->color_code;

        $att = Attribute::create($attData);

        if ($att) {

            $data['success'] = true;
            $data['message'] = 'Attribute successfully created';
            $data['data'] = $att;

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

        $att = Attribute::where('id', $request->edit_id)->findOrfail();

        if ($att) {

            $attData['attribute_set_id'] = $request->attribute_set_id;
            $attData['value'] = $request->value;
            $attData['color_code'] = $request->color_code;

            $success = $att->update($attData);

            if ($success) {

                $data['success'] = true;
                $data['message'] = 'Attribute successfully created';
                $data['data'] = $att;

                return $data;
            }

            return $data;
        }

        $data['message'] = "Attribute doesn't exists";
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
