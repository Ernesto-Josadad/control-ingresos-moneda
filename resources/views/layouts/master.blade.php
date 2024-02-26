<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <title>@yield('titulo')</title>
  @yield('css')

  <!-- Google Font: Source Sans Pro -->
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('css/adminlte.min.css')}}">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper" style="background: #FDEBCD;">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-light" style="background: #08483A;">
    <!-- Logo -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="btn btn-outline-light" class="nav-link" data-widget="pushmenu"><i class="fas fa-bars" aria-hidden="true"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <img src="{{asset('dist/img/logoescuela.png')}}" width="200">
      </li>
    </ul>

    <!-- Cerrar sesion -->
    <ul class="navbar-nav ml-auto">
    <div class="btn" style="color:black; background:#FAEBD7; border-radius: 100%;">
      <i class="fa fa-sign-out fa-2=x" aria-hidden="true"></i>
    </div>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Contenedor de barra lateral -->
  <aside class="main-sidebar" style="background: #08483A">
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Menu barralatera -->
      <nav class="mt-2">
        <div style="font-weight: bold; font-size:20px;">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <li class="nav-item" style="margin-bottom: 20%; margin-top:30%">
            <a href="panel_control" class="nav-link">
            <span class='icon-field'><i class="fa fa-th" style="color: #ffffff;"></i></span>
              <p style="color:white;">
                Panel de control
              </p>
            </a>
          </li>
          <li class="nav-item" style="margin-bottom: 20%;">
            <a href="#" class="nav-link">
            <span class='icon-field'><i class="fa fa-user-plus" style="color: #ffffff;"></i></span>
              <p style="color:white;">
                Alumnos
              </p>
            </a>
          </li>
          <li class="nav-item" style="margin-bottom: 20%;">
            <a href="recibo" class="nav-link">
            <span class='icon-field'><i class="fa fa-clipboard" style="color: #ffffff;"></i></span>
              <p style="color:white;">
                Recibo alumnos
              </p>
            </a>
          </li>
          <li class="nav-item" style="margin-bottom: 20%;">
            <a href="#" class="nav-link">
            <span class='icon-field'><i class="fa fa-users" style="color: #ffffff;"></i></span>
              <p style="color:white;">
                Grupos
              </p>
            </a>
          </li>
          <li class="nav-item" style="margin-bottom: 20%;">
            <a href="#" class="nav-link">
            <span class='icon-field'><i class="fa fa-usd" aria-hidden="true" style="color: #ffffff;"></i></span>
              <p style="color:white;">
                Ingresos
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="background: #FFEBCD;">

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid" >
        @yield('contenido')
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer" style="background: #08483A; color:blanchedalmond"; font-weight:bold; font-size:30pts;>

    <!-- Default to the left -->
    <center>
     Derechos reservados
    </center>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

@stack('scripts')

<!-- jQuery -->
<script src="{{asset('js/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="js/bootstrap.bundle.min.js"></script>
<script src="{{asset('https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js')}}" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<!-- AdminLTE App -->
<script src="{{asset('js/adminlte.min.js')}}"></script>
<script src="{{asset('https://kit.fontawesome.com/92a43fffe7.js')}}" crossorigin="anonymous"></script>
<script src="{{asset('https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js')}}"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybBud7TlRbs/ic4AwGcFZOxg5DpPt8EgeUIgIwzjWfXQKWA3" crossorigin="anonymous"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgr -->

</body>
</html>
