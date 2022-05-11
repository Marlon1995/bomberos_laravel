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
                            <h2>Cuentas de Usuarios</h2>
                            <div class="clearfix"></div>

                        </div>
                        <div class="x_content">
                            <div class="title_right">
                                <div class="col-md-6 col-sm-12 col-xs-12 form-group pull-right top_search">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Buscar por.." value=""
                                            id="tbUsers_InpBuscar">
                                        <span class="input-group-btn">
                                            <button class="btn" type="button">Buscar</button>
                                        </span>
                                    </div>
                                </div>
                            </div>


                            <p class="col-md-6 col-sm-12 col-xs-12">
                                <a href="#" class="btn btn-outline-primary" data-toggle="modal" data-target="#mdlUser__new">
                                    <i class="fa fa-user"></i> Agregar</a>
                                Lista de cuentas de emplados registrados
                            </p>


                            <div class="table-responsive">
                                <table id="tbUsers" class="table table-striped jambo_table bulk_action" style="width:100%">
                                    <thead>
                                        <tr class="headings">
                                            <th class="column-title">C&eacute;dula</th>
                                            <th class="column-title">Usuario</th>
                                            <th class="column-title">Sexo</th>
                                            <th class="column-title">Email</th>
                                            <th class="column-title">Tel&eacute;fono</th>
                                            <th class="column-title">Direcci&oacute;n</th>
                                            <th class="column-title">Rol</th>
                                            <th class="column-title">Acci&oacute;n</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @forelse ($users as $item)
                                            <tr class="even pointer">
                                                <td><label class="a-center cedula">{{ $item->cedula }}</label></td>
                                                <td><label class="a-center nombre">{{ $item->nombre }}</label> <label
                                                        class="apellido">{{ $item->apellido }}</label></td>
                                                <td><label class="sexo">{{ $item->sexo }}</label></td>
                                                <td><label class="email">{{ $item->email }}</label></td>
                                                <td><label class="telefono">{{ $item->telefono }}</label></td>
                                                <td><label class="direccion">{{ $item->direccion }}</label></td>
                                                <td><label class="role">{{ $item->role->role }}</label></td>

                                                <td>
                                                    <div class="btn-group">
                                                        <form method="POST" action="{{ route('users.update', $item->id) }}">
                                                            <input type="hidden" name="tipe" value="newKey">
                                                            <input type="hidden" name="_token"
                                                                value="{{ csrf_token() }}">
                                                            {!! method_field('PUT') !!}
                                                            <button type="submit" class="btn btn-primary btn-xs btn-block"><i class="fa fa-key"></i> </button>
                                                        </form>

                                                        <!--a  href="#" class="btn btn-primary mdlUser__edit"  data-toggle="modal" data-target="#mdlUser"><i class="fa fa-key"></i></a-->
                                                        &nbsp;&nbsp;
                                                        <form method="POST" action="{{ route('users.destroy', $item->id) }}">
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                            {!! method_field('DELETE') !!}
                                                            <button type="submit" class="btn btn-danger btn-xs btn-block"><i class="fa fa-times"></i> </button>
                                                        </form>
                                                    </div>
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
                    Registrar Cuenta
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_content">
                                <form class="form-horizontal form-label-left" method="POST"
                                    action="{{ route('users.update', 1) }}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="tipe" value="updateInformationUser">
                                    <input type="hidden" name="user_au" value="{{ auth()->user()->id }}">
                                    <input type="hidden" name="role_au" value="{{ auth()->user()->role_id }}">
                                    {!! method_field('PUT') !!}

                                    {{-- <p>For alternative valsidation library <code>parsleyJS</code> check out in the <a href="form.html">form page</a> </p> --}}
                                    <span class="section">Informaci&oacute;n Personal</span>

                                    <div class="form-group row">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align">Rol</label>
                                        <div class="col-md-6 col-sm-6 ">
                                            <select class="form-control" id="rol" name="rol">
                                                @forelse ($roles as $role)
                                                    <option value="{{ $role->id }}">{{ $role->role }}</option>
                                                @empty
                                                @endforelse

                                            </select>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align"
                                            for="cedula">C&eacute;dula </label>
                                        <div class="col-md-6 col-sm-6">
                                            <input type="text" id="cedula" name="cedula" value="" class="form-control"
                                                required="required">
                                        </div>
                                    </div>


                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="nombre">Nombre
                                        </label>
                                        <div class="col-md-6 col-sm-6">
                                            <input type="text" id="nombre" name="nombre"
                                                onKeyPress="return fn_aceptaNum(event)" value="" required="required"
                                                class="form-control">
                                        </div>
                                        {{-- <div class="alert">please put something here</div> --}}
                                    </div>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="apellido">Apellido
                                        </label>
                                        <div class="col-md-6 col-sm-6">
                                            <input type="text" id="apellido" name="apellido" value="" required="required"
                                                class="form-control">
                                        </div>
                                        {{-- <div class="alert">please put something here</div> --}}
                                    </div>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="sexo">Sexo </label>
                                        <div class="col-md-6 col-sm-6">

                                            <p>M: <input type="radio" class="flat" name="sexo" id="genderM"
                                                    value="M" checked data-parsley-multiple="gender"
                                                    style="position: absolute; opacity: 0;">
                                                F: <input type="radio" class="flat" name="sexo" id="genderF"
                                                    value="F" data-parsley-multiple="gender"
                                                    style="position: absolute; opacity: 0;">
                                            </p>

                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align"
                                            for="telefono">Tel&eacute;fono </label>
                                        <div class="col-md-6 col-sm-6">
                                            <input type="text" id="telefono" name="telefono" value="" required="required"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align"
                                            for="direccion">Direcci&oacute;n </label>
                                        <div class="col-md-6 col-sm-6">
                                            <input type="text" id="direccion" name="direccion" value="" required="required"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label for="password" class="col-form-label col-md-3 label-align">Correo</label>
                                        <div class="col-md-6 col-sm-6">
                                            <input type="email" id="email" name="email" value="" class="form-control"
                                                required="required">
                                        </div>
                                        {{-- <div class="alert">please put something here</div> --}}
                                    </div>

                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-6 offset-md-3">
                                            <br>
                                            <button class="btn btn-primary" data-dismiss="modal">Cancelar</button>
                                            <button id="send" type="submit" class="btn btn-success">Guardar
                                                Informaci&oacute;n</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--- update -->
    <div class="modal fade" id="mdlUser__new" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    Registrar Cuenta
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_content">
                                <form class="form-horizontal form-label-left" method="POST"
                                    action="{{ route('users.store') }}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="tipe" value="">
                                    <input type="hidden" name="user_au" value="{{ auth()->user()->id }}">
                                    <input type="hidden" name="role_au" value="{{ auth()->user()->role_id }}">
                                    {{-- <p>For alternative valsidation library <code>parsleyJS</code> check out in the <a href="form.html">form page</a> </p> --}}
                                    <span class="section">Informaci&oacute;n Personal</span>

                                    <div class="form-group row">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align">Rol</label>
                                        <div class="col-md-6 col-sm-6 ">
                                            <select class="form-control" id="rol" name="rol">
                                                @forelse ($roles as $role)
                                                    @if ($role->id != 1)
                                                        <option value="{{ $role->id }}">{{ $role->role }}</option>
                                                    @endif
                                                @empty
                                                @endforelse

                                            </select>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align"
                                            for="cedula">C&eacute;dula </label>
                                        <div class="col-md-6 col-sm-6">
                                            <input type="text" id="cedula" name="cedula" value=""
                                                onKeyPress="return fn_aceptaNum(event)" class="form-control"
                                                required="required">
                                        </div>
                                    </div>


                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="nombre">Nombre
                                        </label>
                                        <div class="col-md-6 col-sm-6">
                                            <input type="text" id="nombre" name="nombre" value=""
                                                onKeyPress="return fn_aceptaLETRAS(event)" required="required"
                                                class="form-control">
                                        </div>
                                        {{-- <div class="alert">please put something here</div> --}}
                                    </div>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="apellido">Apellido
                                        </label>
                                        <div class="col-md-6 col-sm-6">
                                            <input type="text" id="apellido" name="apellido" value=""
                                                onKeyPress="return fn_aceptaLETRAS(event)" required="required"
                                                class="form-control">
                                        </div>
                                        {{-- <div class="alert">please put something here</div> --}}
                                    </div>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="sexo">Sexo
                                        </label>
                                        <div class="col-md-6 col-sm-6">

                                            <p>M: <input type="radio" class="flat" name="sexo" id="genderM"
                                                    value="M" checked data-parsley-multiple="gender"
                                                    style="position: absolute; opacity: 0;">
                                                F: <input type="radio" class="flat" name="sexo" id="genderF"
                                                    value="F" data-parsley-multiple="gender"
                                                    style="position: absolute; opacity: 0;">
                                            </p>

                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align"
                                            for="telefono">Tel&eacute;fono </label>
                                        <div class="col-md-6 col-sm-6">
                                            <input type="text" id="telefono" name="telefono" value=""
                                                onKeyPress="return fn_aceptaNum(event)" required="required"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align"
                                            for="direccion">Direcci&oacute;n </label>
                                        <div class="col-md-6 col-sm-6">
                                            <input type="text" id="direccion" name="direccion" value="" required="required"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label for="password" class="col-form-label col-md-3 label-align">Correo</label>
                                        <div class="col-md-6 col-sm-6">
                                            <input type="email" id="email" name="email" value="" class="form-control"
                                                required="required">
                                        </div>
                                        {{-- <div class="alert">please put something here</div> --}}
                                    </div>

                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-6 offset-md-3">
                                            <br>
                                            <button class="btn btn-primary" data-dismiss="modal">Cancelar</button>
                                            <button id="send" type="submit" class="btn btn-success">Guardar
                                                Informaci&oacute;n</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- fin -->

