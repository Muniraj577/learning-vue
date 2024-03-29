<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{ env('APP_NAME') }} @hasSection('title') | @yield('title') @endif
</title>
<link rel="icon" href="{{ asset('images/inventory.png') }}" type="image/*" sizes="16x16">
@include('layouts.admin.style')
<style>
    #overlay {
        position: fixed;
        display: none;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 2;
        cursor: pointer;
    }

</style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper" id="app">

    @include('layouts.admin.header')

    <!-- Main Sidebar Container -->
    @include('layouts.admin.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div id="overlay"></div>
        <div class="loading" style="position: absolute; left: 50%; top: 40%;z-index: 1000000;display: none;">
            <img src="{{ asset('loader.gif') }}" class="img-fluid mx-auto d-block" style="height: 200px;" alt="">
        </div>
        <router-view></router-view>
    </div>
    <!-- /.content-wrapper -->
    @include('layouts.admin.footer')
</div>
<!-- ./wrapper -->

@include('layouts.admin.script')

</body>

</html>
