<head>
    @yield('pre_header')

    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title> {{allSettings('company_name') ? allSettings('company_name') : 'woomart '}} | @yield('title')</title>
    <meta name="description" content="{!! allSettings('meta_description') ? allSettings('meta_description') : '' !!}" />
    <meta name="keywords" content="{!! allSettings('meta_keywords') ? allSettings('meta_keywords') : '' !!}" />
    <meta name="author" content="{{ allSettings('meta_author') ? allSettings('meta_author') : '' }}" />

    <!-- Place favicon.ico in the root directory -->
    <link rel="apple-touch-icon" href="{{ allSettings('fav_icon') ? allSettings('fav_icon') : asset('assets/front/images/favicon.png')}}">
    <link rel="shortcut icon" href="{{ allSettings('fav_icon') ? allSettings('fav_icon') :  asset('assets/front/images/favicon.png')}}" type="image/x-icon">
    <!-- fonts file -->
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- css file  -->
    <link rel="stylesheet" href="{{asset('assets/front/css/plugins.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/css/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/css/responsive.css')}}'">
    <script src="{{asset('assets/front/js/modernizr-3.11.2.min.js')}}"></script>

    @yield('post_header')

</head>
