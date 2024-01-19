<!DOCTYPE html>
<html lang="en">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=0.6">

    <link rel="shortcut icon" href="/assets/img/icons/@yield('icono')" type="image/x-icon">


    <title>{{ auth()->user()->nombre . ' ' . auth()->user()->apellido }}</title>

    <!-- Bootstrap -->


    <link href="/assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="/assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <!--link href="/assets/vendors/nprogress/nprogress.css" rel="stylesheet"-->

    <!-- iCheck -->
    <link href="/assets/vendors/iCheck/skins/flat/green.css" rel="stylesheet">

    <!-- bootstrap-progressbar -->
    <!--link href="/assets/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet"-->
    <!-- JQVMap -->
    <link href="/assets/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <link href="/assets/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet" />
    <!-- bootstrap-daterangepicker -->
    <link href="/assets/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="/assets/css/custom.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/assets/dataTable/dataTables.css" />
    <link href="/assets/vendors/pnotify/dist/pnotify.css" rel="stylesheet">
    <link href="/assets/vendors/pnotify/dist/pnotify.buttons.css" rel="stylesheet">
    <link href="/assets/vendors/pnotify/dist/pnotify.nonblock.css" rel="stylesheet">
    <script src="/assets/vendors/jquery/dist/jquery.min.js" type="text/javascript"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" rel="stylesheet">


    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        //cargando
        //window.onload = function () { $("#contenedor").fadeOut(); $('body').removeClass('hiiden_page'); }
    </script>
    <style>
        .mensjae-bien {
            width: 50%;
            margin-left: 50%;
        }

        .mensjae-mal {
            width: 50%;
            margin-left: 50%;
        }

        .ui-pnotify.ui-pnotify-fade-normal.ui-pnotify.ui-pnotify-move {
            opacity: 0 !important;
        }

                /* Estilos para pantallas grandes */
@media (min-width: 1200px) {
    /* Estilos específicos para pantallas grandes */
}

/* Estilos para pantallas medianas */
@media (max-width: 1199px) and (min-width: 768px) {
    /* Estilos específicos para pantallas medianas */
}

/* Estilos para pantallas pequeñas */
@media (max-width: 767px) {
    /* Estilos específicos para pantallas pequeñas */
} 
        #contenedor {
            width: auto;
            height: 100pc
        }

        .hiiden_page {
            overflow: hidden;
        }

        .loader,
        .loader:before,
        .loader:after {
            background: #09F;
            -webkit-animation: load1 1s infinite ease-in-out;
            animation: load1 1s infinite ease-in-out;
            width: 1em;
            height: 4em;
        }

        .loader:before,
        .loader:after {
            position: absolute;
            top: 0;
            content: '';
        }

        .loader:before {
            left: -1.5em;
        }

        .loader {
            text-indent: -9999em;
            margin: 10% auto;
            position: relative;
            font-size: 11px;
            -webkit-animation-delay: 0.16s;
            animation-delay: 0.16s;
        }

        .loader:after {
            left: 1.5em;
            -webkit-animation-delay: 0.32s;
            animation-delay: 0.32s;
        }

        @-webkit-keyframes load1 {

            0%,
            80%,
            100% {
                box-shadow: 0 0 #FFF;
                height: 4em;
            }

            40% {
                box-shadow: 0 -2em #09F;
                height: 5em;
            }
        }

        @keyframes load1 {

            0%,
            80%,
            100% {
                box-shadow: 0 0 #09F;
                height: 4em;
            }

            40% {
                box-shadow: 0 -2em #09F;
                height: 5em;
            }
        }

        table thead th,
        table tbody td,
        table tbody td label {
            font-size: 12px !important;
        }

        table tbody td a,
        table tbody th a,
        table tbody td button,
        table tbody td div {
            font-size: 12px !important;
        }
    </style>

</head>

