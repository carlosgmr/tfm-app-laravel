<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <title>{{ env('APP_NAME') }} | @yield('title')</title>

        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="/bower_components/bootstrap/dist/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="/bower_components/font-awesome/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="/bower_components/Ionicons/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="/dist/css/AdminLTE.min.css">
        <!-- AdminLTE Skins -->
        <link rel="stylesheet" href="/dist/css/skins/skin-blue.min.css">

        <!-- Morris chart -->
        <!-- <link rel="stylesheet" href="bower_components/morris.js/morris.css"> -->
        <!-- jvectormap -->
        <!-- <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css"> -->
        <!-- Date Picker -->
        <!-- <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css"> -->
        <!-- Daterange picker -->
        <!-- <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css"> -->
        <!-- bootstrap wysihtml5 - text editor -->
        <!-- <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css"> -->

        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <header class="main-header">
                <!-- Logo -->
                <a href="{{ route('administrator.home') }}" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>App</b></span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b>{{ env('APP_NAME_1') }}</b>{{ env('APP_NAME_2') }}</span>
                </a>

                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>

                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <!-- User Account: style can be found in dropdown.less -->
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="/dist/img/avatar.png" class="user-image" alt="User Image">
                                    <span class="hidden-xs">NAME</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <img src="/dist/img/avatar.png" class="img-circle" alt="User Image">
                                        <p>
                                            NAME
                                            <small>Registrado el CREATED_AT</small>
                                        </p>
                                    </li>
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="#" class="btn btn-default btn-flat">Perfil</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="#" class="btn btn-default btn-flat">Cerrar sesión</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>

            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu" data-widget="tree">
                        <li><a href="{{ route('administrator.administrator.listing') }}"><i class="fa fa-circle-o"></i> <span>Administradores</span></a></li>
                        <li><a href="{{ route('administrator.instructor.listing') }}"><i class="fa fa-circle-o"></i> <span>Instructores</span></a></li>
                        <li><a href="{{ route('administrator.user.listing') }}"><i class="fa fa-circle-o"></i> <span>Usuarios</span></a></li>
                        <li><a href="{{ route('administrator.group.listing') }}"><i class="fa fa-circle-o"></i> <span>Grupos</span></a></li>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>@yield('title')</h1>
                    <ol class="breadcrumb"></ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    @yield('content')
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    <b>Version</b> {{ env('APP_VERSION') }}
                </div>
                <strong>Copyright &copy; {{ date('Y') }} <a href="{{ env('APP_COPYRIGHT_URL') }}">{{ env('APP_COPYRIGHT') }}</a>.</strong>
            </footer>
        </div>
        <!-- ./wrapper -->

        <!-- jQuery 3 -->
        <script src="/bower_components/jquery/dist/jquery.min.js"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="/bower_components/jquery-ui/jquery-ui.min.js"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge('uibutton', $.ui.button);
        </script>
        <!-- Bootstrap 3.3.7 -->
        <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- Morris.js charts -->
        <!-- <script src="bower_components/raphael/raphael.min.js"></script> -->
        <!-- <script src="bower_components/morris.js/morris.min.js"></script> -->
        <!-- Sparkline -->
        <!-- <script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script> -->
        <!-- jvectormap -->
        <!-- <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script> -->
        <!-- <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script> -->
        <!-- jQuery Knob Chart -->
        <!-- <script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script> -->
        <!-- daterangepicker -->
        <!-- <script src="bower_components/moment/min/moment.min.js"></script> -->
        <!-- <script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script> -->
        <!-- datepicker -->
        <!-- <script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script> -->
        <!-- Bootstrap WYSIHTML5 -->
        <!-- <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script> -->
        <!-- Slimscroll -->
        <!-- <script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script> -->
        <!-- FastClick -->
        <!-- <script src="bower_components/fastclick/lib/fastclick.js"></script> -->
        <!-- AdminLTE App -->
        <script src="dist/js/adminlte.min.js"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <!-- <script src="dist/js/pages/dashboard.js"></script> -->
        <!-- AdminLTE for demo purposes -->
        <!-- <script src="dist/js/demo.js"></script> -->
    </body>
</html>