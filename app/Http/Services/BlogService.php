<?php

namespace App\Http\Services;

use App\Models\Blog;
use App\Models\BlogComment;
use App\Models\User;
use Illuminate\Support\Str;

class BlogService
{
    /*
     *  * Add and Update Banner
     */

    public function addEdit($request)
    {
        $data = ['success' => false, 'message' => 'Something went wrong', 'data' => []];

        $blogData['title'] = $request->title;
        $blogData['slug'] = isset($request->slug) ? $request->slug : (strlen($blogData['title']) > 120 ? Str::slug(time() . '-' . substr($blogData['title'], 0, 120), '-') : Str::slug(time() . '-' . $blogData['title'], '-'));
        $blogData['description'] = $request->description;
        $blogData['quotation'] = $request->quotation;
        $blogData['active_status'] = isset($request->active_status) ? $request->active_status : true;
        $blogData['popular'] = $request->has('popular') ? true : false;

        if (!empty($request->image)) {
            $old_img = '';

            if ($request->edit_id) {

                $file = Blog::where('id', $request->edit_id)->first();
                $old_img = isset($file) ? $file->image : '';
            }
            $blogData['image'] = fileUpload($request['image'], path_blog_image(), $old_img); // upload file
        }

        //update

        if ($request->edit_id) {

            $blog = Blog::where('id', $request->edit_id)->first();
            if ($blog) {

                $success = $blog->update($blogData);

                if ($success) {

                    $data['success'] = true;
                    $data['message'] = 'Banner Successfully updated';
                    $data['data'] = $blog;

                    return $data;
                }
                return $data;
            }

            $data['message'] = "Blog doesn't exists";
            return $data;

        }

        // add/create new Banner

        $blog = Blog::create($blogData);


        if ($blog) {

            $data['success'] = true;
            $data['message'] = 'Blog Successfully added';
            $data['data'] = $blog;

            return $data;
        }
        return $data;

    }

    /*
     *  Delete Banner
     */

    public function delete($id)
    {
        $data = ['success' => false, 'message' => 'Something went wrong', 'data' => []];

        $blog = Blog::where('id', decrypt($id))->first();
        if ($blog) {

            removeImage(path_blog_image(), $blog->image);

            $delete = $blog->delete();

            if ($delete) {

                $data['success'] = true;
                $data['message'] = 'Blog Successfully deleted';

                return $data;
            }
            return $data;
        }

        $data['message'] = "Blog doesn't exists";
        return $data;

    }


//    ********************** End Banner Delete  **********************

    /*
     * * search form user side
     */

    public function search($request)
    {
        $searchText = $request->search;

        $length = strlen($searchText);
        $keywords = [];

        $keywords[] = $searchText;

        if ($length > 3) {
            for ($i = 0; $i < $length; $i = $i + 3) {
                $keywords[] = substr($searchText, $i, 3);

                $string = $length - ($i + 3);
                if ($string < 3) {
                    break;
                }
            }
        }
        # search with string

        return Blog::where(['active_status' => STATUS_ACTIVE])
            ->where('title', 'LIKE', '%' . $searchText . '%')
            ->orwhere('description', 'LIKE', '%' . $searchText . '%')
            ->paginate(6);
    }

    public function comment($request)
    {
        $data = ['success' => false, 'message' => 'Something went wrong', 'data' => []];
        if ($request->user_id) {
            $user = User::where('id', $request->user_id)->first();
        }

        $commentData['parent_id'] = isset($request->comment_id) ? $request->comment_id : PARENT;
        $commentData['blog_id'] = $request->blog_id;
        $commentData['user_id'] = isset($user) ? $user->id : null;
        $commentData['first_name'] = isset($user) ? $user->name : $request->first_name;
        $commentData['last_name'] = $request->last_name;
        $commentData['email'] = isset($user) ? $user->email : $request->email;
        $commentData['comment'] = $request->comment;

        $comment = BlogComment::create($commentData);

        if ($comment) {
            $data['success'] = true;
            $data['message'] = 'comment successfully added';

            return $data;
        }

        return $data;


    }
}