<!--body class="nav-md hiiden_page">
    <div id="contenedor"><div class="loader" id="loader">Loading...</div></div-->

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col" style="background: #0d6350;">
                <div class="left_col scroll-view" style="background: #0d6350;">
                    <div class="navbar nav_title" style="border: 0; background:#0d6350; ">
                        <a href="/" class="site_title">
                            <img src="" alt="">
                            <span><small>CBA - ATACAMES</small></span>
                        </a>
                    </div>
                    <div class="clearfix"></div>

                    <!-- menu profile quick info -->
                    <div class="profile clearfix">
                        <div class="profile_pic">

                            @if (empty(auth()->user()->foto))
                            @if (auth()->user()->sexo == 'M')
                            @php $icono = "invitado.jpg"; @endphp
                            @else
                            @php $icono = "bombero.png"; @endphp
                            @endif
                            @else
                            @php $icono = auth()->user()->foto; @endphp
                            @endif

                            <img src="/assets/img/users/{{ $icono }}" alt="{{ auth()->user()->nombre }}" style="padding: 0!important" class="img-circle profile_img">
                        </div>
                        <div class="profile_info">
                            <span>{{ auth()->user()->role->role }},</span>
                            <h2>{{ auth()->user()->nombre . ' ' . auth()->user()->apellido }}</h2>
                        </div>
                    </div>
                    <!-- /menu profile quick info -->
                    <br />

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                        <div class="menu_section">
                            <h3>Men&uacute;</h3>
                            <ul class="nav side-menu">
                                @if (auth()->user()->hasRoles([1]))
                                <li>
                                    <a href="/"><i class="fa fa-home"></i> Inicio </a>
                                </li>
                                @endif
                                <li>
                                    <a href="/profile"><i class="fa fa-user"></i> Perfil </a>
                                </li>

                                @if (auth()->user()->hasRoles([1, 4]))
                                <li>
                                    <a href="/clients"><i class="fa fa-file-text"></i> Emitir Formulario</a>
                                <li>

                                <li><a href="/report-date-inspecciones" > <i class="fa fa-file-pdf-o"></i>
                                                REPORTE INSPECCIONES POR FECHA </a></li>
                               
                               
                                @endif

                                @if (auth()->user()->hasRoles([7, 8]))
                                <li>
                                    <a href="/inspecciones"><i class="fa fa-fire-extinguisher"></i> Inspecciones</a>
                                </li>
                                @endif

                                @if (auth()->user()->hasRoles([3]))
                                <li>
                                    <a href="/clients"><i class="fa fa-file-text"></i>Formularios</a>
                                </li>
                                @endif


                                @if (auth()->user()->hasRoles([5]))
                                <li><a><i class="fa fa-usd"></i> Descuentos <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="/payments"> Descuentos</a></li>
                                        <li><a href="/history-payments"> Historial Descuentos</a></li>
                                    </ul>
                                </li>
                                @endif

                                @if (auth()->user()->hasRoles([3]))


                                <li><a><i class="fa fa-building"></i> Permisos <span
                                                class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu">
                                        <li><a href="/payments"> Pagos Permisos</a></li>
                                        <li><a href="/different-payments"> Otros Cobros</a></li>
                                        <li><a href="/history-payments"> Historial Pagos</a></li>
                                        <li><a href="/permisos"> Imprimir Permisos Establecimientos</a></li>
                                        <li><a href="/especies"> Especies</a></li>


                                        </ul>
                                    </li>

                                    <li><a><i class="fa fa-calendar"></i> Ordenanzas <span
                                                class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu">
                                            <li><a href="/cobro-ordenanza">Formulario Ordenanzas</a></li>
                                            <li><a href="/payments-ordenanzas"> Pagos Ordenanzas</a></li>
                                            <li><a href="/permisos-ordenanza"> Imprimir Permisos Ordenanzas</a></li>
                                            <li><a href="/history-ordenanzas"> Historial Ordenanzas</a></li>

                                        </ul>
                                    </li>

    
                                <li>
                                    <a href="/client"><i class="fa fa-group"></i>Clientes</a>
                                </li>

                               

                                 <li><a><i class="fa fa-bar-chart"></i> Reportes <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                    <li><a href="/reporte1" target="_blank"> <i class="fa fa-file-pdf-o"></i> REPORTE DIARIO</a></li>




                                    <li><a href="/report-date" > <i class="fa fa-file-pdf-o"></i> REPORTE POR FECHAS</a></li>
                                    
                                    <li><a href="/reporte4" target="_blank"> <i class="fa fa-file-pdf-o"></i>  NO EMITIDOS</a></li>
                                    <li><a href="/report-date-especies" target=""> <i class="fa fa-file-pdf-o"></i> REPORTE ESPECIES EXONERACIÓN</a></li>
                                    <li><a href="/report-date-emitidas" target=""> <i class="fa fa-file-pdf-o"></i> REPORTE ESPECIES EMITIDAS</a></li>
                                    <li><a href="/report-date-titulos" target=""> <i class="fa fa-file-pdf-o"></i> REPORTE TITULOS</a></li>

                                     
                                   <!--     <li><a href="/reporteParroquias" target="_blank">Clientes Por Parroquias 
                                            </a></li> -->
                                    </ul>
                                </li>
                                @endif


                                @if (auth()->user()->hasRoles([5]))
                                <li>
                                    <a href="/reporte-general"><i class="fa fa-file"></i> Reportes </a>
                                </li>
                                @endif


                                @if (auth()->user()->hasRoles([1, 5]))
                                <li><a><i class="fa fa-key"></i> Empleados <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="/users">Cuentas</a></li>
                                        @if (auth()->user()->hasRoles([1]))
                                        <li><a href="/rols">Roles</a></li>
                                        @endif

                                    </ul>
                                </li>
                                @endif



                                @if (auth()->user()->hasRoles([1]))
                                <li>
                                    <a href="/config"><i class="fa fa-cogs"></i> Sistema </a>
                                </li>
                                @endif

                                @if (auth()->user()->hasRoles([6]))
                                <li>
                                    <a href="/home"><i class="fa fa-bar-chart"></i> Dashboard </a>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </div>

                    <!-- /sidebar menu -->

                    <!-- /menu footer buttons -->
                    <div class="sidebar-footer hidden-small"></div>
                    <!-- /menu footer buttons -->
                </div>
            </div>

            <!-- top navigation -->
            <div class="top_nav">
                <div class="nav_menu">
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>
                    <nav class="nav navbar-nav">
                        <ul class=" navbar-right">
                            <li class="nav-item dropdown open" style="padding-left: 15px;">
                                <a href="javascript:" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                                    <img src="/assets/img/users/{{ $icono }}" alt="{{ auth()->user()->nombre }}">
                                </a>
                                <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="/profile"> Perfil</a>
                                    <a class="dropdown-item" href="/logout"><i class="fa fa-sign-out pull-right"></i>
                                        Salir</a>
                                </div>
                            </li>

                            <!--
                <li role="presentation" class="nav-item dropdown open">
                  <a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope-o"></i>
                    <span class="badge bg-green">1</span>
                  </a>
                  <ul class="dropdown-menu list-unstyled msg_list" role="menu" aria-labelledby="navbarDropdown1">
                    <li class="nav-item">
                      <a class="dropdown-item">
                        <span class="image"><img src="/assets/img/users/{{ $icono }}" alt="Profile Image" /></span>
                        <span>
                          <span>Administrador</span>
                          <span class="time">3 min</span>
                        </span>
                        <span class="message">
                          Hola como estas...
                        </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <div class="text-center">
                        <a class="dropdown-item">
                          <strong>Ver todos los mensajes</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                      </div>
                    </li>
                  </ul>
                </li>
                  -->
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- /top navigation -->



            @yield('pagecontent')

            <!-- footer content -->
            <footer>
                <div class="pull-right">
                    © {{ now()->year }} Todos los derechos reservados <a href="#">T&eacute;rminos y Condiciones</a>
                </div>
                <div class="clearfix"></div>
            </footer>
            <!-- /footer content -->
        </div>
    </div>
    </div>
    </div>

    <!-- jQuery -->
    <!-- Bootstrap -->
    <script src="/assets/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FastClick -->
    <script src="/assets/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <!--script src="/assets/vendors/nprogress/nprogress.js"></script-->
    <!-- Chart.js -->
    <script src="/assets/vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="/assets/vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <!--script src="/assets/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script-->
    <!-- iCheck -->
    <script src="/assets/vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="/assets/vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="/assets/vendors/Flot/jquery.flot.js"></script>
    <script src="/assets/vendors/Flot/jquery.flot.pie.js"></script>
    <script src="/assets/vendors/Flot/jquery.flot.time.js"></script>
    <script src="/assets/vendors/Flot/jquery.flot.stack.js"></script>
    <script src="/assets/vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="/assets/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="/assets/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="/assets/vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="/assets/vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="/assets/vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="/assets/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="/assets/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="/assets/vendors/moment/min/moment.min.js"></script>
    <script src="/assets/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- jQuery Smart Wizard -->
    <script src="/assets/vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js"></script>
    <!-- Custom Theme Scripts -->

    <script src="/assets/vendors/moment/min/moment.min.js"></script>
    <script src="/assets/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>


    <script src="/assets/js/custom.min.js"></script>
    <script type="text/javascript" src="/assets/dataTable/datatables.min.js"></script>

    <script type="text/javascript" src="/assets/dataTable/dis/js/jquery.dataTables.min.js"></script>


    <script src="/assets/vendors/pnotify/dist/pnotify.js"></script>
    <script src="/assets/vendors/pnotify/dist/pnotify.buttons.js"></script>
    <script src="/assets/vendors/pnotify/dist/pnotify.nonblock.js"></script>
    <script src="/assets/animaciones.js"></script>
    @yield('scrpts-jqrey')

</body>

</html>