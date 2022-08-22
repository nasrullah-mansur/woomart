@extends('front.layouts.master', isset($id) ? $id : '')
@section('title', '404')
@section('content')
    <?php
    $error404 = error404();
    ?>
<div class="error-page pb-60">
    <div class="container">
        <div class="section-wrap">
            <div class="row">
                <div class="col-lg-6">
                    <img src="{{ isset($error404) ? $error404->image : asset('assets/front/images/404.png')}}" alt="404 image">
                </div>
                <div class="col-lg-6 align-self-center">
                    <div class="erroe-content">
                        <h1 class="error-title"><span>404</span> Error!</h1>

                        <p>{{isset($message) ? $message : ''}}</p>
                        <a href="{{route('home', app()->getLocale())}}" class="btn-style-two">Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
