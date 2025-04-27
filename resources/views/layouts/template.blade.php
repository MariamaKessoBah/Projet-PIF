<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name') }} | @yield('title')</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">

  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">

  <!-- Toastr -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/toastr/toastr.min.css') }}">

  <!-- Dropzone -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/dropzone/min/dropzone.min.css') }}">

  <!-- DateTimePicker -->
  <link rel="stylesheet" href="{{ asset('assets/dist/css/jquery.datetimepicker.min.css') }}">

  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">

  <!-- Bootstrap4 Toggle -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap4-toggle/css/bootstrap4-toggle.min.css') }}">

  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/dist/css/styles.css') }}">

  <!-- External Libraries -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<!-- Inclure Bootstrap JS (le fichier JS doit être après l'inclusion de jQuery) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.min.js"></script>
<!-- jQuery et Bootstrap JS (obligatoire pour éviter l'erreur $ is not defined) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>


{{-- <!-- Fichiers CSS et JS de Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js"></script> --}}


  <!-- Custom Styles -->
  <style>
    .btn-active {
      background-color: #007bff !important;
      color: white !important;
    }

    .main-content {
      margin-top: 60px;
      margin-bottom: 60px;
    }

    .nav-link.active {
      background-color: #007bff;
      color: white;
    }

    .nav-treeview .nav-link.active {
      background-color: white;
      color: #007bff;
    }

    .nav-treeview .nav-link.active p {
      color: #007bff;
    }

    .custom-alert-success {
      background-color: #d4edda;
      color: #155724;
      border: 1px solid #c3e6cb;
    }

    .custom-alert-danger {
      background-color: #f8d7da;
      color: #721c24;
      border: 1px solid #f5c6cb;
    }

    .toast {
      position: fixed;
      top: 20px;
      right: 20px;
      z-index: 1050;
      min-width: 200px;
    }
  </style>
<!-- Dans la section graphes -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <!-- jQuery -->
  <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>
  <!-- Navbar -->
  @include('layouts.topbar')

  <!-- Sidebar -->
  @include('layouts.sidebar')

  <!-- Main Content -->
  <div class="content-wrapper main-content">
    @yield('content')

  </div>

  <!-- Footer -->

  @include('layouts.footer')
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark"></aside>

  <!-- Scripts -->
  <!-- Bootstrap 4 -->
  <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  <!-- overlayScrollbars -->
  <script src="{{ asset('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>

  <!-- AdminLTE App -->
  <script src="{{ asset('assets/dist/js/adminlte.js') }}"></script>

  <!-- Plugins -->
  <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/toastr/toastr.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/bootstrap4-toggle/js/bootstrap4-toggle.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/dropzone/min/dropzone.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
  <script src="{{ asset('assets/dist/js/jquery.datetimepicker.full.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>

  <!-- jQuery UI -->
  <script src="{{ asset('assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>

  <!-- External Scripts -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

  <!-- Page-specific Scripts -->
  <script>
    $(document).ready(function () {
      $('.select2').select2({
        placeholder: "Please select here",
        width: "100%"
      });

      bsCustomFileInput.init();

      $('.summernote').summernote({
        height: 300,
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
          ['fontname', ['fontname']],
          ['fontsize', ['fontsize']],
          ['color', ['color']],
          ['para', ['ol', 'ul', 'paragraph', 'height']],
          ['table', ['table']],
          ['view', ['undo', 'redo', 'fullscreen', 'codeview', 'help']]
        ]
      });

      $('.datetimepicker').datetimepicker({
        format: 'Y/m/d H:i'
      });

      $(".switch-toggle").bootstrapToggle();

      $('.number').on('input keyup keypress', function () {
        var val = $(this).val().replace(/[^0-9]/g, '');
        val = val > 0 ? parseFloat(val).toLocaleString("en-US") : 0;
        $(this).val(val);
      });

      var page = 'home';
      var s = '';
      if (s != '') {
        page = page + '_' + s;
      }

      if ($('.nav-link.nav-' + page).length > 0) {
        $('.nav-link.nav-' + page).addClass('active');
        if ($('.nav-link.nav-' + page).hasClass('tree-item')) {
          $('.nav-link.nav-' + page).closest('.nav-treeview').siblings('a').addClass('active');
          $('.nav-link.nav-' + page).closest('.nav-treeview').parent().addClass('menu-open');
        }
        if ($('.nav-link.nav-' + page).hasClass('nav-is-tree')) {
          $('.nav-link.nav-' + page).parent().addClass('menu-open');
        }
      }
    });

    window.start_load = function () {
      $('body').prepend('<div id="preloader2"></div>');
    };

    window.end_load = function () {
      $('#preloader2').fadeOut('fast', function () {
        $(this).remove();
      });
    };

    window.viewer_modal = function ($src = '') {
      start_load();
      var t = $src.split('.').pop();
      var view = t == 'mp4' ? $("<video src='" + $src + "' controls autoplay></video>") : $("<img src='" + $src + "' />");
      $('#viewer_modal .modal-content').empty().append(view);
      $('#viewer_modal').modal({
        show: true,
        backdrop: 'static',
        keyboard: false
      });
      end_load();
    };

    window.uni_modal = function ($title = '', $url = '', $size = "") {
      start_load();
      $.ajax({
        url: $url,
        success: function (resp) {
          if (resp) {
            $('#uni_modal .modal-title').html($title);
            $('#uni_modal .modal-body').html(resp);
            if ($size != '') {
              $('#uni_modal .modal-dialog').addClass($size);
            } else {
              $('#uni_modal .modal-dialog').removeAttr("class").addClass("modal-dialog modal-md");
            }
            $('#uni_modal').modal({
              show: true,
              backdrop: 'static',
              keyboard: false
            });
            end_load();
          }
        }
      });
    };

    window.alert_toast = function ($msg = 'TEST', $bg = 'success', $pos = '') {
      var Toast = Swal.mixin({
        toast: true,
        position: $pos || 'top-end',
        showConfirmButton: false,
        timer: 3000
      });
      Toast.fire({
        icon: $bg,
        title: $msg
      });
    };
  </script>


<!-- À la fin du body -->
<script src="{{ asset('assets/plugins/chart.js/Chart.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>

<!-- Juste avant @stack('scripts') -->
<script>
    // Configuration globale de Chart.js
    Chart.defaults.global = {
        responsive: true,
        maintainAspectRatio: false
    };
</script>

@stack('scripts')


</body>
</html>