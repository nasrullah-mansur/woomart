@extends('front.layouts.master')
@section('title', 'about us')
@section('content')

    <!-- about us ara starte here  -->
    <div class="about-us-area">
        <div class="container">
            <div class="about-wrap">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="about-image-area">
                            <img src="{{isset($about_us) ? $about_us->image : asset('assets/front/images/about-image.png')}}" alt="about image" />
                        </div>
                    </div>
                    <div class="col-lg-6 ">
                        <div class="about-info">
                            <h2>About Us</h2>
                          <p>
                              {!! isset($about_us) ? $about_us->about_us : '' !!}
                          </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- about us ara end here  -->
    <!-- mission vision area start here  -->
    <div class="mission-vision-area mt-50">
        <div class="container">
            <div class="section-wrap">
                <div class="row">
                    <div class="col-lg-3 col-md-6 align-self-center">
                        <div class="mission-info">
                            <h2>{!! isset($about_us) ? $about_us->middle_section_title : '' !!}</h2>
                            <p>{!! isset($about_us) ? $about_us->middle_section_description : '' !!} </p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="single-mission text-center mt-0">
                            <div class="mision-icon">
                                <img src="{{isset($about_us) ? $about_us->middle_section_content1_icon : '' }}" alt="">
                            </div>
                            <h3>{!! isset($about_us) ? $about_us->middle_section_content1_title : '' !!}</h3>
                            <p>{!! isset($about_us) ? $about_us->middle_section_content1_description : '' !!}</p>
                            <a class="learmore-btn" href="#">Learn More <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="single-mission text-center">
                            <div class="mision-icon">
                                <img src="{{isset($about_us) ? $about_us->middle_section_content2_icon : '' }}" alt="">

                            </div>
                            <h3>{!! isset($about_us) ? $about_us->middle_section_content2_title : '' !!}</h3>
                            <p>{!! isset($about_us) ? $about_us->middle_section_content2_description : '' !!}</p>
                            <a class="learmore-btn" href="#">Learn More <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="single-mission text-center">
                            <div class="mision-icon">
                                <img src="{{isset($about_us) ? $about_us->middle_section_content3_icon : '' }}" alt="">
                            </div>
                            <h3>{!! isset($about_us) ? $about_us->middle_section_content3_title : '' !!}</h3>
                            <p>{!! isset($about_us) ? $about_us->middle_section_content3_description : '' !!}</p>
                            <a class="learmore-btn" href="#">Learn More <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- mission vision area end here  -->
    <!-- team-area start here  -->
    @if(isset($talents[0]))
        <section class="team-area mt-50">
        <div class="container">
            <div class="section-wrap">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="top-section">
                            <h2 class="section-title">Our Talented Team</h2>
                        </div>
                    </div>
                </div>
                <div class="team-slide  m-b-15 ">
                        @foreach($talents as $talent)
                            <div class="sngle-team text-center ">
                        <div class="team-thumnail">
                            <a href="#"><img src="{{$talent->image}}" alt="team" /></a>
                        </div>
                        <div class="team-info">
                            <h3 class="team-name"><a href="#">{{$talent->name}}</a></h3>
                            <p class="team-profesiona">{{$talent->designation}}</p>
                        </div>
                    </div>
                        @endforeach
                </div>
            </div>
        </div>
    </section>
    @endif
    <!-- team-area end here  -->
    <!-- testimonial-two-area start here  -->
    @if(isset($feedbacks[0]))
    <section class="testimonial-area mt-50 mb-60">
        <div class="container">
            <div class="section-wrap">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="top-section">
                            <h2 class="section-title">Client Feedbacks</h2>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-lg-4">
                        <div class="testimonial-left-area">
                            <div class="testimonal-author-images">
                                    @foreach($feedbacks as $feedbackImage)
                                <div class="sigle-iamge text-center">
                                    <img src="{{$feedbackImage->image}}" alt="" />
                                </div>
                                    @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="testimonail-list ">
                            @foreach($feedbacks as $feedback)
                            <div class="single-testimonial">
                                <div class="clint-say">
                                    <p>{!! $feedback->feedback !!}</p></div>
                                <div class="media align-items-center">
                                    <div class="author-image mr-3">
                                        <img src="{{$feedback->image}}" alt="" />
                                    </div>
                                    <div class="media-body">
                                        <h5 class="mt-0 clint-title"><a href="#">{{$feedback->name}}</a></h5>
                                        <p class="mb-0  clint-profession">{{$feedback->profession}}</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
    <!-- testimonial-two-area end here  -->

@endsection
