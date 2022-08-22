@extends('front.layouts.master')
@section('title', allSettings('title') ? allSettings('title') : 'home')
@section('content')



    <!-- slider two area start here -->
    <section class="slider-two-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 offset-lg-3">
                    <div class="slider-two-slide">
                        @if(isset($info['sliders'][0]))
                            @foreach($info['sliders'] as $slider)
                                <div class="baner-image">
                                    <a href="{{route('shop', app()->getLocale())}}"> <img src="{{$slider->image}}" alt="banner"> </a>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- slider two area end here -->
    <!-- Product Categories area start here  -->
    <section class="brands-area brands-v2 ">
        <div class="container">
            <div class="section-wrap">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="top-section">
                            <h2 class="section-title">Our Brands</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="brand-lsit brand-slide">
                            @if(isset($info['brands'][0]))
                                @foreach($info['brands'] as $brand)
                                    <div class="single-barnd d-flex justify-content-center align-items-center">
                                        <a href="{{route('product.brand',[app()->getLocale(), $brand->slug ])}}">
                                            <figure class="barnd-thumbnail">
                                                <img src="{{$brand->image}}" alt="brand"/>
                                            </figure>
                                        </a>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Categories area end here  -->
    <!-- Product Categories area start here  -->
    <section class="Product-categories-v2  mt-50">
        <div class="container">
            <div class="section-wrap">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="top-section">
                            <h2 class="section-title">{{allSettings('category_section') ? allSettings('category_section') : 'Top Product Categories'}}</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="categories-lsit categories-slide">

                            @if(isset($info['top_categories'][0]))
                                @foreach($info['top_categories'] as $top_category)

                                    <div class="single-categories">
                                        <a href="{{route('category.product', [app()->getLocale(), $top_category->slug])}}">
                                            <figure class="categories-thumbnail">
                                                <img src="{{$top_category->image}}" alt="top categories"/>
                                                <div class="overlay-content"><span
                                                        class="categories-title">{{$top_category->name}}</span></div>
                                            </figure>
                                        </a>
                                        <span class="categories-name">{{$top_category->name}}</span>
                                        <a href="#" class="arrow-btn"><i class="fas fa-arrow-right"></i></a>
                                    </div>

                                @endforeach
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Categories area end here  -->
    <!-- offer area start here  -->
    <section class="offer-area mt-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="offer-big-banner">
                        <a href="{{route('shop', app()->getLocale())}}">
                            <img class="banner-image"
                             src="{{ isset($info['banner']->offer_banner1) ? $info['banner']->offer_banner1 : asset('assets/front/images/offer/offer-big-banner.jpg')}}"
                             alt="offer images"/>  </a>

                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="offer-small-banner left-align">
                        <a href="{{route('shop', app()->getLocale())}}">
                        <img class="banner-image"
                             src="{{ isset($info['banner']->offer_banner2) ? $info['banner']->offer_banner2 : asset('assets/front/images/offer/offer-small-image1.jpg')}}"
                             alt="offer images"/>
                        </a>

                    </div>
                    <div class="offer-small-banner">
                        <a href="{{route('shop', app()->getLocale())}}">
                        <img class="banner-image"
                             src="{{ isset($info['banner']->offer_banner3) ? $info['banner']->offer_banner3 : asset('assets/front/images/offer/offer-small-image2.jpg')}}"
                             alt="offer images"/>
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- offer area end here  -->
    <!-- Featured Product area start here  -->
    <section class="featured-product featured-two-v2 mt-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-wrap">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="top-section">
                                    <h2 class="section-title">{{allSettings('first_section') ? allSettings('first_section') : 'Featured Product'}}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="featured-slide">
                            <div class="featured-list m-b-30">
                                <div class="row">

                                    @if(isset($info['first_section_products'][0]))
                                        @foreach($info['first_section_products'] as $f_product)

                                            <div class="col-lg-3 col-md-6 col-sm-6">
                                                <div class="grid-single-poduct text-center">
                                                    <div class="product-front">
                                                        <figure class="product-thumbnail ">
                                                            <img src="{{$f_product->primary_image}}"
                                                                 alt="product"/>
                                                            @if(($f_product->discount))
                                                                <span
                                                                    class="off bg-color">{{$f_product->discount.' %'}}</span>
                                                            @endif

                                                            @if(($f_product->is_new))
                                                                <span class="new">{{$f_product->is_new}}</span>
                                                            @endif

                                                        </figure>
                                                        <div class="product-info bg-white">
                                                            <h2 class="product-title">{{$f_product->name}}</h2>
                                                            <ul class="product-review">
                                                                <li><i class="fas fa-star"></i></li>
                                                                <li><i class="fas fa-star"></i></li>
                                                                <li><i class="fas fa-star"></i></li>
                                                                <li><i class="fas fa-star"></i></li>
                                                                <li><i class="far fa-star"></i></li>
                                                            </ul>
                                                            <h3 class="price"> {{allSettings('currency') ? allSettings('currency') : '$' }} {{$f_product->discount_price > 0 ? $f_product->discount_price : $f_product->price}}</h3>
                                                        </div>
                                                    </div>
                                                    <div class="product-back">
                                                        <figure class="product-thumbnail ">
                                                            <a href="{{route('single.product',[app()->getLocale(), $f_product->slug])}}"><img
                                                                    src="{{$f_product->primary_image}}"
                                                                    alt="product"/></a>
                                                        </figure>
                                                        <div class="product-meta">
                                                            <ul>
                                                                <li><a href="#"><i class="flaticon-heart"></i> </a></li>
                                                                <li><a href="#" data-toggle="modal"
                                                                       data-target="#first-modal"><i
                                                                            class="flaticon-eye"></i> </a></li>
                                                            </ul>
                                                        </div>
                                                        <a class="add-cart" href="#" > <i
                                                                class="flaticon-shopping-cart-empty-side-view"></i> Add
                                                            to Cart</a>
                                                    </div>
                                                </div>
                                            </div>

                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Featured Product area start here  -->
    <!-- Trendy Fashion area start here  -->
    <section class="trend-fashion-area mt-50">
        <div class="container">
            <div class="trend-slide">
                <div class="single-trend">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="trend-image">
                                <img src="{{isset($info['banner']->trend_banner1) ? $info['banner']->trend_banner1 : ''}}"
                                    alt="trend"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Trendy Fashion area end here  -->
    <!-- Best Selling Products start here   -->
    <section class="best-selling-product home-two-selling-v2 mt-50">
        <div class="container">
            <div class="section-wrap">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="top-section">
                            <h2 class="section-title">{{allSettings('second_section') ? allSettings('second_section') : 'Best Selling Products'}}</h2>
                        </div>
                    </div>
                </div>
                <div class="featured-slide">
                    <div class="featured-list m-b-30">
                        <div class="row">

                            @if(isset($info['second_section_products'][0]))
                                @foreach($info['second_section_products'] as $s_product)

                                    <div class="col-lg-3 col-md-6 col-sm-6">
                                        <div class="grid-single-poduct text-center">
                                            <div class="product-front">
                                                <figure class="product-thumbnail ">
                                                    <img src="{{$s_product->primary_image}}"
                                                         alt="product"/>
                                                    @if(($s_product->discount))
                                                        <span
                                                            class="off bg-color">{{$s_product->discount.' %'}}</span>
                                                    @endif

                                                    @if(($s_product->is_new))
                                                        <span class="new">{{$s_product->is_new}}</span>
                                                    @endif

                                                </figure>
                                                <div class="product-info bg-white">
                                                    <h2 class="product-title">{{$s_product->name}}</h2>
                                                    <ul class="product-review">
                                                        <li><i class="fas fa-star"></i></li>
                                                        <li><i class="fas fa-star"></i></li>
                                                        <li><i class="fas fa-star"></i></li>
                                                        <li><i class="fas fa-star"></i></li>
                                                        <li><i class="far fa-star"></i></li>
                                                    </ul>
                                                    <h3 class="price"> {{allSettings('currency') ? allSettings('currency') : '$' }} {{$s_product->discount_price > 0 ? $s_product->discount_price : $s_product->price}}</h3>
                                                </div>
                                            </div>
                                            <div class="product-back">
                                                <figure class="product-thumbnail ">
                                                    <a href="{{route('single.product', [app()->getLocale(), $s_product->slug])}}"><img
                                                            src="{{$s_product->primary_image}}"
                                                            alt="product"/></a>
                                                </figure>
                                                <div class="product-meta">
                                                    <ul>
                                                        <li><a href="#"><i class="flaticon-heart"></i> </a></li>
                                                        <li><a href="#" data-toggle="modal"
                                                               data-target="#second_section_product-modal"><i
                                                                    class="flaticon-eye"></i> </a></li>
                                                    </ul>
                                                </div>
                                                <a class="add-cart" href="#"> <i
                                                        class="flaticon-shopping-cart-empty-side-view"></i> Add
                                                    to Cart</a>
                                            </div>
                                        </div>
                                    </div>

                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- Best Selling Products end here   -->
    <section class="larg-banner-area mt-50">
        <div class="container">
            <div class="large-banner-info">
                <div class="row no-gutters align-items-center">
                    <div class="col-md-12">
                        <div class="trend-image">
                            <img src="{{isset($info['banner']->trend_banner2) ? $info['banner']->trend_banner2 : ''}}"
                                 alt="trend"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- New Arrivals area start here  -->
    <section class="new-arrivals-area home-two-aravel mt-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-wrap">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="top-section">
                                    <h2 class="section-title">{{allSettings('third_section') ? allSettings('third_section') : 'New Arrivals'}}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @if(isset($info['third_section_products'][0]))
                                @foreach($info['third_section_products'] as $t_product)

                                    <div class="col-lg-3 col-md-6 col-sm-6">
                                        <div class="grid-single-poduct text-center">
                                            <div class="product-front">
                                                <figure class="product-thumbnail ">
                                                    <img src="{{$t_product->primary_image}}"
                                                         alt="product"/>
                                                    @if(($t_product->discount))
                                                        <span
                                                            class="off bg-color">{{$t_product->discount.' %'}}</span>
                                                    @endif

                                                    @if(($t_product->is_new))
                                                        <span class="new">{{$t_product->is_new}}</span>
                                                    @endif

                                                </figure>
                                                <div class="product-info bg-white">
                                                    <h2 class="product-title">{{$t_product->name}}</h2>
                                                    <ul class="product-review">
                                                        <li><i class="fas fa-star"></i></li>
                                                        <li><i class="fas fa-star"></i></li>
                                                        <li><i class="fas fa-star"></i></li>
                                                        <li><i class="fas fa-star"></i></li>
                                                        <li><i class="far fa-star"></i></li>
                                                    </ul>
                                                    <h3 class="price">{{allSettings('currency') ? allSettings('currency') : '$' }} {{$t_product->discount_price ? $t_product->discount_price : $t_product->price}}</h3>
                                                </div>
                                            </div>
                                            <div class="product-back">
                                                <figure class="product-thumbnail ">
                                                    <a href="{{route('single.product', [app()->getLocale(), $t_product->slug])}}"><img
                                                            src="{{$t_product->primary_image}}"
                                                            alt="product"/></a>
                                                </figure>
                                                <div class="product-meta">
                                                    <ul>
                                                        <li><a href="#"><i class="flaticon-heart"></i> </a></li>
                                                        <li><a href="#" data-toggle="modal"
                                                               data-target="#third_section_product-modal"><i
                                                                    class="flaticon-eye"></i> </a></li>
                                                    </ul>
                                                </div>
                                                <a class="add-cart" href="#"> <i
                                                        class="flaticon-shopping-cart-empty-side-view"></i> Add
                                                    to Cart</a>
                                            </div>
                                        </div>
                                    </div>

                                @endforeach
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- New Arrivals area end here  -->
    <!-- blog area start here  -->
    <section class="blog-area home-two-blog mt-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-wrap">
                        <div class="top-section">
                            <h2 class="section-title">Our Latest Blog</h2>
                        </div>

                        <div class="blog-list blog-slide m-b-30">
                            @if(isset($info['latest_blogs'][0]))
                                @foreach($info['latest_blogs'] as $blog)
                                    <article class="single-post">
                                        <div class="post-thumbnail">
                                            <a href="{{route('blog.single',[app()->getLocale(), $blog->slug])}}">

                                                <img src="{{$blog->image}}" alt="blog"/>
                                            </a>
                                            <span
                                                class="blog-date">{{\Carbon\Carbon::parse($blog->created_at)->format('d M, y')}}</span>
                                        </div>
                                        <div class="post-info">
                                            <ul class="post-meta">
                                                <li class="author">
                                                    <a href="#"><i class="far fa-user"></i>John Doe</a>
                                                </li>
                                                <li class="comments">
                                                    <a href="#"><i class="far fa-comments"></i>32 Comments</a>
                                                </li>
                                            </ul>
                                            <h2 class="post-title">
                                                <a href="{{route('blog.single',[app()->getLocale(), $blog->slug])}}">{{\Illuminate\Support\Str::words($blog->title, 5, '...')}}</a>
                                            </h2>
                                            <p class="post-content">{{\Illuminate\Support\Str::words($blog->description, 20, '...')}} </p>
                                            <a href="{{route('blog.single',[app()->getLocale(), $blog->slug])}}" class="post-btn">
                                                Read More <i class="fas fa-arrow-right"></i>
                                            </a>
                                        </div>
                                    </article>
                                @endforeach
                            @endif

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- blog area end here  -->


    <!-- Modal -->


{{--    @include('front.modal.modal')--}}
{{--    @include('front.modal.first_section_product_modal')--}}
{{--    @include('front.modal.second_section_product_modal')--}}
{{--    @include('front.modal.third_section_product_modal')--}}

    <!-- Modal end -->

@endsection

@section('post_script')
    <script>
        $('.add-cart').on('click', function () {

        })
    </script>
@endsection
