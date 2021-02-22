<!DOCTYPE html>
<html dir="{{ Locales::getDir() }}" lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ isset($title) ? $title .' | '. config('app.name', 'Laravel') : config('app.name', 'Laravel')}}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Admin Lte -->
    @if(Locales::getDir() == 'rtl')
        <link rel="stylesheet" href="{{ asset(mix('/css/adminlte.rtl.css')) }}">
    @else
        <link rel="stylesheet" href="{{ asset(mix('/css/adminlte.css')) }}">
    @endif

    @stack('styles')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper" id="app">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Language Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="true">
                    <img src="{{ Locales::getFlag() }}" alt="">
                    <span class="d-none d-md-inline">
                        {{ Locales::getName() }}
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right p-0">
                    @foreach(Locales::get() as $locale)
                        <a href="{{ route('dashboard.locale', $locale->code) }}"
                           class="dropdown-item {{ app()->getLocale() == $locale->code ? 'active' : '' }}">
                            <img src="{{ $locale->flag }}" alt="">
                            {{ $locale->name }}
                        </a>
                    @endforeach
                </div>
            </li>
            <!-- User Dropdown Menu -->
            <li class="nav-item dropdown user-dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">

                    <img src="{{ auth()->user()->getAvatar() }}"
                         alt="{{ auth()->user()->name }}"
                         class="img-circle elevation-2">
                </a>
                <div class="dropdown-menu dropdown-menu-md dropdown-menu-right user-dropdown-menu">
                    <a href="#" onclick="event.preventDefault();document.getElementById('logoutForm').submit()" class="dropdown-item">
                        <i class="fas fa-sign-out-alt mr-2"></i> @lang('adminlte.auth.logout')
                    </a>
                    <form style="display: none;" action="{{ route('logout') }}" method="post" id="logoutForm">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{ url('/') }}" target="_blank" class="brand-link">
            <img src="{{ optional(Settings::instance('logo'))->getFirstMediaUrl('logo') ?: asset('/images/AdminLTELogo.png') }}"
                 alt="{{ Settings::get('title', config('app.name')) }}"
                 style="height: 25px">
            <span class="brand-text font-weight-light">{{ Settings::get('title', config('app.name')) }}</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{ auth()->user()->getAvatar() }}"
                         class="img-circle elevation-2"
                         alt="{{ auth()->user()->name }}">
                </div>
                <div class="info">
                    <a href="#" class="d-block">
                        {{ auth()->user()->name }}
                    </a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column nav-legacy" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                        @yield('sidebar')
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @yield('content')
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        {{ Settings::get('copyright', trans('frontend.copyright')) }}
    </footer>
</div>
<!-- ./wrapper -->

<!-- Scripts -->
<script src="{{ asset(mix('/js/adminlte.js')) }}"></script>

@stack('scripts')
</body>
</html>
