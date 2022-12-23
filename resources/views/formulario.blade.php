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
    </style>

    <div class="right_col" role="main">
        <div class="">
            <div class="x_panel">
                <div class="x_content">
                    <!--contenido-->
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
                                    {{ $client[0]->parroquia }} / {{ $client[0]->barrio }} / {{ $client[0]->referencia }}
                                </div>

                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-2 col-sm-2">TEL&Eacute;FONO: </label>
                                <div class="col-md-3 col-sm-3 ">
                                    {{ $client[0]->telefono }}
                                </div>
                            </div>

                            <!--fin INFORMACIÓN GENERAL-->

                            <form class="form-horizontal form-label-left" method="POST"
                                action="{{ route('formulario.store') }}" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="client_id" value="{{ $client[0]->id }}">
                                <!--REQUERIMIENTOS ESENCIALES--->
                                <div class="x_title cb-subTitle"><b>REQUERIMIENTOS ESENCIALES</b></div>
                                <p>RIESGOS DE INCENDIO </p>

                                <!-- INICIO CODIGO JACXIMIR -->
                                <div class="table-responsive">
                                    <table id="tbConstruccion" class="table table-striped jambo_table bulk_action"
                                           style="width:100%">
                                        <thead>
                                            <tr class="headings" style="text-align:center;">
                                                <th class="column-title cb-header-register__tbConcepto" style="width:50%;">CONCEPTO</th>
                                                <th class="column-title cb-header-register__tbCoeficiente" style="width:25%;">COEFICIENTE</th>
                                            </tr>

                                            <tr class="headings">
                                                <th class="column-title cb-header-registe_construccion" colspan="2" 
                                                    style="text-align:center;">
                                                    <p class="cb-subTitle">CONSTRUCCI&Oacute;N</p>
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr class="even pointe" style="text-align:center;font-weight:900;">
                                                <td>Nº de pisos - Altura</td>
                                                <td></td>
                                            </tr>
                                            @forelse ($requerimientos as $item)
                                                @if ($item->tipoRequerimiento == 'CONSTRUCCION_NA')
                                                    <tr class="even pointe" style="text-align:center;">
                                                        <td>{{$item->descripcion}}</td>
                                                        <td><input type="radio" name="respuesta_{{$item->check_id}}" id="value_{{$item->puntos}}" 
                                                                   value="{{$item->puntos}}" required/>&nbsp;&nbsp;<label for="{{$item->puntos}}">{{$item->puntos}}</label></td>
                                                    </tr>
                                                @endif
                                            @empty
                                            @endforelse

                                            <tr class="even pointe" style="text-align:center;font-weight:900;">
                                                <td>Superficie mayor sector Incendios</td>
                                                <td></td>
                                            </tr>
                                            @forelse ($requerimientos as $item)
                                                @if ($item->tipoRequerimiento == 'CONSTRUCCION_SMSI')
                                                    <tr class="even pointe" style="text-align:center;">
                                                        <td>{{$item->descripcion}}</td>
                                                        <td><input type="radio" name="respuesta_{{$item->check_id}}" id="value_{{$item->puntos}}" 
                                                                   value="{{$item->puntos}}" required/>&nbsp;&nbsp;<label for="{{$item->puntos}}">{{$item->puntos}}</label></td>
                                                    </tr>
                                                @endif
                                            @empty
                                            @endforelse

                                            <tr class="even pointe" style="text-align:center;font-weight:900;">
                                                <td>Resistencia al fuego</td>
                                                <td></td>
                                            </tr>
                                            @forelse ($requerimientos as $item)
                                                @if ($item->tipoRequerimiento == 'CONSTRUCCION_RF')
                                                    <tr class="even pointe" style="text-align:center;">
                                                        <td>{{$item->descripcion}}</td>
                                                        <td><input type="radio" name="respuesta_{{$item->check_id}}" id="value_{{$item->puntos}}" 
                                                                   value="{{$item->puntos}}" required/>&nbsp;&nbsp;<label for="{{$item->puntos}}">{{$item->puntos}}</label></td>
                                                    </tr>
                                                @endif
                                            @empty
                                            @endforelse

                                            <tr class="even pointe" style="text-align:center;font-weight:900;">
                                                <td>Falsos techos</td>
                                                <td></td>
                                            </tr>
                                            @forelse ($requerimientos as $item)
                                                @if ($item->tipoRequerimiento == 'CONSTRUCCION_FT')
                                                    <tr class="even pointe" style="text-align:center;">
                                                        <td>{{$item->descripcion}}</td>
                                                        <td><input type="radio" name="respuesta_{{$item->check_id}}" id="value_{{$item->puntos}}" 
                                                                   value="{{$item->puntos}}" required/>&nbsp;&nbsp;<label for="{{$item->puntos}}">{{$item->puntos}}</label></td>
                                                    </tr>
                                                @endif
                                            @empty
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                                <div class="table-responsive">
                                    <table id="tbFactoresSituacion" class="table table-striped jambo_table bulk_action"
                                           style="width:100%">
                                        <thead>
                                            <tr class="headings" style="text-align:center;">
                                                <th class="column-title cb-header-register__tbConcepto" style="width:50%;">CONCEPTO</th>
                                                <th class="column-title cb-header-register__tbCoeficiente" style="width:25%;">COEFICIENTE</th>
                                            </tr>

                                            <tr class="headings">
                                                <th class="column-title cb-header-registe_factores_situacion" colspan="2" 
                                                    style="text-align:center;">
                                                    <p class="cb-subTitle">FACTORES DE SITUACI&Oacute;N</p>
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr class="even pointe" style="text-align:center;font-weight:900;">
                                                <td>Distancia de los bomberos</td>
                                                <td></td>
                                            </tr>
                                            @forelse ($requerimientos as $item)
                                                @if ($item->tipoRequerimiento == 'FACTORES_DB')
                                                    <tr class="even pointe" style="text-align:center;">
                                                        <td>{{$item->descripcion}}</td>
                                                        <td><input type="radio" name="respuesta_{{$item->check_id}}" id="value_{{$item->puntos}}" 
                                                                   value="{{$item->puntos}}" required/>&nbsp;&nbsp;<label for="{{$item->puntos}}">{{$item->puntos}}</label></td>
                                                    </tr>
                                                @endif
                                            @empty
                                            @endforelse

                                            <tr class="even pointe" style="text-align:center;font-weight:900;">
                                                <td>Accesibilidad de edificios</td>
                                                <td></td>
                                            </tr>
                                            @forelse ($requerimientos as $item)
                                                @if ($item->tipoRequerimiento == 'FACTORES_AE')
                                                    <tr class="even pointe" style="text-align:center;">
                                                        <td>{{$item->descripcion}}</td>
                                                        <td><input type="radio" name="respuesta_{{$item->check_id}}" id="value_{{$item->puntos}}" 
                                                                   value="{{$item->puntos}}" required/>&nbsp;&nbsp;<label for="{{$item->puntos}}">{{$item->puntos}}</label></td>
                                                    </tr>
                                                @endif
                                            @empty
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                                <div class="table-responsive">
                                    <table id="tbProcesos" class="table table-striped jambo_table bulk_action"
                                           style="width:100%">
                                        <thead>
                                            <tr class="headings" style="text-align:center;">
                                                <th class="column-title cb-header-register__tbConcepto" style="width:50%;">CONCEPTO</th>
                                                <th class="column-title cb-header-register__tbCoeficiente" style="width:25%;">COEFICIENTE</th>
                                            </tr>

                                            <tr class="headings">
                                                <th class="column-title cb-header-registe_procesos" colspan="2" 
                                                    style="text-align:center;">
                                                    <p class="cb-subTitle">PROCESOS</p>
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr class="even pointe" style="text-align:center;font-weight:900;">
                                                <td>Peligro de activaci&oacute;n</td>
                                                <td></td>
                                            </tr>
                                            @forelse ($requerimientos as $item)
                                                @if ($item->tipoRequerimiento == 'PROCESOS_PA')
                                                    <tr class="even pointe" style="text-align:center;">
                                                        <td>{{$item->descripcion}}</td>
                                                        <td><input type="radio" name="respuesta_{{$item->check_id}}" id="value_{{$item->puntos}}" 
                                                                   value="{{$item->puntos}}" required/>&nbsp;&nbsp;<label for="{{$item->puntos}}">{{$item->puntos}}</label></td>
                                                    </tr>
                                                @endif
                                            @empty
                                            @endforelse

                                            <tr class="even pointe" style="text-align:center;font-weight:900;">
                                                <td>Carga t&eacute;rmica</td>
                                                <td></td>
                                            </tr>
                                            @forelse ($requerimientos as $item)
                                                @if ($item->tipoRequerimiento == 'PROCESOS_CT')
                                                    <tr class="even pointe" style="text-align:center;">
                                                        <td>{{$item->descripcion}}</td>
                                                        <td><input type="radio" name="respuesta_{{$item->check_id}}" id="value_{{$item->puntos}}" 
                                                                   value="{{$item->puntos}}" required/>&nbsp;&nbsp;<label for="{{$item->puntos}}">{{$item->puntos}}</label></td>
                                                    </tr>
                                                @endif
                                            @empty
                                            @endforelse

                                            <tr class="even pointe" style="text-align:center;font-weight:900;">
                                                <td>Combustibilidad</td>
                                                <td></td>
                                            </tr>
                                            @forelse ($requerimientos as $item)
                                                @if ($item->tipoRequerimiento == 'PROCESOS_C')
                                                    <tr class="even pointe" style="text-align:center;">
                                                        <td>{{$item->descripcion}}</td>
                                                        <td><input type="radio" name="respuesta_{{$item->check_id}}" id="value_{{$item->puntos}}" 
                                                                   value="{{$item->puntos}}" required/>&nbsp;&nbsp;<label for="{{$item->puntos}}">{{$item->puntos}}</label></td>
                                                    </tr>
                                                @endif
                                            @empty
                                            @endforelse

                                            <tr class="even pointe" style="text-align:center;font-weight:900;">
                                                <td>Orden y limpieza</td>
                                                <td></td>
                                            </tr>
                                            @forelse ($requerimientos as $item)
                                                @if ($item->tipoRequerimiento == 'PROCESOS_OL')
                                                    <tr class="even pointe" style="text-align:center;">
                                                        <td>{{$item->descripcion}}</td>
                                                        <td><input type="radio" name="respuesta_{{$item->check_id}}" id="value_{{$item->puntos}}" 
                                                                   value="{{$item->puntos}}" required/>&nbsp;&nbsp;<label for="{{$item->puntos}}">{{$item->puntos}}</label></td>
                                                    </tr>
                                                @endif
                                            @empty
                                            @endforelse

                                            <tr class="even pointe" style="text-align:center;font-weight:900;">
                                                <td>Almacenamiento en altura</td>
                                                <td></td>
                                            </tr>
                                            @forelse ($requerimientos as $item)
                                                @if ($item->tipoRequerimiento == 'PROCESOS_AA')
                                                    <tr class="even pointe" style="text-align:center;">
                                                        <td>{{$item->descripcion}}</td>
                                                        <td><input type="radio" name="respuesta_{{$item->check_id}}" id="value_{{$item->puntos}}" 
                                                                   value="{{$item->puntos}}" required/>&nbsp;&nbsp;<label for="{{$item->puntos}}">{{$item->puntos}}</label></td>
                                                    </tr>
                                                @endif
                                            @empty
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                                <div class="table-responsive">
                                    <table id="tbFactorConcentracion" class="table table-striped jambo_table bulk_action"
                                           style="width:100%">
                                        <thead>
                                            <tr class="headings" style="text-align:center;">
                                                <th class="column-title cb-header-register__tbConcepto" style="width:50%;">CONCEPTO</th>
                                                <th class="column-title cb-header-register__tbCoeficiente" style="width:25%;">COEFICIENTE</th>
                                            </tr>

                                            <tr class="headings">
                                                <th class="column-title cb-header-registe_factor_concentracion" colspan="2" 
                                                    style="text-align:center;">
                                                    <p class="cb-subTitle">FACTOR DE CONCENTRACI&Oacute;N</p>
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr class="even pointe" style="text-align:center;font-weight:900;">
                                                <td>Factor de concentraci&oacute;n</td>
                                                <td></td>
                                            </tr>
                                            @forelse ($requerimientos as $item)
                                                @if ($item->tipoRequerimiento == 'FACTOR_FC')
                                                    <tr class="even pointe" style="text-align:center;">
                                                        <td>{{$item->descripcion}}</td>
                                                        <td><input type="radio" name="respuesta_{{$item->check_id}}" id="value_{{$item->puntos}}" 
                                                                   value="{{$item->puntos}}" required/>&nbsp;&nbsp;<label for="{{$item->puntos}}">{{$item->puntos}}</label></td>
                                                    </tr>
                                                @endif
                                            @empty
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                                <div class="table-responsive">
                                    <table id="tbPropagabilidad" class="table table-striped jambo_table bulk_action"
                                           style="width:100%">
                                        <thead>
                                            <tr class="headings" style="text-align:center;">
                                                <th class="column-title cb-header-register__tbConcepto" style="width:50%;">CONCEPTO</th>
                                                <th class="column-title cb-header-register__tbCoeficiente" style="width:25%;">COEFICIENTE</th>
                                            </tr>

                                            <tr class="headings">
                                                <th class="column-title cb-header-registe_propagabilidad" colspan="3" 
                                                    style="text-align:center;">
                                                    <p class="cb-subTitle">PROPAGABILIDAD</p>
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr class="even pointe" style="text-align:center;font-weight:900;">
                                                <td>Vertical</td>
                                                <td></td>
                                            </tr>
                                            @forelse ($requerimientos as $item)
                                                @if ($item->tipoRequerimiento == 'PROPAGABILIDAD_V')
                                                    <tr class="even pointe" style="text-align:center;">
                                                        <td>{{$item->descripcion}}</td>
                                                        <td><input type="radio" name="respuesta_{{$item->check_id}}" id="value_{{$item->puntos}}" 
                                                                   value="{{$item->puntos}}" required/>&nbsp;&nbsp;<label for="{{$item->puntos}}">{{$item->puntos}}</label></td>
                                                    </tr>
                                                @endif
                                            @empty
                                            @endforelse

                                            <tr class="even pointe" style="text-align:center;font-weight:900;">
                                                <td>Horizontal</td>
                                                <td></td>
                                            </tr>
                                            @forelse ($requerimientos as $item)
                                                @if ($item->tipoRequerimiento == 'PROPAGABILIDAD_H')
                                                    <tr class="even pointe" style="text-align:center;">
                                                        <td>{{$item->descripcion}}</td>
                                                        <td><input type="radio" name="respuesta_{{$item->check_id}}" id="value_{{$item->puntos}}" 
                                                                   value="{{$item->puntos}}" required/>&nbsp;&nbsp;<label for="{{$item->puntos}}">{{$item->puntos}}</label></td>
                                                    </tr>
                                                @endif
                                            @empty
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                                <div class="table-responsive">
                                    <table id="tbDestructibilidad" class="table table-striped jambo_table bulk_action"
                                           style="width:100%">
                                        <thead>
                                            <tr class="headings" style="text-align:center;">
                                                <th class="column-title cb-header-register__tbConcepto" style="width:50%;">CONCEPTO</th>
                                                <th class="column-title cb-header-register__tbCoeficiente" style="width:25%;">COEFICIENTE</th>
                                            </tr>

                                            <tr class="headings">
                                                <th class="column-title cb-header-registe_destructibilidad" colspan="2" 
                                                    style="text-align:center;">
                                                    <p class="cb-subTitle">DESTRUCTIBILIDAD</p>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="even pointe" style="text-align:center;font-weight:900;">
                                                <td>Por calor</td>
                                                <td></td>
                                            </tr>
                                            @forelse ($requerimientos as $item)
                                                @if ($item->tipoRequerimiento == 'DESTRUCTIBILIDAD_PC')
                                                    <tr class="even pointe" style="text-align:center;">
                                                        <td>{{$item->descripcion}}</td>
                                                        <td><input type="radio" name="respuesta_{{$item->check_id}}" id="value_{{$item->puntos}}" 
                                                                   value="{{$item->puntos}}" required/>&nbsp;&nbsp;<label for="{{$item->puntos}}">{{$item->puntos}}</label></td>
                                                    </tr>
                                                @endif
                                            @empty
                                            @endforelse

                                            <tr class="even pointe" style="text-align:center;font-weight:900;">
                                                <td>Por humo</td>
                                                <td></td>
                                            </tr>
                                            @forelse ($requerimientos as $item)
                                                @if ($item->tipoRequerimiento == 'DESTRUCTIBILIDAD_PH')
                                                    <tr class="even pointe" style="text-align:center;">
                                                        <td>{{$item->descripcion}}</td>
                                                        <td><input type="radio" name="respuesta_{{$item->check_id}}" id="value_{{$item->puntos}}" 
                                                                   value="{{$item->puntos}}" required/>&nbsp;&nbsp;<label for="{{$item->puntos}}">{{$item->puntos}}</label></td>
                                                    </tr>
                                                @endif
                                            @empty
                                            @endforelse

                                            <tr class="even pointe" style="text-align:center;font-weight:900;">
                                                <td>Por corrosi&oacute;n</td>
                                                <td></td>
                                            </tr>
                                            @forelse ($requerimientos as $item)
                                                @if ($item->tipoRequerimiento == 'DESTRUCTIBILIDAD_PCO')
                                                    <tr class="even pointe" style="text-align:center;">
                                                        <td>{{$item->descripcion}}</td>
                                                        <td><input type="radio" name="respuesta_{{$item->check_id}}" id="value_{{$item->puntos}}" 
                                                                   value="{{$item->puntos}}" required/>&nbsp;&nbsp;<label for="{{$item->puntos}}">{{$item->puntos}}</label></td>
                                                    </tr>
                                                @endif
                                            @empty
                                            @endforelse

                                            <tr class="even pointe" style="text-align:center;font-weight:900;">
                                                <td>Por agua</td>
                                                <td></td>
                                            </tr>
                                            @forelse ($requerimientos as $item)
                                                @if ($item->tipoRequerimiento == 'DESTRUCTIBILIDAD_PA')
                                                    <tr class="even pointe" style="text-align:center;">
                                                        <td>{{$item->descripcion}}</td>
                                                        <td><input type="radio" name="respuesta_{{$item->check_id}}" id="value_{{$item->puntos}}" 
                                                                   value="{{$item->puntos}}" required/>&nbsp;&nbsp;<label for="{{$item->puntos}}">{{$item->puntos}}</label></td>
                                                    </tr>
                                                @endif
                                            @empty
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                                <div class="table-responsive">
                                    <table id="tbDestructibilidad" class="table table-striped jambo_table bulk_action"
                                           style="width:100%">
                                        <thead>
                                            <tr class="headings" style="text-align:center;">
                                                <th class="column-title cb-header-register__tbConcepto" style="width:50%;">CONCEPTO</th>
                                                <th class="column-title cb-header-register__tbCoeficiente" style="width:25%;">SV</th>
                                                <th class="column-title cb-header-register__tbCoeficiente" style="width:25%;">CV</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($requerimientos as $item)
                                                @if ($item->tipoRequerimiento == 'GENERALES_Y')
                                                    <tr class="even pointe" style="text-align:center;">
                                                        <td>{{$item->descripcion}}</td>
                                                        <td><input type="radio" name="respuesta_{{$item->check_id}}" id="value_{{$item->puntos}}" 
                                                                   value="{{$item->puntos}}" required/>&nbsp;&nbsp;<label for="{{$item->puntos}}">{{$item->puntos}}</label></td>
                                                        <td><input type="radio" name="respuesta_{{$item->check_id}}" id="value_{{$item->puntos_01}}" 
                                                                   value="{{$item->puntos_01}}" required/>&nbsp;&nbsp;<label for="{{$item->puntos_01}}">{{$item->puntos_01}}</label></td>
                                                    </tr>
                                                @endif
                                            @empty
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                                <div class="table-responsive">
                                    <table id="tbObservacionGeneral" class="table table-striped jambo_table bulk_action"
                                           style="width:100%">
                                        <thead>
                                            <tr class="headings" style="text-align:center;">
                                                <th class="column-title cb-header-register__tbObservacion" style="width:100%;">OBSERVACI&Oacute;N</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr class="even pointe" style="text-align:center;">
                                                <td><textarea name="observacion_formulario" id="observacion_formulario" value="" class="form-control col-md-12" required></textarea></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="table-responsive">
                                    <h2 style="color: #ca1404">BCI</h2>
                                    
                                    <div class="form-group row">
                                        <label class="control-label col-md-2 col-sm-2 ">SELECCIONAR VALOR</label>
                                        <div class="col-md-3 col-sm-3">
                                            <label>SI</label><input type="radio" name="respuesta_bci" value="1" required/>
                                            <label>NO</label><input type="radio" name="respuesta_bci" value="0" required/>
                                        </div>
                                    </div>

                                    <h2 style="color: #ca1404">TIPO DE INSTALACI&Oacute;N</h2>

                                    <div class="form-group row">
                                        <label class="control-label col-md-2 col-sm-2 ">INSTALACI&Oacute;N</label>
                                        <div class="col-md-3 col-sm-3">
                                            <select class="form-control" name="tipoInstalacion" id="tipoInstalacion">
                                                @forelse ($tipoInstalacion as $item)
                                                    <option value="{{ $item->id }}">{{ $item->descripcion }}</option>
                                                @empty
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="control-label col-md-2 col-sm-2 ">INGRESAR # (m2)</label>
                                        <div class="col-md-1 col-sm-1">
                                            <input name="cantidad_m2" id="cantidad_m2" onKeyPress="return fn_aceptaNum(event)" class="form-control col-md-10" required>
                                        </div>
                                    </div>

                                            <br>

                                            <hr>
                                            <h2 style="color: #ca1404">Fotos:
                                                <small style="color:#2a3f54;"> Debe Ingresar 4 Fotografias de respaldo
                                                </small>
                                            </h2>



                                            <div class="item form-group">
                                                <label for="password" class="col-form-label col-md-3 label-align">Foto
                                                    1</label>
                                                <div class="col-md-6 col-sm-6">
                                                    <input type="file" name="foto1" class="form-control"
                                                        required="required">
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label for="password" class="col-form-label col-md-3 label-align">Foto
                                                    2</label>
                                                <div class="col-md-6 col-sm-6">
                                                    <input type="file" name="foto2" class="form-control"
                                                        required="required">
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label for="password" class="col-form-label col-md-3 label-align">Foto
                                                    3</label>
                                                <div class="col-md-6 col-sm-6">
                                                    <input type="file" name="foto3" class="form-control"
                                                        required="required">
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label for="password" class="col-form-label col-md-3 label-align">Foto
                                                    4</label>
                                                <div class="col-md-6 col-sm-6">
                                                    <input type="file" name="foto4" class="form-control"
                                                        required="required">
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label for="password" class="col-form-label col-md-3 label-align">Foto
                                                    5</label>
                                                <div class="col-md-6 col-sm-6">
                                                    <input type="file" name="foto5" class="form-control"
                                                        required="required">
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label for="password" class="col-form-label col-md-3 label-align">Foto
                                                    6</label>
                                                <div class="col-md-6 col-sm-6">
                                                    <input type="file" name="foto6" class="form-control"
                                                        required="required">
                                                </div>
                                            </div>



                                            <!--botones-->

                                            <div class="ln_solid"></div>
                                            <div class="form-group">
                                                <h2 style="color: #ca1404">Nota: <small style="color:#2a3f54;"> Antes de
                                                        guardar, Verifique la informaci&oacute;n ingresada </small></h2>

                                                <div class="col-md-6 offset-md-3">
                                                    <a href="/clients" class="btn btn-primary"
                                                        data-dismiss="modal">Cancelar</a>
                                                    <button type="submit" class="btn btn-success">Guardar Formulario</button>
                                                </div>
                                            </div>

                                            <input type="hidden" name="user_au" value="{{ auth()->user()->id }}">
                                            <input type="hidden" name="role_au" value="{{ auth()->user()->role_id }}">
                                            <input type="hidden" name="ruc_usuario" value="{{ $client[0]->ruc }}">


                            </form>

                            <!---fin de formulario--->

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- /page contsnt -->
@endsection