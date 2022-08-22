@extends('front.layouts.master')
@section('content')

    <?php
    $shop_banners = shopBanners();
    $brands = allBrand();
     $categories = allCategory();
    ?>
    <!-- section-top-banner ara start here  -->
    <div class="section-top-banner">
        <div class="container">
            <div class="top-banner-slde">
                @if(isset($shop_banners[0]))
                    @foreach($shop_banners as $banner)
                        <div class="singe-banner">
                            <img src="{{$banner->banner}}" alt="banenr"/>
                        </div>
                    @endforeach
                @endif


            </div>
        </div>
    </div>
    <!-- section-top-banner ara end here  -->

    <!-- shop page start here  -->
    <div class="shop-page-aera mt-45 pb-50">
        <div class="container">
            <div class="shop-page-top">
                <div class="row align-items-center">
                    <div class="col-lg-5 order-1 order-lg-0">
                        <ul class="breadcrumb-page">
                            @if(isset($category_name))
                            <li><a href="#">Categories</a></li>

                                @if($category_name->parent)
                                <li><a href="{{route('category.product', $category_name->parent->slug)}}"> {{$category_name->parent->name}}</a></li>
                                    <li><a href="{{route('sub.category.product', $category_name->slug)}}"> {{$category_name->name}}</a></li>
                                @else
                                    <li><a href="{{route('category.product', $category_name->slug)}}"> {{$category_name->name}}</a></li>
                                @endif

                            @endif

                        </ul>
                    </div>
                    <div class="col-lg-7 ">
                        <div class="shop-top-rght d-flex align-items-center justify-content-lg-end">
                            <!-- list-grad-filter start here  -->
                            <div class="list-grid-wrap">
                                <ul class="nav nav-tabs" id="listgridtab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" id="list-tab" data-toggle="tab" href="#list"
                                           role="tab" aria-controls="list" aria-selected="true">
                                            <i class="flaticon-list"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="grid-tab" data-toggle="tab" href="#grid" role="tab"
                                           aria-controls="grid" aria-selected="false">
                                            <i class="flaticon-grid-1"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- list-grad-filter end here  -->
                            <!-- catagor-filter start here  -->
                            <div class="catagor-btn-list">
                                <ul>
                                    <li class="{{isset($section) && $section == 'best_match' ? 'active' : ''}}"><a href="#">Best Match</a></li>
                                    <li class="{{isset($section) && $section == 'trending' ? 'active' : ''}}"><a href="{{route('shop.product.trending')}}">Trending</a></li>
                                    <li class="{{isset($section) && $section == 'newest' ? 'active' : ''}}"><a href="{{route('shop.product.newest')}}">Newest</a></li>
                                    <li class="{{isset($section) && $section == 'best_rated' ? 'active' : ''}}"><a href="{{route('shop.product.best.rated')}}">Best Rated</a></li>
                                </ul>
                            </div>
                            <!-- catagor-filter end here  -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-50">
                <div class="col-lg-9">
                    <div class="tab-content" id="listgridtabcontent">
                        <!-- list view item start here  -->
                        <div class="tab-pane fade show active" id="list" role="tabpanel" aria-labelledby="list-tab">
                            @if(isset($products[0]))
                                @foreach($products as $product)
                            <div class="list-single-poduct d-flex  align-items-center justify-content-between">
                                <div class="product-thumbanial">
                                    <a href="{{route('single.product', $product->slug)}}">
                                        <img src="{{$product->primary_image}}" alt="product"/>
                                    </a>
                                </div>
                                <div class="product-info d-flex align-items-center justify-content-between">
                                    <div class="product-left">
                                        <h3><a href="{{route('single.product', $product->slug)}}">{{$product->name}}</a></h3>
                                        <ul class="review-list">
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="far fa-star"></i></li>
                                        </ul>
                                        <p>{!! $product->about_product !!}</p>
                                    </div>
                                    <div class="product-right text-md-right">
                                        <h2 class="price">${{$product->discount_price > 0 ? $product->discount_price : $product->price}}</h2>
                                        <div class="fevatir-icon">
                                            <a href="#"><i class="flaticon-heart"></i></a>
                                        </div>
                                        <a class="add-cart" href="#"> <i
                                                class="flaticon-shopping-cart-empty-side-view"></i> Add to Cart</a>
                                    </div>
                                </div>
                            </div>
                                @endforeach
                            @endif
                        </div>
                        <!-- list view item end here  -->
                        <!-- grid view item start here  -->
                        <div class="tab-pane fade" id="grid" role="tabpanel" aria-labelledby="grid-tab">
                            <div class="section-wrap">
                                <div class="featured-list m-b-30">
                                    <div class="row">
                                        @if(isset($products[0]))
                                            @foreach($products as $product)
                                        <div class="col-lg-4 col-md-6">
                                            <div class="grid-single-poduct text-center">
                                                <div class="product-front">
                                                    <figure class="product-thumbnail">
                                                        <img src="{{$product->primary_image}}" alt="product"/>
                                                        <span class="off">-{{$product->discount}}%</span>
                                                        <span class="new">{{$product->is_new}}</span>
                                                        <a class="heart" href="#"><i class="flaticon-heart"></i> </a>
                                                    </figure>
                                                    <div class="product-info">
                                                        <h2 class="product-title">{{$product->name}}</h2>
                                                        <ul class="product-review">
                                                            <li><i class="fas fa-star"></i></li>
                                                            <li><i class="fas fa-star"></i></li>
                                                            <li><i class="fas fa-star"></i></li>
                                                            <li><i class="fas fa-star"></i></li>
                                                            <li><i class="far fa-star"></i></li>
                                                        </ul>
                                                        <p class="product-content">{!! \Illuminate\Support\Str::words($product->about_product,6) !!}</p>
                                                        <h3 class="price">$ {{$product->discount_price > 0 ? $product->discount_price : $product->price}}</h3>
                                                    </div>
                                                </div>
                                                <div class="product-back">
                                                    <figure class="product-thumbnail">
                                                        <a href="{{route('single.product', $product->slug)}}"><img src="{{$product->primary_image}}"
                                                                                        alt="product"/></a>
                                                    </figure>
                                                    <div class="product-meta">
                                                        <ul>
                                                            <li><a href="#"><i class="flaticon-heart"></i> </a></li>
                                                            <li><a href="#" data-toggle="modal"
                                                                   data-target="#prodect-modal"><i
                                                                        class="flaticon-eye"></i> </a></li>
                                                        </ul>
                                                    </div>
                                                    <a class="add-cart" href="#"> <i
                                                            class="flaticon-shopping-cart-empty-side-view"></i> Add to
                                                        Cart</a>
                                                </div>
                                            </div>
                                        </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- grid view item start here  -->
                    </div>
                    <div class="pagination-area mt-50">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="pagination-page d-flex align-items-center">
                                    <div class="page-count">
                                        <span>Page</span>
                                        <input class="page-number" type="text" value="2"/>
                                        <span>of 30</span>
                                    </div>
                                    <ul class="page-controls">
                                        <li class="control-btn"><a href="#"><i class="fas fa-caret-left"></i> Prev</a>
                                        </li>
                                        <li class="control-btn"><a href="#">Next <i class="fas fa-caret-right"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-4 text-lg-right">
                                <div class="show-per-page ">
                                    <div class="perpage-wrap d-flex  align-items-center">
                                        <span class="show-page">Show Per Page</span>
                                        <select class="niceselect">
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="sidebar-area">
                        <div class="single-widget ">
                            <div class="widget-title text-center">
                                <h3>Filters</h3>
                            </div>
                            <div class="widget-wrap catagory-widget">
                                <h4>Categories</h4>
                                <ul>
                                    @if(isset($categories[0]))
                                        @foreach($categories as $category)

                                            <li><a href="{{route('category.product', $category->slug)}}"> {{$category->name}}</a></li>

                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                            <div class="widget-wrap price-widget">
                                <h4>Price</h4>
                                <div>
                                    <input type="text" id="amount" readonly/>
                                </div>
                                <div id="slider-range"></div>
                            </div>
                            <div class="widget-wrap Brand-widget">
                                <h4>Brand</h4>
                                <div class="check-box-inner">

                                    @if(isset($brands[0]))
                                        @foreach($brands as $brand)

                                    <div class="filter-check-box">
                                        <input type="checkbox" id="{{'brand'.$loop->iteration}}" value="{{$brand->name}}">
                                        <label for="{{'brand'.$loop->iteration}}">{{$brand->name}} </label>
                                    </div>
                                        @endforeach
                                        @endif
                                </div>
                            </div>
                            <div class="widget-wrap review-widget">
                                <h4>Average Reviews</h4>
                                <ul>
                                    <li>
                                        <span class="fas fa-star"></span>
                                        <span class="fas fa-star"></span>
                                        <span class="fas fa-star"></span>
                                        <span class="fas fa-star"></span>
                                        <span class="far fa-star"></span>
                                        <span class="up">& Up</span>
                                    </li>
                                    <li>
                                        <span class="fas fa-star"></span>
                                        <span class="fas fa-star"></span>
                                        <span class="fas fa-star"></span>
                                        <span class="fas fa-star"></span>
                                        <span class="far fa-star"></span>
                                        <span class="up">& Up</span>
                                    </li>
                                    <li>
                                        <span class="fas fa-star"></span>
                                        <span class="fas fa-star"></span>
                                        <span class="fas fa-star"></span>
                                        <span class="fas fa-star"></span>
                                        <span class="far fa-star"></span>
                                        <span class="up">& Up</span>
                                    </li>
                                    <li>
                                        <span class="fas fa-star"></span>
                                        <span class="fas fa-star"></span>
                                        <span class="fas fa-star"></span>
                                        <span class="fas fa-star"></span>
                                        <span class="far fa-star"></span>
                                        <span class="up">& Up</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="single-widget best-sell-widget">
                            <div class="widget-title text-center">
                                <h3>Best Sell</h3>
                            </div>
                            <div class="widget-wrap product-list">
                                @if(isset($best_selling_products[0]))
                                    @foreach($best_selling_products as $product)
                                <div class="bestsell-product">
                                    <div class="media">
                                        <a href="{{route('single.product', $product->slug)}}" class="product-img mr-3">
                                            <img src="{{$product->primary_image}}" alt="img">
                                        </a>
                                        <div class="media-body ">
                                            <h3 class="product-title mt-0"><a href="{{route('single.product', $product->slug)}}">{{$product->name}}</a></h3>
                                            <ul class="product-review">
                                                <li><i class="fas fa-star"></i></li>
                                                <li><i class="fas fa-star"></i></li>
                                                <li><i class="fas fa-star"></i></li>
                                                <li><i class="fas fa-star"></i></li>
                                                <li><i class="far fa-star"></i></li>
                                            </ul>
                                            <span class="price">$ {{$product->discount_price > 0 ? $product->discount_price : $product->price}}</span>
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

    <!-- shop page end here  -->
@endsection
