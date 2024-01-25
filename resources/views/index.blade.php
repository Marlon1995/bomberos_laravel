@extends('layout')

@section('title', ucwords($data[0]->nombre))
@section('icono', $data[0]->icono )

@section('pagecontent')


                      
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">



<link href="assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">

<link href="assets/vendors/nprogress/nprogress.css" rel="stylesheet">

<link href="assets/vendors/iCheck/skins/flat/green.css" rel="stylesheet">

<link href="assets/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">

<link href="assets/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet" />

<link href="assets/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

<link href="assets/build/css/custom.min.css" rel="stylesheet">
</head>
<div class="right_col" role="main" style="min-height: 1121px;">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">


                    @if( auth()->user()->hasRoles([6,1]))










<div class="row" style="display: inline-block;">
<div class="tile_count">
<div class="col-md-3 col-sm-4  tile_stats_count">
<span class="count_top"><i class="fa fa-user"></i> Usuarios Totales</span>
<div class="count">15</div>

</div>
<div class="col-md-3 col-sm-4  tile_stats_count">
<span class="count_top"><i class="fa fa-user"></i> Mujeres</span>
<div class="count green">7</div>

</div>
<div class="col-md-3 col-sm-4  tile_stats_count">
<span class="count_top"><i class="fa fa-user"></i> Hombres</span>
<div class="count">8</div>

</div>
<div class="col-md-3 col-sm-4  tile_stats_count">
<span class="count_top"><i class="fa fa-user"></i> Total Locales</span>
<div class="count">15</div>

</div>

</div>
</div>

<div class="row">
<div class="col-md-12 col-sm-12 ">
<div class="dashboard_graph">
<div class="row x_title">
<div class="col-md-6">
<h3 allign="center">Estadisticas Individuales</h3>
</div>

</div>
<div class="col-md-9 col-sm-9 ">
<div id="chart_plot_01" class="demo-placeholder"></div>
</div>
<div class="col-md-3 col-sm-3  bg-white">
<div class="x_title">
<h2></h2>
<div class="clearfix"></div>
</div>
<div class="col-md-12 col-sm-12 ">
<div>
<p>Permisos Emitidos</p>
<div class="">
<div class="progress progress_sm" style="width: 76%;">
<div class="progress-bar bg-green" role="progressbar" data-transitiongoal="80"></div>
</div>
</div>
</div>
<div>
<p>Permisos Cancelados</p>
<div class="">
<div class="progress progress_sm" style="width: 76%;">
<div class="progress-bar bg-green" role="progressbar" data-transitiongoal="60"></div>
</div>
</div>
</div>
</div>
<div class="col-md-12 col-sm-12 ">
<div>
<p>Permisos Permitidos</p>
<div class="">
<div class="progress progress_sm" style="width: 76%;">
<div class="progress-bar bg-green" role="progressbar" data-transitiongoal="40"></div>
</div>
</div>
</div>
<div>
<p>Permisos Anulados</p>
<div class="">
<div class="progress progress_sm" style="width: 76%;">
<div class="progress-bar bg-green" role="progressbar" data-transitiongoal="50"></div>
</div>
</div>
</div>
</div>
</div>
<div class="clearfix"></div>
</div>
</div>
</div>
<br />
<div class="row">
<div class="col-md-6 col-sm-4 ">
<div class="x_panel tile fixed_height_320">
<div class="x_title">
<h2>Estadisticas Generales</h2>
<ul class="nav navbar-right panel_toolbox">
<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
</li>

<li><a class="close-link"><i class="fa fa-close"></i></a>
</li>
</ul>
<div class="clearfix"></div>
</div>
<div class="x_content">
<div class="widget_summary">
<div class="w_left w_25">
<span>Pagados</span>
</div>
<div class="w_center w_55">
<div class="progress">
<div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
 <span class="sr-only">80% Complete</span>
</div>
</div>
</div>
<div class="w_right w_20">
<span>15</span>
</div>
<div class="clearfix"></div>
</div>
<div class="widget_summary">
<div class="w_left w_25">
<span>Adeudados</span>
</div>
<div class="w_center w_55">
<div class="progress">
<div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 20%;">
<span class="sr-only">60% Complete</span>
</div>
</div>
</div>
<div class="w_right w_20">
<span>10</span>
</div>
<div class="clearfix"></div>
</div>
<div class="widget_summary">
<div class="w_left w_25">
<span>Anulados</span>
</div>
<div class="w_center w_55">
<div class="progress">
<div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 5%;">
<span class="sr-only">60% Complete</span>
</div>
</div>
</div>
<div class="w_right w_20">
<span>3</span>
</div>
<div class="clearfix"></div>
</div>
<div class="widget_summary">
<div class="w_left w_25">
<span>Suspendidos</span>
</div>
<div class="w_center w_55">
<div class="progress">
<div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 5%;">
<span class="sr-only">60% Complete</span>
</div>
</div>
</div>
<div class="w_right w_20">
<span>3</span>
</div>
<div class="clearfix"></div>
</div>
<div class="widget_summary">
<div class="w_left w_25">
<span>Cerrados</span>
</div>
<div class="w_center w_55">
<div class="progress">
<div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 15%;">
<span class="sr-only">60% Complete</span>
</div>
</div>
</div>
<div class="w_right w_20">
<span>1</span>
</div>
<div class="clearfix"></div>
</div>
</div>
</div>
</div>
<div class="col-md-6 col-sm-4 ">
<div class="x_panel tile fixed_height_320 overflow_hidden">
<div class="x_title">
<h2>CATEGORIAS</h2>
<ul class="nav navbar-right panel_toolbox">
<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
</li>

