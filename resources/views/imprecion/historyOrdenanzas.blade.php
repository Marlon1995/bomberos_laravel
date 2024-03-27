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
                                        <h2><i class="fa fa-file-text-o"></i> Comprobantes de Pagos Ordenanza</h2>
                                    </div>
                                    <div class="title_right">

                                    </div>
                                </div>

                                <div class="x_content">
                                    <div class="table-responsive">
                                        <table id="tb_historial" class="table table-striped jambo_table bulk_action" style="width:100%">
                                            <thead>
                                            <tr class="headings">
                                                <th class="column-title ">CI - RUC</th>
                                                <th class="column-title ">RAZ&Oacute;N SOCIAL</th>
                                                <th class="column-title ">OBSERVACIÓN</th>
                                                <th class="column-title ">FORMA PAGO</th>
                                                <th class="column-title ">TIPO PAGO</th>
                                                <th class="column-title ">DESCRIPCI&Oacute;N</th>
                                                <th class="column-title ">VALOR</th>
                                                <th class="column-title ">FECHA</th>


                                                @if( auth()->user()->role_id != 5 )
                                                    <th class="column-title ">ESTADO</th>
                                                @else
                                                    <th class="column-title ">DOCUMENTO</th>
                                                @endif

                                                 <th class="column-title" align="center"></th>
                                              
                                            </tr>
                                            </thead>
                                            <tbody>


                                            @forelse ($historial as $item)
                                                    <tr class="evenpointer">
                                                        <td><label>{{$item->ruc}}</label></td>
                                                        <td><label>{{$item->razonSocial}}</label></td>
                                                        <td><label>{{$item->observacion}}</label></td>


                                                    @if( !empty( $item->formaspago ) ) <td><label>{{$item->formaspago}}</label></td> @else <td><label> EFECTIVO </label> </td> @endif

                                                        <td><label>{{$item->tipos_pago}}</label> </td>
                                                        <td><label>{{$item->descripcion}}</label> </td>



                                                        <td><label>{{$item->valor}}</label></td>
                                                        <td><label>{{$item->created_at}}</label></td>
                                                        
                                                        @if( auth()->user()->role_id != 5 )
                                                    
                                                            <th class="column-title ">PAGADO</th>
                                                        @else
                                                      
                                                            <th class="column-title ">
                                                                <a href="./dicumentosRespaldo/{{$item->docRespaldo}}" target="_blank" class="btn btn-success btn-block">DOCUMENTO</a> </td>
                                                            </th>
                                                        @endif



                                                        <td><a href="bill-payments-ordenanzas/{{$item->id}}" target="_blank" class="btn btn-info btn-block">IMPRIMIR</a> </td>
                                                       
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
                    }
                });
            }


            $("#tb_historial_b").on('keyup', function (event) {
                var val = $("#tb_historial_b").val();
                tb_historial.search(val).draw();
            });

    </script>

@endsection




