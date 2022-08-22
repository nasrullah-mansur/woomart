
<!-- header area start here  -->
<header class="header-area header-v2">
    <!-- top bar area start here  -->
    <div class="topbar-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 text-center text-md-left">
                    <div class="topbar-left">
                        <ul class="social-meida">
                            <li><a href="{{allSettings('facebook')}}"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="{{allSettings('linkedin')}}"><i class="fab fa-linkedin"></i></a></li>
                            <li><a href="{{allSettings('twitter')}}"><i class="fab fa-twitter"></i></a></li>
                            <li><a class="pinterest" href="{{allSettings('pinterest')}}"><i class="fab fa-pinterest"></i></a></li>

                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 text-center text-md-right">
                    <div class="topbar-right ">
                        <ul>
                            <li class="account dropdown">
                                <a href="#"> <i class="user-icon fas fa-user-circle"></i> Account <i
                                        class="angle-down fa fa-angle-down"></i></a>
                                <ul class="dropdon-itme">
                                    <li><a href="{{route('sign.in', app()->getLocale())}}">Sign In</a></li>
                                    <li><a href="{{route('sign.up', app()->getLocale())}}">Sign Up</a></li>
                                    <li><a href="reset-password.html">Reset Password</a></li>
                                    <li><a href="#">profile</a></li>
                                    <li><a href="#">notifications</a></li>
                                    <li><a href="#">settings</a></li>
                                    <li><a href="#">log out</a></li>
                                </ul>
                            </li>
                            <li class="currancy dropdown">
                                <a href="#">USD <i class="angle-down fa fa-angle-down"></i></a>
                                <ul class="dropdon-itme">
                                    <li><a href="#">USD</a></li>
                                    <li><a href="#">EUR</a></li>
                                    <li><a href="#">INR</a></li>
                                    <li><a href="#">BTD</a></li>
                                </ul>
                            </li>
                            <?php
                            $en = ['en'];
                            $bn = ['bn'];


                            if (isset($id)) {

                                array_push($en, $id);
                                array_push($bn, $id);
                            }

                            ?>
                            <li class="language dropdown">
                                <a href="#"> <img src="images/flag.png" alt="flag"> English <i
                                        class="angle-down fa fa-angle-down"></i></a>
                                <ul class="dropdon-itme">
                                    <li><a href="{{ route(Route::currentRouteName(), $en) }}"><img src="{{asset('assets/front/images/flag.png')}}" alt="flag"> English</a></li>
                                    <li><a href="{{ route(Route::currentRouteName(), $bn) }}"><img src="{{asset('assets/front/images/flag.png')}}" alt="flag"> Dautch</a></li>
                                    <li><a href="#"><img src="{{asset('assets/front/images/flag.png')}}" alt="flag"> Hindi</a></li>
                                    <li><a href="{{ route(Route::currentRouteName(), $bn) }}"><img src="{{asset('assets/front/images/flag.png')}}" alt="flag"> Bangla</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- top bar area end here  -->
    <!-- header-middle-aera star here   -->
    <div class="header-middle-area">
        <div class="container ">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-6 col-6 order-0 order-lg-1">
                    <div class="brand-area">
                        <a href="{{route('home', app()->getLocale())}}"><img src="{{ allSettings('logo') ? allSettings('logo')  : asset('assets/front/images/logo1.png')}}" alt="Woomart"/></a>
                    </div>
                </div>
                <div class="col-lg-6  order-2 order-lg-2">
                    <div class="search-area">
                        <form action="{{route('product.search', app()->getLocale())}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="search-wrap">
                                <select class="niceselect selct-area search-item" name="category_id">
                                    <option data-display="Product Categories" value="{{null}}">Product Categories</option>

                                    @if(isset($categories[0]))
                                        @foreach($categories as $p_category)
                                            <option value="{{$p_category->id}}">{{$p_category->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <div class="form-group search-item m-0">
                                    <input type="text" class="search-input" id="search" name="search_text"
                                           placeholder="Search Product..."/>
                                    <button type="submit" class="search-btn"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-6 order-1 order-lg-3">
                    <div class="middle-right">
                        <ul>
                            <li>
                                <a href="wishlist.html"><i class="flaticon-heart"></i></a>
                            </li>
                            <li>
                                <a href="{{route('cart.index', app()->getLocale())}}">
                                    <i class="flaticon-shopping-cart-empty-side-view"></i>
                                </a>
                                <div class="card-amount">
                                    <span > My Cart -{{allSettings('currency')}} {{myCatAmount() ?  myCatAmount()  : 0.00}}</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- header-middle-aera star here   -->
    <!-- header bottom area  start here  -->
    <div class="header-botom-area">
        <div class="container">
            <div class="row">
                @if(isset($menu) && $menu == 'Home')
                    @include('front.layouts.include.header_category')
                @else
                    @include('front.layouts.include.content_category')
                @endif

                <div class="col-lg-9 col-md-9 text-left text-md-right">
                    <nav class="main-menu-area">
                        <ul>
                            <li>
                                <a href="{{route('home', app()->getLocale())}}">Home </a>
                            </li>
                            <li class="mega-menu-itms position-static">
                                <a href="shop.html">Shop <i class="fa fa-angle-down"></i></a>
                                <ul class="mega-menu row">

                                    @if(isset($categories[0]))
                                        @foreach($categories as $category)
                                            <li class="col-3">
                                                <ul>
                                                    <li class="mega-menu-title"><a
                                                            href="{{route('category.product', [app()->getLocale(), $category->slug])}}">{{$category->name}}</a>
                                                    </li>
                                                    @if(isset($category->child[0]))
                                                        @foreach($category->child as $child)
                                                            <li>
                                                                <a href="{{route('sub.category.product',[app()->getLocale(),$child->slug])}}">{{$child->name}}</a>
                                                            </li>
                                                        @endforeach
                                                    @endif
                                                </ul>
                                            </li>
                                        @endforeach
                                    @endif
                                    <li class="col-12 brad-logo-area">

                                        @if(isset($categories[0]))
                                            @foreach($categories as $p_category)
                                                <div><a href="#"><img
                                                            src="{{asset('assets/front/images/brands/clients_logo1.png')}}"
                                                            alt="clients_logo"/></a></div>
                                            @endforeach
                                        @endif
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">Pages <i class="fa fa-angle-down"></i></a>
                                <ul class="submenu-items">
                                    <li><a href="{{route('about', app()->getLocale())}}">about</a></li>
                                    <li><a href="{{route('shop', app()->getLocale())}}">shop</a></li>
                                    <li><a href="{{route('blogs', app()->getLocale())}}">blog</a></li>
                                    <li><a href="{{route('contact', app()->getLocale())}}">Contact</a></li>
                                    <li><a href="{{'cart.index', app()->getLocale()}}">cart</a></li>
                                    <li><a href="checkout.html">checkout</a></li>
                                    <li><a href="faq.html">FAQ</a></li>
                                    <li><a href="order-track.html">order track</a></li>
                                    <li><a href="{{route('sign.in', app()->getLocale())}}">sign in</a></li>
                                    <li><a href="{{route('sign.up', app()->getLocale())}}">sign up</a></li>
                                    <li><a href="reset-password.html">reset password</a></li>
                                    <li><a href="{{route('terms.and.conditions', app()->getLocale())}}">terms conditions</a></li>
                                    <li><a href="wishlist.html">wishlist</a></li>
                                    <li><a href="{{route('error.404', app()->getLocale())}}">404 page</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="{{route('blogs', app()->getLocale())}}">Blog </a>
                            </li>
                            <li>
                                <a href="{{route('contact', app()->getLocale())}}">Contact</a>
                            </li>

                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- header bottom area  end here  -->
</header>
<!-- header area end here  -->
<!-- mobile-header-area start here  -->
<div class="mobile-header-area">
    <div class="mobile-header-top">
        <ul class="social-meida">
            <li><a href="{{allSettings('pinterest')}}"><i class="fab fa-facebook-f"></i></a></li>
            <li><a href="{{allSettings('linkedin')}}"><i class="fab fa-linkedin"></i></a></li>
            <li><a href="{{allSettings('twitter')}}"><i class="fab fa-twitter"></i></a></li>
            <li><a class="pinterest" href="{{allSettings('pinterest')}}"><i class="fab fa-pinterest"></i></a></li>

        </ul>
    </div>
    <div class="mobile-header-bottom">
        <div class="menu-bar">
            <a href="#" class="menu-bars">
                <span class="bar-line"></span>
                <span class="menu-text">menu</span>
            </a>
        </div>
        <div class="brand-logo">
            <a href="index.html"><img src="{{asset('assets/front/images/logo1.png')}}" alt="woomart"/></a>
        </div>
        <div class="icon-bar">
            <a class="search-open" href="#"><i class="fa fa-search"></i></a>
            <a class="cart" href="{{'cart.index', app()->getLocale()}}"><i class="fas fa-shopping-cart"></i> <span class="cart-number">0</span>
            </a>
        </div>
    </div>
    <div class="mobile-search-area">
        <div class="mobile-search-form">
            <form action="#">
                <div class="form-group">
                    <input type="text" class="form-control" id="mobile-search" name="%s"
                           placeholder="Search Product...">
                    <button type="submit" class="search-submit"><i class="fa fa-search"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- mobile-header-area end here  -->
<!-- offcanvase menu area start here  -->
<div class="panel-backdrop "></div>
<div class="offcanvase-manu-area ">
    <nav class="mobile-menu">
        <ul>
            <li>
                <a href="{{route('home', app()->getLocale())}}">Home </a>
            </li>
            <li>
                <a href="{{route('shop', app()->getLocale())}}">Shop</a>
                <ul class="mega-menu-items">

                    <li>
                        <h4 class="megamenu-title">Men Fashion</h4>
                        <a href="#">Shirt</a>
                        <a href="#">T- Shirt</a>
                        <a href="#">Pant</a>
                        <a href="#">Jeans</a>
                        <a href="#">Trowser</a>
                    </li>
                    <li>
                        <h4 class="megamenu-title">Women Fashion</h4>
                        <a href="#">Shirt</a>
                        <a href="#">Shirt</a>
                        <a href="#">T- Shirt</a>
                        <a href="#">Pant</a>
                        <a href="#">Jeans</a>
                        <a href="#">Trowser</a>
                    </li>
                    <li>
                        <h4 class="megamenu-title">Electronics</h4>
                        <a href="#">Shirt</a>
                        <a href="#">T- Shirt</a>
                        <a href="#">Pant</a>
                        <a href="#">Jeans</a>
                        <a href="#">Trowser</a>
                    </li>
                    <li>
                        <h4 class="megamenu-title">Mobile & Laptops</h4>
                        <a href="#">Shirt</a>
                        <a href="#">T- Shirt</a>
                        <a href="#">Pant</a>
                        <a href="#">Jeans</a>
                        <a href="#">Trowser</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">Pages </a>
                <ul class="submenu-items">
                    <li><a href="{{route('about', app()->getLocale())}}">about</a></li>
                    <li><a href="{{route('shop', app()->getLocale())}}">shop</a></li>
                    <li><a href="blog.html">blog</a></li>
                    <li><a href="{{route('contact', app()->getLocale())}}">Contact</a></li>
                    <li><a href="{{'cart.index', app()->getLocale()}}">cart</a></li>
                    <li><a href="checkout.html">checkout</a></li>
                    <li><a href="faq.html">FAQ</a></li>
                    <li><a href="order-track.html">order track</a></li>
                    <li><a href="sign-in.html">sign in</a></li>
                    <li><a href="sign-up.html">sign up</a></li>
                    <li><a href="reset-password.html">reset password</a></li>
                    <li><a href="{{route('terms.and.conditions', app()->getLocale())}}">terms conditions</a></li>
                    <li><a href="wishlist.html">wishlist</a></li>
                    <li><a href="{{route('error.404', app()->getLocale())}}">404 page</a></li>
                </ul>
            </li>
            <li>
                <a href="blog.html">Blog </a>
            </li>
            <li>
                <a href="{{route('contact', app()->getLocale())}}">Contact</a>
            </li>

            <li>
                <a href="wishlist.html"><i class="far fa-heart"></i> Wishlist</a>
            </li>
            <li>
                <a href="sign-up.html"><i class="far fa-user"></i> Login / Register</a>
            </li>
        </ul>
    </nav>
    <div class="catagory-area">
        <h3 class="catagory-title">Categories</h3>
        <ul class="catagory-list">
            <li><a href="#"> <i class="fas fa-chair"></i> Furniture</a></li>
            <li><a href="#"> <i class="far fa-lightbulb"></i> Lighting</a></li>
            <li><a href="#"> <i class="fas fa-shopping-basket"></i> Accessories</a></li>
            <li><a href="#"> <i class="far fa-clock"></i> Clocks</a></li>
            <li><a href="#"> <i class="fas fa-cookie"></i> Cooking</a></li>
            <li><a href="#"> <i class="fas fa-plug"></i> Electronics</a></li>
            <li><a href="#"> <i class="fas fa-tshirt"></i> Fashion</a></li>
        </ul>
    </div>
</div>
<!-- offcanvase menu area end here  -->
