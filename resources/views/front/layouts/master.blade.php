<!DOCTYPE html>
<html class="no-js" lang="en">

<?php
$categories = allCategory();
$brands = allBrand();
?>


@include('front.layouts.include.head')
<body class="body-class">
<!-- pre-loder-area area start here  -->

<div class="preloader">
            <span class="loader">
                <span class="loader-inner"></span>
            </span>
</div>

<!-- pre-loder-area area end here  -->


<!-- header -area area start here  -->
@include('front.layouts.include.header')
<!-- header -area area start here  -->
@include('sweetalert::alert')

<!-- mobile-header -area area end here  -->
@yield('content')
<!-- footer area start here  -->
@include('front.layouts.include.footer')
<!-- footer area end here  -->
@include('front.layouts.include.script')
</body>
</html>
