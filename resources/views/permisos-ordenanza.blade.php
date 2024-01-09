@extends('layout')

@section('title', ucwords($data[0]->nombre))
@section('icono', $data[0]->icono)

@section('pagecontent')
    <style>
        .cb-header-register {
            display: flex;
            align-items: center;
        }

        .cb-header-register__img {
            height: 100px;
            margin-right: 1%;
            margin-left: 1%;
        }

        .cb-header-registe_description {
            padding: 2px;
            color: black;
            font-size: 11px;
            text-align: justify;
            margin-left: 10%;
        }

        .cb-header-register__Nro {
            margin-left: 70%;
            color: #000000;
        }

        .cb-subTitle {
            color: #ca1404;
            font-weight: bold;
            margin: 12px 0;
            font-size: 13px;
        }

        .cb-header-register__tbDecripcion {
            width: 40%;
            text-align: justify;
        }

        .cb-header-register__tbSi,
        .cb-header-register__tbNo {
            width: 5%;
        }

        .cb-header-register__tbObservacion {
            width: 50%;
        }

        .modal-dialog {
            max-width: 70% !important;
        }

        .ui-pnotify-text {
            display: none !important;
        }
    </style>
    @if (session()->has('Respuesta'))
        <label id="Respuesta" eporte1 style="display: none;">{{ session('Respuesta') }}</label>
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

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_content">

                    <!--contenido-->


                    <div class="page-title">
                        <div class="title_left">
                            <h2><i class="fa fa-shield"></i> Permisos de Funcionamiento</h2>
                        </div>
                    
                    </div>


                    <div class="clearfix"></div>
                    <!-- tabla clientes--->
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <p>Listado de permisos de funcionamiento</p>

                                <div class="table-responsive">
                                    <table id="tbPermisos" class="table table-striped jambo_table bulk_action"
                                        style="width:100%;">
                                        <thead>
                                            <tr class="headings">
                                            <th class="column-title">ID</th>
                                                <th class="column-title">RUC</th>
                                                <th class="column-title">RAZ&Oacute;N SOCIAL</th>
                                                <th class="column-title">REP. LEGAL</th>
                                                <th class="column-title">AÑO</th>
                                                <th class="column-title no-link last"> &nbsp;ACCI&Oacute;N&nbsp;&nbsp;</th>
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
                                                    <td>
                                                        <label
                                                            class="a-center representanteLegal">{{ $item->representanteLegal }}</label>
                                                    </td>
                                                    <td>
                                                        
                                                        <label class="a-center updated_at">{{ $item->updated_at }}</label>
                                                    </td>
                                                    <td style="text-align: center">
                                                        <a href="permiso-ordenanzas/{{ $item->id }}" target="_blank"
                                                            class="btn btn-primary"><i class="fa fa-file-text-o"
                                                                style="font-size: 14px"></i></a>
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



@endsection

@section('scrpts-jqrey')

    <script>
        var tbPermisosOrdenanza;
        $(document).ready(function() {
            $("#tbPermisos_InpBuscar").val("");

            fn_tbPermisos_ini();
         

        });

        function fn_tbPermisos_ini() {
            tbPermisos = $("#tbPermisos").dataTable({
                pageLength: 10,
                order: [[0, "desc"]],
                "language": {
                    "lengthMenu": 'Mostrar'+
                    '<select style="width:60px" >'+
                    '<option>5</option>'+
                    '<option>10</option>'+
                    '<option>20</option>'+
                    '<option>25</option>'+
                    '<option value="-1">Todos</option>'+
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

        $("#tbPermisos_InpBuscar").on('keyup', function(event) {
            $("#tbPermisos").search(this.value).draw();
            });
            
    </script>
@endsection
