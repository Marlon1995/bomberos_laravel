@extends('layout')

@section('title', ucwords($data[0]->nombre))
@section('icono', $data[0]->icono)

@section('pagecontent')
    <!-- page content -->

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



    <div class="right_col" role="main">
        <div class="">
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Pago de Especies</h2>
                            <div class="clearfix"></div>

                        </div>
                        <div class="x_content">
                            <div class="title_right">
                              
                            </div>


                            <p class="col-md-6 col-sm-12 col-xs-12">
                                <a href="#" class="btn btn-outline-primary" data-toggle="modal" data-target="#mdlUser"> <i
                                        class="fa fa-user"></i> Agregar</a>
                                Lista de pago de especies
                            </p>


                            <div class="table-responsive">
                                <table id="tbEspecies" class="table table-striped jambo_table bulk_action"
                                    style="width:100%">
                                    <thead>
                                        <tr class="headings">
                                            <th class="column-title">LOCAL</th>
                                            <th class="column-title">CONTRIBUYENTE</th>
                                            <th class="column-title">RUC</th>
                                            <th class="column-title">DIRECCIÓN</th>
                                            <th class="column-title">TELÉFONO</th>
                                            <th class="column-title">N° ESPECIE</th>
                                            <th class="column-title">DESCRIPCIÓN</th>
                                            <th class="column-title">VALOR</th>
                                            <th class="column-title">ESTADO</th>
                                            <th class="column-title"></th>
                                            <th class="column-title">EXONERACIONES</th>
                                            <th class="column-title"></th>
                                            <th class="column-title"></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @forelse ($especie as $item)
                                            <tr class="even pointer">
                                                <td>{{ $item->razonSocial }}</td>
                                                <td>{{ $item->representanteLegal }}</td>
                                                <td>{{ $item->ruc }}</td>
                                                <td>{{ $item->direccion }}</td>
                                                <td>{{ $item->telefono }}</td>
                                                <td>{{ $item->especie }}</td>
                                                <td>{{ $item->descripcion }}</td>
                                                <td>{{ $item->cantidad * $item->valor }}</td>
                                                <td>
                                                 @if ($item->estado == 0)
                                                 <span style="color: red;">ANULADA</span>

                                                @elseif ($item->estado == 1)
                                                <strong>ACTIVA</strong>

                                                         @else
       
                                                     @endif
                                                    </td>
                                                    @if ($item->estado == 1)
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="especiesPayments/{{ $item->id }}"
                                                            class="btn btn-info" target="_blank"> IMPRIMIR </a>
                                                        &nbsp;&nbsp;
                                                        <form method="POST"
                                                            action="{{ route('especies.destroy', $item->id) }}">
                                                            @csrf
                                                            
                                                            {!! method_field('DELETE') !!}
                                                            <button type="submit" class="btn btn-danger btn-xs btn-block"><i
                                                                    class="fa fa-times"></i> </button>
                                                                        
                                                        </form>
                                                    </div>
                                                </td>

                                                <td><a href="exoneraciones_artesano/{{ $item->id }}" target="_blank"
                                                        class="btn btn-info btn-block">ARTESANOS</a> </td>
                                                <td><a href="exoneraciones_tercera/{{ $item->id }}" target="_blank"
                                                        class="btn btn-warning">TERCERA</a> </td>
                                                <td><a href="exoneraciones_discapacidad/{{ $item->id }}"
                                                        target="_blank" class="btn btn-success">DISCAPACIDAD</a> </td>
                                                            


                                                           @elseif ($item->estado == 0)
                                                           <td></td>
                                                           <td></td>
                                                           <td></td>
                                                           <td></td>
                                                           @endif  
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
        </div>
    </div>
    <!-- /page content -->





    <style>
        .modal-dialog {
            max-width: 90% !important;
        }
    </style>
    <!-- Modal -->
    <div class="modal fade" id="mdlUser" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Especies</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>




                <div class="modal-body">
                    <div class="form-group row" style="margin-left: 10px">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-3" style="text-align: right">
                                    <img src="/assets/img/icons/logo.png" width="100px">
                                </div>
                                <div class="col-sm-6" style="text-align: center">
                                    <h2 style="margin: 2px; font-weight: bold;">ACUERDO MINISTERIAL N° 1616 DEL 29 DE
                                        OCTUBRE DE 1997</h2>
                                    <p style="margin: 2px; font-weight: bold;">REGISTRO OFICIAL N° 741 DEL 29 DE ENERO DEL
                                        2019</p>
                                    <p style="margin: 2px; font-weight: bold;">RUC 08600506900001</p>
                                    <p style="margin: 2px; font-weight: bold;">TELEFONO: 0602731-001</p>
                                </div>
                                <div class="col-sm-3"></div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-6" style="text-align: center">
                                    <h2 style="text-align: center; font-weight: bold">ORDEN DE PAGO DE PERMISO DE
                                        FUNCIONAMIENTO CUERPO DE BOMBEROS</h2>
                                    <p style="text-align: right;">Atacames, {{ now()->toDateTimeString() }}</p>
                                    <p style="text-align: right;">Permiso año {{ date('Y') }} </p>
                                    <style>
                                        .margin_p {
                                            margin: -6px;
                                        }
                                    </style>


                                    <form method="POST" action="{{ route('especies.store') }}">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        @csrf
                                        <div class="container">
                                            <div class="row" style="border: 1px solid;">
                                                <div class="col-sm-1"></div>
                                                <div class="col-sm-10" style="text-align: left;padding: 10px">

                                                    <div class="item form-group ">
                                                        <label class="col-form-label col-md-4 col-sm-4 label-align"
                                                            for="cedula">RUC</label>
                                                        <div class="col-md-9 col-sm-9">
                                                            <input type="text" class="form-control" name="ruc" id="ruc"
                                                                onKeyPress="return fn_aceptaNum(event)" placeholder="RUC"
                                                                required>
                                                        </div>
                                                    </div>


                                                    <div class="item form-group ">
                                                        <label class="col-form-label col-md-4 col-sm-4 label-align"
                                                            for="cedula">NOMBRE DEL LOCAL</label>
                                                        <div class="col-md-9 col-sm-9">
                                                            <input type="text" class="form-control" name="razonSocial"
                                                                id="nombreLocal" placeholder="NOMBRE DEL LOCAL" required>
                                                        </div>
                                                    </div>

                                                    <div class="item form-group ">
                                                        <label class="col-form-label col-md-4 col-sm-4 label-align"
                                                            for="cedula">PROPIETARIO</label>
                                                        <div class="col-md-9 col-sm-9">
                                                            <input type="text" class="form-control"
                                                                name="representanteLegal" id="representanteLegal"
                                                                onKeyPress="return fn_aceptaLETRAS(event)"
                                                                placeholder="PROPIETARIO" required>
                                                        </div>
                                                    </div>

                                                    <div class="item form-group ">
                                                        <label class="col-form-label col-md-4 col-sm-4 label-align"
                                                            for="cedula">DIRECCI&Oacute;N</label>
                                                        <div class="col-md-9 col-sm-9">
                                                            <input type="text" class="form-control" name="direccion"
                                                                id="direccion" placeholder="DIRECCI&Oacute;N" required>
                                                        </div>
                                                    </div>

                                                    <div class="item form-group ">
                                                        <label class="col-form-label col-md-4 col-sm-4 label-align"
                                                            for="cedula">TEL&Eacute;FONO</label>
                                                        <div class="col-md-9 col-sm-9">
                                                            <input type="text" class="form-control " name="telefono"
                                                                id="telefono" onKeyPress="return fn_aceptaNum(event)"
                                                                placeholder="TEL&Eacute;FONO" required>
                                                        </div>
                                                    </div>

                                                    <div class="item form-group ">
                                                        <label class="col-form-label col-md-4 col-sm-4 label-align"
                                                            for="anioPago">N# ESPECIE</label>
                                                        <div class="col-md-9 col-sm-9">
                                                            <input type="text" class="form-control " name="especie"
                                                                placeholder="N# ESPECIE" required>
                                                        </div>
                                                    </div>

                                                    <div class="item form-group ">
                                                        <label class="col-form-label col-md-4 col-sm-4 label-align"
                                                            for="anioPago">DESCRIPCIÓN</label>
                                                        <div class="col-md-9 col-sm-9">
                                                            <input type="text" class="form-control " name="descripcion"
                                                                placeholder="DESCRIPCION" required>
                                                        </div>
                                                    </div>

                                                    <div class="item form-group ">
                                                        <label class="col-form-label col-md-4 col-sm-4 label-align"
                                                            for="anioPago">CANTIDAD</label>
                                                        <div class="col-md-9 col-sm-9">
                                                            <input type="text" class="form-control col-md-4 "
                                                                name="cantidad" placeholder="1" required value="1">
                                                        </div>
                                                    </div>



                                                    <div class="item form-group ">
                                                        <label class="col-form-label col-md-4 col-sm-4 label-align"
                                                            for="anioPago">VALOR $</label>
                                                        <div class="col-md-9 col-sm-9">
                                                            <input type="text" class="form-control col-md-4 " name="valor"
                                                                placeholder="2" required value="2">
                                                        </div>
                                                    </div>


                                                    <input type="submit" value="FACTURAR" class="btn btn-info"
                                                        style="font-size: 55px; text-align:center">
                                                </div>
                                                <div class="col-sm-1"></div>
                                            </div>

                                        </div>
                                    </form>

                                </div>
                                <div class="col-sm-3"></div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>



