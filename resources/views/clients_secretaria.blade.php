@extends('layout')

@section('title', ucwords($data[0]->nombre))
@section('icono', $data[0]->icono)

@section('pagecontent')
    <style>
        .ui-pnotify-text {
            display: none !important;
            ;
        }

        .cb-subTitle {
            color: #ca1404;
            font-weight: bold;
            margin: 12px 0;
            font-size: 13px;
        }

        .modal-dialog {
            max-width: 70% !important;
        }
    </style>
    @if (session()->has('Respuesta'))
        <label id="Respuesta" style="display: none;">{{ session('Respuesta') }}</label>
        <script>
            toastr.success($("#Respuesta").text());
        </script>
    @endif

    @if (session()->has('Respuesta_erro'))
        <label id="Respuesta_erro" style="display: none;">{{ session('Respuesta_erro') }}</label>
        <script>
            toastr.error($("#Respuesta_erro").text());
        </script>
    @endif

    @if (session()->has('Respuesta_wn'))
        <label id="Respuesta_wn" style="display: none;">{{ session('Respuesta_wn') }}</label>
        <script>
            toastr.warning($("#Respuesta_wn").text());
        </script>
    @endif



    <!-- page content -->
    <div class="right_col" role="main">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_content">

                    <!--contenido-->

                    <div class="page-title">
                        <div class="title_left">
                            <h2><i class="fa fa-fire-extinguisher"></i> Clientes </h2>
                        </div>
                        <div class="title_right">
                            <div class="col-md-9 col-sm-12 col-xs-12 form-group pull-right top_search">
                                <div class="input-group">




                                 

                                    <select class="form-control tbClientes_selectBuscar">
                                        @forelse ($sector as $item)
                                            <option value="{{ $item->descripcion }}">{{ $item->descripcion }}</option>
                                        @empty
                                        @endforelse
                                    </select>


                                    <select class="form-control tbClientes_selectBuscar">
                                        <option value="" selected>TODOS</option>
                                        <option value="DESACTIVAR" selected>ACTIVADOS</option>
                                        <option value="DESACTIVADOS">DESACTIVADOS</option>
                                    </select>




                                    <span class="input-group-btn"><button class="btn"
                                            type="button">Buscar</button></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <!-- tabla clientes--->
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <p>Listado de Clients registrados</p>

                                <div class="table-responsive">
                                    <table id="tbClientes" class="table table-striped jambo_table bulk_action"
                                        style="width:100%;">
                                        <thead>
                                            <tr class="headings">
                                            <th class="column-title">ID</th>
                                                <th class="column-title">RUC</th>
                                                <th class="column-title">RAZ&Oacute;N. SOCIAL</th>
                                                <th class="column-title">REP. LEGAL</th>
