@yield('pre_script')

<script src="{{asset('assets/admin/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{asset('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('assets/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('assets/admin/dist/js/adminlte.js')}}"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="{{asset('assets/admin/dist/js/demo.js')}}"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="{{asset('assets/admin/plugins/jquery-mousewheel/jquery.mousewheel.js')}}"></script>
<script src="{{asset('assets/admin/plugins/raphael/raphael.min.js')}}"></script>
<script src="{{asset('assets/admin/plugins/jquery-mapael/jquery.mapael.min.js')}}"></script>
<script src="{{asset('assets/admin/plugins/jquery-mapael/maps/usa_states.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('assets/admin/plugins/chart.js/Chart.min.js')}}"></script>

{{--toaster--}}
<script src="{{asset('assets/admin/plugins/toastr/toastr.min.js')}}"></script>

{{-- Notification Start  --}}

{{--<script src="https://js.pusher.com/7.0/pusher.min.js"></script>--}}
{{--<script>--}}

    {{--// Enable pusher logging - don't include this in production--}}
    {{--Pusher.logToConsole = true;--}}

    {{--var pusher = new Pusher('110259ebd309d4f49354', {--}}
        {{--cluster: 'ap2'--}}
    {{--});--}}

    {{--var channel = pusher.subscribe('new.order');--}}
    {{--channel.bind('App\\Events\\OrderPlacingEvent', function(data) {--}}
        {{--alert(JSON.stringify(data));--}}
    {{--});--}}
{{--</script>--}}


<script src="{{asset('assets/admin/plugins/summernote/summernote-bs4.min.js')}}"></script>

<script>
    $(function () {
        // Summernote
        $('.textarea').summernote()
    })
</script>
</script>
@yield('post_script')
