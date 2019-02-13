<!DOCTYPE html>
<html lang="en" data-textdirection="ltr" class="loading">
<head>
    @include('admin.layouts.head')
</head>
<body data-open="click" data-menu="vertical-menu" data-col="2-columns"
      class="vertical-layout vertical-menu 2-columns  fixed-navbar">

@include('admin.layouts.navbar')
@include('admin.layouts.sidebar')
<div class="app-content content container-fluid">
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body"><!-- stats -->
            @yield('content')
        </div>
    </div>
</div>
@include('admin.layouts.footer')

<div class="page_loading">
    <img src="{{ asset('assets\admin\images\loading_gif.gif') }}" alt="" style="margin-left: 50%;
    margin-top: 20%;
    width: 60px;">
</div>
@include('admin.layouts.modal')

</body>
</html>
