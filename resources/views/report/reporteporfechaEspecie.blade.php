@extends('layout')

@section('title', ucwords($data[0]->nombre))
@section('icono', $data[0]->icono)

@section('pagecontent')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h4></h4>
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
                                <div class="col-md-4">
                                    Rango de Fechas
                                    <form class="" method="GET" action="/reportePorFechasEspecies" target="_blank">
    <fieldset>
        <div class="control-group">
            <div class="controls">
                <div class="input-prepend input-group">
                    <span class="add-on input-group-addon"><i class="fa fa-calendar"></i></span>
                    <input type="text" style="width: 200px" name="reservation" id="reservation" class="form-control" value="" />
                </div>
            </div>
        </div>
        <div class="control-group">
            <label for="tipoTransaccion">Tipo de Transacción:</label>
            <select name="tipoTransaccion" id="tipoTransaccion" class="form-control">
                <option value="1">Pagadas</option>
                <option value="0">Anuladas</option>
            </select>
        </div>
        <br><br>
        <button class="btn btn-info">GENERAR</button>
    </fieldset>
</form>

                                </div>
                            </div>
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
        /*
            $.datepicker.regional['es'] = {
                closeText: 'Cerrar',
                prevText: '< Ant',
                nextText: 'Sig >',
                currentText: 'Hoy',
                monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
                dayNames: ['Domingo', 'Lunes', 'Martes', 'Mi&eacute;rcoles', 'Jueves', 'Viernes', 'S&aacute;bado'],
                dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
                dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','S&aacute;'],
                weekHeader: 'Sm',
                dateFormat: 'dd/mm/yy',
                firstDay: 1,
                isRTL: false,
                showMonthAfterYear: false,
                yearSuffix: ''
            };
            $.datepicker.setDefaults($.datepicker.regional['es']);

             $( "#reservation" ).datepicker({
                dateFormat: "dd/mm/yy"
            });
    */
    </script>
@endsection