<li><a class="close-link"><i class="fa fa-close"></i></a>
</li>
</ul>
<div class="clearfix"></div>
</div>
<div class="x_content">
<table class="" style="width:100%">
<tr>
<th style="width:37%;">
<p>Top 5</p>
</th>
<th>
<div class="col-lg-7 col-md-7 col-sm-7 ">
<p class="">Categorias</p>
</div>
<div class="col-lg-5 col-md-5 col-sm-5 ">
<p class="">Porcentaje</p>
</div>
</th>
</tr>
<tr>
<td>
<canvas class="canvasDoughnut" height="140" width="140" style="margin: 15px 10px 10px 0"></canvas>
</td>
<td>
<table class="tile_info">
<tr>
<td>
<p><i class="fa fa-square blue"></i>INDUSTRIAS Y FABRILES </p>
</td>
<td>20%</td>
</tr>
<tr>
<td>
<p><i class="fa fa-square red"></i>ALMACENAMIENTO </p>
</td>
<td>50%</td>
</tr>
<tr>
<td>
<p><i class="fa fa-square purple"></i>INSTALACIONES ESPECIALES </p>
</td>
<td>20%</td>
</tr>
<tr>
<td>
<p><i class="fa fa-square orange"></i>SERVICIOS </p>
</td>
<td>20%</td>
</tr>
<tr>
<td>
<p><i class="fa fa-square green"></i>COMERCIOS </p>
</td>
<td>30%</td>
</tr>

</table>
</td>
</tr>
</table>
</div>
</div>
</div>





                    @endif

                </div>
            </div>
        </div>
    </div>
</div>


<script src="/assets/vendors/jquery/dist/jquery.min.js" type="6304ed0b5a38e43fd3f22110-text/javascript"></script>

<script src="assets/vendors/bootstrap/dist/js/bootstrap.bundle.min.js" type="6304ed0b5a38e43fd3f22110-text/javascript"></script>

<script src="assets/vendors/fastclick/lib/fastclick.js" type="6304ed0b5a38e43fd3f22110-text/javascript"></script>

<script src="assets/vendors/nprogress/nprogress.js" type="6304ed0b5a38e43fd3f22110-text/javascript"></script>

<script src="assets/vendors/Chart.js/dist/Chart.min.js" type="6304ed0b5a38e43fd3f22110-text/javascript"></script>

<script src="assets/vendors/gauge.js/dist/gauge.min.js" type="6304ed0b5a38e43fd3f22110-text/javascript"></script>

<script src="assets/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js" type="6304ed0b5a38e43fd3f22110-text/javascript"></script>

<script src="assets/vendors/iCheck/icheck.min.js" type="6304ed0b5a38e43fd3f22110-text/javascript"></script>

<script src="assets/vendors/skycons/skycons.js" type="6304ed0b5a38e43fd3f22110-text/javascript"></script>

<script src="assets/vendors/Flot/jquery.flot.js" type="6304ed0b5a38e43fd3f22110-text/javascript"></script>
<script src="assets/vendors/Flot/jquery.flot.pie.js" type="6304ed0b5a38e43fd3f22110-text/javascript"></script>
<script src="assets/vendors/Flot/jquery.flot.time.js" type="6304ed0b5a38e43fd3f22110-text/javascript"></script>
<script src="assets/vendors/Flot/jquery.flot.stack.js" type="6304ed0b5a38e43fd3f22110-text/javascript"></script>
<script src="assets/vendors/Flot/jquery.flot.resize.js" type="6304ed0b5a38e43fd3f22110-text/javascript"></script>

<script src="assets/vendors/flot.orderbars/js/jquery.flot.orderBars.js" type="6304ed0b5a38e43fd3f22110-text/javascript"></script>
<script src="assets/vendors/flot-spline/js/jquery.flot.spline.min.js" type="6304ed0b5a38e43fd3f22110-text/javascript"></script>
<script src="assets/vendors/flot.curvedlines/curvedLines.js" type="6304ed0b5a38e43fd3f22110-text/javascript"></script>

<script src="assets/vendors/DateJS/build/date.js" type="6304ed0b5a38e43fd3f22110-text/javascript"></script>

<script src="assets/vendors/jqvmap/dist/jquery.vmap.js" type="6304ed0b5a38e43fd3f22110-text/javascript"></script>
<script src="assets/vendors/jqvmap/dist/maps/jquery.vmap.world.js" type="6304ed0b5a38e43fd3f22110-text/javascript"></script>
<script src="assets/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js" type="6304ed0b5a38e43fd3f22110-text/javascript"></script>

<script src="assets/vendors/moment/min/moment.min.js" type="6304ed0b5a38e43fd3f22110-text/javascript"></script>
<script src="assets/vendors/bootstrap-daterangepicker/daterangepicker.js" type="6304ed0b5a38e43fd3f22110-text/javascript"></script>

<script src="assets/build/js/custom.min.js" type="6304ed0b5a38e43fd3f22110-text/javascript"></script>
<script src="https://ajax.cloudflare.com/cdn-cgi/scripts/7089c43e/cloudflare-static/rocket-loader.min.js" data-cf-settings="6304ed0b5a38e43fd3f22110-|49" defer=""></script></body>
</html>




@endsection

