<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"/>
<html>
    <head>
        <meta charset="utf-8"/>
        <meta content="IE=edge" http-equiv="X-UA-Compatible"/>
        <!-- CSRF Token -->
        <meta content="{{ csrf_token() }}" name="csrf-token"/>
        <title>
            {{ config('app.name', 'Laravel') }}
        </title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport"/>
        <!-- Bootstrap 3.3.7 -->
        <link href="assets/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"/>
        <!-- Font Awesome -->
        <link href="assets/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet"/>
        <!-- Ionicons -->
        <link href="assets/bower_components/Ionicons/css/ionicons.min.css" rel="stylesheet"/>
        <!-- Theme style -->
        <link href="assets/dist/css/AdminLTE.css" rel="stylesheet"/>
        <link href="assets/dist/css/style.css" rel="stylesheet"/>
        <!-- AdminLTE Skins. Choose a skin from the css/skins
folder instead of downloading all of them to reduce the load. -->
        <link href="assets/dist/css/skins/_all-skins.min.css" rel="stylesheet"/>

        <!-- Select2 -->
        <link href="assets/bower_components/select2/dist/css/select2.min.css" rel="stylesheet"/>
        <!-- plugin lobiPanle -->
        <link href="assets/plugins/lobipanel/css/lobipanel.css" rel="stylesheet"/>
        <!-- plugin lobiBox -->
        <link href="assets/plugins/lobibox/css/lobibox.css" rel="stylesheet"/>
        <!-- bootstrap datepicker -->
        <link href="assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
        <!--DATA TABLES -->
        <link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet"/>
        <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet"/>
        <link href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css" rel="stylesheet"/>
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css" rel="stylesheet"/>
        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic" rel="stylesheet"/>
        @section('css')
        @show
    </head>
    <body class="hold-transition skin-blue sidebar-mini fixed">
        <!-- Site wrapper -->
        <div class="wrapper">
            <header class="main-header">
                <!-- Logo -->
                <a class="logo" href="/home">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini">
                        <b>
                            F
                        </b>
                        AC
                    </span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg">
                        <b>
                            {{ config('app.name', 'Laravel') }}
                        </b>
                    </span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top">
                    <!-- Sidebar toggle button-->
                    <a class="sidebar-toggle" data-toggle="push-menu" href="#" role="button">
                        <span class="sr-only">
                            Toggle navigation
                        </span>
                        <span class="icon-bar">
                        </span>
                        <span class="icon-bar">
                        </span>
                        <span class="icon-bar">
                        </span>
                    </a>
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <!-- User Account: style can be found in dropdown.less -->
                            <li class="dropdown user user-menu">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    <img alt="User Image" class="user-image" src="assets/dist/img/user2-160x160.jpg">
                                    <span class="hidden-xs">
                                        {{Utilitarios::personaLogueado()}}
                                    </span>
                                    </img>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <img alt="User Image" class="img-circle" src="assets/dist/img/user2-160x160.jpg">
                                        <p>
                                            {{Utilitarios::personaLogueado()}}
                                            <small>
                                                {{Utilitarios::getRol()}}
                                            </small>
                                        </p>
                                        </img>
                                    </li>
                                    <!-- Menu Body -->
                                    <!-- <li class="user-body">
                                        <div class="row">
                                            <div class="col-xs-4 text-center">
                                                <a href="#">
                                                    Followers
                                                </a>
                                            </div>
                                            <div class="col-xs-4 text-center">
                                                <a href="#">
                                                    Sales
                                                </a>
                                            </div>
                                            <div class="col-xs-4 text-center">
                                                <a href="#">
                                                    Friends
                                                </a>
                                            </div>
                                        </div>-->
                                    <!-- /.row -->
                                    <!-- </li>-->
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a class="btn btn-default btn-flat" href="#">
                                                Perfil
                                            </a>
                                        </div>
                                        <div class="pull-right">
                                            <a class="btn btn-default btn-flat" href="{{ route('logout') }}">
                                                Salir
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!-- =============================================== -->
            <!-- Left side column. contains the sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img alt="User Image" class="img-circle" src="assets/dist/img/user2-160x160.jpg">
                            </img>
                        </div>
                        <div class="pull-left info">
                            <p>
                                {{Utilitarios::getRol()}}
                            </p>
                            <a href="#">
                                <i class="fa fa-circle text-success">
                                </i>
                                En Línea
                            </a>
                        </div>
                    </div>
                    <!-- search form -->
                    <!-- <form action="#" class="sidebar-form" method="get">
                        <div class="input-group">
                            <input class="form-control" name="q" placeholder="Search..." type="text">
                                <span class="input-group-btn">
                                    <button class="btn btn-flat" id="search-btn" name="search" type="submit">
                                        <i class="fa fa-search">
                                        </i>
                                    </button>
                                </span>
                            </input>
                        </div>
                    </form>-->
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu" data-widget="tree" id="opciones">
                        <li class="header">
                            MENÚ DE NAVEGACIÓN
                        </li>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>
            <!-- =============================================== -->
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                @yield('content')
                <!-- Modal BLOQUEAR PANTALLA MIENTRAS PROCESA DATOS-->
                <div class="modal fade" data-backdrop="static" data-keyboard="false" id="modalBloquear">
                    <div class="modal-dialog" style="width: 100%; height: 100%; position: fixed; display: flex; align-items: center; justify-content: center;">
                        <img src="assets/dist/img/cargando.gif">
                        </img>
                    </div>
                </div>
                <!-- /.FIN DE MODAL PROCESOMIENTO DE DATOS -->
                <!--MODAL ALERTA DE caducidad de SESSION-->
                <div class="modal fade" data-backdrop="static" data-keyboard="false" id="mpeTimeout" tabindex="-1">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div style="background-color: #448cbc; color: #ffffff; height: 20px">
                                <!--class="modal-header"--->
                                <div class="text-center">
                                    <h5>
                                        <strong>
                                            Session por Expirar..!!!
                                        </strong>
                                    </h5>
                                </div>
                            </div>
                            <div class="modal-body">
                                <div class="text-center">
                                    <p>
                                        Su Session expirará en
                                        <span id="segundos">
                                        </span>
                                        segundos.
                                        <br/>
                                        Desea reiniciar Su Session ?
                                    </p>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary pull-left btn-xs" onclick="ResetSession()" type="button">
                                    Si
                                </button>
                                <button class="btn btn-warning btn-xs" onclick="CerrarSession()" type="button">
                                    No
                                </button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                </div>
                <!-- /.Fin de alerta de caducidad -->
            </div>
            <!-- /.content-wrapper -->
            <!-- <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    <b>
                        Version
                    </b>
                    2.4.18
                </div>
                <strong>
                    Copyright © 2014-2019
                    <a href="https://adminlte.io">
                        AdminLTE
                    </a>
                    .
                </strong>
                All rights
                reserved.
            </footer>-->
        </div>
        <!-- ./wrapper -->
        <!-- jQuery 3 -->
        <script src="assets/bower_components/jquery/dist/jquery.min.js"></script>
        <script src="assets/bower_components/jquery/dist/jquery-ui.min.js"></script>
        <!-- Bootstrap 3.3.7 -->
        <script src="assets/bower_components/bootstrap/dist/js/bootstrap.min.js">
        </script>
        <!-- SlimScroll -->
        <script src="assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js">
        </script>
        <!-- FastClick -->
        <script src="assets/bower_components/fastclick/lib/fastclick.js">
        </script>
        <!-- AdminLTE App -->
        <script src="assets/dist/js/adminlte.min.js">
        </script>
        <!-- AdminLTE for demo purposes -->
        <script src="assets/dist/js/demo.js">
        </script>
        <!-- Select2 -->
        <script src="assets/bower_components/select2/dist/js/select2.full.min.js">
        </script>

        <!-- plugin lobiPanle -->
        <script src="assets/plugins/lobipanel/js/lobipanel.js">
        </script>
        <!-- plugin lobiBox -->
        <script src="assets/plugins/lobibox/js/lobibox.js">
        </script>

        <!-- bootstrap datepicker -->
        <script src="assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js">
        </script>
        <!--DATA TABLES -->
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" type="text/javascript">
        </script>
        <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js" type="text/javascript">
        </script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js" type="text/javascript">
        </script>
        <script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js" type="text/javascript">
        </script>
        <script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js">
        </script>
        <!-- propios del sistema -->
        <script src="assets/app/js/cargarOpciones.js">
        </script>
        <script src="assets/app/js/validaciones.js">
        </script>
        <script>
            $(document).ready(function () {
                $('.sidebar-menu').tree();
                imprimirOpciones("{{Request::root()}}");
                SessionExpireAlert();
            });
            //alerta de session
            //sesion expirado
            var setIntervalo = null;
            var setTimpoEjecucion = null;
            var setTimpoSalida = null;
            function SessionExpireAlert() {
                var tiempoSession = 20; //tiempo en minutos 
                var timeout = (tiempoSession * 1000 * 60);
                var seconds = timeout / 1000;
                //  console.log(seconds);
                document.getElementsByName("segundos").innerHTML = seconds;
                if (setIntervalo) {
                    clearInterval(setIntervalo);
                }

                setIntervalo = setInterval(function () {
                    seconds--;
                    //  console.log(seconds);
                    document.getElementById("segundos").innerHTML = seconds;
                }, 1000);

                if (setTimpoEjecucion) {
                    clearTimeout(setTimpoEjecucion);
                }

                setTimpoEjecucion = setTimeout(function () {
                    $('#mpeTimeout').modal('show');
                }, timeout - 30 * 1000);

                if (setTimpoSalida) {
                    clearTimeout(setTimpoSalida);
                }

                setTimpoSalida = setTimeout(function () {
                    window.location = "{{ route('logout') }}";
                }, timeout);

            }
            ;

            function ResetSession() {

                SessionExpireAlert();
                // $('#mpeTimeout').modal('toogle');
            }

            function CerrarSession() {
                window.location = "{{ route('logout') }}";
            }
        </script>
        @section('js')
        @show
    </body>
</html>