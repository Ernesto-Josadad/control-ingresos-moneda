<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('titulo')</title>

    <!-- Google Font: Source Sans Pro -->
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper" style="background: #FF977A;">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-light" style="background: #08483A;">
            <!-- Logo -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <img src="dist/img/logoescuela.png" width="200">
                </li>

            </ul>

    <!-- Cerrar sesion -->
    <ul class="navbar-nav ml-auto">
    <a class="dropdown-item" style="background: #FF977A;"><img src="dist/img/logout.png" width="20" class="logout"><strong>   Cerrar Sesión</strong> </a>
    </ul>
  </nav>
  <!-- /.navbar -->

        <!-- Contenedor de barra lateral -->
        <aside class="main-sidebar sidebar-light-primary ">
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional)
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div>-->

                <!-- Menu barralatera -->
                <nav class="mt-2">
                    <div style="font-weight: bold; font-size:25px;">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                            data-accordion="false">
                            <li style="margin-bottom: 40%;">

                            </li>
                            <li class="nav-item" style="margin-bottom: 20%;">
                                <a href="#" class="nav-link">
                                    <span class='icon-field'><img src="dist/img/panel.png" width="40"></span>
                                    <p>
                                        Panel de control
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item" style="margin-bottom: 20%;">
                                <a href="#" class="nav-link">
                                    <span class='icon-field'><img src="dist/img/usuario.png" width="40"></span>
                                    <p>
                                        Alumnos
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item" style="margin-bottom: 20%;">
                                <a href="#" class="nav-link">
                                    <span class='icon-field'><img src="dist/img/ticket.png" width="40"></span>
                                    <p>
                                        Recibo alumnos
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item" style="margin-bottom: 20%;">
                                <a href="#" class="nav-link">
                                    <span class='icon-field'><img src="dist/img/altas.png" width="40"></span>
                                    <p>
                                        Grupos
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item" style="margin-bottom: 20%;">
                                <a href="#" class="nav-link">
                                    <span class='icon-field'><img src="dist/img/pago.png" width="40"></span>
                                    <p>
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
        <div class="content-wrapper" style="background: #FF977A;">

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    @yield('contenido')
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->


        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer" style="background: #08483A; color:blanchedalmond"; font-weight:bold;
            font-size:30pts;>

            <!-- Default to the left -->
            <center>
                Derechos reservados
            </center>
        </footer>
  <!-- Contenedor de barra lateral -->
  <aside class="main-sidebar" style="background: #08483A;">
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Menu barralatera -->
      <nav class="mt-2">
        <div style="font-weight: bold; font-size:20px;">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li style="margin-bottom: 40%;">
          </li>
          <li class="nav-item" style="margin-bottom: 20%; margin-top:30%">
            <a href="panel_control" class="nav-link">
            <span class='icon-field'><img src="dist/img/panel.png" width="40"></span>
              <p style="color:white;">
                Panel de control
              </p>
            </a>
          </li>
          <li class="nav-item" style="margin-bottom: 20%;">
            <a href="#" class="nav-link">
            <span class='icon-field'><img src="dist/img/usuario.png" width="40"></span>
              <p style="color:white;">
                Alumnos
              </p>
            </a>
          </li>
          <li class="nav-item" style="margin-bottom: 20%;">
            <a href="recibo" class="nav-link">
            <span class='icon-field'><img src="dist/img/ticket.png" width="40"></span>
              <p style="color:white;">
                Recibo alumnos
              </p>
            </a>
          </li>
          <li class="nav-item" style="margin-bottom: 20%;">
            <a href="#" class="nav-link">
            <span class='icon-field'><img src="dist/img/altas.png" width="40"></span>
              <p style="color:white;">
                Grupos
              </p>
            </a>
          </li>
          <li class="nav-item" style="margin-bottom: 20%;">
            <a href="#" class="nav-link">
            <span class='icon-field'><img src="dist/img/pago.png" width="40"></span>
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
  <div class="content-wrapper" style="background: #FF977A;">

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
<script src="js/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="js/adminlte.min.js"></script>
</body>

</html>
