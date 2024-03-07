@extends('layout')

@section('title', ucwords($data[0]->nombre))
@section('icono', $data[0]->icono )

@section('pagecontent')

    <style>
        .ui-pnotify-shadow{
            display: none;
        }
    </style>

<div class="right_col" role="main">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_content">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="solicitudes" role="tabpanel" >
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="page-title">
                                    <div class="title_left">
                                        <h2><i class="fa fa-file-text-o"></i> Historial de Pagos</h2>
                                    </div>
                                    <div class="title_right">

                                    </div>
                                </div>

                                <div class="x_content">
                                    <p class="text-muted font-13 m-b-30">Listado de comprobantes de Pago</p>
                                    <div class="table-responsive">
                                        <table id="tb_historial" class="table table-striped jambo_table bulk_action" style="width:100%">
                                            <thead>
                                            <tr class="headings">
                                            <th class="column-title ">ID</th>

                                                <th class="column-title ">CI - RUC</th>
                                                <th class="column-title ">RAZ&Oacute;N SOCIAL</th>
                                                <th class="column-title ">PROPIETARIO</th>
                                                <th class="column-title ">FORMA PAGO</th>
                                               
                                                <th class="column-title ">VALOR</th>
                                                <th class="column-title ">AÑO DE PAGO</th>
                                                <th class="column-title ">ESTADO</th>



                                            
                                              
                                            </tr>
                                            </thead>
                                            <tbody>


                                            @forelse ($historial as $item)
                                                    <tr class="evenpointer">
                                                    <td><label>{{$item->id}}</label></td>

                                                        <td><label>{{$item->ruc}}</label></td>
                                                        <td><label>{{$item->razonSocial}}</label></td>
                                                        <td><label>{{$item->representanteLegal}}</label></td>

                                                    @if( !empty( $item->formaspago ) ) <td><label>{{$item->formaspago}}</label></td> @else <td><label> DESCUENTO </label> </td> @endif

                                                  



                                                        <td><label>{{$item->valor}}</label></td>
                                                        <td><label>{{$item->created_at}}</label></td>
                                                        
                                                   
                                                        <th class="column-title ">PAGADO</th>



                                                       
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
    </div>
</div>

@endsection

@section('scrpts-jqrey')
    <script>


        var tb_historial;

        $(document).ready( function () {
            fn_tb_historial_ini();
        });
            function fn_tb_historial_ini() {
                tb_historial = $("#tb_historial").dataTable({
                     pageLength: 10,
                     order: [
                [0, "desc"]
            ],
                    "language": {
                        "lengthMenu": 'Mostrar'+
                        '<select style="width:60px" >'+
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
                    },
                  
    columnDefs: [
        {
            targets: 0, // Indica la posición de la columna que quieres ocultar (en este caso, la columna 0)
            visible: false
        }
        // Puedes agregar más definiciones de columnas según sea necesario
    ]
                });
            }


            $("#tb_historial_b").on('keyup', function (event) {
                var val = $("#tb_historial_b").val();
                tb_historial.search(val).draw();
            });

    </script>

@endsection




