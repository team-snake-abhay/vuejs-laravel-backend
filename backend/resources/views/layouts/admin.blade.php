<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')-{{ config('app.name') }}</title>
    <!-- Favicon Icon -->
    <link rel="icon" type="image/x-icon" href="{{asset('pub_template/images/favicon.ico')}}" />

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{url('AdminLTE/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{url('AdminLTE/dist/css/adminlte.min.css')}}">

    @yield('css')
</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        @include('layouts._partials.admin.navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('layouts._partials.admin.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <!-- <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Blank Page</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Blank Page</li>
            </ol>
          </div>
        </div>
      </div><!- /.container-fluid ->
    </section> -->

            <!-- Main content -->
            <section class="content">

                @yield('content')

            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        @include('layouts._partials.admin.footer')

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{url('AdminLTE/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{url('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{url('AdminLTE/dist/js/adminlte.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <!-- <script src="{{url('AdminLTE/dist/js/demo.js')}}"></script> -->
    <script>
    /** add active class and stay opened when selected */
    var url = window.location;

    // for sidebar menu entirely but not cover treeview
    $('ul.nav-sidebar a').filter(function() {
        return this.href == url;
    }).addClass('active');

    // for treeview
    $('ul.nav-treeview a').filter(function() {
        return this.href == url;
    }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');
    </script>
    <!-- Page Js -->
    @yield('js')
    <!-- Page Js -->

</body>

</html>