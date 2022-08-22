@extends('front.layouts.master', $product)
@section('title', isset($page_tile) ? $page_tile : 'product details')
@section('content')
    <?php
    $shop_banners = shopBanners();
    $brands = allBrand();
    $categories = allCategory();
    ?>
    <!-- single shop page start here  -->
    <div class="single-shop-page pb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="section-wrap">
                        <div class="product-single-view">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="product-slier-big-image">
                                        <div class="product-priview-slide">
                                            @if($product->primary_image)
                                                <a href="{{$product->primary_image}}" data-fancybox="gallery">
                                                    <img class="example-image" src="{{$product->primary_image}}"
                                                         alt="image-1">
                                                </a>
                                            @endif

                                            @if($product->image2)
                                                <a href="{{$product->image2}}" data-fancybox="gallery">
                                                    <img class="example-image" src="{{$product->image2}}" alt="image-1">
                                                </a>
                                            @endif

                                            @if($product->image3)
                                                <a href="{{$product->image3}}" data-fancybox="gallery">
                                                    <img class="example-image" src="{{$product->image3}}" alt="image-1">
                                                </a>
                                            @endif

                                            @if($product->image4)
                                                <a href="{{$product->image4}}" data-fancybox="gallery">
                                                    <img class="example-image" src="{{$product->image4}}" alt="image-1">
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="product-thumbnail-image">
                                        <ul class="product-thumb-silide">
                                            @if($product->primary_image)
                                                <li><img src="{{$product->primary_image}}" alt="primary image"/></li>
                                            @endif

                                            @if($product->image2)
                                                <li><img src="{{$product->image2}}" alt="image2"/></li>
                                            @endif

                                            @if($product->image3)
                                                <li><img src="{{$product->image3}}" alt="image3"/></li>
                                            @endif

                                            @if($product->image4)
                                                <li><img src="{{$product->image4}}" alt="image4"/></li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="product-details-content ">
                                        <h3 class="product-title">{{$product->name}}</h3>
                                        <div class="quickview-peragraph ">
                                            <p>{!! $product->about_product !!} </p>
                                        </div>

                                        @if($product->discount_price > 0)
                                            <div class="price-box">
                                                <span
                                                    class="price"> {{allSettings('currency') ? allSettings('currency') : '$' }} {{$product->discount_price}}</span>
                                                <span
                                                    class="old-price"><s>$ {{$product->price}}</s></span><span
                                                    class="off">- {{$product->discount}}%</span>
                                            </div>
                                        @else
                                            <div class="price-box">
                                                <span
                                                    class="price"> {{allSettings('currency') ? allSettings('currency') : '$' }} {{$product->price}}</span>
                                            </div>
                                        @endif
                                        <div class="single-variable color-variable">
                                            <h4>Color</h4>
                                            <ul>
                                                <li><span class="color oragne"></span></li>
                                                <li><span class="color black"></span></li>
                                                <li><span class="color white"></span></li>
                                                <li><span class="color blue"></span></li>
                                                <li><span class="color violet"></span></li>
                                                <li><span class="color red"></span></li>
                                            </ul>
                                        </div>
                                        <div class="single-variable size-variable">
                                            <h4>Sizes</h4>
                                            <ul>
                                                @if(isset($product->productSize[0]))
                                                    @foreach($product->productSize as $productSize)
                                                        <li><span class="size "
                                                                  id="product_size">{{$productSize->size}}</span></li>
                                                    @endforeach
                                                @endif
                                            </ul>
                                        </div>
                                        <div class="quickview-cart-box">
                                            <h4>Quantity</h4>
                                            <div class="quickview-cart-wrap d-flex align-items-center ">
                                                <div class="quickview-quality">
                                                    <div class="cart-plus-minus">
                                                        <div class="dec qtybutton btn">-</div>
                                                        <input class="cart-plus-minus-box quantity" type="text"
                                                               name="qtybutton"
                                                               value="1">
                                                        <div class="inc qtybutton btn">+</div>
                                                    </div>
                                                </div>
                                                <div class="stock in-stock ">
                                                    <p>Available: <span>In stock</span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div
                                        class="single-product-bottom d-flex justify-content-between align-items-center">
                                        <div class="button-list">
                                            <ul class="d-flex align-items-center">
                                                <li><a class="btn back-shop"
                                                       href="{{route('home', app()->getLocale())}}"> <i
                                                            class="fas fa-angle-left"></i> Back to shopping</a></li>
                                                <li><a class="btn buy-now" href="#"> Buy Now</a></li>
                                                <li><a class="btn add-cart" href="javascript:void(0)" data-id="{{$product->id}}"> <i
                                                            class="flaticon-shopping-cart-empty-side-view"></i> Add to
                                                        Cart</a></li>
                                            </ul>
                                        </div>
                                        <div class="fevatir-icon">
                                            <a href="#"><i class="flaticon-heart"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="section-wrap mt-50">
                        <div class="porduct-review">
                            <ul class="nav nav-tabs" id="reviewtab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="overview-tab" data-toggle="tab" href="#overview"
                                       role="tab" aria-controls="overview" aria-selected="true">Product Overview</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="review-tab" data-toggle="tab" href="#review" role="tab"
                                       aria-controls="review" aria-selected="false">Customers Review</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="reviewtabContent">
                                <div class="tab-pane fade show active" id="overview" role="tabpanel"
                                     aria-labelledby="overview-tab">
                                    <div class="product-description">
                                        <h3 class="section-top-title">Product Description</h3>
                                        <p>
                                            {!! $product->description!!}
                                        </p>
                                        <div class="table-responsive">
                                            <?php
                                            $sizes = allSize();
                                            ?>
                                            <table class="table description-table">
                                                <thead>
                                                <tr>
                                                    <th scope="col">Size</th>
                                                    <th scope="col">Chest</th>
                                                    <th scope="col">Shoulder</th>
                                                    <th scope="col">Length</th>
                                                    <th scope="col">Sleeve</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @if(isset($sizes[0]))
                                                    @foreach($sizes as $size)
                                                        <tr>
                                                            <td>{{$size->size}}</td>
                                                            <td>{{$size->chest}}</td>
                                                            <td>{{$size->shoulder}}</td>
                                                            <td>{{$size->length}}</td>
                                                            <td>{{$size->sleeve}}</td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
                                    <div class="product-review-info">
                                        <h3 class="section-top-title">Customer’s Reviews</h3>
                                        <div class="review-list">
                                            <ul>
                                                <li>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <span class="parcent">80%</span>
                                                </li>
                                                <li>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                    <span class="parcent">11%</span>
                                                </li>
                                                <li>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                    <span class="parcent">9%</span>
                                                </li>
                                                <li>
                                                    <i class="fas fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                    <span class="parcent">00%</span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="custmar-review">
                                            <div class="single-review">
                                                <div class="media">
                                                    <div class="author-image mr-5">
                                                        <img class="autor-iamge" src="images/review-author-iamge.png"
                                                             alt="images"/>
                                                        <a class="author-name d-block" href="#">Rima Khan</a>
                                                    </div>
                                                    <div class="media-body">
                                                        <ul>
                                                            <li>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                            </li>
                                                        </ul>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                            Blandit blandit tortor donec viverra viverra nisi placerat
                                                            tempor.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="single-review">
                                                <div class="media">
                                                    <div class="author-image mr-5">
                                                        <img class="autor-iamge" src="images/review-author-iamge.png"
                                                             alt="images"/>
                                                        <a class="author-name d-block" href="#">Rima Khan</a>
                                                    </div>
                                                    <div class="media-body">
                                                        <ul>
                                                            <li>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                            </li>
                                                        </ul>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                            Blandit blandit tortor donec viverra viverra nisi placerat
                                                            tempor.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="single-review">
                                                <div class="media">
                                                    <div class="author-image mr-5">
                                                        <img class="autor-iamge" src="images/review-author-iamge.png"
                                                             alt="images"/>
                                                        <a class="author-name d-block" href="#">Rima Khan</a>
                                                    </div>
                                                    <div class="media-body">
                                                        <ul>
                                                            <li>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                            </li>
                                                        </ul>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                            Blandit blandit tortor donec viverra viverra nisi placerat
                                                            tempor.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="section-wrap mt-50">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="top-section ">
                                    <h2 class="section-title">See Related Product</h2>
                                </div>
                            </div>
                        </div>
                        <div class="offer-product-slide">
                            <div class="grid-view-list m-b-30">
                                <div class="row">
                                    @if(isset($related_products))
                                        @foreach($related_products as $r_product)
                                            <div class="col-lg-6 col-md-6">
                                                <div class="product-listview">
                                                    <div class="media">
                                                        <div class="product-thumbnail mr-5">
                                                            <span class="sale">Sale</span>
                                                            <a href="{{route('single.product', [app()->getLocale(), $r_product->slug]) }}">
                                                                <img src="{{$r_product->primary_image}}"
                                                                     alt="list product"/>
                                                            </a>
                                                        </div>
                                                        <div class="media-body">
                                                            <h3 class="product-title mt-0">
                                                                <a href="{{route('single.product', [app()->getLocale(),$r_product->slug])}}">{{$r_product->name}}</a>
                                                            </h3>
                                                            <ul class="product-review">
                                                                <li><i class="fas fa-star"></i></li>
                                                                <li><i class="fas fa-star"></i></li>
                                                                <li><i class="fas fa-star"></i></li>
                                                                <li><i class="fas fa-star"></i></li>
                                                                <li><i class="far fa-star"></i></li>
                                                            </ul>
                                                            <div class="price-list">@if($r_product->discount_price > 0 )
                                                                    <span
                                                                        class="price"> {{allSettings('currency') ? allSettings('currency').$r_product->discount_price : '$'.$r_product->discount_price}}</span>
                                                                    <span
                                                                        class="old-price">{{allSettings('currency') ? allSettings('currency').$r_product->price : '$ '.$r_product->price}}</span>
                                                                @else
                                                                    <span
                                                                        class="price"> {{allSettings('currency') ? allSettings('currency').$r_product->price : '$'.$r_product->price}}</span>

                                                                @endif
                                                            </div>
                                                            <a class="add-cart" href="#">
                                                                <i class="flaticon-shopping-cart-empty-side-view"></i>
                                                                Add to Cart
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="grid-view-list m-b-30">
                                <div class="row">
                                    @if(isset($related_products))
                                        @foreach($related_products as $r_product)
                                            <div class="col-lg-6 col-md-6">
                                                <div class="product-listview">
                                                    <div class="media">
                                                        <div class="product-thumbnail mr-5">
                                                            <span class="sale">Sale</span>
                                                            <a href="{{route('single.product', [app()->getLocale(), $r_product->slug] )}}">
                                                                <img src="{{$r_product->primary_image}}"
                                                                     alt="list product"/>
                                                            </a>
                                                        </div>
                                                        <div class="media-body">
                                                            <h3 class="product-title mt-0">
                                                                <a href="{{route('single.product', [app()->getLocale(), $r_product->slug ])}}">{{$r_product->name}}</a>
                                                            </h3>
                                                            <ul class="product-review">
                                                                <li><i class="fas fa-star"></i></li>
                                                                <li><i class="fas fa-star"></i></li>
                                                                <li><i class="fas fa-star"></i></li>
                                                                <li><i class="fas fa-star"></i></li>
                                                                <li><i class="far fa-star"></i></li>
                                                            </ul>
                                                            <div class="price-list">
                                                                @if($r_product->discount_price > 0 )
                                                                    <span
                                                                        class="price"> {{allSettings('currency') ? allSettings('currency').$r_product->discount_price : '$'.$r_product->discount_price}}</span>
                                                                    <span
                                                                        class="old-price">{{allSettings('currency') ? allSettings('currency').$r_product->price : '$ '.$r_product->price}}</span>
                                                                @else
                                                                    <span
                                                                        class="price"> {{allSettings('currency') ? allSettings('currency').$r_product->price : '$'.$r_product->price}}</span>

                                                                @endif
                                                            </div>
                                                            <a class="add-cart" href="#">
                                                                <i class="flaticon-shopping-cart-empty-side-view"></i>
                                                                Add to Cart
                                                            </a>
                                                        </div>
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

                                            <li>
                                                <a href="{{route('category.product',[app()->getLocale(), $category->slug])}}"> {{$category->name}}</a>
                                            </li>

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
                                                <input type="checkbox" id="{{'brand'.$loop->iteration}}"
                                                       value="{{$brand->name}}">
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
                        <div class="single-widget add-banner-widget ">
                            <div class="widget-title text-center">
                                <h3>Girls Collections</h3>
                            </div>
                            <figure class="add-image">
                                <img src="{{asset('assets/front/images/product/14.png')}}" alt="show"/>
                            </figure>
                        </div>
                        <div class="single-widget ">
                            <a href="#">
                                <img src="{{asset('assets/front/images/banner-add.png')}}" alt="banner add"/>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- single shop page end here  -->
@endsection

@section('post_script')
    <script>
        $('.add-cart').on('click', function () {

            let product_id = $('.add-cart').attr('data-id');
            let quantity = $('.quantity').val();
            let size = '';
            let color = '';


            $.ajax({
                url: "{{URL::route('cart.add', app()->getLocale())}}",

                method: "POST",
                data: {
                    'product_id': product_id,
                    'quantity': quantity,
                    'color': color,
                    'size': size,
                    '_token': "{{csrf_token()}}"
                },
                success: function (data) {

                    if (data['success'] == true) {

                        $(".card-amount").empty();
                        $(".card-amount").append("<b>My Cart - {{allSettings('currency')}}"+data['data']['total_price']+"</b>");
                        console.log(data['message']);

                        console.log(data['data']['total_price']);

                    } else {
                        console.log(data['message']);
                    }

                }

            });
        })
    </script>
@endsection

