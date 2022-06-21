@extends('layout')

@section('title', 'CB - atacames')
@section('icono', 'favicon.png')

@section('pagecontent')


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
            toastr.warning($("#Respuesta_wn").text(), 'Alerta', {
                timeOut: 5000
            });
        </script>
    @endif

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
            </div>
            <br>
            <div class="row">
                <div class="col-md-12 col-sm-12 ">

                    <div class="x_panel">
                        <div class="x_content">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="card text-center">
                                        <div class="card-header">
                                            Información Personal
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                @if (empty(auth()->user()->foto))
                                                    @if (auth()->user()->sexo == 'M')
                                                        <img class="img-responsive avatar-view"
                                                            src="./assets/img/users/invitado.jpg" alt="Foto de Perfil"
                                                            style="width: 150px">
                                                    @else
                                                        <img class="img-responsive avatar-view"
                                                            src="./assets/img/users/mujer.jpg" alt="Foto de Perfil"
                                                            style="width: 150px">
                                                    @endif
                                                @else
                                                    <img class="img-responsive avatar-view"
                                                        src="./assets/img/users/{{ auth()->user()->foto }}"
                                                        alt="Foto de Perfil" style="width: 150px">
                                                @endif
                                            </h5>
                                            <p class="card-text">
                                            <h3>{{ auth()->user()->nombre . ' ' . auth()->user()->apellido }}</h3>

                                            <ul class="list-unstyled user_data">
                                                <li>
                                                    <i class="fa fa-briefcase user-profile-icon"></i>
                                                    {{ auth()->user()->role->role }}
                                                </li>
                                                <li>
                                                    <i class="fa fa-phone"></i> {{ auth()->user()->telefono }}
                                                </li>

                                                <li>
                                                    <i class="fa fa-map-marker user-profile-icon"></i>
                                                    {{ auth()->user()->direccion }}
                                                </li>

                                                <li>
                                                    <i class="fa fa-envelope"></i> {{ auth()->user()->email }}
                                                </li>
                                            </ul>
                                            </p>
                                            <button class="btn btn-success btn-block" data-toggle="modal"
                                                data-target="#mdlPerfil"><i class="fa fa-edit m-right-xs"></i> Editar Peril
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="card text-center">
                                        <div class="card-header">
                                            Cambio de Contraseña
                                        </div>
                                        <div class="card-body">
                                            <p class="card-text">
                                            <form class="form-horizontal form-label-left" method="POST"
                                                action="{{ route('profile.update', auth()->user()->id) }}">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="hidden" name="tipe" value="updatePasword">
                                                {!! method_field('PUT') !!}


                                                <div class="item form-group">
                                                    <label class="col-form-label label-align" for="cedula">Nueva
                                                        Contraseña</label>
                                                    <div class="col-md-10">
                                                        <input type="password" id="contraseniaNueva" name="contraseniaNueva"
                                                            value="" class="form-control" required="required">
                                                    </div>
                                                </div>

                                                <div class="item form-group">
                                                    <label class="col-form-label label-align" for="cedula">Confirme
                                                        Contraseña</label>
                                                    <div class="col-md-10">
                                                        <input type="password" id="confirmaContrasenia"
                                                            name="confirmaContrasenia" value="" class="form-control"
                                                            required="required">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-md-6 offset-md-3">
                                                        <button id="send" type="submit"
                                                            class="btn btn-success btn-block">Actualizar Contraseña</button>
                                                    </div>
                                                </div>
                                            </form>
                                            </p>
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
    <!-- /page content -->


    <div class="modal fade" id="mdlPerfil" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 90%!important;" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> <i class="fa fa-user"></i> EDITAR PERFIL</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_content">
                                <form class="form-horizontal form-label-left" method="POST"
                                    action="{{ route('profile.update', auth()->user()->id) }}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="tipe" value="updateInformationUser">
                                    {!! method_field('PUT') !!}

                                    <!--FIN FORMULARIO DE INSPECCIÓN--->


                                    {{-- <p>For alternative valsidation library <code>parsleyJS</code> check out in the <a href="form.html">form page</a> </p> --}}
                                    <span class="section">Informaci&oacute;n Personal</span>


                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align"
                                            for="cedula">C&eacute;dula </label>
                                        <div class="col-md-6 col-sm-6">
                                            <input type="text" id="cedula" name="cedula"
                                                value="{{ auth()->user()->cedula }}"
                                                onKeyPress="return fn_aceptaNum(event)" class="form-control"
                                                required="required">
                                        </div>
                                    </div>

                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="nombre">Nombre
                                        </label>
                                        <div class="col-md-6 col-sm-6">
                                            <input type="text" id="nombre" name="nombre"
                                                value="{{ auth()->user()->nombre }}"
                                                onKeyPress="return fn_aceptaLETRAS(event)" required="required"
                                                class="form-control">
                                        </div>
                                        {{-- <div class="alert">please put something here</div> --}}
                                    </div>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="apellido">Apellido
                                        </label>
                                        <div class="col-md-6 col-sm-6">
                                            <input type="text" id="apellido" name="apellido"
                                                value="{{ auth()->user()->apellido }}"
                                                onKeyPress="return fn_aceptaLETRAS(event)" required="required"
                                                class="form-control">
                                        </div>
                                        {{-- <div class="alert">please put something here</div> --}}
                                    </div>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="sexo">Sexo </label>
                                        <div class="col-md-6 col-sm-6">

                                            <p>
                                                @if (auth()->user()->sexo == 'M')
                                                    M: <input type="radio" class="flat" name="sexo" id="genderM"
                                                        value="M" checked data-parsley-multiple="gender"
                                                        style="position: absolute; opacity: 0;">
                                                    F: <input type="radio" class="flat" name="sexo" id="genderF"
                                                        value="F" data-parsley-multiple="gender"
                                                        style="position: absolute; opacity: 0;">
                                                @else
                                                    M: <input type="radio" class="flat" name="sexo" id="genderM"
                                                        value="M" data-parsley-multiple="gender"
                                                        style="position: absolute; opacity: 0;">
                                                    F: <input type="radio" class="flat" name="sexo" id="genderF"
                                                        value="F" checked data-parsley-multiple="gender"
                                                        style="position: absolute; opacity: 0;">
                                                @endif
                                            </p>

                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align"
                                            for="telefono">Tel&eacute;fono </label>
                                        <div class="col-md-6 col-sm-6">
                                            <input type="text" id="telefono" name="telefono"
                                                onKeyPress="return fn_aceptaNum(event)"
                                                value="{{ auth()->user()->telefono }}" required="required"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align"
                                            for="direccion">Direcci&oacute;n </label>
                                        <div class="col-md-6 col-sm-6">
                                            <input type="text" id="direccion" name="direccion"
                                                value="{{ auth()->user()->direccion }}" required="required"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="item form-group">
                                        <label for="password" class="col-form-label col-md-3 label-align">Correo</label>
                                        <div class="col-md-6 col-sm-6">
                                            <input type="email" id="email" name="email"
                                                value="{{ auth()->user()->email }}" disabled class="form-control"
                                                required="required">
                                        </div>
                                    </div>


                                    <hr>
                                    <div class="form-group">
                                        <div class="col-md-6 offset-md-3">
                                            <br>
                                            <button class="btn btn-primary" data-dismiss="modal">Cancelar</button>
                                            <button id="send" type="submit" class="btn btn-success">Actualizar
                                                Informacion</button>
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

@endsection
@section('scrpts-jqrey')

@endsection
