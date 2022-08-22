<?php

namespace App\Http\Services;

use App\Models\Color;

class ColorService
{
    /*
     *  * Store attribute set
     */

    public function store($request)
    {
        $data = ['success' => false, 'message' => 'Something went wrong', 'data' => []];

        $colorData['name'] = $request->name;
        $colorData['color_code'] = $request->color_code;

        $color = Color::create($colorData);

        if ($color) {

            $data['success'] = true;
            $data['message'] = 'Color successfully created';
            $data['data'] = $color;

            return $data;
        }

        return $data;
    }

    /*
    *  * update color attribute set
    */

    public function update($request)
    {
        $data = ['success' => false, 'message' => 'Something went wrong', 'data' => []];

        $color = Color::where('id', $request->edit_id)->first();

        if ($color) {

            if ($color->name != $request->name)
            {
                $existingColor = Color::where('name', $request->name)->exists();
                if ($existingColor)
                {
                    $data['message'] = "Color already exists";
                    return $data;
                }
            }

            $colorData['name'] = $request->name;
            $colorData['color_code'] = $request->color_code;

            $success = $color->update($colorData);

            if ($success) {

                $data['success'] = true;
                $data['message'] = 'Color successfully updated';
                $data['data'] = $color;

                return $data;
            }

            return $data;
        }

        $data['message'] = "Color doesn't exists";
        return $data;

    }


    /*
     *  Delete Banner
     */

    public function delete($id)
    {
        $data = ['success' => false, 'message' => 'Something went wrong', 'data' => []];

        $color = Color::where('id', decrypt($id))->first();
        if ($color) {

            $delete = $color->delete();

            if ($delete) {

                $data['success'] = true;
                $data['message'] = 'Color set successfully deleted';

                return $data;
            }
            return $data;
        }

        $data['message'] = "Color set doesn't exists";
        return $data;

    }

}
