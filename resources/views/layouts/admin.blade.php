<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Dashboard</title>

  <!-- Font Awesome Icons -->
  <link href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" rel="stylesheet" />
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/responsive.bootstrap4.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  @stack('css')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="javascript:;" class="brand-link" style="text-align:center;font-size:25px;">
      <span class="brand-text font-weight-light"><b>LARACRM</b></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <!-- <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div> -->
        <div class="info">
          <a href="javascript:;" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
         @hasrole('Admin')
         <li class="nav-item">
          <a href="/admin/dashboard" class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
               <i class="fas fa-tachometer-alt"></i>
               <p>
                  Dashboard
               </p>
             </a>
           </li>
           <li class="nav-item">
           <a href="{{ route('admin.categories.index') }}" class="nav-link {{ request()->is('admin/categories') || request()->is('admin/categories/*') ? 'active' : '' }}">
              <i class="fas fa-list"></i>
              <p>
                 Κατηγορίες
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.companies.index') }}" class="nav-link {{ request()->is('admin/companies') || request()->is('admin/companies/*') ? 'active' : '' }}">
              <i class="fas fa-building"></i>
              <p>
                 Εταιρείες
              </p>
            </a>
          </li>
           <li class="nav-item">
            <a href="{{ route('admin.employees.index') }}" class="nav-link {{ request()->is('admin/employees') || request()->is('admin/employees/*') ? 'active' : '' }}">
              <i class="fas fa-users"></i>
              <p>
                 Εργαζόμενοι
              </p>
            </a>
          </li>

        @endhasrole

        @hasrole('Moderator')
        <li class="nav-item">
          <a href="/moderator/dashboard" class="nav-link {{ request()->is('moderator/dashboard') ? 'active' : '' }}">
               <i class="fas fa-tachometer-alt"></i>
               <p>
                  Dashboard
               </p>
             </a>
           </li>
          <li class="nav-item">
            <a href="{{ route('moderator.companies.index') }}" class="nav-link {{ request()->is('moderator/companies') || request()->is('moderator/companies/*') ? 'active' : '' }}">
              <i class="fas fa-building"></i>
              <p>
                 Εταιρείες
              </p>
            </a>
          </li>
           <li class="nav-item">
            <a href="{{ route('moderator.employees.index') }}" class="nav-link {{ request()->is('moderator/speakers') || request()->is('moderator/speakers/*') ? 'active' : '' }}">
              <i class="fas fa-users"></i>
              <p>
                 Εργαζόμενοι
              </p>
            </a>
          </li>
         @endhasrole

          <li class="nav-item">
              <a href="{{ route('logout') }}" class="nav-link"
              onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <i class="fas fa-fw fa-sign-out-alt"></i>
              <p>      
              Log Out
              </p>
           </a>
           <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
          </form>
        </li>
         
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <div class="content-wrapper" style="min-height: 917px;">
      <!-- Main content -->
      <section class="content" style="padding-top: 20px">
          @include('partials.alerts')
          @yield('content')
      </section>
      <!-- /.content -->
  </div>



  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2020.</strong> All rights reserved.
  </footer>

</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ asset('js/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<!-- DataTables -->
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('js/responsive.bootstrap4.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('js/demo.js') }}"></script>
<!-- Sweet Alert -->
<script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>  


<script>
  $(function () {
    $("#example").DataTable({
      "responsive": true,
      "autoWidth": false,
      "pageLength": 25
    });
  });
</script>

@stack('js')

</body>
</html>
