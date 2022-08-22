@extends('front.layouts.master', $blogs['single'])
@section('title', 'blog details')
@section('content')
    <div class="single-blog-page pb-60">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="section-wrap">
                        <article class="sigle-post">
                            <h2 class="post-title">{{ $blogs['single']->title}}</h2>
                            <div class="post-thumbnail">
                                <img src="{{ $blogs['single']->image}}" alt="post image">
                                <span class="post-date">{{\Illuminate\Support\Carbon::parse($blogs['single']->created_at)->format('d M, y')}}</span>
                            </div>
                            <p class="post-content">{{\Illuminate\Support\Str::words($blogs['single']->description,100,'')}}</p>
                             <blockquote class="blockquote">
                                <q>{{$blogs['single']->quotation}}</q>
                            </blockquote>

                            @php

                            $string_length  =  strlen(\Illuminate\Support\Str::words($blogs['single']->description,100));
                           @endphp
                            <p class="post-content">{!! substr($blogs['single']->description, $string_length+2) !!}</p>  <div class="blog-meta">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <ul class="meta-box">
                                            <li>
                                                <a href="#"><i class="far fa-user"></i> John Doe</a>
                                            </li>
                                            <li>
                                                <a href="#"><i class="far fa-comments"></i> {{isset($blogs['single']->comment) ? count($blogs['single']->comment) : 0}} Comments</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="social-share-area text-lg-right">
                                            <span class="share-title">Share this Post : </span>
                                            <ul>
                                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                                <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                                <li><a href="#"><i class="fab fa-pinterest-p"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if(isset($blogs['single']->comment[0]))
                                @foreach($blogs['single']->comment as $comment)
                            <div class="single-post-commnt">
                                <ul class="comment-list">
                                    <li class="sngle-comment">
                                        <div class="media align-items-center">
                                            <a class="mr-4" href="#">
                                                <img class="author-image" src="{{ isset($comment->user->image) ? $comment->user->image :asset('assets/front/images/comment1.png')}}" alt="comment">
                                            </a>
                                            <div class="media-body ">
                                                <h3 class="author-name"><a href="#">{{$comment->first_name.' '.$comment->last_name}}</a></h3>
                                                <h5 class="post-date">
                                                    {{\Carbon\Carbon::parse($comment->created_at)->format('d M Y') .' at '.\Carbon\Carbon::parse($comment->created_at)->format('H:i')}} |
                                                    <a class="replay-btn reply" href="#write_reply" onclick="getCommentId(`{{$comment->id}}`)">Reply</a>
                                                </h5>
                                                <p>{{$comment->comment}}</p> </div>
                                        </div>
                                    </li>

                                    <li class="sngle-comment ">
                                        @if(isset($comment->reply[0]))
                                            @foreach($comment->reply as $reply)
                                        <div class="media align-items-center">
                                            <a class="mr-4" href="#">
                                                <img class="author-image" src="{{ isset($comment->user->image) ? $comment->user->image :asset('assets/front/images/comment2.png')}}" alt="comment">
                                            </a>
                                            <div class="media-body ">
                                                <h3 class="author-name"><a href="#">{{$reply->first_name.' '.$reply->last_name}}</a></h3>
                                                <h5 class="post-date">
                                                    {{\Carbon\Carbon::parse($reply->created_at)->format('d M Y') .' at '.\Carbon\Carbon::parse($reply->created_at)->format('H:i')}} |
                                                    <a class="replay-btn reply" href="#write_reply" onclick="getCommentId(`{{$comment->id}}`)">Reply</a>

                                                </h5>
                                                <p>{{$reply->comment}}</p>
                                            </div>
                                        </div>
                                            @endforeach
                                        @endif
                                    </li>

                                </ul>
                            </div>
                                @endforeach
                                @endif
                        </article>
                    </div>
                    <div class="section-wrap mt-50" id="write_reply">
                        <h2 class="sectin-wrap-title">Write a comment</h2>
                        <div class="comment-form">
                            <form action="{{route('blog.comment', app()->getLocale())}}" method="POST" enctype="multipart/form-data" >
                                @csrf
                                <div class="row">
                                    @if(Auth::user())
                                        <input type="hidden" name="user_id" value="{{Auth::id()}}">
                                    @else
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name">
                                            <span class="text-danger">{{$errors->first('first_name')}}</span>

                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="last_name" name="last_name"  placeholder="Last Name">
                                            <span class="text-danger">{{$errors->first('last_name')}}</span>

                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="email" name="email" placeholder="Email">
                                            <span class="text-danger">{{$errors->first('email')}}</span>

                                        </div>
                                    </div>
                                    @endif
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <textarea class="message-box" id="comment"  name="comment" rows="3" placeholder="Message"></textarea>

                                            <span class="text-danger">{{$errors->first('comment')}}</span>
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" name="blog_id" value="{{$blogs['single']->id}}">
                                <input type="hidden" name="comment_id" id="comment_id">
                                <button type="submit" class="btn-style-two secondary-bg border-0">Send Comment</button>
                            </form>
                        </div>
                    </div>
                    <div class="pagination-area mt-50">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="pagination-page d-flex align-items-center justify-content-between">
                                    <div class="page-count">
                                        <span>Page</span>
                                        <input class="page-number" type="text" value="2">
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
                                <form method="post" action="{{route('blog.search', app()->getLocale())}}" enctype="multipart/form-data">
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
                                                    <a href="{{route('blog.single',[app()->getLocale(), $recent_blog->slug])}}">
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
                            <img src="{{asset('assets/front/images/watch.jpg')}}" alt="iamge" />
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
                                                    <a href="{{route('blog.single', [app()->getLocale(), $popular_blog->slug])}}">
                                                        <img src="{{$popular_blog->image}}" alt="iamge" />
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <h4 class="post-date"><i class="fas fa-calendar"></i> {{\Illuminate\Support\Carbon::parse($popular_blog->created_at)->format('d M, y')}}</h4>
                                                    <h3 class="post-title">
                                                        <a href="{{route('blog.single', [app()->getLocale(), $popular_blog->slug])}}">{{\Illuminate\Support\Str::words($popular_blog->title, '7')}}</a>
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

@section('post_script')

    <script>
        function getCommentId($id) {
            let commentId = document.getElementById('comment_id');
            comment_id.value = $id;
        }
    </script>
@endsection
