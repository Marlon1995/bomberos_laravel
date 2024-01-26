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
                                
                                    <h4> &nbsp; Tipo de Reporte &nbsp; </h4>
                                    <select class="form-control col-md-4" id="tipoReporte">
                                        <option value="ccdiarios" selected>Cierre Caja Diario</option>
                                        <option value="permisos">Permisos</option>
                                        <option value="remitidos">Registros no emitidos</option>
                                        <option value="parroquias">Parroquias</option>
                                    </select>
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
                            </div>
                        </div>

                        <div class="x_content">
                            <center>
                             

                                
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

        //$("#fechasSemanales").hide();
        $("#tipoReporte").change(function() {
            $("#fechasSemanales").show();
         
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
