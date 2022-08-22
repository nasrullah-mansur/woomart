<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Blog;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $info['all_categories'] = Category::where(['active_status'=> STATUS_ACTIVE, 'parent_id' => PARENT])->get();
        $info['top_categories'] = Category::where(['active_status' => STATUS_ACTIVE, 'top_category' => true])->get();
        $info['brands'] = Brand::where(['active_status' => STATUS_ACTIVE])->get();
        $info['sliders'] = Slider::where(['active_status' => STATUS_ACTIVE])->get();
        $info['banner'] = Banner::first();
        $info['first_section_products'] = Product::where(['active_status' => STATUS_ACTIVE, 'first_section' => true])->orderBy('id','desc')->take(8)->get();
        $info['second_section_products'] = Product::where(['active_status' => STATUS_ACTIVE, 'second_section' => true])->orderBy('id','desc')->take(8)->get();
        $info['third_section_products'] = Product::where(['active_status' => STATUS_ACTIVE, 'third_section' => true])->orderBy('id','desc')->take(8)->get();
        $info['latest_blogs'] = Blog::where(['active_status' => STATUS_ACTIVE])->orderBy('id','desc')->take(3)->get();

        $content = 'index';
        return view('front.index',['info' => $info, 'content' =>$content,'menu' => 'Home' ]);
    }
}
