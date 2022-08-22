<?php

namespace App\Http\Services;

use App\Models\Size;

class SizeService
{
    /*
     *  * Store attribute set
     */

    public function store($request)
    {
        $data = ['success' => false, 'message' => 'Something went wrong', 'data' => []];

        $sizeData['size'] = $request->size;
        $sizeData['chest'] = $request->chest;
        $sizeData['shoulder'] = $request->shoulder;
        $sizeData['length'] = $request->length;
        $sizeData['sleeve'] = $request->sleeve;


        $size = Size::create($sizeData);

        if ($size) {

            $data['success'] = true;
            $data['message'] = 'Size successfully created';
            $data['data'] = $size;

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

        $size = Size::where('id', $request->edit_id)->first();

        if ($size) {

            if ($size->size != $request->size)
            {
                $existingSize = Size::where('size', $request->size)->exists();
                if ($existingSize)
                {
                    $data['message'] = "Size already exists";
                    return $data;
                }
            }

            $sizeData['size'] = $request->size;
            $sizeData['chest'] = $request->chest;
            $sizeData['shoulder'] = $request->shoulder;
            $sizeData['length'] = $request->length;
            $sizeData['sleeve'] = $request->sleeve;

            $success = $size->update($sizeData);

            if ($success) {

                $data['success'] = true;
                $data['message'] = 'Size successfully updated';
                $data['data'] = $size;

                return $data;
            }

            return $data;
        }

        $data['message'] = "Size doesn't exists";
        return $data;

    }


    /*
     *  Delete Banner
     */

    public function delete($id)
    {
        $data = ['success' => false, 'message' => 'Something went wrong', 'data' => []];

        $size = Size::where('id', decrypt($id))->first();
        if ($size) {

            $delete = $size->delete();

            if ($delete) {

                $data['success'] = true;
                $data['message'] = 'Size successfully deleted';

                return $data;
            }
            return $data;
        }

        $data['message'] = "Size set doesn't exists";
        return $data;

    }

}
