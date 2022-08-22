@extends('front.layouts.master')
@section('title', 'contact')
@section('content')
    <?php
    $contactus = contactus();
    ?>
    <div class="contact-page pb-60">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 order-1 order-lg-0">
                    <div class="section-wrap">
                        <div class="contact-info">
                            <h3>{{isset($contactus->contact_title) ? $contactus->contact_title : 'Get A Qoute'}}</h3>
                            <p>{!! isset($contactus->why_contact) ? $contactus->why_contact : '' !!}</p>
                            <ul class="contacts-info-list">
                                <li>
                                    <i class="icon fas fa-phone-alt"></i>
                                    {{isset($contactus) ? $contactus->phone : '(0321) 645-798-021'}}
                                </li>
                                <li>
                                    <i class="icon fas fa-envelope"></i>
                                    {{isset($contactus) ? $contactus->email : 'info@mail.com'}}
                                </li>
                                <li>
                                    <i class="icon fas fa-map-marker"></i>
                                    {!! isset($contactus) ? $contactus->address : '354 King Street, Melbourne Victoria 5467 Australia' !!}
                                </li>
                            </ul>
                            <ul class="social-meida-contact">
                                <li><a href="{{allSettings('facebook')}}"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="{{allSettings('twitter')}}"><i class="fab fa-twitter"></i></a></li>
{{--                                <li><a href="{{allSettings('facebook')}}"><i class="fab fa-instagram"></i></a></li>--}}
                                <li><a href="{{allSettings('linkedin')}}"><i class="fab fa-linkedin-in"></i></a></li>
                                <li><a class="pinterest" href="{{allSettings('pinterest')}}"><i class="fab fa-pinterest"></i></a></li>

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="section-wrap form-wrap">
                        <div class="primary-form">
                            <h3 class="form-top-title">{{isset($contactus->form_title) ? $contactus->form_title : 'Drop a line to us'}}</h3>
                            <form action="#">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="firstname">First Name</label>
                                            <input type="text" class="form-control" id="firstname" name="firstname" required="">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="lastname">Last Name</label>
                                            <input type="text" class="form-control" id="lastname" name="lastname" required="">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="phone">Phone</label>
                                            <input type="text" class="form-control" id="phone" name="phone" required="">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" required="">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="message">Message</label>
                                            <textarea class="message-box" id="message" rows="3"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn-style-two primary-bg">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
