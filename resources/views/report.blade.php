@extends('layout')

@section('title', ucwords($data[0]->nombre))
@section('icono', $data[0]->icono)

@section('pagecontent')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h4>REPORTES GENERALES</h4>
                </div>
                <div class="title_right">
                </div>
            </div>

            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-10 col-sm-10 col-xs-10">
                    <div class="x_panel">
                        <div class="x_title">
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="well" style="overflow: auto">
                                <div class="input-group">
                                    <h4>Modo Reporte &nbsp; </h4>
                                    <select class="form-control col-md-4" id="modoReporte">
                                        <option value="1" selected>Diario</option>
                                        <option value="2">Rango de Fecha</option>
                                    </select>

                                    <h4> &nbsp; Tipo de Reporte &nbsp; </h4>
                                    <select class="form-control col-md-4" id="tipoReporte">
                                        <option value="ccdiarios" selected>Cierre Caja Diario</option>
                                        <option value="permisos">Permisos</option>
                                        <option value="remitidos">Registros no emitidos</option>
                                        <option value="parroquias">Parroquias</option>
                                    </select>
                                </div>

                                <center>
                                    <button class="btn btn-info " id="fechas_click">RANGO DE FECHAS</button>
                                </center>

                            </div>
                        </div>

                        <div class="x_content">
                            <center>
                                <div class="col-md-4" id="fechasDiarias" style="display: none">
                                    Fecha
                                    <fieldset>
                                        <div class="col-md-11 xdisplay_inputx form-group row has-feedback">
                                            <input type="text" class="form-control has-feedback-left fechaDiario"
                                                id="single_cal1" aria-describedby="inputSuccess2Status">
                                            <span class="fa fa-calendar form-control-feedback left"
                                                aria-hidden="true"></span>
                                            <span id="inputSuccess2Status" class="sr-only">(success)</span>
                                        </div>
                                        <button class="btn btn-info" id="reporteDiario">GENERAR PDF</button>
                                    </fieldset>
                                </div>

                                <div class="col-md-4" id="fechasSemanales" style="display: none">
                                    Rango de Fechas
                                    <fieldset>
                                        <div class="control-group ">
                                            <div class="controls">
                                                <div class="input-prepend input-group">
                                                    <span class="add-on input-group-addon"><i
                                                            class="fa fa-calendar"></i></span>
                                                    <input type="text" style="width: 200px" name="reservation"
                                                        id="reservation" class="form-control fechaSemanalR" value="" />
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btn-info" id="fechaSemanal">GENERAR PDF</button>
                                    </fieldset>
                                </div>
                            </center>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->


@endsection
@section('scrpts-jqrey')
    <script>
        //modoReporte

        $("#modoReporte").change(function() {
            $("#fechasDiarias").hide();
            $("#fechasSemanales").hide();
        });
        $("#tipoReporte").change(function() {
            $("#fechasDiarias").hide();
            $("#fechasSemanales").hide();
        });

        $("#fechas_click").click(function() {
            // CIERRE DE CAJAS
            if ($("#modoReporte").val() == 1 && $("#tipoReporte").val() == 'ccdiarios') {
                $("#fechasDiarias").show();
                return true;
            } else
            if ($("#modoReporte").val() == 2 && $("#tipoReporte").val() == 'ccdiarios') {
                $("#fechasSemanales").show();
                return true;
            } else

                // REGISTROS EMITIDOS
                if ($("#modoReporte").val() == 1 && $("#tipoReporte").val() == 'remitidos') {
                    $("#fechasDiarias").show();
                    return true;
                } else
            if ($("#modoReporte").val() == 2 && $("#tipoReporte").val() == 'remitidos') {
                $("#fechasSemanales").show();
                return true;
            } else


                // PERMISOS
                if ($("#modoReporte").val() == 1 && $("#tipoReporte").val() == 'permisos') {
                    $("#fechasDiarias").show();
                    return true;
                } else
            if ($("#modoReporte").val() == 2 && $("#tipoReporte").val() == 'permisos') {
                $("#fechasSemanales").show();
                return true;
            } else {
                $("#fechasDiarias").hide();
                $("#fechasSemanales").hide();
            }



            // parroquias
            if ($("#modoReporte").val() == 1 && $("#tipoReporte").val() == 'parroquias') {
                $("#fechasDiarias").show();
                return true;
            } else
            if ($("#modoReporte").val() == 2 && $("#tipoReporte").val() == 'parroquias') {
                $("#fechasSemanales").show();
                return true;
            } else {
                $("#fechasDiarias").hide();
                $("#fechasSemanales").hide();
            }



        });

        $("#reporteDiario").click(function() {
            var tipo = $("#tipoReporte").val();

            var d = $(".fechaDiario").val();
            var cast = new Date(d).format('Ymd');
            var fecha = cast.toString();

            window.open('reporteContadorDiario/' + tipo + '/' + fecha, '_blank');

        });

        $("#fechaSemanal").click(function() {
            var tipo = $("#tipoReporte").val();

            var fecha = $(".fechaSemanalR").val();
            var di = fecha.substring(0, 10);
            var df = fecha.substring(13, 23);

            var casti = new Date(di).format('Ymd');
            var castf = new Date(df).format('Ymd');

            var fechaInicial = casti.toString();
            var fechaFinal = castf.toString();

            window.open('reporteContadorSemanal/' + tipo + '/' + fechaInicial + '/' + fechaFinal, '_blank');

        });
    </script>
@endsection
