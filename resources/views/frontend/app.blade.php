<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  {{--
  <meta name="viewport" content="width=device-width, initial-scale=1"> --}}
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>SIPADU BAIMAN</title>
  @include('frontend.css')
  <style>
    .active {
      background-color: #2969b0 !important;
      background-image: linear-gradient(to right, #0954a9, #0785a9, #4db1a5, #2ba79f);
    }
  </style>

  <!-- PWA  -->
  <meta name="theme-color" content="#6777ef" />
  <link rel="apple-touch-icon" href="{{ asset('logo.PNG') }}">
  <link rel="manifest" href="{{ asset('/manifest.json') }}">
</head>

<body class="hold-transition sidebar-mini layout-navbar-fixed">
  <div class="wrapper">
    <!-- Navbar -->

    <nav class="main-header navbar navbar-expand navbar-dark navbar-lightblue"
      style="background-image: linear-gradient(15deg, #13547a 0%, #80d0c7 100%)">
      {{-- <nav class="main-header navbar navbar-expand navbar-dark navbar-lightblue"
        style="background-color: #2969b0 !important; background-image:linear-gradient(to right , #0954a9, #0785a9, #4db1a5, #2ba79f)">
        --}}
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
          <li class="nav-item">
            <img src="/admin/sipadu3.png" alt="Baiman" width="40px"> <span style="font-size: 20px;">SIPADU BAIMAN</span>
            {{--
            <a href="#" class="nav-link text-white">SIPADU
              BAIMAN</a> --}}
          </li>
        </ul>
        <ul class="navbar-nav ml-auto">
        </ul>
      </nav>
      <!-- /.navbar -->

      <!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-light-lightblue elevation-4">
        <a href="#" class="brand-link navbar-lightblue  text-center"
          style="background-image: linear-gradient(15deg, #13547a 0%, #80d0c7 100%)">
          <span class="brand-text font-weight-light text-white">

            <img src="/admin/3logo.png" alt="Baiman" width="90px">
          </span>
        </a>
        <div class="sidebar">

          @include('frontend.menu_superadmin')



        </div>
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper" style="background-color: #ebfbf7">

        @yield('slide')
        <!-- Main content -->
        <div class="content">
          <div class="container-fluid">
            @yield('content')
          </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
      </div>

      {{-- <footer class="main-footer">
        <div class="float-right d-none d-sm-inline">
        </div>
        <strong>Copyright &copy; 2022 Banjarmasin</strong>
        <div class="float-right d-none d-sm-inline-block">


        </div>
      </footer> --}}
  </div>

  <nav class="navbar navbar-light border-top navbar-expand d-md-none d-lg-none d-xl-none fixed-bottom"
    style="padding: 0px 0px">
    <ul class="navbar-nav nav-justified w-100">
      <li class="nav-item">
        <a class="nav-link text-sm" href="/">
          <div class="text-center" style="
          line-height: 13px;"><i class="fas fa-home"></i></div><span>Home</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-sm" href="/login">
          <div class="text-center" style="
          line-height: 13px;"><i class="fas fa-key"></i></div><span>Login</span>
        </a>

      </li>
    </ul>
  </nav>
  @include('frontend.js')
  <script src="{{ asset('/sw.js') }}"></script>
  <script>
    if (!navigator.serviceWorker.controller) {
        navigator.serviceWorker.register("/sw.js").then(function (reg) {
            console.log("Service worker has been registered for scope: " + reg.scope);
        });
    }
  </script>
</body>

</html>