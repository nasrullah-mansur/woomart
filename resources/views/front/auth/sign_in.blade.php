@extends('front.layouts.master')
@section('title', isset($page_title) ? $page_title : 'sign-in')
@section('content')
    <div class="register-page pb-60">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-wrap">
                        <div class="register-info">
                            <div class="register-top text-center">
                                <h2>{{allSettings('sign_in_title') ? allSettings('sign_in_title') : 'Welcome Back'}}</h2>
                                <p>{{allSettings('welcome_message') ? allSettings('welcome_message') : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fermentum uismod'}}</p>
                        </div>
                            <div class="register-form">
                                <form action="{{route('sign.in.store', app()->getLocale())}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group ">
                                        <input type="text" class="form-control" name="email" id="username" placeholder="Email">
                                        <i class="icon fas fa-user"></i>
                                    </div>
                                    <div class="form-group mb-3">
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                        <i class="icon fas fa-lock"></i>
                                    </div>
                                    <div class="form-bottom d-flex align-items-center justify-content-between">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="remember">
                                            <label class="form-check-label" for="remember">Remember me</label>
                                        </div>
                                        <a class="forgot-password" href="reset-password.html">Forgot password?</a>
                                    </div>
                                    <div class="form-btn text-center">
                                        <button type="submit" class="btn-style-two">Sign In</button>
                                    </div>
                                </form>
                            </div>
                            <div class="register-bottom text-center">
                                <div class="bottom-title">
                                    <h3>Or</h3>
                                </div>
                                <ul class="btn-list d-flex align-items-center justify-content-between">
                                    <li><a class="login-btn facebook" href="#"><i class="fab fa-facebook-f"></i>Log In with Facebook</a></li>
                                    <li><a class="login-btn google" href="#"><i class="fab fa-google"></i>Log In with Google</a></li>
                                </ul>
                                <p class="have-account mb-0">
                                    Don’t have account?
                                    <a href="{{route('sign.up', app()->getLocale())}}">Sign Up Now</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="register-right">
                        <img src="{{allSettings('sign_in_image') ? allSettings('sign_in_image') : asset('assets/front/images/register2.jpg')}}" alt="register right image">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
