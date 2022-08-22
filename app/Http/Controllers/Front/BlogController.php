<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\BLogCommentRequest;
use App\Http\Services\BlogService;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    private $blogService;
    public function __construct(BlogService $blogService)
    {
        $this->blogService = $blogService;
    }

    public function index()
    {
        $blogs['all'] = Blog::where(['active_status' => STATUS_ACTIVE])->orderBy('id', 'desc')->paginate(6);
        $blogs['recent'] = Blog::where(['active_status' => STATUS_ACTIVE])->orderBy('id', 'desc')->take(3)->get();
        $blogs['popular'] = Blog::where(['active_status' => STATUS_ACTIVE, 'popular' => true])->take(3)->get();

        return view('front.blog.index',['blogs' => $blogs, 'menu' => 'blog']);
    }



    public function search(Request $request)
    {
        $blogs['all'] = $this->blogService->search($request);

        $blogs['recent'] = Blog::where(['active_status' => STATUS_ACTIVE])->orderBy('id', 'desc')->take(3)->get();
        $blogs['popular'] = Blog::where(['active_status' => STATUS_ACTIVE, 'popular' => true])->take(3)->get();

        return view('front.blog.index',['blogs' => $blogs, 'menu' => 'blog']);
    }


//    single blog, blog details

    public function singleBlog($lang, $slug)
    {
        $blog= Blog::where('slug', $slug)->with('comment')->first();

        if ($blog)
        {
            $blogs['single'] = $blog;
            $blogs['recent'] = Blog::where(['active_status' => STATUS_ACTIVE])->orderBy('id', 'desc')->take(3)->get();
            $blogs['popular'] = Blog::where(['active_status' => STATUS_ACTIVE, 'popular' => true])->take(3)->get();

            return view('front.blog.single',['blogs' => $blogs, 'menu' => 'blog']);
        }
        toast("Blog doesn't exists",'warning');
        return view('front.404');
    }

    public function comment(Request $request)
    {
        app(BLogCommentRequest::class);
        $comment = $this->blogService->comment($request);

        if ($comment['success'] == true)
        {
            toast($comment['message'],'success');
            return redirect()->back();

        }
        toast($comment['message'],'warning');
        return redirect()->back();
    }
}
