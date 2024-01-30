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
                                    <form class="" method="GET"  action="{{ url('/report/PorParroquia')}} "  target="_blank" >
                                        <fieldset>
                                            <div class="control-group ">
                                                <div class="controls">
                                                    <div class="input-prepend input-group">
                                                        <span class="add-on input-group-addon"><i
                                                                class="fa fa-calendar"></i></span>
                                                        <input type="text" style="width: 200px" name="reservation"
                                                            id="reservation" class="form-control" value="" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="control-group">
 

<div class="control-group">
    <div class="controls">
        <div class="input-prepend input-group">
            <span class="add-on input-group-addon"><i class="fa fa-map-marker"></i></span>
            <select name="parroquia" id="parroquia" class="form-control">
                <!-- Las opciones se cargarán dinámicamente desde la ruta listarParroquias -->
            </select>
        </div>
    </div>
</div>
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
    $(document).ready(function () {
        // Hacer una petición AJAX para obtener las parroquias desde la ruta listarParroquias
        $.ajax({
            url: '{{ url("listarParroquias") }}',
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                // Iterar sobre las parroquias y agregarlas como opciones al select
                $.each(data, function (index, parroquia) {
                    $('#parroquia').append('<option value="' + parroquia.id + '">' + parroquia.descripcion + '</option>');
                });
            },
            error: function (error) {
                console.log('Error al obtener las parroquias:', error);
            }
        });
    });
</script>

@endsection