@endsection
@section('scrpts-jqrey')
    <script>
        var tbEspecies = $('#tbEspecies').dataTable({

            pageLength: 10,
            order: [
                [0, "asc"]
            ],
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
            },
            select: true
        });


        $("#tbEspecies_InpBuscar").on('keyup', function(event) {
            tbEspecies.search(this.value).draw();
        });

        $("#ruc").change(function() {
            var ruc = $("#ruc").val();
            if (ruc == '') {
                toastr.warning('Ingrese un número de RUC para la verificación');
                return true;
            }
            var endpoint = 'verificaRuc/' + ruc;

            $.ajax({
                async: false,
                type: "GET",
                dataType: "json",
                contentType: "application/x-www-form-urlencoded",
                url: endpoint,
                success: function(datos) {
                    if (datos[0].ruc == ruc) {
                        toastr.success('El RUC: ' + datos[0].ruc + ', YA EXISTE');
                        $("#nombreLocal").val(datos[0].razonSocial);
                        $("#representanteLegal").val(datos[0].representanteLegal);
                        $("#direccion").val(datos[0].barrio);

                        $("#telefono").val(datos[0].telefono);

                        return true;
                    }

                    toastr.error('No existen coincidencias, ' + datos[0].ruc);
                    $("#nombreLocal").val("");
                    $("#representanteLegal").val("");
                    $("#direccion").val("");
                    $("#telefono").val("");
                    return true;
                }
            });
        });
    </script>
@endsection