@endsection
@section('scrpts-jqrey')
    <script>
        var tbUsers;
        fn_tbUsers_ini();

        function fn_tbUsers_ini() {
            tbUsers = $('#tbUsers').DataTable({
                dom: '<"top">rt<"bottom"><"clear">',
                pageLength: 30,
                order: [
                    [5, "desc"]
                ],
                drawCallback: function(settings) {
                    //CARGANDO
                },
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
        }

        $("#tbUsers_InpBuscar").on('keyup', function(event) {
            tbUsers.search(this.value).draw();
        });



        $(".mdlUser__edit").on('click', function() {
            var cedula = $(this).closest("tr").find('label.cedula');
            var nombre = $(this).closest("tr").find('label.nombre');
            var apellido = $(this).closest("tr").find('label.apellido');
            var sexo = $(this).closest("tr").find('label.sexo');
            var $sexo = $(sexo).text();
            var email = $(this).closest("tr").find('label.email');
            var telefono = $(this).closest("tr").find('label.telefono');
            var direccion = $(this).closest("tr").find('label.direccion');
            var role = $(this).closest("tr").find('label.role');
            var $rol = $(role).text();

            $("#cedula").val($(cedula).text());
            $("#nombre").val($(nombre).text());
            $("#apellido").val($(apellido).text());
            if ($sexo == 'M') {
                $("#genderM").attr('checked', true);
            }
            if ($sexo == 'F') {
                $("#genderF").attr('checked', true);
            }
            $("#email").val($(email).text());
            $("#telefono").val($(telefono).text());
            $("#direccion").val($(direccion).text());

        });
    </script>
@endsection
