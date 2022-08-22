<?php

use Illuminate\Support\Facades\Route;

route::get('ss/', 'AuthController@adminlogin')->name('admin.login');
route::post('ss/', 'AuthController@adminlogin')->name('admin.login');


route::post('ss/logout', 'App\Http\Controllers\AuthController@adminlogin')->name('admin.logout');

Route::group(['middleware' => 'auth.admin', 'prefix' => 'admin', 'namespace' => 'Admin'], function () {


    //    ****************** Dashboard ***************

    Route::get('dashboard', 'DashboardController@home')->name('admin.dashboard');

    //    ******************Category***************

    Route::group(['prefix' => 'category'], function () {

        Route::get('', 'CategoryController@index')->name('admin.category');

        Route::get('create', 'CategoryController@createStore')->name('admin.category.create');
        Route::post('store', 'CategoryController@createStore')->name('admin.category.store');

        Route::get('edit/{slug}', 'CategoryController@editUpdate')->name('admin.category.edit');
        Route::post('update', 'CategoryController@editUpdate')->name('admin.category.update');

        Route::get('delete/{slug}', 'CategoryController@delete')->name('admin.category.delete');

        Route::get('status/{edit}/{status}', 'CategoryController@changeStatus')->name('admin.categoryChangeStatus');

    });

    //    ****************** color attribute ***************

    Route::group(['prefix' => 'color-attribute'], function () {

        Route::get('', 'ColorController@index')->name('admin.color');
        Route::get('create', 'ColorController@createStore')->name('admin.color.create');
        Route::post('store', 'ColorController@createStore')->name('admin.color.store');

        Route::get('edit/{id}', 'ColorController@editUpdate')->name('admin.color.edit');
        Route::post('update', 'ColorController@editUpdate')->name('admin.color.update');

        Route::get('delete/{id}', 'ColorController@delete')->name('admin.color.delete');

    });

    //    ****************** Size attribute ***************

    Route::group(['prefix' => 'size-attribute'], function () {

        Route::get('', 'SizeController@index')->name('admin.size');

        Route::get('create', 'SizeController@createStore')->name('admin.size.create');
        Route::post('store', 'SizeController@createStore')->name('admin.size.store');

        Route::get('edit/{id}', 'SizeController@editUpdate')->name('admin.size.edit');
        Route::post('update', 'SizeController@editUpdate')->name('admin.size.update');

        Route::get('delete/{id}', 'SizeController@delete')->name('admin.size.delete');


    });

    //    ******************  Brand ***************

    Route::group(['prefix' => 'brand'], function () {

        Route::get('', 'BrandController@index')->name('admin.brand');

        Route::get('create', 'BrandController@createStore')->name('admin.brand.create');
        Route::post('store', 'BrandController@createStore')->name('admin.brand.store');

        Route::get('edit/{id}', 'BrandController@editUpdate')->name('admin.brand.edit');
        Route::post('update', 'BrandController@editUpdate')->name('admin.brand.update');

        Route::get('delete/{id}', 'BrandController@delete')->name('admin.brand.delete');

        Route::get('status/{slug}/{status}', 'BrandController@changeStatus')->name('admin.brandChangeStatus');
    });

    //    ******************  Slider ***************

    Route::group(['prefix' => 'slider'], function () {

        Route::get('', 'SliderController@index')->name('admin.slider');

        Route::get('crate', 'SliderController@createStore')->name('admin.slider.create');
        Route::post('store', 'SliderController@createStore')->name('admin.slider.store');

        Route::get('edit/{id}', 'SliderController@editUpdate')->name('admin.slider.edit');
        Route::post('update', 'SliderController@editUpdate')->name('admin.slider.update');

        Route::get('delete/{id}', 'SliderController@delete')->name('admin.slider.delete');

        Route::get('status/{id}/{status}', 'SliderController@changeStatus')->name('admin.sliderChangeStatus');

    });

    //   ******************  Banner ***************

    Route::group(['prefix' => 'banner'], function () {

        Route::get('', 'BannerController@index')->name('admin.banner');

        Route::get('create', 'BannerController@createStore')->name('admin.banner.create');
        Route::post('store', 'BannerController@createStore')->name('admin.banner.store');

        Route::get('edit/{id}', 'BannerController@editUpdate')->name('admin.banner.edit');
        Route::post('update', 'BannerController@editUpdate')->name('admin.banner.update');

        Route::get('delete/{id}', 'BannerController@delete')->name('admin.banner.delete');

        Route::get('status/{id}/{status}', 'BannerController@changeStatus')->name('admin.bannerChangeStatus');

    });

    //    ******************  Blog ***************

    Route::group(['prefix' => 'blog'], function () {

        Route::get('', array('page_title' => 'Banner', 'task' => 'list', 'uses' => 'BlogController@index'))->name('admin.blog');

        Route::get('add', array('page_title' => 'Banner', 'task' => 'create', 'uses' => 'BlogController@addEdit'))->name('admin.blog.add');
        Route::post('add', array('page_title' => 'Banner', 'task' => 'create', 'uses' => 'BlogController@addEdit'))->name('admin.blog.add');

        Route::get('edit/{slug}', array('page_title' => 'Banner', 'task' => 'edit', 'uses' => 'BlogController@edit'))->name('admin.blog.edit');
        Route::get('delete/{id}', array('page_title' => 'Banner', 'task' => 'delete', 'uses' => 'BlogController@delete'))->name('admin.blog.delete');

        Route::get('status/{id}/{status}', array('page_title' => 'Banner', 'task' => 'list', 'uses' => 'BlogController@changeStatus'))->name('admin.blogChangeStatus');

    });

//*********************Product *****************

    Route::group(['prefix' => 'product'], function () {

        Route::get('', 'ProductController@index')->name('admin.product');

        Route::get('create', 'ProductController@createStore')->name('admin.product.create');
        Route::post('store', 'ProductController@createStore')->name('admin.product.store');

        Route::get('edit/{slug}', 'ProductController@editUpdate')->name('admin.product.edit');
        Route::post('update', 'ProductController@editUpdate')->name('admin.product.update');

        Route::get('delete/{slug}', 'ProductController@delete')->name('admin.product.delete');

        Route::get('status/{slug}/{status}', 'ProductController@changeStatus')->name('admin.product.status');


        Route::post('subcategory', 'ProductController@sub_category')->name('admin.product.subcategory');

        Route::get('details/{slug}', 'ProductController@ProductDetails')->name('admin.product.details');
    });

    //********************** General Settings ***********************

    Route::group(['prefix' => 'settings'], function () {

        Route::get('general', 'AdminSettingsController@generalSettings')->name('admin.general.settings');
        Route::post('general-update', 'AdminSettingsController@generalSettings')->name('admin.general.settings.update');

    });

    //********************** Pages ***********************

    Route::group(['prefix' => 'page'], function () {

        #contact us
        Route::get('contact-us', 'ContactUsSettingsController@contactUs')->name('admin.contact.us.settings');
        Route::post('contact-us', 'ContactUsSettingsController@contactUs')->name('admin.contact.us.settings');

        #about us
        Route::get('about-us', 'PagesController@aboutUs')->name('admin.page.about_us');
        Route::post('about-us-update', 'PagesController@aboutUs')->name('admin.page.about_us.update');

        Route::get('sign-up-sign-in', 'PagesController@signUpSignIn')->name('admin.page.sign_up_sign_in');
        Route::post('sign-up-sign-in-update', 'PagesController@signUpSignIn')->name('admin.page.sign_up_sign_in.update');

        Route::get('home', 'PagesController@home')->name('admin.page.home');
        Route::post('home-update', 'PagesController@home')->name('admin.page.home.update');

        #Terms and condition
        Route::get('terms-and-conditions', 'PagesController@termAndConditions')->name('admin.page.term.and.condition');
        Route::post('terms-and-conditions-update', 'PagesController@termAndConditions')->name('admin.page.term.and.condition.update');

        #404
        Route::get('404', 'PagesController@error404')->name('admin.page.404');
        Route::post('404-update', 'PagesController@error404')->name('admin.page.404.update');


        # shop
        Route::group(['prefix' => 'shop'], function () {

            Route::get('', 'ShopController@index')->name('admin.page.shop');

            Route::get('create', 'ShopController@createStore')->name('admin.page.shop.create');
            Route::post('store', 'ShopController@createStore')->name('admin.page.shop.store');

            Route::get('edit/{id}', 'ShopController@editUpdate')->name('admin.page.shop.edit');
            Route::post('update', 'ShopController@editUpdate')->name('admin.page.shop.update');

            Route::get('delete/{id}', 'ShopController@delete')->name('admin.page.shop.delete');

            Route::get('status/{slug}/{status}', 'ShopController@changeStatus')->name('admin.page.shop.status');

        });

        # talent team
        Route::group(['prefix' => 'talent-team'], function () {

            Route::get('', 'TalentTeamController@index')->name('admin.talent.team');

            Route::get('create', 'TalentTeamController@createStore')->name('admin.talent.team.create');
            Route::post('store', 'TalentTeamController@createStore')->name('admin.talent.team.store');

            Route::get('edit/{id}', 'TalentTeamController@editUpdate')->name('admin.talent.team.edit');
            Route::post('update', 'TalentTeamController@editUpdate')->name('admin.talent.team.update');

            Route::get('delete/{id}', 'TalentTeamController@delete')->name('admin.talent.team.delete');

            Route::get('status/{slug}/{status}', 'TalentTeamController@changeStatus')->name('admin.talent.team.status');

        });

        # Client feedback
        Route::group(['prefix' => 'client-feedbacks'], function () {

            Route::get('', 'ClientFeedbackController@index')->name('admin.client.feedback');

            Route::get('edit/{id}', 'ClientFeedbackController@editUpdate')->name('admin.client.feedback.edit');
            Route::post('update', 'ClientFeedbackController@editUpdate')->name('admin.client.feedback.update');

            Route::get('status/{slug}/{status}', 'ClientFeedbackController@changeStatus')->name('admin.client.feedback.status');

        });

    });


//****************** Profile ********************

    Route::group(['prefix' => 'profile'], function () {

        Route::get('', 'ProfileController@profile')->name('admin.profile');
        Route::post('update', 'ProfileController@updateProfile')->name('admin.profile.update');
        Route::post('password/update', 'ProfileController@updatePassword')->name('admin.password.update');

    });


    //    ******************** Orders ***********************


    Route::group(['prefix' => 'orders'], function () {

        Route::get('{key?}', ['as' => '', 'uses' => 'ManageOrderController@index'])->name('admin.orders');

        #trash
        Route::get('all/trash', ['as' => '', 'uses' => 'ManageOrderController@trash'])->name('admin.all.deleted.order');
        Route::get('all/request-products', ['as' => '', 'uses' => 'ManageOrderController@userDemandProducts'])->name('admin.user.demand.products');


        Route::get('fore-delete/{id}', ['as' => '', 'uses' => 'ManageOrderController@forceDelete'])->name('admin.order.force.delete');
        Route::get('restore/{id}', ['as' => '', 'uses' => 'ManageOrderController@restore'])->name('admin.order.restore');
        #

        Route::get('all/products', ['as' => '', 'uses' => 'ManageOrderController@allOrderProducts'])->name('admin.all.order.products');

        Route::get('invoice/{id}', 'ManageOrderController@invoice')->name('admin.order.invoice');
        Route::get('details/{id}', 'ManageOrderController@details')->name('admin.order.details');
        Route::get('delete/{id}', 'ManageOrderController@delete')->name('admin.order.delete');

        Route::post('product/status/update', 'ManageOrderController@productOrderStatusUpdate')->name('admin.order.product.status.update');


        Route::post('order/status/update', 'ManageOrderController@orderStatusUpdate')->name('admin.order.status.update');

        Route::post('order/delivery-failed', 'ManageOrderController@deliveryFailed')->name('admin.order.delivery.failed');

        Route::get('transactions', 'ManageOrderController@transactions')->name('transactions');


        Route::get('/report/order', 'ReportController@orderReport')->name('admin.report.order');
        Route::post('/report/order', 'ReportController@orderReport')->name('admin.report.order');


    });

    //    ******************** Users ***********************


    Route::group(['prefix' => 'users'], function () {

        Route::get('', 'UserController@index')->name('admin.all.users');
        Route::get('/orders/{id}', 'UserController@userOrders')->name('admin.user.orders');
        Route::get('/orders-invoice/{id}', 'UserController@userOrdersInvoice')->name('admin.user.orders.invoice');

        Route::post('', 'UserController@sendSms')->name('admin.sendSms');

        Route::get('lucky-winner', 'UserController@luckyWinner')->name('admin.lottery');
        Route::post('lucky-winner', 'UserController@luckyWinner')->name('admin.lottery');


    });

    #General Account

    Route::group(['prefix' => 'general-account'], function () {

        # ShopStick account Summery
        Route::get('/summery', array('page_title' => 'Account Summery', 'task' => 'add', 'uses' => 'AccountController@shopstickAccountSummery'))->name('admin.shopstick.account.summery');

        #expense Head
        Route::get('/expense-head', array('page_title' => 'Expense Head', 'task' => 'add', 'uses' => 'AccountController@expenseHeadIndex'))->name('admin.account.expense.head');

        Route::get('/expense-head-add', array('page_title' => 'Expense', 'task' => 'add', 'uses' => 'AccountController@expenseHeadaddEdit'))->name('admin.account.expense.head.addEdit');
        Route::post('/expense-head-add', array('page_title' => 'Expense', 'task' => 'add', 'uses' => 'AccountController@expenseHeadAddEdit'))->name('admin.account.expense.head.addEdit');

        Route::get('/expense-head-status/change/{id}/{status}', array('page_title' => 'Expense', 'task' => 'add', 'uses' => 'AccountController@expenseHeadStatusChange'))->name('admin.account.expense.head.statusChange');
        Route::get('/expense-head-status/delete/{id}', array('page_title' => 'Expense', 'task' => 'add', 'uses' => 'AccountController@ExpHeadDelete'))->name('admin.account.expense.head.delete');

        Route::get('/expense-head-status/edit/{id}', array('page_title' => 'Expense', 'task' => 'add', 'uses' => 'AccountController@ExpHeadEit'))->name('admin.account.expense.head.edit');

        #expense
        Route::get('/expense', array('page_title' => 'Expense', 'task' => 'add', 'uses' => 'AccountController@expense'))->name('admin.account.expense');

        Route::get('/expense-add', array('page_title' => 'Expense', 'task' => 'add', 'uses' => 'AccountController@expenseAddEdit'))->name('admin.account.expense.addEdit');
        Route::post('/expense-add', array('page_title' => 'Expense', 'task' => 'add', 'uses' => 'AccountController@expenseAddEdit'))->name('admin.account.expense.addEdit');

        Route::get('/expense-delete/{id}', array('page_title' => 'Expense', 'task' => 'add', 'uses' => 'AccountController@expenseDelete'))->name('admin.account.expense.head.delete');

        Route::get('/expense-details/{id}', array('page_title' => 'Expense', 'task' => 'create', 'uses' => 'AccountController@expenseDetails'))->name('admin.account.expense.details');

        # product manage by shop stick account

        Route::get('/infos', array('page_title' => 'Shopstick Accounts Info', 'task' => 'list', 'uses' => 'AccountController@accountInfo'))->name('admin.account.info');

    });


    # Contact
    Route::group(['prefix' => 'contact'], function () {

        Route::get('', array('page_title' => 'Contact', 'task' => 'list', 'uses' => 'ContactController@index'))->name('admin.contact.index');
        Route::get('delete/{id}', array('page_title' => 'Contact', 'task' => 'list', 'uses' => 'ContactController@delete'))->name('admin.contact.delete');
        Route::get('/reply/{id}', array('page_title' => 'Contact', 'task' => 'Reply', 'uses' => 'ContactController@reply'))->name('admin.contact.reply');
        Route::post('/send-reply', array('page_title' => 'Contact', 'task' => 'list', 'uses' => 'ContactController@sendReply'))->name('admin.contact.sendReply');

    });

});


