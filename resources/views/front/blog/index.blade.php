@extends('front.layouts.master')
@section('title', 'blogs')
@section('content')
    <div class="blog-page pb-60">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="section-wrap">
                        <h2 class="section-title mb-5">Our Latest Blog</h2>
                        <div class="row m-b-30">
                            @if(isset($blogs['all'][0]))
                                @foreach($blogs['all'] as $blog)
                                    <div class="col-lg-6 col-md-6">
                                        <article  class="single-post">
                                            <div class="post-thumbnail">
                                                <a href="{{route('blog.single', [app()->getLocale(), $blog->slug])}}">
                                                    <img src="{{$blog->image}}" alt="blog" />
                                                </a>
                                                <span class="blog-date">{{\Carbon\Carbon::parse($blog->created_at)->format('d M, y')}}</span>
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
                                                    <a href="{{route('blog.single',  [app()->getLocale(), $blog->slug])}}">{{\Illuminate\Support\Str::words($blog->title,5,'..')}}</a>
                                                </h2>
                                                <p class="post-content">{{\Illuminate\Support\Str::words($blog->description, 10, '...')}}</p>
                                                <a href="{{route('blog.single',  [app()->getLocale(), $blog->slug])}}" class="post-btn">
                                                    Read More <i class="fas fa-arrow-right"></i>
                                                </a>
                                            </div>
                                        </article>
                                    </div>

                                @endforeach

                            @endif

                        </div>
                    </div>
                    <div class="pagination-area mt-50">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="pagination-page d-flex align-items-center justify-content-between">
                                    <div class="page-count">
                                        <span>Page</span>
                                        <input class="page-number" type="text" value="2" />
                                        <span>of 30</span>
                                    </div>
                                    <ul class="page-controls">
                                        <li class="control-btn"><a href="#"><i class="fas fa-caret-left"></i> Prev</a></li>
                                        <li class="control-btn"><a href="#">Next <i class="fas fa-caret-right"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="sidebar-area">
                        <div class="single-widget search-widget ">
                            <div class="widget-title text-center">
                                <h3>Search Post</h3>
                            </div>
                            <div class="search-form widget-wrap">
                                <form method="post" action="{{route('blog.search',app()->getLocale())}}" enctype="multipart/form-data">
                                   @csrf
                                    <div class="form-group mb-0">
                                        <input type="text" class="form-control" id="search2" name="search_blog" placeholder="search here..." />
                                        <button type="submit" class="search-icon fas fa-search"></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="single-widget recent-post-widget ">
                            <div class="widget-title text-center">
                                <h3>Recent Blog</h3>
                            </div>
                            <div class="recent-post-list widget-wrap">
                                @if(isset(  $blogs['recent'][0]))
                                    @foreach(  $blogs['recent'] as $recent_blog)
                                <div class="singe-post">
                                    <div class="media align-items-center">
                                        <div class="post-thumbnail mr-3">
                                            <a href="{{route('blog.single', [app()->getLocale(), $recent_blog->slug])}}">
                                                <img src="{{$recent_blog->image}}" alt="iamge" />
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <h4 class="post-date"><i class="fas fa-calendar"></i> {{\Illuminate\Support\Carbon::parse($recent_blog->created_at)->format('d M, y')}}</h4>
                                            <h3 class="post-title">
                                                <a href="{{route('blog.single',[app()->getLocale(), $recent_blog->slug])}}">{{\Illuminate\Support\Str::words($recent_blog->title, '7')}}</a>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                                    @endforeach
                                    @endif

                            </div>
                        </div>
                        <div class="single-widget add-banner-widget ">
                            <div class="widget-title text-center">
                                <h3>Girls Collections</h3>
                            </div>
                            <img src="images/watch.jpg" alt="iamge" />
                        </div>
                        <div class="single-widget recent-post-widget ">
                            <div class="widget-title text-center">
                                <h3>Popular Blog</h3>
                            </div>
                            <div class="recent-post-list widget-wrap">
                                @if(isset(  $blogs['popular'][0]))
                                    @foreach(  $blogs['popular'] as $popular_blog)
                                        <div class="singe-post">
                                            <div class="media align-items-center">
                                                <div class="post-thumbnail mr-3">
                                                    <a href="{{route('blog.single', [app()->getLocale(),$popular_blog->slug])}}">
                                                        <img src="{{$popular_blog->image}}" alt="iamge" />
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <h4 class="post-date"><i class="fas fa-calendar"></i> {{\Illuminate\Support\Carbon::parse($popular_blog->created_at)->format('d M, y')}}</h4>
                                                    <h3 class="post-title">
                                                        <a href="{{route('blog.single', [app()->getLocale(),$popular_blog->slug])}}">{{\Illuminate\Support\Str::words($popular_blog->title, '7')}}</a>
                                                    </h3>
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

    @endsection
