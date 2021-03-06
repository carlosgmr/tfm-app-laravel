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
                <a href="{{ urlHome() }}" class="logo">
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
                                    <span class="hidden-xs">{{ appUser('fullname') }}</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <img src="/dist/img/avatar.png" class="img-circle" alt="User Image">
                                        <p>
                                            {{ appUser('fullname') }}
                                            <small>Registrado el {{ esDatetime(appUser('created_at')) }}</small>
                                        </p>
                                    </li>
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <!--
                                        <div class="pull-left">
                                            <a href="#" class="btn btn-default btn-flat">Perfil</a>
                                        </div>
                                        -->
                                        <div class="pull-right">
                                            <a href="{{ route('logout') }}" class="btn btn-default btn-flat">Cerrar sesión</a>
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
                        @php $module = getModule() @endphp
                        @switch(appUser('role'))
                            @case('administrator')
                                <li @if ($module === 'administrator') class="active" @endif>
                                    <a href="{{ route('administrator.administrator.listing') }}">
                                        <i class="fa fa-circle-o"></i> <span>Administradores</span>
                                    </a>
                                </li>
                                <li @if ($module === 'instructor') class="active" @endif>
                                    <a href="{{ route('administrator.instructor.listing') }}">
                                        <i class="fa fa-circle-o"></i> <span>Instructores</span>
                                    </a>
                                </li>
                                <li @if ($module === 'user') class="active" @endif>
                                    <a href="{{ route('administrator.user.listing') }}">
                                        <i class="fa fa-circle-o"></i> <span>Usuarios</span>
                                    </a>
                                </li>
                                <li @if ($module === 'group') class="active" @endif>
                                    <a href="{{ route('administrator.group.listing') }}">
                                        <i class="fa fa-circle-o"></i> <span>Grupos</span>
                                    </a>
                                </li>
                            @break
                            
                            @case('instructor')
                                <li @if ($module === 'group') class="active" @endif>
                                    <a href="{{ route('instructor.group.listing') }}">
                                        <i class="fa fa-circle-o"></i> <span>Grupos</span>
                                    </a>
                                </li>
                                <li @if ($module === 'questionary') class="active" @endif>
                                    <a href="{{ route('instructor.questionary.listing') }}">
                                        <i class="fa fa-circle-o"></i> <span>Exámenes/encuestas</span>
                                    </a>
                                </li>
                            @break

                            @case('user')
                                <li @if ($module === 'group') class="active" @endif>
                                    <a href="{{ route('user.group.listing') }}">
                                        <i class="fa fa-circle-o"></i> <span>Grupos</span>
                                    </a>
                                </li>
                                <li @if ($module === 'questionary') class="active" @endif>
                                    <a href="{{ route('user.questionary.listing') }}">
                                        <i class="fa fa-circle-o"></i> <span>Exámenes/encuestas</span>
                                    </a>
                                </li>
                            @break
                        @endswitch
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!--
                <section class="content-header">
                    <h1></h1>
                    <ol class="breadcrumb"></ol>
                </section>
                -->

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box">
                                <div class="box-header with-border">
                                    <h1 class="box-title">@yield('title')</h1>

                                    <div class="box-tools pull-right">
                                        @yield('tools')
                                    </div>
                                </div>
                                <div class="box-body">
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    @if (isset($apiErrors) && count($apiErrors) > 0)
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($apiErrors as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    @if (Session::has('flashMessage') && Session::has('flashType'))
                                        <div class="alert alert-{{ Session::get('flashType') }} alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                                            {{ Session::get('flashMessage') }}
                                        </div>
                                    @endif

                                    @yield('content')
                                </div>
                                <div class="box-footer">
                                    @yield('footer')
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    <b>Version</b> {{ env('APP_VERSION') }}
                </div>
                <strong>Copyright &copy; {{ date('Y') }} <a href="{{ env('APP_COPYRIGHT_URL') }}" target="_blank">{{ env('APP_COPYRIGHT') }}</a>.</strong>
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
        <script src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
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
        <script src="/dist/js/adminlte.min.js"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <!-- <script src="dist/js/pages/dashboard.js"></script> -->
        <!-- AdminLTE for demo purposes -->
        <!-- <script src="dist/js/demo.js"></script> -->
        @yield('script')
    </body>
</html>