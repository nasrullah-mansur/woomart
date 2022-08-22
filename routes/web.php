<?php

use Illuminate\Support\Facades\Route;

// admin all routes here
require base_path('routes/link/admin.php');

Route::redirect('/', '/en');


Route::group(['prefix' => '{language}', 'namespace' => 'Front'], function () {

    Route::get('', 'HomeController@index')->name('home');
    #pages

    Route::get('contact', 'PagesController@contact')->name('contact');
    Route::get('about', 'PagesController@about')->name('about');

    Route::get('shop', 'PagesController@shop')->name('shop');
    Route::get('shop-product-trending', 'PagesController@shopTrendind')->name('shop.product.trending');
    Route::get('shop-product-newest', 'PagesController@shopNewest')->name('shop.product.newest');
    Route::get('shop-product-best-rated', 'PagesController@shopBestRated')->name('shop.product.best.rated');

    Route::get('terms-and-conditions', 'PagesController@termAndConditions')->name('terms.and.conditions');
    Route::get('error-404', 'PagesController@error404')->name('error.404');

    #user sign-up, sign-in

    Route::get('sign-up', 'AuthController@signUp')->name('sign.up');
    Route::post('sign-up-store', 'AuthController@signUp')->name('sign.up.store');

    Route::get('sign-in', 'AuthController@signIn')->name('sign.in');
    Route::post('sign-in-store', 'AuthController@signIn')->name('sign.in.store');


    # product
    Route::group(['prefix' => 'product'], function () {

        Route::get('details/{slug}', 'ProductController@singleProduct')->name('single.product');
        Route::post('search', 'ProductController@searchProduct')->name('product.search');

        Route::get('category/{slug}', 'ProductController@categoryProduct')->name('category.product');
        Route::get('sub-category/{slug}', 'ProductController@subCategoryProduct')->name('sub.category.product');
        Route::get('brand/{slug}', 'ProductController@brandProduct')->name('product.brand');

    });

    #blog
    Route::group(['prefix' => 'blog'], function () {

        Route::get('', 'BlogController@index')->name('blogs');
        Route::post('search', 'BlogController@search')->name('blog.search');
        Route::get('details/{slug}', 'BlogController@singleBlog')->name('blog.single');

        Route::post('comment', 'BlogController@comment')->name('blog.comment');


    });

    # cart
    Route::group(['prefix' => 'cart'], function () {

        Route::get('', 'CartController@index')->name('cart.index');

        Route::post('add-to-cart', 'CartController@add')->name('cart.add');
        Route::get('remove-from-cart/{id}', 'CartController@remove')->name('cart.remove');

    });





});
