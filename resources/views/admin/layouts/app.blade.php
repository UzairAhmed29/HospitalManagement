<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CoronaMedicalCare | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('/css/admin/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('/css/admin/tempusdominus-bootstrap-4.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('/css/admin/icheck-bootstrap.min.css') }}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('/css/admin/jqvmap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('/css/admin/adminlte.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('/css/admin/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('/css/admin/daterangepicker.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('/css/admin/summernote-bs4.min.css') }}">
  <!-- select2 -->
  <link rel="stylesheet" href="{{ asset('/css/admin/select2.min.css') }}">
    <style>
        mark.highlight {
            background: yellow !important;
        }
        </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  {{-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div> --}}

  <!-- Navbar -->
  @include('admin/partials/navbar')
  <!-- /.navbar -->
  <!-- Main Sidebar Container -->
  @include('admin/partials/sidebar')

  <!-- Content Wrapper. Contains page content -->
    @if(Session::has('success'))
        <div id="remove-noti" class="alert alert-success" role="alert" style="width: 81%; float: right; text-align: center; margin: 18px auto;">
            {{ Session::get('success') }}
        </div>
    @endif
  @yield('content')
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2022 <a href=""></a></strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('/js/admin/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('/js/admin/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('/js/admin/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<!--<script src="plugins/chart.js/Chart.min.js"></script> -->
<!-- Sparkline -->
<script src="{{ asset('/js/admin/sparkline.js') }}"></script>
<!-- JQVMap -->
{{-- <script src="{{ asset('/js/admin/jquery.vmap.min.js') }}"></script> --}}
{{-- <script src="{{ asset('/js/admin/jquery.vmap.usa.js') }}"></script> --}}
<!-- jQuery Knob Chart -->
<script src="{{ asset('/js/admin/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('/js/admin/moment.min.js') }}"></script>
<script src="{{ asset('/js/admin/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('/js/admin/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('/js/admin/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('/js/admin/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('/js/admin/adminlte.js') }}"></script>
<!-- AdminLTE for demo purposes -->
{{-- <script src="{{ asset('/js/admin/demo.js') }}"></script> --}}
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('/js/admin/dashboard.js') }}"></script>
<script src="{{ asset('/js/admin/select2.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/gh/vdw/HideSeek@master/jquery.hideseek.min.js"></script>
<script>
    jQuery(document).ready(function() {
            setTimeout(function() {
                jQuery("#remove-noti").fadeOut();
            }, 3000);
    });
</script>
@yield('scripts')
</body>
</html>
