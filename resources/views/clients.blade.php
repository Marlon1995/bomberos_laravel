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
                            <h2><i class="fa fa-fire-extinguisher"></i> Formularios de Inspecci&oacute;n </h2>
                        </div>
                        <div class="title_right">
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group pull-right top_search">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Buscar por.." value=""
                                        id="tbClientes_InpBuscar">
                                    <span class="input-group-btn">
                                        <button class="btn" type="button">Buscar</button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <!-- tabla clientes--->
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                @if (auth()->user()->hasRoles([4]))
                                    <a href="#" class="btn btn-outline-primary" data-toggle="modal"
                                        data-target="#mdlNuevEmpleado"> <i class="fa fa-user"></i> Agregar</a>
                                @endif
                                <p>Listado de Formularios de Inspecci&oacute;n registrados</p>

                                <div class="table-responsive">
                                    <table id="tbClientes" class="table table-striped jambo_table bulk_action"
                                        style="width:100%;">
                                        <thead>
                                            <tr class="headings">
                                                <th class="column-title">RUC</th>
                                                <th class="column-title">RAZ&Oacute;N. SOCIAL</th>
                                                <th class="column-title">REP. LEGAL</th>
                                                <th class="column-title">CATEGOR&Iacute;A</th>
                                                <th class="column-title">DENOMINACI&Oacute;N</th>
                                                <th class="column-title">AÑO PAGO</th>
                                                <th class="column-title no-link last"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($clients as $item)
                                                <!---INPECTOR ROL 4--->
                                                @if (auth()->user()->hasRoles([4]))
                                                    <tr class="even pointer">
                                                        <td><label class="a-center ruc">{{ $item->ruc }}</label></td>
                                                        <td><label
                                                                class="a-center razonSocial">{{ $item->razonSocial }}</label>
                                                        </td>
                                                        <td><label
                                                                class="a-center representanteLegal">{{ $item->representanteLegal }}</label>
                                                        </td>
                                                        <td><label class="a-center denominacion">{{ $item->anio }}</label>
                                                        </td>
                                                        <td><label
                                                                class="a-center categorias">{{ $item->categorias }}</label>
                                                        </td>
                                                        <td><label
                                                                class="a-center denominacion">{{ $item->denominacion }}</label>
                                                        </td>
                                                        <td class="a-center last">
                                                            @if ($item->estado == 4)
                                                                <div class="btn btn-success btn-block">ACTIVO</div>
                                                            @elseif($item->estado == 2 || $item->estado == 5)
                                                                <div class="btn btn-info btn-block">PENDIENTE</div>
                                                            @elseif($item->estado == 6)
                                                                <div class="btn btn-warning btn-block">SOLICITADO</div>
                                                            @else
                                                                <div class="btn btn-success btn-block">EMITIDO</div>
                                                            @endif
                                                        </td>
                                                        <td style="	white-space:nowrap;">



                                                            @if ($item->estado == 2)
                                                                <div style="width: 130px">
                                                                    <a href="clients/{{ $item->id }}"
                                                                        class="btn btn-primary"><i
                                                                            class="fa fa-file-text-o"></i></a>
                                                                    <a href="#"
                                                                        class="btn btn-warning mdlModificaEmpleado"
                                                                        data-toggle="modal"
                                                                        data-idmodCli="{{ $item->id }}"
                                                                        data-target="#mdlModificaEmpleado"><i
                                                                            class="fa fa-edit"></i></a>
                                                                </div>
                                                            @endif


                                                            @if ($item->estado == 4 || $item->estado == 6)
                                                                <div style="width: 130px">
                                                                    <form method="POST"
                                                                        action="{{ route('clients.update', $item->id) }}">
                                                                        <input type="hidden" name="_token"
                                                                            value="{{ csrf_token() }}">
                                                                        <input type="hidden" name="caso"
                                                                            value="solicitar">
                                                                        {!! method_field('PUT') !!}
                                                                        <button type="submit" class="btn btn-info"><i
                                                                                class="fa fa-envelope-o"
                                                                                style="color: white;"></i></button>
                                                                        <a href="formulario-cliente-pdf/{{ $item->id }}"
                                                                            class="btn btn-outline-primary"
                                                                            target="_blank"><i
                                                                                class="fa fa-file-pdf-o"></i></a>

                                                                    </form>
                                                                </div>
                                                            @endif


                                                            @if ($item->estado == 5)
                                                                <div style="width: 130px">
                                                                    <form method="POST"
                                                                        action="{{ route('clients.update', $item->id) }}">
                                                                        <input type="hidden" name="_token"
                                                                            value="{{ csrf_token() }}">
                                                                        <input type="hidden" name="caso"
                                                                            value="update_emitir">
                                                                        {!! method_field('PUT') !!}

                                                                        <a href="clients-edit/{{ $item->id }}"
                                                                            class="btn btn-primary"><i
                                                                                class="fa fa-file-text-o"></i></a>
                                                                        <a href="#"
                                                                            class="btn btn-warning mdlModificaEmpleado"
                                                                            data-toggle="modal"
                                                                            data-idmodCli="{{ $item->id }}"
                                                                            data-target="#mdlModificaEmpleado"><i
                                                                                class="fa fa-edit"></i></a>
                                                                        <button type="submit" class="btn btn-success"><i
                                                                                class="fa fa-check-circle"
                                                                                style="color: white;"></i></button>
                                                                    </form>
                                                                </div>
                                                            @endif

                                                        </td>
                                                    </tr>
                                                @endif




                                                <!---SECRETARIA  ROL 3-->
                                                @if (auth()->user()->hasRoles([3]))
                                                    @if ($item->estado == 4 || $item->estado == 6 || $item->estado == 7 || $item->estado == 8)
                                                        <tr class="even pointer">
                                                            <td class="a-center">{{ $item->ruc }}</td>
                                                            <td class="a-center" style="width: 10%">
                                                                {{ $item->razonSocial }}</td>
                                                            <td class="a-center" style="width: 15%">
                                                                {{ $item->representanteLegal }}</td>
                                                            <td>{{ $item->categorias }}</td>
                                                            <td>{{ $item->denominacion }}</td>
                                                            <td>{{ $item->anio }}</td>
                                                            <td style="	white-space:nowrap;">
                                                                @if ($item->estado == 6)
                                                                    <form method="POST"
                                                                        action="{{ route('clients.update', $item->id) }}">
                                                                        <input type="hidden" name="_token"
                                                                            value="{{ csrf_token() }}">
                                                                        <input type="hidden" name="caso"
                                                                            value="autorizar_reinspeccion">
                                                                        <input type="hidden" name="user_au"
                                                                            value="{{ auth()->user()->id }}">
                                                                        <input type="hidden" name="role_au"
                                                                            value="{{ auth()->user()->role_id }}">
                                                                        {!! method_field('PUT') !!}
                                                                        <button type="submit"
                                                                            class="btn btn-warning btn-block">
                                                                            REINSPECCI&Oacute;N
                                                                        </button>
                                                                    </form>
                                                                @endif
                                                                @if ($item->estado == 4)
                                                                    <form method="POST"
                                                                        action="{{ route('clients.update', $item->id) }}">
                                                                        <input type="hidden" name="_token"
                                                                            value="{{ csrf_token() }}">
                                                                        <input type="hidden" name="caso"
                                                                            value="autorizar_reinspeccion">
                                                                        {!! method_field('PUT') !!}
                                                                        <a href="{{ route('permiso-funcionamiento.show', $item->id) }}"
                                                                            class="btn btn-success">Emitir</a>

                                                                        <button type="submit"
                                                                            class="btn btn-warning">Reinspecci&oacute;n</button>

                                                                    </form>
                                                                @endif
                                                                @if ($item->estado == 7)
                                                                    <a href="#"
                                                                        class="btn btn-info btn-block">EMITIDO </a>
                                                                @endif


                                                                @if ($item->estado == 8)
                                                                    <form method="POST"
                                                                        action="{{ route('clients.update', $item->id) }}">
                                                                        <input type="hidden" name="_token"
                                                                            value="{{ csrf_token() }}">
                                                                        <input type="hidden" name="caso"
                                                                            value="revertir_permiso">
                                                                        {!! method_field('PUT') !!}
                                                                        <button type="submit"
                                                                            class="btn btn-danger btn-block">Revertir
                                                                            Permiso</button>
                                                                    </form>
                                                                @endif




                                                            </td>
                                                            <td>
                                                                @if ($item->estado == 4 || $item->estado == 6)
                                                                    <!-- el estado 4 es cuando ya grabo y espera solicitar pago--->
                                                                    <a href="formulario-cliente-pdf/{{ $item->id }}"
                                                                        class="btn btn-outline-primary" target="_blank"><i
                                                                            class="fa fa-file-pdf-o"></i> </a>
                                                                @endif

                                                                @if ($item->estado == 8)
                                                                    <a href="permiso/{{ $item->id }}"
                                                                        class="btn btn-info" target="_blank"><i
                                                                            class="fa fa-eye"></i></a>
                                                                @endif

                                                                @if ($item->estado == 7)
                                                                    <a href="#"
                                                                        class="btn btn-outline-info mdlInfroPago__Client"
                                                                        data-toggle="modal"
                                                                        data-target="#mdlInfroPago__Client"
                                                                        data-razonSocial="{{ $item->razonSocial }}"
                                                                        data-representanteLegal="{{ $item->representanteLegal }}"
                                                                        data-ruc="{{ $item->ruc }}"
                                                                        data-idCli="{{ $item->id }}"><i
                                                                            class="fa fa-eye"></i></a>
                                                                @endif

                                                            </td>

                                                        </tr>
                                                    @endif
                                                @endif

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
    </div>
    </div>
    </div>
    <!-- /page contsent -->


    <!-- Modal mdlNuevEmpleado-->
    <div class="modal fade" id="mdlNuevEmpleado" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 90%!important;" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> <i class="fa fa-user"></i> FORMULARIO DE REGISTRO DE USUARIOS</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="x_panel">
                        <div class="x_title cb-subTitle"><b>FORMULARIO DE INSPECCI&Oacute;N</b></div>
                        <div class="x_content">

                            <form class="form-horizontal form-label-left" method="POST"
                                action="{{ route('clients.store') }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="user_au" value="{{ auth()->user()->id }}">
                                <input type="hidden" name="role_au" value="{{ auth()->user()->role_id }}">
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
                                <!--FIN FORMULARIO DE INSPECCIÓN--->

                                <!--INFORMACIÓN GENERAL-->
                                <div class="x_title cb-subTitle">INFORMACI&Oacute;N GENERAL</div>
                                <div class="form-group row">
                                    <label class="control-label col-md-4 col-sm-4 ">RUC</label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" name="ruc" id="ruc"
                                            onKeyPress="return fn_aceptaNum(event)" class="form-control col-md-5"
                                            required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-md-4 col-sm-4 ">RAZ&Oacute;N SOCIAL <small>(NOMBRE
                                            COMERCIAL)</small> </label>
                                    <div class="col-md-8 col-sm-8 ">
                                        <input type="text" name="razonSocial" id="razonSocial"
                                            class="form-control col-md-11" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-md-4 col-sm-4 ">REPRESENTANTE LEGAL
                                        <small>(PROPIETARIO)</small> </label>
                                    <div class="col-md-8 col-sm-8 ">
                                        <input type="text" name="representanteLegal" id="representanteLegal"
                                            onKeyPress="return fn_aceptaLETRAS(event)" class="form-control col-md-11"
                                            required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-md-2 col-sm-2">PARROQUIA</label>
                                    <div class="col-md-4 col-sm-4">
                                        <select class="form-control" name="parroquia" id="parroquia">
                                            @forelse ($sector as $item)
                                                <option value="{{ $item->id }}">{{ $item->descripcion }}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-sm-6 ">
                                        <label class="control-label col-md-2 col-sm-2 ">BARRIO</label>
                                        <input type="text" name="barrio" id="barrio"
                                            onKeyPress="return fn_aceptaLETRAS(event)" class="form-control col-md-6"
                                            required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-md-2 col-sm-2 ">REFERENCIA</label>
                                    <div class="col-md-8 col-sm-8 ">
                                        <textarea name="referencia" id="referencia" class="form-control col-md-10" required></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-md-2 col-sm-2">TEL&Eacute;FONO: </label>
                                    <div class="col-md-3 col-sm-3 ">
                                        <input type="text" name="telefono" id="telefono"
                                            onKeyPress="return fn_aceptaNum(event)" class="form-control col-md-10"
                                            required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-md-2 col-sm-2">E-MAIL: </label>
                                    <div class="col-md-7 col-sm-7 ">
                                        <input type="email" name="email" id="email"
                                            class="form-control col-md-10" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-md-2 col-sm-2 ">CATEGOR&Iacute;A</label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <select class="form-control" name="categoria" id="categoria">
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
                                        <select class="form-control" name="actividad" id="actividad"></select>
                                    </div>
                                </div>

                                <!--fin INFORMACIÓN GENERAL-->


                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 offset-md-3">
                                        <button class="btn btn-primary" data-dismiss="modal">Cancelar</button>
                                        <button type="submit"
                                            class="btn btn-success btn__infoPersoanlCli">Guardar</button>
                                    </div>.ñ
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


    <!--  marlon -->
    <div class="modal fade" id="mdlModificaEmpleado" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 90%!important;" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> <i class="fa fa-pencil"></i> MODIFICAR INFORMACI&Oacute;N DE USUARIOS
                    </h5>
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
                                <input type="hidden" name="caso" value="update_info">
                                <input type="hidden" name="clietn_id" id="clietn_id" value="">
                                <!--FORMULARIO DE INSPECCIÓN--->
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="col-md-3 col-sm-3 ">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="radio" name="tipoInspecion" id="tipoInspecion_md"
                                                            value="1" class="flat" checked> INSPECCI&Oacute;N
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-3 ">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="radio" name="tipoInspecion" id="tipoInspecion_md"
                                                            value="2" class="flat"> RE-INSPECCI&Oacute;N
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
                                <!--FIN FORMULARIO DE INSPECCIÓN--->

                                <!--INFORMACIÓN GENERAL-->
                                <div class="x_title cb-subTitle">INFORMACI&Oacute;N GENERAL</div>
                                <div class="form-group row">
                                    <label class="control-label col-md-4 col-sm-4 ">RUC</label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" name="ruc" id="ruc_md"
                                            onKeyPress="return fn_aceptaNum(event)" value=""
                                            class="form-control col-md-5" value="" required disabled="">
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
                                    <label class="control-label col-md-4 col-sm-4 ">REPRESENTANTE LEGAL
                                        <small>(PROPIETARIO)</small> </label>
                                    <div class="col-md-8 col-sm-8 ">
                                        <input type="text" name="representanteLegal"
                                            onKeyPress="return fn_aceptaLETRAS(event)" id="representanteLegal_md"
                                            value="" class="form-control col-md-11" required>
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
                                            onKeyPress="return fn_aceptaNum(event)" value=""
                                            class="form-control col-md-10" required>
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
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>


    <style>
        .tamano___letrainfo {
            font-size: 20px;
        }

        .td__pagos tr th b {
            margin-left: 20px;
        }
    </style>

    <div class="modal fade" id="mdlInfroPago__Client" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 90%!important;" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
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
                                    <div class="container">
                                        <div class="row" style="border: 1px solid;">
                                            <div class="col-sm-1"></div>
                                            <div class="col-sm-5" style="text-align: left;padding: 10px">
                                                <p class="margin_p"><b>NOMBRE DEL LOCAL</b></p>
                                                <p class="margin_p"><b>REPRESENTANTE /PROPIETARIO</b></p>
                                                <p class="margin_p"><b>RUC</b></p>
                                                <p class="margin_p"><b>DIRECCI&Oacute;N</b></p>
                                                <p class="margin_p"><b>TEL&Eacute;FONO</b></p>
                                                <p class="margin_p"><b>CATEGORIA</b></p>

                                            </div>
                                            <div class="col-sm-5" style="text-align: left;padding: 10px">
                                                <p class="margin_p" id="razonSocial__MdPagos"></p>
                                                <p class="margin_p" id="repLegar__MdPagos"></p>
                                                <p class="margin_p" id="ruc__mdPAgos"></p>
                                                <p class="margin_p" id="direccion__MdPagos"></p>
                                                <p class="margin_p" id="telefono__MdPagos"></p>
                                                <p class="margin_p" id="catgoria__MdPagos"></p>
                                            </div>
                                            <div class="col-sm-1"></div>
                                        </div>

                                        <div class="row" style="border: 1px solid;">
                                            <div class="col-sm-1"></div>
                                            <div class="col-sm-5" style="text-align: left;padding: 10px">
                                                <p class="margin_p"><b>T. Anticipos:
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </b> <label
                                                        id="anticipos__mdpagos"></label></p>
                                                <p class="margin_p"><b>T. Descuentos:
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </b><label
                                                        id="descuentos__mdpagos"></label></p>
                                                <p class="margin_p"><b>T. Impuesto BCE: &nbsp;&nbsp; </b><label
                                                        id="RecargoTrimestral__mdpagos"></label></p>
                                                <p class="margin_p"><b>T. Tasa Anual:
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </b><label
                                                        id="TasaAnual__mdpagos"></label></p>
                                                <p class="margin_p"><b>Valor Tasa Anual: &nbsp;&nbsp;&nbsp;
                                                    </b><label id="TotalTasaAnual__mdpagos"></label></p>

                                            </div>
                                            <div class="col-sm-5" style="text-align: center;">
                                                <br><br>
                                                <p style="font-size: 20px; font-weight: bold"><b>TOTAL: </b><label
                                                        id="saldo__mdpagos"></label></p>
                                            </div>

                                            <div class="col-sm-1"></div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-sm-3"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>



