<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Dashboard</title>

  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('backend/plugins/fontawesome-free/css/all.min.css') }}">

  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('backend/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">

  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('backend/dist/css/adminlte.min.css') }}">

  {{-- For Tostar Message --}}
  <link href="{{ asset('backend/plugins/toastr/toastr.min.css') }}" rel="stylesheet"/>
  



  @livewireStyles
  <script>
    $(document).readey(function(){
      
      toaster.options = {
        "positionClass": "toast-top-right",
        "closeButton": true,
        "progressBar": true,
      }
    });
  </script>
</head>
<body class="hold-transition sidebar-mini layout-fixed">










 <!-- wrapper Start-->   
<div class="wrapper">
   
  <!-- Navbar Start-->
  @include('layouts.partials.nav')
  <!-- /.navbar End-->

  <!-- Main Sidebar Container Start-->
  @include('layouts.partials.aside')
  <!-- Main Sidebar Container End-->

  {{-- Dynamic Content Start--}}
  <div class="content-wrapper">
      {{ $slot }}
  </div>
  {{-- Dynamic Content End--}}

</div>
<!-- wrapper End-->













<!-- jQuery -->
<script src="{{ asset('backend/plugins/jquery/jquery.min.js') }}"></script>

<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('backend/plugins/jquery-ui/jquery-ui.min.js') }}"></script>

<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>

<!-- Bootstrap 4 -->
<script src="{{ asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- daterangepicker -->
<script src="{{ asset('backend/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('backend/plugins/daterangepicker/daterangepicker.js') }}"></script>

<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('backend/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>

<!-- AdminLTE App -->
<script src="{{ asset('backend/dist/js/adminlte.js') }}"></script>

<!-- AdminLTE for demo purposes -->
<script src="{{ asset('backend/dist/js/demo.js') }}"></script>

{{-- For Tostar Message --}}
<script src="{{ asset('/pluginsbackend/plugins/toastr/toastr.min.js') }}"></script>
 {{-- Html ZEditor Form --}}
<script src="https://cdn.ckeditor.com/ckeditor5/29.2.0/classic/ckeditor.js"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@stack('js')

@livewireScripts
</body>
</html>