<!--                                                 <th class="column-title">CATEGOR&Iacute;A</th>
                                                <th class="column-title">DENOMINACI&Oacute;N</th> -->
                                                <th class="column-title">PARROQUIA</th>
                                                <th class="column-title">ESTADO</th>
                                                <th class="column-title">ACCION</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($clients as $item)
                                                <tr class="even pointer">
                                                <td><label class="a-center ruc">{{ $item->id }}</label></td>

                                                    <td><label class="a-center ruc">{{ $item->ruc }}</label></td>
                                                    <td><label
                                                            class="a-center razonSocial">{{ $item->razonSocial }}</label>
                                                    </td>
                                                    <td><label
                                                            class="a-center representanteLegal">{{ $item->representanteLegal }}</label>
                                                    </td>
                                                    <td><label class="a-center">{{ $item->parroquia }}</label>
                                                    </td>
                                                    <td style="text-align: center">
                                                        @if ($item->estado > 4)
                                                            <button class="btn btn-danger btn-block mdlModificaEmpleado"
                                                                data-toggle="modal" data-idCli_1="{{ $item->id }}"
                                                                data-target="#mdlModificaEmpleado">DESACTIVAR </button>
                                                        @endif
                                                        @if ($item->estado == 1)
                                                            DESACTIVADO
                                                        @endif

                                                        @if ($item->estado <= 4 && $item->estado != 1)
                                                            PENDIENTE
                                                        @endif

                                                    </td>
                                                    <td style="text-align: center">
                                                        @if ($item->estado <= 4 && $item->estado != 1)
                                                            <div class="btn btn-warning btn-block mdlModificaInfoEmpleado"
                                                                data-toggle="modal" data-idCli_1="{{ $item->id }}"
                                                                data-target="#mdlModificaInfoEmpleado">
                                                                <i class="fa fa-edit"></i>
                                                            </div>
                                                        @endif

                                                    </td>
                                                </tr>

                                            @empty
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- fin tabla clientes--->


            </div>
            <!-- fin section clientes -->
        </div>


    </div>
 
    <!-- /page contsent -->


    <!-- Modal mdlNuevEmpleado-->
    <div class="modal fade" id="mdlModificaEmpleado" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 90%!important;" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> <i class="fa fa-ban"></i> DESACTIVAR CLIENTE</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="x_panel">
                        <div class="x_title cb-subTitle"><b>DESACTIVAR CLIENTE</b></div>
                        <div class="x_content">




                            <form class="form-horizontal form-label-left" method="POST"
                                action="{{ route('client.destroy', 1) }}" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="client_id" id="client_id_1" value="">
                                {!! method_field('DELETE') !!}

                                <!--FORMULARIO DE INSPECCIÓN--->
                                <div class="row" style="text-align: center;">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="col-md-12 col-sm-12">
                                                <div class="checkbox">
                                                    <label>
                                                        Archivo de Respaldo
                                                    </label>
                                                    <label>
                                                        <input type="file" name="respaldo" required>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 offset-md-3">
                                        <button type="submit" class="btn btn-danger btn-block"><i class="fa fa-ban"
                                                style="color: white;"></i> DESACTIVAR</button>
                                        <button class="btn btn-primary btn-block" data-dismiss="modal">CANCELAR</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
    <!-- fin  Modal mdlNuevEmpleado-->




    <div class="modal fade" id="mdlModificaInfoEmpleado" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 90%!important;" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> <i class="fa fa-pencil"></i> MODIFICAR INFORMACI&Oacute;N DE USUARIOS</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="x_panel">
                        <div class="x_title cb-subTitle"><b>FORMULARIO DE INSPECCI&Oacute;N</b></div>

                        <div class="x_content">
                            <form class="form-horizontal form-label-left" method="POST"
                                action="{{ route('clients.update', 1) }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                {!! method_field('PUT') !!}
                                <input type="hidden" name="caso" value="update_info_2">
                                <input type="hidden" name="clietn_id" id="clietn_id" value="">

                                <!--FORMULARIO DE INSPECCIÓN--->
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="col-md-3 col-sm-3 ">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="radio" name="tipoInspecion" value="1"
                                                            class="flat" checked> INSPECCI&Oacute;N
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-3 ">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="radio" name="tipoInspecion" value="2"
                                                            class="flat"> RE-INSPECCI&Oacute;N
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-6 col-sm-6 text-center">
                                                    <b>Fecha: </b> {{ now()->toDateString() }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!--INFORMACIÓN GENERAL-->
                                <div class="x_title cb-subTitle">INFORMACI&Oacute;N GENERAL</div>
                                <div class="form-group row">
                                    <label class="control-label col-md-4 col-sm-4 ">RUC</label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" name="ruc" id="ruc_md" onKeyPress="return fn_aceptaNum(event)"
                                            value="" class="form-control col-md-5" value="" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-md-4 col-sm-4 ">RAZ&Oacute;N SOCIAL <small>(NOMBRE
                                            COMERCIAL)</small> </label>
                                    <div class="col-md-8 col-sm-8 ">
                                        <input type="text" name="razonSocial" id="razonSocial_md" value=""
                                            class="form-control col-md-11" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-md-4 col-sm-4 ">REPRESENTANTE LEGAL O PERSONA NATURAL
                                        <small>(PROPIETARIO)</small> </label>
                                    <div class="col-md-8 col-sm-8 ">
                                        <input type="text" name="representanteLegal"
                                            onKeyPress="return fn_aceptaLETRAS(event)" id="representanteLegal_md" value=""
                                            class="form-control col-md-11" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-md-2 col-sm-2">PARROQUIA</label>
                                    <div class="col-md-4 col-sm-4">
                                        <select class="form-control" name="parroquia" id="parroquia_md">
                                            @forelse ($sector as $item)
                                                <option value="{{ $item->id }}">{{ $item->descripcion }}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-sm-6 ">
                                        <label class="control-label col-md-2 col-sm-2 ">BARRIO</label>
                                        <input type="text" name="barrio" id="barrio_mod"
                                            onKeyPress="return fn_aceptaLETRAS(event)" class="form-control col-md-6"
                                            required>
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-md-2 col-sm-2 ">REFERENCIA</label>
                                    <div class="col-md-8 col-sm-8 ">
                                        <textarea name="referencia" id="referencia_md" value="" class="form-control col-md-10" required></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-md-2 col-sm-2">TEL&Eacute;FONO: </label>
                                    <div class="col-md-3 col-sm-3 ">
                                        <input type="text" name="telefono" id="telefono_md"
                                            onKeyPress="return fn_aceptaNum(event)" value="" class="form-control col-md-10"
                                            required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-md-2 col-sm-2 ">CATEGOR&Iacute;A</label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <select class="form-control" name="categoria" id="categoria_md">
                                            @forelse ($categoria as $item)
                                                <option value="{{ $item->id }}">{{ $item->descripcion }}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label class="control-label col-md-2 col-sm-2 ">DENOMINACI&Oacute;N</label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <select class="form-control" name="actividad" id="actividad_md"></select>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label class="control-label col-md-2 col-sm-2 ">RIESGO</label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <select class="form-control" name="riesgo" id="actividad_md">
                                            <option value="1">RE</option>
                                            <option value="2">RO</option>
                                            <option value="3">RL</option>
                                        </select>
                                    </div>
                                </div>

                                <!--fin INFORMACIÓN GENERAL-->


                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 offset-md-3">
                                        <button class="btn btn-primary" data-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-success">Guardar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>





