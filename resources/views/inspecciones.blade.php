@extends('layout')

@section('title', ucwords($data[0]->nombre))
@section('icono', $data[0]->icono )

@section('pagecontent')

    <div class="right_col" role="main">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_content">
                    <div class="page-title">
                        <div class="title_left">
                            <h2><i class="fa fa-fire-extinguisher"></i> Formularios de Inspecci&oacute;n </h2>
                        </div>
                        <div class="title_right">
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group pull-right top_search">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Buscar por.." value="" id="tbClientes_InpBuscar">
                                    <span class="input-group-btn">
                                    <button class="btn" type="button">Buscar</button>
                                  </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">

                                <p>Listado de Formularios de Inspecci&oacute;n registrados</p>

                                <div class="table-responsive">
                                    <table id="tbClientes" class="table table-striped jambo_table bulk_action" style="width:100%;">
                                        <thead>
                                        <tr class="headings">
                                            <th class="column-title">RUC</th>
                                            <th class="column-title">RAZ&Oacute;N. SOCIAL</th>
                                            <th class="column-title">REP. LEGAL</th>
                                            <th class="column-title">CATEGOR&Iacute;A</th>
                                            <th class="column-title">DENOMINACI&Oacute;N</th>
                                            <th class="column-title no-link last"></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse ($clients as $item)
                                                <tr class="even pointer">
                                                    <td><label class="a-center ruc">{{ $item->ruc }}</label></td>
                                                    <td><label class="a-center razonSocial">{{ $item->razonSocial }}</label></td>
                                                    <td><label class="a-center representanteLegal">{{ $item->representanteLegal }}</label></td>
                                                    <td><label class="a-center categorias">{{ $item->categorias }}</label></td>
                                                    <td><label class="a-center denominacion">{{ $item->denominacion }}</label></td>
                                                    <td style="text-align: center">
                                                        <a href="formulario-cliente-pdf/{{$item->id}}" class="btn btn-outline-primary"  target="_blank"><i class="fa fa-file-pdf-o"></i> </a>
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
            tbClientes = $('#tbClientes').DataTable({
                dom: '<"top">rt<"bottom"><"clear">',
                pageLength: 20,
                order: [[3, "asc"]],
                drawCallback: function (settings) {
                    //CARGANDO
                },
                select: true,
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
            });

        }
        $("#tbClientes_InpBuscar").on('keyup' , function(event){
            tbClientes.search(this.value).draw();
        });

    </script>
@endsection

