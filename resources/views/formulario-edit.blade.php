@extends('layout')

@section('title', ucwords($data[0]->nombre))
@section('icono', $data[0]->icono)

@section('pagecontent')
    <!-- page content -->
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

        .imgFotoLocal {
            width: 250px;
            height: 250px;
            border: 1px solid black;
            margin: 3px 4px;
        }

        .cjaFotosLocal {
            margin-left: 50px;
        }
    </style>


    <div class="right_col" role="main">
        <div class="">
            <div class="x_panel">
                <div class="x_content">
                    <!--contenido-->
                    <div class="tab-content" id="myTabContent">
                        <!-- section nuevo clientes -->

                        <!-- titulo -->
                        <div class="cb-header-register">
                            <img src="/assets/img/icons/{{ $data[0]->logo }}" alt="@yield('title')"
                                class="cb-header-register__img">
                            <h1 class="cb-header-registe__title">CUERPO DE BOMBEROS <br>DEL CANT&Oacute;N ATACAMES</h1>
                        </div>

                        <div class="page-title">
                            <div class="title_left">
                                <p class="cb-header-registe_description"><b>
                                        ACUERDO MINISTERIAL No. 1616 DEL 29 DE OCTUBRE DE 1997 <br>
                                        REGISTRO OFICIAL No. 741 DEL 29 DE ENERO DEL 2019<br>
                                        RUC: 0860050690001 </b> </p>
                            </div>

                            <div class="title_right">
                                <p class="cb-header-register__Nro">Nro. {{ $client[0]->id }} </p>
                            </div>
                        </div>

                        <!---formulario--->
                        <div class="x_panel">
                            <div class="x_title cb-subTitle">
                                @if ($client[0]->id == 1)
                                    <b>FORMULARIO DE INSPECCI&Oacute;N</b>
                                @endif
                                @if ($client[0]->id == 2)
                                    <b>FORMULARIO DE RE-INSPECCI&Oacute;N</b>
                                @endif
                            </div>

                            <div class="x_content">
                                <!--INFORMACIÓN GENERAL-->
                                <div class="form-group row">
                                    <label class="control-label col-md-4 col-sm-4 ">RUC</label>
                                    <div class="col-md-6 col-sm-6 ">
                                        {{ $client[0]->ruc }}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-md-4 col-sm-4 ">RAZ&Oacute;N SOCIAL <small>(NOMBRE
                                            COMERCIAL)</small> </label>
                                    <div class="col-md-8 col-sm-8 ">
                                        {{ $client[0]->razonSocial }}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-md-4 col-sm-4 ">REPRESENTANTE LEGAL
                                        <small>(PROPIETARIO)</small> </label>
                                    <div class="col-md-8 col-sm-8 ">
                                        {{ $client[0]->representanteLegal }}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-md-2 col-sm-2">DIRECI&Oacute;N</label>
                                    <div class="col-md-10 col-sm-10 ">
                                        {{ $client[0]->parroquia }} / {{ $client[0]->barrio }} /
                                        {{ $client[0]->referencia }}
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-md-2 col-sm-2">TEL&Eacute;FONO: </label>
                                    <div class="col-md-3 col-sm-3 ">
                                        {{ $client[0]->telefono }}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-md-2 col-sm-2 ">DENOMINACI&Oacute;N</label>
                                    <div class="col-md-10 col-sm-10 ">
                                        {{ $client[0]->denominacion }}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-md-2 col-sm-2 ">CATEGOR&Iacute;A</label>
                                    <div class="col-md-3 col-sm-3 ">
                                        {{ $client[0]->categoria }}
                                    </div>
                                </div>


                                <!--fin INFORMACIÓN GENERAL-->

                                <form class="form-horizontal form-label-left" method="POST"
                                    action="{{ route('formulario.update', $client[0]->id) }}"
                                    enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    {!! method_field('PUT') !!}

                                    <!--REQUERIMIENTOS ESENCIALES--->
                                    <div class="x_title cb-subTitle"><b>REQUERIMIENTOS ESENCIALES</b></div>
                                    <p>RIESGOS DE INCENDIO </p>


                                    <div class="table-responsive">
                                        <table id="tbInstacionesElectricas"
                                            class="table table-striped jambo_table bulk_action" style="width:100%">
                                            <thead class="headings">
                                                <tr class="headings">
                                                    <th class="column-title cb-header-registe_description">
                                                        <p class="cb-subTitle">INSTALACIONES EL&Eacute;CTRICAS</p>
                                                    </th>
                                                    <th class="column-title cb-header-register__tbSi">SI</th>
                                                    <th class="column-title cb-header-register__tbNo">NO</th>
                                                    <th class="column-title cb-header-register__tbObservacion">
                                                        OBSERVACIONES
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($requerimientos as $item)
                                                    @if ($item->tipoRequerimiento == 'INSTALACIONES ELECTRICAS')
                                                        <tr class="even pointe">
                                                            <td>{{ $item->descripcion }}</td>
                                                            <td>
                                                                <div class="col-md-2 col-sm-2 ">
                                                                    <div class="checkbox">
                                                                        @if ($item->respuesta == 1)
                                                                            <label><input type="radio"
                                                                                    name="respuesta_{{ $item->edit }}"
                                                                                    value="1" class="flat"
                                                                                    checked></label>
                                                                        @else
                                                                            <label><input type="radio"
                                                                                    name="respuesta_{{ $item->edit }}"
                                                                                    value="1"
                                                                                    class="flat"></label>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="col-md-2 col-sm-2 ">
                                                                    <div class="checkbox">
                                                                        @if ($item->respuesta == 0)
                                                                            <label><input type="radio"
                                                                                    name="respuesta_{{ $item->edit }}"
                                                                                    value="0" class="flat"
                                                                                    checked></label>
                                                                        @else
                                                                            <label><input type="radio"
                                                                                    name="respuesta_{{ $item->edit }}"
                                                                                    value="0"
                                                                                    class="flat"></label>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <textarea name="observacion_{{ $item->edit }}" rows="5" class="form-control col-md-12 col-sm-12 col-xs-12">{{ $item->observacion }}</textarea>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @empty
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="table-responsive">
                                        <table id="tbAlmacenamiento" class="table table-striped jambo_table bulk_action"
                                            style="width:100%">
                                            <thead>
                                                <tr class="headings">
                                                    <th class="column-title cb-header-registe_description">
                                                        <p class="cb-subTitle">ALMACENAMIENTO </p>
                                                    </th>
                                                    <th class="column-title cb-header-register__tbSi">SI</th>
                                                    <th class="column-title cb-header-register__tbNo">NO</th>
                                                    <th class="column-title cb-header-register__tbObservacion">
                                                        OBSERVACIONES
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($requerimientos as $item)
                                                    @if ($item->tipoRequerimiento == 'ALMACENAMIENTO')
                                                        <tr class="even pointe">
                                                            <td>{{ $item->descripcion }}</td>
                                                            <td>
                                                                <div class="col-md-2 col-sm-2 ">
                                                                    <div class="checkbox">
                                                                        @if ($item->respuesta == 1)
                                                                            <label><input type="radio"
                                                                                    name="respuesta_{{ $item->edit }}"
                                                                                    value="1" class="flat"
                                                                                    checked></label>
                                                                        @else
                                                                            <label><input type="radio"
                                                                                    name="respuesta_{{ $item->edit }}"
                                                                                    value="1"
                                                                                    class="flat"></label>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="col-md-2 col-sm-2 ">
                                                                    <div class="checkbox">
                                                                        @if ($item->respuesta == 0)
                                                                            <label><input type="radio"
                                                                                    name="respuesta_{{ $item->edit }}"
                                                                                    value="0" class="flat"
                                                                                    checked></label>
                                                                        @else
                                                                            <label><input type="radio"
                                                                                    name="respuesta_{{ $item->edit }}"
                                                                                    value="0"
                                                                                    class="flat"></label>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <textarea name="observacion_{{ $item->edit }}" rows="5" class="form-control col-md-12 col-sm-12 col-xs-12">{{ $item->observacion }}</textarea>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @empty
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="table-responsive">
                                        <table id="tbAlmaceammientoGLP" class="table table-striped jambo_table bulk_action"
                                            style="width:100%">
                                            <thead>
                                                <tr class="headings">
                                                    <th class="column-title cb-header-registe_description">
                                                        <p class="cb-subTitle">ALMACENAMIENTO DE G.L.P.</p>
                                                    </th>
                                                    <th class="column-title cb-header-register__tbSi">SI</th>
                                                    <th class="column-title cb-header-register__tbNo">NO</th>
                                                    <th class="column-title cb-header-register__tbObservacion">
                                                        OBSERVACIONES
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($requerimientos as $item)
                                                    @if ($item->tipoRequerimiento == 'ALMACENAMIENTO DE G.L.P.')
                                                        <tr data-fila="{{ $item->id }}" class="even pointe">
                                                            <td>{{ $item->descripcion }}</td>
                                                            @if ($item->descripcion != 'CANTIDAD')
                                                                @if ($item->respuesta == 1)
                                                                    <td>
                                                                        <div class="col-md-2 col-sm-2 ">
                                                                            <div class="checkbox">
                                                                                <label><input type="radio"
                                                                                        name="respuesta_{{ $item->edit }}"
                                                                                        value="1" class="flat"
                                                                                        checked></label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="col-md-2 col-sm-2 ">
                                                                            <div class="checkbox">
                                                                                <label><input type="radio"
                                                                                        name="respuesta_{{ $item->edit }}"
                                                                                        value="0"
                                                                                        class="flat"></label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                @endif

                                                                @if ($item->respuesta == 0)
                                                                    <td>
                                                                        <div class="col-md-2 col-sm-2 ">
                                                                            <div class="checkbox">
                                                                                <label><input type="radio"
                                                                                        name="respuesta_{{ $item->edit }}"
                                                                                        value="1"
                                                                                        class="flat"></label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="col-md-2 col-sm-2 ">
                                                                            <div class="checkbox">
                                                                                <label><input type="radio"
                                                                                        name="respuesta_{{ $item->edit }}"
                                                                                        value="0" class="flat"
                                                                                        checked></label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                @endif
                                                            @endif

                                                            @if ($item->descripcion == 'CANTIDAD')
                                                                <td colspan="2">
                                                                    <input type="text" name="cantidad_{{ $item->edit }}"
                                                                        value="{{ $item->cantidad }}"
                                                                        class="form-control">
                                                                </td>
                                                            @endif
                                                            <td>
                                                                <textarea name="observacion_{{ $item->edit }}" rows="3" class="form-control col-md-12 col-sm-12 col-xs-12">{{ $item->observacion }}</textarea>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @empty
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="table-responsive">
                                        <table id="tbEquiposDeProteccion"
                                            class="table table-striped jambo_table bulk_action" style="width:100%">
                                            <thead>
                                                <tr class="headings">
                                                    <th class="column-title cb-header-registe_description">
                                                        <p class="cb-subTitle">EQUIPOS DE PROTECCION Y CONTRA
                                                            INCENDIOS</p>
                                                    </th>
                                                    <th class="column-title cb-header-register__tbSi">SI</th>
                                                    <th class="column-title cb-header-register__tbNo">NO</th>
                                                    <th class="column-title cb-header-register__tbObservacion">
                                                        OBSERVACIONES
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($requerimientos as $item)
                                                    @if ($item->tipoRequerimiento == 'EQUIPOS DE PROTECCION Y CONTRA INCENDIOS')
                                                        <tr class="even pointe">
                                                            <td>{{ $item->descripcion }}</td>
                                                            <td>
                                                                <div class="col-md-2 col-sm-2 ">
                                                                    <div class="checkbox">
                                                                        @if ($item->respuesta == 1)
                                                                            <label><input type="radio"
                                                                                    name="respuesta_{{ $item->edit }}"
                                                                                    value="1" class="flat"
                                                                                    checked></label>
                                                                        @else
                                                                            <label><input type="radio"
                                                                                    name="respuesta_{{ $item->edit }}"
                                                                                    value="1"
                                                                                    class="flat"></label>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="col-md-2 col-sm-2 ">
                                                                    <div class="checkbox">
                                                                        @if ($item->respuesta == 0)
                                                                            <label><input type="radio"
                                                                                    name="respuesta_{{ $item->edit }}"
                                                                                    value="0" class="flat"
                                                                                    checked></label>
                                                                        @else
                                                                            <label><input type="radio"
                                                                                    name="respuesta_{{ $item->edit }}"
                                                                                    value="0"
                                                                                    class="flat"></label>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <textarea name="observacion_{{ $item->edit }}" rows="5" class="form-control col-md-12 col-sm-12 col-xs-12">{{ $item->observacion }}</textarea>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @empty
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="table-responsive">
                                        <table id="tbExtintores" class="table table-striped jambo_table bulk_action"
                                            style="width:100%">
                                            <thead class="headings">
                                                <tr>
                                                    <th class="column-title cb-header-registe_description">
                                                        <p class="cb-subTitle">EXTINTORES</p>
                                                    </th>
                                                    <th class="column-title cb-header-register__tbSi">PQS</th>
                                                    <th class="column-title cb-header-register__tbNo">CO2</th>
                                                    <th class="column-title cb-header-register__tbObservacion">
                                                        OBSERVACIONES
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($requerimientos as $item)
                                                    @if ($item->tipoRequerimiento == 'EXTINTORES')
                                                        <tr class="even pointe">
                                                            <td>{{ $item->descripcion }}</td>
                                                            @if ($item->descripcion != 'CANTIDAD')
                                                                @if ($item->respuesta == 1)
                                                                    <td>
                                                                        <div class="col-md-2 col-sm-2 ">
                                                                            <div class="checkbox">
                                                                                <label><input type="radio"
                                                                                        name="respuesta_{{ $item->edit }}"
                                                                                        value="1" class="flat"
                                                                                        checked> SI </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="col-md-2 col-sm-2 ">
                                                                            <div class="checkbox">
                                                                                <label><input type="radio"
                                                                                        name="respuesta_{{ $item->edit }}"
                                                                                        value="0" class="flat">
                                                                                    NO </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                @endif

                                                                @if ($item->respuesta == 0)
                                                                    <td>
                                                                        <div class="col-md-2 col-sm-2 ">
                                                                            <div class="checkbox">
                                                                                <label><input type="radio"
                                                                                        name="respuesta_{{ $item->edit }}"
                                                                                        value="1" class="flat">
                                                                                    SI </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="col-md-2 col-sm-2 ">
                                                                            <div class="checkbox">
                                                                                <label><input type="radio"
                                                                                        name="respuesta_{{ $item->edit }}"
                                                                                        value="0" class="flat"
                                                                                        checked> NO </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                @endif

                                                                <td rowspan="2">
                                                                    <textarea name="observacion_{{ $item->edit }}" id="autocomplete-custom-append" rows="4"
                                                                        class="form-control col-md-12 col-sm-12 col-xs-12">{{ $item->observacion }}</textarea>
                                                                </td>
                                                            @else
                                                                <td>
                                                                    <input type="text" name="cantidad_{{ $item->edit }}"
                                                                        class="form-control"
                                                                        value="{{ $item->cantidad }}">
                                                                </td>
                                                                <td>
                                                                    <input type="text" name="cantidadB_{{ $item->edit }}"
                                                                        class="form-control"
                                                                        value="{{ $item->cantidadB }}">
                                                                </td>
                                                            @endif
                                                        </tr>
                                                    @endif
                                                @empty
                                                @endforelse
                                            </tbody>

                                        </table>
                                    </div>

                                    <div class="table-responsive">
                                        <div class="x_title cb-subTitle"><b>REQUERIMIENTOS SECUNDARIOS</b></div>
                                    </div>

                                    <div class="table-responsive">
                                        <table id="tbRecursos" class="table table-striped jambo_table bulk_action"
                                            style="width:100%">
                                            <thead>
                                                <tr class="headings">
                                                    <th class="column-title cb-header-registe_description">
                                                        <p class="cb-subTitle">RECURSOS</p>
                                                    </th>
                                                    <th class="column-title cb-header-register__tbSi">SI</th>
                                                    <th class="column-title cb-header-register__tbNo">NO</th>
                                                    <th class="column-title cb-header-register__tbObservacion">
                                                        OBSERVACIONES
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($requerimientos as $item)
                                                    @if ($item->tipoRequerimiento == 'RECURSOS')
                                                        <tr class="even pointe">
                                                            <td>{{ $item->descripcion }}</td>
                                                            <td>
                                                                <div class="col-md-2 col-sm-2 ">
                                                                    <div class="checkbox">
                                                                        @if ($item->respuesta == 1)
                                                                            <label><input type="radio"
                                                                                    name="respuesta_{{ $item->edit }}"
                                                                                    value="1" class="flat"
                                                                                    checked></label>
                                                                        @else
                                                                            <label><input type="radio"
                                                                                    name="respuesta_{{ $item->edit }}"
                                                                                    value="1"
                                                                                    class="flat"></label>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="col-md-2 col-sm-2 ">
                                                                    <div class="checkbox">
                                                                        @if ($item->respuesta == 0)
                                                                            <label><input type="radio"
                                                                                    name="respuesta_{{ $item->edit }}"
                                                                                    value="0" class="flat"
                                                                                    checked></label>
                                                                        @else
                                                                            <label><input type="radio"
                                                                                    name="respuesta_{{ $item->edit }}"
                                                                                    value="0"
                                                                                    class="flat"></label>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <textarea name="observacion_{{ $item->edit }}" rows="3" class="form-control col-md-12 col-sm-12 col-xs-12">{{ $item->observacion }}</textarea>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @empty
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="table-responsive">
                                        <table id="tbCausales" class="table table-striped jambo_table bulk_action"
                                            style="width:100%">
                                            <thead>
                                                <tr class="headings">
                                                    <th class="column-title cb-header-registe_description">
                                                        <p class="cb-subTitle">CAUSALES PARA RETIRO DE PERMISO DE
                                                            FUNCIONAMIENTOS</p>
                                                    </th>
                                                    <th class="column-title cb-header-register__tbSi">SI</th>
                                                    <th class="column-title cb-header-register__tbNo">NO</th>
                                                    <th class="column-title cb-header-register__tbObservacion">
                                                        OBSERVACIONES
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($requerimientos as $item)
                                                    @if ($item->tipoRequerimiento == 'CAUSALES PARA RETIRO DE PERMISO DE FUNCIONAMIENTOS')
                                                        <tr class="even pointe">
                                                            <td>{{ $item->descripcion }}</td>
                                                            <td>
                                                                <div class="col-md-2 col-sm-2">
                                                                    <div class="checkbox">
                                                                        @if ($item->respuesta == 1)
                                                                            <label><input type="radio"
                                                                                    name="respuesta_{{ $item->edit }}"
                                                                                    value="1" class="flat"
                                                                                    checked></label>
                                                                        @else
                                                                            <label><input type="radio"
                                                                                    name="respuesta_{{ $item->edit }}"
                                                                                    value="1"
                                                                                    class="flat"></label>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="col-md-2 col-sm-2 ">
                                                                    <div class="checkbox">
                                                                        @if ($item->respuesta == 0)
                                                                            <label><input type="radio"
                                                                                    name="respuesta_{{ $item->edit }}"
                                                                                    value="0" class="flat"
                                                                                    checked></label>
                                                                        @else
                                                                            <label><input type="radio"
                                                                                    name="respuesta_{{ $item->edit }}"
                                                                                    value="0"
                                                                                    class="flat"></label>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <textarea name="observacion_{{ $item->edit }}" rows="3" class="form-control col-md-12 col-sm-12 col-xs-12">{{ $item->observacion }}</textarea>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @empty
                                                @endforelse

                                            </tbody>
                                        </table>
                                    </div>

                                    <hr>

                                    <h2 style="color: #ca1404">Nota: <small style="color:#2a3f54;"> Además, de cumplir con
                                            el pago del permiso del cuerpo de bomberos, tendrá que haber cancelado las
                                            siguientes obligaciones:</small></h2>

                                    @forelse ($requerimientos as $item)
                                        @if ($item->tipoRequerimiento == 'OTROS')
                                            <div class="form-group row">
                                                <label
                                                    class="col-md-3 col-sm-3  control-label">{{ $item->descripcion }}</label>
                                                <div class="col-md-9 col-sm-9 ">
                                                    <div class="radio">
                                                        @if ($item->respuesta == 0)
                                                            <label><input type="radio" name="respuesta_{{ $item->edit }}"
                                                                    value="0" class="flat" checked> NO </label>
                                                        @else
                                                            <label><input type="radio" name="respuesta_{{ $item->edit }}"
                                                                    value="0" class="flat"> NO </label>
                                                        @endif

                                                        @if ($item->respuesta == 1)
                                                            <label><input type="radio" name="respuesta_{{ $item->edit }}"
                                                                    value="1" class="flat" checked> SI </label>
                                                        @else
                                                            <label><input type="radio" name="respuesta_{{ $item->edit }}"
                                                                    value="1" class="flat"> SI </label>
                                                        @endif

                                                        <input type="hidden" name="count" value="{{ $item->edit }}">

                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @empty
                                    @endforelse

                                    <hr>
                                    <h2 style="color: #ca1404">TIPO DE RIESGO </h2>
                                    <div class="form-group row">
                                        <label class="control-label col-md-2 col-sm-2 ">RIESGO</label>
                                        <div class="col-md-3 col-sm-3 ">
                                            <input type="hidden" value="{{ $client[0]->riesgo_id }}"
                                                id="idMod__tipoNegocio">
                                            <select class="form-control" name="tipoNegocio" id="tipoNegocio">
                                                @forelse ($riego as $item)
                                                    <option value="{{ $item->id }}">{{ $item->descripcion }}</option>
                                                @empty
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>

                                    <script>
                                        var newIndex = $("#idMod__tipoNegocio").val();
                                        $('#tipoNegocio option[value="' + newIndex + '"]').attr('selected', true)
                                    </script>

                                    <div class="form-group row">
                                        <label class="control-label col-md-2 col-sm-2 ">OBSERVACI&Oacute;N</label>
                                        <div class="col-md-8 col-sm-8 ">
                                            <textarea name="decripcion_riego" id="decripcion_riego" value="" class="form-control col-md-10" required>{{ $client[0]->decripcion }}</textarea>
                                        </div>
                                    </div>







                                    <br>

                                    <hr>
                                    <h2 style="color: #ca1404">Fotos:
                                        <small style="color:#2a3f54;"> Editar Fotografias de respaldo
                                        </small>
                                    </h2>


                                    @if (!empty($fotosLocal[0]->path))

                                        <br>


                                        <div class="cjaFotosLocal">
                                            @if (!empty($fotosLocal[0]->path))
                                                Foto 1 <img src="/imgFormularios/{{ $fotosLocal[0]->path }}"
                                                    class="imgFotoLocal">
                                            @endif

                                            @if (!empty($fotosLocal[1]->path))
                                                Foto 2 <img src="/imgFormularios/{{ $fotosLocal[1]->path }}"
                                                    class="imgFotoLocal">
                                            @endif

                                            @if (!empty($fotosLocal[2]->path))
                                                Foto 3 <img src="/imgFormularios/{{ $fotosLocal[2]->path }}"
                                                    class="imgFotoLocal">
                                            @endif

                                            <br>

                                            @if (!empty($fotosLocal[3]->path))
                                                Foto 4 <img src="/imgFormularios/{{ $fotosLocal[3]->path }}"
                                                    class="imgFotoLocal">
                                            @endif

                                            @if (!empty($fotosLocal[4]->path))
                                                Foto 5 <img src="/imgFormularios/{{ $fotosLocal[4]->path }}"
                                                    class="imgFotoLocal">
                                            @endif

                                            @if (!empty($fotosLocal[5]->path))
                                                Foto 6 <img src="/imgFormularios/{{ $fotosLocal[5]->path }}"
                                                    class="imgFotoLocal">
                                            @endif

                                        </div>

                                    @endif
                                    <hr>




                                    <div class="item form-group">
                                        <label for="password" class="col-form-label col-md-3 label-align">Foto 1</label>
                                        <div class="col-md-6 col-sm-6">
                                            <input type="file" name="foto1" class="form-control">
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label for="password" class="col-form-label col-md-3 label-align">Foto 2</label>
                                        <div class="col-md-6 col-sm-6">
                                            <input type="file" name="foto2" class="form-control">
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label for="password" class="col-form-label col-md-3 label-align">Foto 3</label>
                                        <div class="col-md-6 col-sm-6">
                                            <input type="file" name="foto3" class="form-control">
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label for="password" class="col-form-label col-md-3 label-align">Foto 4</label>
                                        <div class="col-md-6 col-sm-6">
                                            <input type="file" name="foto4" class="form-control">
                                        </div>
                                    </div>

                                    <div class="item form-group">
                                        <label for="password" class="col-form-label col-md-3 label-align">Foto 5</label>
                                        <div class="col-md-6 col-sm-6">
                                            <input type="file" name="foto5" class="form-control">
                                        </div>
                                    </div>


                                    <div class="item form-group">
                                        <label for="password" class="col-form-label col-md-3 label-align">Foto 6</label>
                                        <div class="col-md-6 col-sm-6">
                                            <input type="file" name="foto6" class="form-control">
                                        </div>
                                    </div>




                                    <!--botones-->
                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <h2 style="color: #ca1404">Nota:
                                            <small style="color:#2a3f54;"> Antes de guardar, Verifique la informaci&oacute;n
                                                ingresada
                                            </small>
                                        </h2>

                                        <input type="hidden" name="ruc_usuario" value="{{ $client[0]->id }}">

                                        <div class="col-md-6 offset-md-3">
                                            <a href="/clients" class="btn btn-primary" data-dismiss="modal">Cancelar</a>
                                            <button type="submit" class="btn btn-success">Actualizar Formulario</button>
                                        </div>
                                    </div>

                                </form>

                            </div>
                        </div>
                        <!---fin de formulario--->


                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /page contsent -->

@endsection
