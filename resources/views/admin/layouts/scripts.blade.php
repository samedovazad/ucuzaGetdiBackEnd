<script>
    var _token = "{{ csrf_token() }}";
</script>

<!-- BEGIN VENDOR JS-->
<script src="{{ asset('assets/admin/js/jquery.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/js/tether.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/js/perfect-scrollbar.jquery.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/js/unison.min.js') }}" type="text/javascript"></script>
{{--<script src="{{ asset('assets/admin/js/blockUI.min.js') }}" type="text/javascript"></script>--}}
{{--<script src="{{ asset('assets/admin/js/jquery.matchHeight-min.js') }}" type="text/javascript"></script>--}}
{{--<script src="{{ asset('assets/admin/js/screenfull.min.js') }}" type="text/javascript"></script>--}}
<script src="{{ asset('assets/admin/js/pace.min.js') }}" type="text/javascript"></script>
<!-- BEGIN VENDOR JS-->
<!-- BEGIN PAGE VENDOR JS-->
{{--<script src="{{ asset('assets/admin/js/chart.min.js') }}" type="text/javascript"></script>--}}
<!-- END PAGE VENDOR JS-->
<!-- BEGIN ROBUST JS-->
<script src="{{ asset('assets/admin/js/app-menu.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/js/app.js') }}" type="text/javascript"></script>
<!-- END ROBUST JS-->
<!-- BEGIN PAGE LEVEL JS-->
{{--<script src="{{ asset('assets/admin/js/dashboard-lite.js') }}" type="text/javascript"></script>--}}
<!-- END PAGE LEVEL JS-->

<script src="{{ asset('js/jquery-confirm.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/jquery.mask.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/underscore.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/script.js') }}" type="text/javascript"></script>
@yield('js')