@endsection
@section('scrpts-jqrey')
    <script>
        var tbClientes;
        fn_tbClientes_ini();
        $("#tbClientes_InpBuscar").val("");

        function fn_tbClientes_ini() {
            tbClientes = $('#tbClientes').dataTable({
             
                pageLength: 10,
                order: [
                    [0, "desc"]
                ],
                drawCallback: function(settings) {
                    //CARGANDO
                },
                select: true,
                "language": {
                    "lengthMenu": 'Mostrar' +
                        '<select style="width:60px" >' +
                        '<option>5</option>' +
                        '<option>10</option>' +
                        '<option>20</option>' +
                        '<option>25</option>' +
                        '<option value="-1">Todos</option>' +
                        '</select> registros por página',
                    "zeroRecords": "No se encontraron resultados en su busqueda",
                    "searchPlaceholder": "Buscar por..",
                    "info": " ",
                    "infoEmpty": "No existen registros",
                    "infoFiltered": "",
                    "search": "Buscar:",
                    "processing": "Procesando...:",
                    "paginate": {
                        "first": "Primero",
                        "last": "Último",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    },
                }
                ,
    columnDefs: [
        {
            targets: 0, // Indica la posición de la columna que quieres ocultar (en este caso, la columna 0)
            visible: false
        }
        // Puedes agregar más definiciones de columnas según sea necesario
    ]
        
            });

        }
      




        $(".mdlModificaEmpleado").click(function() {
            var id = $(this).attr("data-idCli_1");
            $("#client_id_1").val(id);
        });

        $(".mdlModificaInfoEmpleado").click(function() {
            var valorID = $(this).attr("data-idCli_1");
            var endpoint = 'resumenInfoCliente/' + valorID;
            $("#clietn_id").val(valorID);

            $.ajax({
                async: false,
                type: "GET",
                dataType: "json",
                contentType: "application/x-www-form-urlencoded",
                url: endpoint,
                success: function(datos) {

                    $("#tipoInspecion_md").val(datos[0].tipoFormulario);
                    $("#ruc_md").val(datos[0].ruc);
                    $("#razonSocial_md").val(datos[0].razonSocial);
                    $("#representanteLegal_md").val(datos[0].representanteLegal);
                    $("#parroquia_md").val(datos[0].parroquia_id);
                    $("#barrio_mod").val(datos[0].barrio);
                    $("#referencia_md").val(datos[0].referencia);
                    $("#telefono_md").val(datos[0].telefono);


                    var endpoint = 'denomincacniones/' + datos[0].categoria_id;
                    $.ajax({
                        async: false,
                        type: "GET",
                        dataType: "json",
                        contentType: "application/x-www-form-urlencoded",
                        url: endpoint,
                        success: function(datos) {
                            $("#actividad").empty();
                            for (var i = 0; i < datos.length; i++) {
                                $("#actividad_md").append('<option value="' + datos[i][
                                    'id'] + '">' + datos[i]['descripcion'] +
                                    ' </option>');
                            }
                        }
                    });



                    $('#categoria_md option[value="' + datos[0].categoria_id + '"]').attr('selected',
                        true)
                    $('#actividad_md option[value="' + datos[0].denominacion_id + '"]').attr('selected',
                        true)





                }
            });





        });

        $("#categoria_md").change(function() {
            var combo_actividad = $("select[id=categoria_md]").val();
            var endpoint = 'denomincacniones/' + combo_actividad;
            $.ajax({
                async: false,
                type: "GET",
                dataType: "json",
                contentType: "application/x-www-form-urlencoded",
                url: endpoint,
                success: function(datos) {
                    $("#actividad_md").empty();
                    for (var i = 0; i < datos.length; i++) {
                        $("#actividad_md").append('<option value="' + datos[i]['id'] + '" selected>' +
                            datos[i]['descripcion'] + ' </option>');
                    }
                }
            });
        });
    </script>
@endsection
