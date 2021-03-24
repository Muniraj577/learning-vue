<?php
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;
// $user = Auth::guard('admin')->user();
$menu = 'menu-open';
$active = 'active';
$catNav = Request::is('admin/category*');
$brandNav = Request::is('admin/brand*');
$unitNav = Request::is('admin/unit*');
$warehousenav = Request::is('admin/warehouse*');
$supplier = Request::is('admin/supplier*');
$productNav = Request::is('admin/product*');
$purchaseNav = Request::is('admin/purchase*');
$customerNav = Request::is('admin/customer*');
$saleNav = Request::is('admin/sale*');
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{route('admin.dashboard')}}" class="brand-link">
               <img src="{{asset('images/admin/avatars/default.png')}}" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{env('APP_NAME')}}</span>
    </a>
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('images/admin/avatars/default.png')}}" class="img-circle elevation-2"
                     alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Muniraj Rajbanshi</a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <router-link to="/admin/dashboard" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt iCheck"></i>
                        <p>Dashboard</p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/admin/profile" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt iCheck"></i>
                        <p>Profile</p>
                    </router-link>
                </li>
                {{-- @include('layouts.admin.sidebar.allnav') --}}
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
</aside>
