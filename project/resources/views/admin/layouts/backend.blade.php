<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

  <meta charset="utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title')</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://6597-2-132-47-181.ngrok-free.app/admin/plugins/fontawesome-free/css/all.min.css">


  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

  <!-- Font Awesome Icons -->

  <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">

  <!-- IonIcons -->

  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

  <!-- Theme style -->

  <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">

  <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">

  <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

  <!-- Theme style -->



  <link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css') }}">



   <!-- summernote -->

  <link rel="stylesheet" href="{{ asset('admin/plugins/summernote/summernote-bs4.min.css') }}">

  <!-- CodeMirror -->

  <link rel="stylesheet" href="{{ asset('admin/plugins/codemirror/codemirror.css') }}">

  <link rel="stylesheet" href="{{ asset('admin/plugins/codemirror/theme/monokai.css') }}">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <!-- SimpleMDE -->

  {{-- <link rel="stylesheet" href="{{ asset('admin/plugins/simplemde/simplemde.min.css') }}"> --}}



  <link rel="stylesheet" href="{{asset('admin/css/style.css')}}">

</head>

<!--

`body` tag options:



  Apply one or more of the following classes to to the body tag

  to get the desired effect



  * sidebar-collapse

  * sidebar-mini

-->

<body class="hold-transition sidebar-mini">

  <div class="wrapper">

	 <!-- Navbar -->

	  <nav class="main-header navbar navbar-expand navbar-white navbar-light admin-dashboard-top ">

		<!-- Left navbar links -->

		<ul class="navbar-nav">

		  <li class="nav-item">

			<a class="nav-link" data-widget="pushmenu" id="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>

		  </li>

		  <li class="nav-item d-none d-sm-inline-block">

			<a href="{{ url('/') }}" class="nav-link">View Site</a>

		  </li>

		  <!-- <li class="nav-item d-none d-sm-inline-block">

			<a href="{{ url('/admin/dashboard') }}" class="nav-link">Contact</a>

		  </li> -->

		</ul>



		<!-- Right navbar links -->

		<ul class="navbar-nav ml-auto">
 

		  <!-- Notifications Dropdown Menu -->

		  <li class="nav-item dropdown">

			<a class="nav-link" data-toggle="dropdown" href="#">

			  <i class="fas fa-user"></i> {{ Auth::user()->name }}

			  <!--<span class="badge badge-warning navbar-badge">{{ Auth::user()->name }}</span>-->

			</a>

			<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

			  <span class="dropdown-item dropdown-header">Administrator</span>

			  <div class="dropdown-divider"></div>

			  <a href="{{ url('admin/profile') }}" class="dropdown-item">

				<i class="fas fa-user"></i>  My Proперfile

				<!--<span class="float-right text-muted text-sm">3 mins</span>-->

			  </a>

			  <div class="dropdown-divider"></div>

			  <a href="{{ url('admin/logout') }}" class="dropdown-item"   onclick="event.preventDefault();document.getElementById('logout-form').submit();">

				<i class="fas fa-user"></i>  Logout

				<!--<span class="float-right text-muted text-sm">3 mins</span>-->

			  </a>

			  <form id="logout-form" action="{{ url('/logout') }}" method="POST" class="d-none">

				@csrf

			  </form>

			</div>

		  </li>

		  <li class="nav-item">

			<a class="nav-link" data-widget="fullscreen" href="#" role="button">

			  <i class="fas fa-expand-arrows-alt"></i>

			</a>

		  </li>

		  <!--<li class="nav-item">

			<a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">

			  <i class="fas fa-th-large"></i>

			</a>

		  </li>-->

		</ul>

	  </nav>

	  <!-- /.navbar -->



      <!-- Main Sidebar Container -->

 @include('admin.layouts.sidebar')

   @yield('content')

<!-- Control Sidebar -->

  <aside class="control-sidebar control-sidebar-dark">

    <!-- Control sidebar content goes here -->

  </aside>

  <!-- /.control-sidebar -->



  <!-- Main Footer -->

  <footer class="main-footer">

    <strong>Copyright &copy; 2024-2025 <a href="https://dipanshutech.com/">Dipanshutech</a>.</strong>

    All rights reserved.

    <div class="float-right d-none d-sm-inline-block">

      <!--<b>Version</b> 3.2.0-->

    </div>

  </footer>

</div>

<!-- ./wrapper -->



<!-- REQUIRED SCRIPTS -->



<!-- jQuery -->

<script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>

<!-- Bootstrap -->

<script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- AdminLTE -->

<script src="{{ asset('admin/build/js/AdminLTE.js') }}"></script>



<!-- OPTIONAL SCRIPTS -->

<script src="{{ asset('admin/plugins/chart.js/Chart.min.js') }}"></script>

<!-- AdminLTE for demo purposes -->

{{-- <script src="{{ asset('admin/dist/js/demo.js') }}"></script> --}}

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->

<script src="{{ asset('admin/dist/js/pages/dashboard3.js') }}"></script>



<!-- DataTables  & Plugins -->

<script src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>

<script src="{{ asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

<script src="{{ asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>

<script src="{{ asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

<script src="{{ asset('admin/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>

<script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>

<script src="{{ asset('admin/plugins/jszip/jszip.min.js') }}"></script>

<script src="{{ asset('admin/plugins/pdfmake/pdfmake.min.js') }}"></script>

<script src="{{ asset('admin/plugins/pdfmake/vfs_fonts.js') }}"></script>
 
<script src="{{ asset('admin/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>

<script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>

<script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

<!-- AdminLTE App -->

{{-- <script src="{{ asset('admin/build/js/adminlte.min.js') }}"></script> --}}

<!-- AdminLTE for demo purposes -->

{{-- <script src="{{ asset('admin/dist/js/demo.js') }}"></script> --}}

<!-- Page specific script -->



<!-- Summernote -->

<script src="{{ asset('admin/plugins/summernote/summernote-bs4.min.js') }}"></script>

<!-- CodeMirror -->

<script src="{{ asset('admin/plugins/codemirror/codemirror.js') }}"></script>

<script src="{{ asset('admin/plugins/codemirror/mode/css/css.js') }}"></script>

<script src="{{ asset('admin/plugins/codemirror/mode/xml/xml.js') }}"></script>

<script src="{{ asset('admin/plugins/codemirror/mode/htmlmixed/htmlmixed.js') }}"></script>



<script src="{{ asset('admin/js/admin.js') }}"></script>





<script>

  $(function () {

    $("#example1").DataTable({

      "responsive": true, "lengthChange": false, "autoWidth": false,

      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]

    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    $('#example2').DataTable({

      "paging": true,

      "lengthChange": false,

      "searching": false,

      "ordering": true,

      "info": true,

      "autoWidth": false,

      "responsive": true,

    });

  });

</script>



<script>

  $(function () {

    // Summernote

    $('#summernote').summernote()

    // CodeMirror

    CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {

      mode: "htmlmixed",

      theme: "monokai"

    });

  })
  $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    })
    $(".alert").fadeTo(2000, 500).slideUp(500, function(){
    $(".alert").slideUp(500);
});
</script>

</body>

</html>

