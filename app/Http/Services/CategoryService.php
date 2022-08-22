<?php

namespace App\Http\Services;


use App\Models\Category;
use Illuminate\Support\Str;

class CategoryService
{


    public function getAllCategoryForDatatable()
    {
        return Category::select('*');
    }

    /*
      *  * store Category
     */

    public function store($request)
    {
        $data = ['success' => false, 'data' => [], 'message' => 'something went wrong'];

        $cateData['name'] = $request->name;
        $cateData['parent_id'] = $request->parent_id;
        $cateData['active_status'] = $request->active_status;
        $cateData['top_category'] = $request->has('top_category') ? true : false;
        $cateData['description'] = $request->description;


        if (isset($request->parent_id)) {
            $parent = Category::where('id', $request->parent_id)->first();
        }

        $cateData['slug'] = isset($request->slug) ? $request->slug : (time() . '-' . Str::slug((isset($parent) ? $parent->name . '-' . $request->name : $request->name), '-'));

        if (!empty($request->image)) {

            $old_img = '';
            $cateData['image'] = fileUpload($request['image'], path_category_image(), $old_img); // upload image/file
        }


        if (!empty($request->icon)) {

            $old_img = '';
            $cateData['icon'] = fileUpload($request['icon'], path_category_image(), $old_img); // upload icon/file
        }


        $existCategory = Category::where(['name' => $cateData['name'], 'parent_id' => $cateData['parent_id']])->exists();

        if ($existCategory) {

            $data['message'] = __('Category already exists');
            return $data;
        }


        $category = Category::create($cateData);

        if ($category) {

            $data['success'] = true;
            $data['message'] = __('Category Successfully added');
            $data['data'] = $category;

            return $data;
        }
        return $data;

    }

    //    ***************** End store Category *******************


    /*
      *  * update Category
    */

    public function update($request)
    {
        $data = ['success' => false, 'data' => [], 'message' => 'something went wrong'];

        $cateData['name'] = $request->name;
        $cateData['parent_id'] = $request->parent_id;
        $cateData['active_status'] = $request->active_status;
        $cateData['top_category'] = $request->has('top_category') ? true : false;
        $cateData['description'] = $request->description;


        if (isset($request->parent_id)) {
            $parent = Category::where('id', $request->parent_id)->first();
        }

        $cateData['slug'] = isset($request->slug) ? $request->slug : (time() . '-' . Str::slug((isset($parent) ? $parent->name . '-' . $request->name : $request->name), '-'));

        $category = Category::where('id', $request->edit_id)->first();

        if ($category) {

            if (!empty($request->image)) {

                $old_img = $category->image;
                $cateData['image'] = fileUpload($request['image'], path_category_image(), $old_img); // upload image/file
            }

            if (!empty($request->icon)) {

                $old_img = $category->icon;
                $cateData['icon'] = fileUpload($request['icon'], path_category_image(), $old_img); // upload image/file
            }

            //   # category must be not itself parent

            if ($category->id == $cateData['parent_id']) {

                $data['message'] = __('Category should not be parent itself');
                return $data;

            }

            //   # name check
            if ($category->name != $request->name) {
                $existCategory = Category::where(['name' => $cateData['name'], 'parent_id' => $cateData['parent_id']])->exists();

                if ($existCategory) {

                    $data['message'] = __('Category already exists');
                    $data['data'] = $category;

                    return $data;
                }
            }
            //   # slug check

            if ($category->slug != $cateData['slug']) {

                $slug_category = Category::where(['slug' => $cateData['slug']])->exists();

                if ($slug_category) {

                    $data['message'] = __('Slug already exists');
                    $data['data'] = $category;

                    return $data;

                }
            }


            $success = $category->update($cateData);
            if ($success) {

                $data['success'] = true;
                $data['message'] = __('Category Successfully updated');
                $data['data'] = $category;

                return $data;

            }
            return $data;
        }

        $data['message']  = "Category doesn't exists";
        return $data;
    }

//    ***************** End Update Category *******************

    /*
     *  * Delete Category
     */

    public function delete($id)
    {
        $data = ['success' => false, 'data' => '', 'message' => __('Something went wrong, please try again, Thanks')];

        $category = Category::where(['id' => decrypt($id)])->first();

        if ($category) {

            $this->changeParent($category->id);
            $delete = $category->delete($id);

            if ($delete) {

                $data['success'] = true;
                $data['message'] = __('Category successfully deleted');

                return $data;
            }
            return $data;

        }
        $data['message'] = "Category doesn't exists";
        return $data;
    }

    /*
     * * Change Parent
     */

    public function changeParent($id)
    {
        $categories = Category::where(['parent_id' => $id])->get();

        foreach ($categories as $category) {

            $data['edit_id'] = $category->id;
            $data['parent_id'] = PARENT;

            $category = Category::where('id', $data['edit_id'])->first();
            $category->update($data);
        }

        return true;
    }


// ***************** Delete Category ****************
}
