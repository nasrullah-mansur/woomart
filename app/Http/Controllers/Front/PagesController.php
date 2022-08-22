<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\ClientFeedback;
use App\Models\Error404;
use App\Models\Product;
use App\Models\TalentTeam;
use App\Models\TermsAndCondition;
use Illuminate\Http\Request;

class PagesController extends Controller
{

    public function contact()
    {
        return view('front.pages.contact');
    }

    public function about()
    {

        $about_us = AboutUs::first();
        $talents = TalentTeam::where('active_status', STATUS_ACTIVE)->get();
        $feedbacks = ClientFeedback::where('active_status', STATUS_ACTIVE)->get();
        return view('front.pages.about_us', ['page_title'=>'about us','about_us' => $about_us, 'talents' => $talents, 'feedbacks' => $feedbacks]);
    }

    public function termAndConditions()
    {
        $terms_and_conditions = TermsAndCondition::first();

        return view('front.pages.terms_and_conditions', ['terms_and_conditions' => $terms_and_conditions]);
    }

    public function error404($lang, $message = null)
    {
        return view('front.404',['message' => $message]);
    }

    public function shop()
    {
        $products = Product::where(['active_status' => STATUS_ACTIVE , 'is_trending' => true])->paginate(6);
        $best_selling_products = Product::where(['active_status' => STATUS_ACTIVE , 'second_section' => true])->take(4)->get();
         $id['id'] = 1;
        return view('front.pages.shop',['id'=>$id, 'section' =>'trending', 'products' => $products, 'best_selling_products' => $best_selling_products]);
    }

    public function shopTrendind()
    {
        $products = Product::where(['active_status' => STATUS_ACTIVE , 'is_trending' => true])->paginate(6);
        $best_selling_products = Product::where(['active_status' => STATUS_ACTIVE , 'second_section' => true])->take(4)->get();
        $id['id'] = 1;
        return view('front.pages.shop',['id'=>$id, 'section' =>'trending', 'products' => $products, 'best_selling_products' => $best_selling_products]);
    }

    public function shopNewest()
    {
        $products = Product::where(['active_status' => STATUS_ACTIVE])->paginate(6);
        $best_selling_products = Product::where(['active_status' => STATUS_ACTIVE ])->orderBy('id', 'desc')->take(4)->get();
        $id['id'] = 1;
        return view('front.pages.shop',['id' =>$id, 'section' =>'newest', 'products' => $products, 'best_selling_products' => $best_selling_products]);
    }

    public function shopBestRated()
    {
        $products = Product::where(['active_status' => STATUS_ACTIVE , 'second_section' => true])->paginate(6);
        $best_selling_products = Product::where(['active_status' => STATUS_ACTIVE , 'second_section' => true])->take(4)->get();
        $id['id'] =1;
        return view('front.pages.shop',[ 'id' =>$id, 'section' =>'best_rated', 'products' => $products, 'best_selling_products' => $best_selling_products]);
    }
}
