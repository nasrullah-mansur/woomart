@extends('front.layouts.master')
@section('title', isset($page_title) ? $page_title : 'sign-up')
@section('content')
    <div class="register-page pb-60">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-wrap">
                        <div class="register-info">
                            <div class="register-top text-center">
                                <h2>{{allSettings('sign_up_title') ? allSettings('sign_up_title') : 'Join With US'}}</h2>
                                <p>{{allSettings('why_sign_up') ? allSettings('why_sign_up') : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fermentum uismod'}}</p></div>
                            <div class="register-form" >
                                <form id="formsubmit" action="{{route('sign.up.store', app()->getLocale())}}" method="POST" enctype="multipart/form-data" >
                                    @csrf
                                    <div class="form-group ">
                                        <input type="text" class="form-control" name="name" id="fullname" placeholder="Full Name" value="{{old('name')}}">
                                        <i class="icon fas fa-user"></i>
                                        <span class="text-danger">{{$errors->first('name')}}</span>
                                    </div>
                                    <div class="form-group ">
                                        <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                                        <i class="icon fas fa-envelope"></i>
                                        <span class="text-danger">{{$errors->first('email')}}</span>

                                    </div>
                                    <div class="form-group ">
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                        <i class="icon fas fa-lock"></i>

                                        <span class="text-danger">{{$errors->first('password')}}</span>

                                    </div>
                                    <div class="form-group mb-3">
                                        <input type="password" class="form-control" id="repassword" name="password_confirmation" placeholder="Re-enter Password">
                                        <i class="icon fas fa-lock"></i>

                                        <span class="text-danger">{{$errors->first('password_confirmation')}}</span>

                                    </div>
                                    <div class="form-bottom ">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="agree" name="agree">
                                            <label class="form-check-label" for="agree">{{allSettings('agree_for') ? allSettings('agree_for') : 'JAgree with Terms &amp; Policy'}}</label>

                                        </div>
                                    </div>
                                    <div class="form-btn text-center">
                                        <button type="submit" id="sign_up" class="btn-style-two">Sign Up</button>
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
                                    Already have an account?
                                    <a href="{{route('sign.in', app()->getLocale())}}">Sign In Now</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="register-right">
                        <img src="{{allSettings('sign_up_image') ? allSettings('sign_up_image') : asset('assets/front/images/register2.jpg')}}" alt="register right image">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('post_script')

{{--    <script>--}}

{{--            $('#sign_up').click(function (event) {--}}

{{--                event.preventDefault();--}}
{{--                var agree = $('#agree').val();--}}

{{--                if (agree == 'on')--}}
{{--                {--}}
{{--                    return true;--}}
{{--                }--}}


{{--            });--}}
{{--    </script>--}}
@endsection
