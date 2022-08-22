<?php
    $contactus = contactUs();
?>

<footer class="footer-area-v2 mt-50">
    <div class="widget-area ">
        <div class="container">
            <div class="feature-lsit">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="single-feature">
                                <div class="media">
                                    <div class="icon mr-5 align-self-center">
                                        <i class="fas fa-shopping-basket"></i>
                                    </div>
                                    <div class="media-body">
                                        <h4 class="mt-0">Shopping Cart</h4>
                                        <span>Step 1</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="single-feature">
                                <div class="media">
                                    <div class="icon mr-5 align-self-center">
                                        <i class="fas fa-money-check-alt"></i>
                                    </div>
                                    <div class="media-body">
                                        <h4 class="mt-0">Payment</h4>
                                        <span>Step 2</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="single-feature">
                                <div class="media">
                                    <div class="icon mr-5 align-self-center">
                                        <i class="fas fa-truck"></i>
                                    </div>
                                    <div class="media-body">
                                        <h4 class="mt-0">Delivery</h4>
                                        <span>Step 3</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="single-feature">
                                <div class="media">
                                    <div class="icon mr-5 align-self-center">
                                        <i class="fas fa-clipboard-check"></i>
                                    </div>
                                    <div class="media-body">
                                        <h4 class="mt-0">Confirmation</h4>
                                        <span>Step 4</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="widget-wrap">
                <div class="row m-b-30">
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="single-widget text-widget">
                            <div class="footer-brand">
                                <a href=""><img src="{{allSettings('logo') ? allSettings('logo') :  asset('assets/front/images/white-logo2.png')}}" alt="woomart" /></a>
                            </div>
                            <p>{!! allSettings('about_us') ? allSettings('about_us') : '' !!}</p>
                            <ul class="social-media-widget">
                                <li><a class="facebook" href="{{allSettings('facebook')}}"><i class="fab fa-facebook"></i></a></li>
                                <li><a class="twitter" href="{{allSettings('twitter')}}"><i class="fab fa-twitter"></i></a></li>
                                <li><a class="linkedin" href="{{allSettings('linkedin')}}"><i class="fab fa-linkedin-in"></i></a></li>
                                <li><a class="pinterest" href="{{allSettings('pinterest')}}"><i class="fab fa-pinterest"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="single-widget footer-menu">
                            <h3 class="widget-title">Quick Menu</h3>
                            <ul>
                                <li><a href="{{route('home', app()->getLocale())}}">Home</a></li>
{{--                                <li><a href="#">Catergory</a></li>--}}
                                <li><a href="{{route('shop', app()->getLocale())}}">Shop</a></li>
                                <li><a href="{{route('blogs', app()->getLocale())}}">Blog</a></li>
                                <li><a href="{{route('contact', app()->getLocale())}}">Contact Us</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="single-widget contact-widget">
                            <h3 class="widget-title">Contact us</h3>
                            <ul class="address-list">
                                <li>{!! isset($contactus) ? $contactus->address : '354 King Street, Melbourne Victoria 5467 Australia' !!}</li>
                                <li>{{isset($contactus) ? $contactus->phone : '(0321) 645-798-021'}}</li>
                                <li>{{isset($contactus) ? $contactus->site_url : 'yoursite.com'}}</li>
                                <li>{{isset($contactus) ? $contactus->email : 'info@mail.com'}}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="single-widget newsletter-widget">
                            <h3 class="widget-title">Newsletter</h3>
                            <div class="subscribe-form">
                                <form action="#">
                                    <div class="form-group">
                                        <input type="email" class="form-control" id="subscribe" name="subscribe" placeholder="Subscribe Newsletter" />
                                    </div>
                                    <button type="submit" class="btn-style-two">Subscribe</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="footer-bottom-wrap">
                <div class="row ">
                    <div class="col-lg-6 col-md-6">
                        <div class="copyright-area text-center text-md-left">
                            <p class="copyright-text">&copy; Copyright {{\Carbon\Carbon::now()->format('Y')}} <a href="#">ZainikLab</a></p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="footer-bottom-menu text-center text-md-right">
                            <ul>
                                <li><a href="{{route('terms.and.conditions', app()->getLocale())}}">Terms & Conditions </a></li>
                                <li><a href="{{route('terms.and.conditions', app()->getLocale())}}">Privacy</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
