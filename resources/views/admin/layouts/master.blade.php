<!DOCTYPE html>
<html lang="en">

@include('admin.layouts.include.header')

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">

<div class="wrapper">

    @include('admin.layouts.include.navbar')
    @include('sweetalert::alert')

    <aside class="main-sidebar sidebar-dark-primary elevation-4">


        @include('admin.layouts.include.brand_logo')
        @include('admin.layouts.include.sidebar')

    </aside>

    <div class="content-wrapper">
        @include('admin.layouts.include.page_title')
        <section class="content">
            @yield('content')
        </section>

    </div>

    <aside class="control-sidebar control-sidebar-dark">

    </aside>

    @include('admin.layouts.include.footer')

</div>

@include('admin.layouts.include.script')

</body>
</html>
