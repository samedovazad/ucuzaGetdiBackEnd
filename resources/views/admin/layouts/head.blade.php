<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<title>@yield('title','Login') | ucuzagetdi.com </title>
<!-- BEGIN VENDOR CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/bootstrap.css') }}">
<!-- font icons-->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/fonts/icomoon.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/fonts/flag-icon.min.css') }}">
{{--<link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/pace.css') }}">--}}
<!-- END VENDOR CSS-->
<!-- BEGIN ROBUST CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/bootstrap-extended.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/app.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/colors.css') }}">
<!-- END ROBUST CSS-->
<!-- BEGIN Page Level CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/vertical-menu.css') }}">
{{--<link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/vertical-overlay-menu.css') }}">--}}
{{--<link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/palette-gradient.css') }}">--}}

<link rel="stylesheet" href="{{ asset('css/jquery-confirm.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/style.css') }}">

<style>
    .page_loading{
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        /* left: 0; */
        z-index: 99999;
        opacity: 0.4;
        background-color: darkslategray;
        display: none;
    }
</style>
<!-- END Custom CSS-->
@yield('css')