@endsection
@section('scrpts-jqrey')
    <script>
        $(document).ready(function() {
            var combo_actividad = $("select[id=categoria]").val();
            var endpoint = 'denomincacniones/' + combo_actividad;
            $.ajax({
                async: false,
                type: "GET",
                dataType: "json",
                contentType: "application/x-www-form-urlencoded",
                url: endpoint,
                success: function(datos) {
                    $("#actividad").empty();
                    for (var i = 0; i < datos.length; i++) {
                        $("#actividad").append('<option value="' + datos[i]['id'] + '">' + datos[i][
                            'descripcion'
                        ] + ' </option>');
                        $("#actividad_md").append('<option value="' + datos[i]['id'] + '" >' + datos[i][
                            'descripcion'
                        ] + ' </option>');
                    }
                }
            });
        });
        // $(".btn__infoPersoanlCli").hide();



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
        $("#categoria").change(function() {
            var combo_actividad = $("select[id=categoria]").val();
            var endpoint = 'denomincacniones/' + combo_actividad;
            $.ajax({
                async: false,
                type: "GET",
                dataType: "json",
                contentType: "application/x-www-form-urlencoded",
                url: endpoint,
                success: function(datos) {
                    $("#actividad").empty();
                    for (var i = 0; i < datos.length; i++) {
                        $("#actividad").append('<option value="' + datos[i]['id'] + '">' + datos[i][
                            'descripcion'
                        ] + ' </option>');
                    }
                }
            });
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
                        //  $(".btn__infoPersoanlCli").hide();
                        toastr.error('El RUC: ' + datos[0].ruc + ', YA EXISTE');
                        $("#razonSocial").val(datos[0].razonSocial);
                        $("#representanteLegal").val(datos[0].representanteLegal);
                        $("#barrio").val(datos[0].barrio);
                        $("#referencia").val(datos[0].referencia);
                        $("#telefono").val(datos[0].telefono);
                        $("#email").val(datos[0].email);
                        return true;
                    }
                    toastr.success('No existen coincidencias, ' + datos[0].ruc);
                    // $(".btn__infoPersoanlCli").show();
                    $("#razonSocial").val("");
                    $("#representanteLegal").val("");
                    $("#barrio").val("");
                    $("#referencia").val("");
                    $("#telefono").val("");
                    $("#email").val("");
                    return true;
                }
            });
        });


        $(".mdlInfroPago__Client").on('click', function() {

            var endpoint = 'resumenPago/' + $(this).attr("data-idCli");

            $.ajax({
                async: false,
                type: "GET",
                dataType: "json",
                contentType: "application/x-www-form-urlencoded",
                url: endpoint,
                success: function(datos) {
                    $("#razonSocial__MdPagos").text(datos['cliente']['razonSocial']);
                    $("#repLegar__MdPagos").text(datos['cliente']['representanteLegal']);
                    $("#ruc__mdPAgos").text(datos['cliente']['ruc']);
                    $("#direccion__MdPagos").text(datos['cliente']['direccion']);
                    $("#telefono__MdPagos").text(datos['cliente']['telefono']);
                    $("#catgoria__MdPagos").text(datos['cliente']['categoria']);
                    $("#saldo__mdpagos").text('$ ' + datos['cliente']['saldo']);
                    $("#anticipos__mdpagos").text('$ ' + datos['Pagos']['anticipos']);
                    $("#descuentos__mdpagos").text('$ ' + datos['Pagos']['descuentos']);
                    $("#RecargoTrimestral__mdpagos").text('$ ' + datos['Pagos']['RecargoTrimestral']);
                    $("#TasaAnual__mdpagos").text('$ ' + datos['Pagos']['TasaAnual']);
                    $("#TotalTasaAnual__mdpagos").text('$ ' + datos['Pagos']['TasaAnualR']);


                },
                error: function(d) {
                    toastr.error('Algo  salió mal, Reintente');
                }
            });
        });


        var tbClientes;
        var tbClientes;
        fn_tbClientes_ini();
        $("#tbClientes_InpBuscar").val("");

        function fn_tbClientes_ini() {
            tbClientes = $('#tbClientes').DataTable({
                dom: '<"top">rt<"bottom"><"clear">',
                pageLength: 20,
                order: [
                    [3, "asc"]
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
            });

        }
        $("#tbClientes_InpBuscar").on('keyup', function(event) {
            tbClientes.search(this.value).draw();
        });

        $(".mdlModificaEmpleado").click(function() {
            var valorID = $(this).attr("data-idmodCli");
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
                                        'id'
                                    ] + '">' + datos[i]['descripcion'] +
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
    </script>
@endsection
