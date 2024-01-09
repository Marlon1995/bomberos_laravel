@extends('layout')

@section('title', ucwords($data[0]->nombre))
@section('icono', $data[0]->icono )

@section('pagecontent')

    @if ( session()->has('Respuesta') )       <label id="Respuesta"
                                                     style="display: none;">{{ session('Respuesta') }}</label>
    <script>toastr.success($("#Respuesta").text()); </script>
    @endif

    @if ( session()->has('Respuesta_erro') )  <label id="Respuesta_erro"
                                                     style="display: none;">{{ session('Respuesta_erro') }}</label>
    <script>toastr.error($("#Respuesta_erro").text()); </script>
    @endif

    @if ( session()->has('Respuesta_wn') )  <label id="Respuesta_wn"
                                                   style="display: none;">{{ session('Respuesta_wn') }}</label>
    <script>toastr.warning($("#Respuesta_wn").text()); </script>
    @endif

    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h5> Administraci&oacute;n de Moras Trimestrales </h5>
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
                            <p class="text-muted font-13 m-b-30">
                                Listado de porcentade de recargos trimestrales
                            </p>


                            <table id="datatable_moras" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                     <th>Trimestre</th>
                                     <th>Porcentaje BCE</th>
                                 </tr>
                                </thead>
                                <tbody>
                                @forelse ($impuesto_trimestral as $item)

                                    <tr>
                                         <td>{{ $item->trimestre }} </td>
                                         <td>
                                            <form method="POST" action="{{ route('moras.update', $item->id )}}">
                                                <input type="text" name="porcentaje" id="porcentaje"   onKeyPress="return fn_aceptaNum(event)" value="{{$item->porcentaje}}" maxlength="5" class="form-control col-md-10 col-sm-10">
                                        </td>
                                        <td>
                                                 <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                 {!! method_field('PUT') !!}
                                                <button type="submit"class="btn btn-success btn-xs btn-block">ACTUALIZAR</button>
                                            </form>

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

@endsection


@section('scrpts-jqrey')
    <script>


        var tb_historial;

        $(document).ready( function () {
            $("#datatable_moras").dataTable({
                pageLength: 10,
                "language": {
                    "lengthMenu": 'Mostrar' +
                    '<select style="width:60px" >' +
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
            });

        });


    </script>

@endsection











