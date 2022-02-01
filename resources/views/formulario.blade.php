@extends('layout')

@section('title', ucwords($data[0]->nombre))
@section('icono', $data[0]->icono )

@section('pagecontent')
    <!-- page content -->
    <style>
        .cb-header-register{
            display: flex;
            align-items: center;
        }
        .cb-header-register__img{
            height: 100px;
            margin-right: 1%;
            margin-left: 1%;
        }
        .cb-header-registe_description{
            padding: 2px;
            color: black;
            font-size: 11px;
            text-align: justify;
            margin-left: 10%;
        }
        .cb-header-register__Nro{
            margin-left: 70%;
            color: #000000;
        }

        .cb-subTitle{
            color: #ca1404;
            font-weight: bold;
            margin: 12px 0;
            font-size: 13px;
        }
        .cb-header-register__tbDecripcion{
            width: 40%;
            text-align: justify;
        }
        .cb-header-register__tbSi,
        .cb-header-register__tbNo{
            width: 5%;
        }
        .cb-header-register__tbObservacion{
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
                                <img src="/assets/img/icons/{{ $data[0]->logo}}" alt="@yield('title')" class="cb-header-register__img">
                                <h1 class="cb-header-registe__title">CUERPO DE BOMBEROS <br>DEL CANT&Oacute;N ATACAMES</h1>
                            </div>

                            <div class="page-title">
                                <div class="title_left">
                                    <p class="cb-header-registe_description" ><b>
                                            ACUERDO MINISTERIAL No. 1616 DEL 29 DE OCTUBRE DE 1997 <br>
                                            REGISTRO OFICIAL No. 741 DEL 29 DE ENERO DEL 2019<br>
                                            RUC: 0860050690001 </b> </p>
                                </div>

                                <div class="title_right">
                                    <p class="cb-header-register__Nro">Nro. {{$client[0]->id}} </p>
                                </div>
                            </div>

                            <!---formulario--->
                            <div class="x_panel">
                                <div class="x_title cb-subTitle">
                                    @if( $client[0]->id == 1 )
                                        <b>FORMULARIO DE INSPECCI&Oacute;N</b>
                                    @endif
                                    @if( $client[0]->id == 2 )
                                        <b>FORMULARIO DE RE-INSPECCI&Oacute;N</b>
                                    @endif
                                </div>
                                <div class="x_content">
                                    <!--INFORMACIÓN GENERAL-->
                                        <div class="form-group row">
                                            <label class="control-label col-md-4 col-sm-4 ">RUC</label>
                                            <div class="col-md-6 col-sm-6 ">
                                                {{$client[0]->ruc}}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-md-4 col-sm-4 ">RAZ&Oacute;N SOCIAL <small>(NOMBRE COMERCIAL)</small> </label>
                                            <div class="col-md-8 col-sm-8 ">
                                                {{$client[0]->razonSocial}}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-md-4 col-sm-4 ">REPRESENTANTE LEGAL <small>(PROPIETARIO)</small> </label>
                                            <div class="col-md-8 col-sm-8 ">
                                                {{$client[0]->representanteLegal}}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-md-2 col-sm-2">DIRECI&Oacute;N</label>
                                            <div class="col-md-10 col-sm-10 ">
                                                {{$client[0]->parroquia}} / {{$client[0]->barrio}} / {{$client[0]->referencia}}
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-md-2 col-sm-2">TEL&Eacute;FONO: </label>
                                            <div class="col-md-3 col-sm-3 ">
                                                {{$client[0]->telefono}}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-md-2 col-sm-2 ">DENOMINACI&Oacute;N</label>
                                            <div class="col-md-10 col-sm-10 ">
                                                {{$client[0]->denominacion}}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                                <label class="control-label col-md-2 col-sm-2 ">CATEGOR&Iacute;A</label>
                                            <div class="col-md-3 col-sm-3 ">
                                                {{$client[0]->categoria}}
                                            </div>
                                        </div>


                                    <!--fin INFORMACIÓN GENERAL-->

                                    <form class="form-horizontal form-label-left" method="POST" action="{{ route('formulario.store')}}" enctype="multipart/form-data">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="client_id" value="{{$client[0]->id}}">
                                        <!--REQUERIMIENTOS ESENCIALES--->
                                        <div class="x_title cb-subTitle"><b>REQUERIMIENTOS ESENCIALES</b></div>
                                        <p>RIESGOS DE INCENDIO </p>

                                    <div class="table-responsive">
                                        <table id="tbInstacionesElectricas" class="table table-striped jambo_table bulk_action" style="width:100%">
                                            <thead>
                                                <tr class="headings">
                                                        <th class="column-title cb-header-registe_description"><p class="cb-subTitle" >INSTALACIONES EL&Eacute;CTRICAS</p></th>
                                                        <th class="column-title cb-header-register__tbSi">SI</th>
                                                        <th class="column-title cb-header-register__tbNo">NO</th>
                                                        <th class="column-title cb-header-register__tbObservacion">OBSERVACIONES</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                @forelse ($requerimientos as $item)
                                                    @if($item->tipoRequerimiento == 'INSTALACIONES ELECTRICAS')
                                                    <tr class="even pointe">
                                                        <td>{{$item->descripcion}}</td>
                                                        <td>
                                                            <div class="col-md-2 col-sm-2 ">
                                                                <div class="checkbox">
                                                                    <label><input type="radio" name="respuesta_{{$item->id}}" value="1" class=" " required></label>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-md-2 col-sm-2 ">
                                                                <div class="checkbox">
                                                                    <label><input type="radio" name="respuesta_{{$item->id}}" value="0" class=" " required></label>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <textarea name="observacion_{{$item->id}}" id="autocomplete-custom-append" rows="5" onKeyPress="return fn_aceptaLETRAS(event)"  class="form-control col-md-12 col-sm-12 col-xs-12" ></textarea>
                                                        </td>
                                                    </tr>
                                                    @endif
                                                @empty
                                                @endforelse
                                                </tbody>
                                            </table>
                                    </div>

                                    <div class="table-responsive">
                                            <table id="tbAlmacenamiento" class="table table-striped jambo_table bulk_action" style="width:100%">
                                                    <thead>
                                                    <tr class="headings">
                                                        <th class="column-title cb-header-registe_description"><p class="cb-subTitle">ALMACENAMIENTO </p></th>
                                                        <th class="column-title cb-header-register__tbSi">SI</th>
                                                        <th class="column-title cb-header-register__tbNo">NO</th>
                                                        <th class="column-title cb-header-register__tbObservacion">OBSERVACIONES</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @forelse ($requerimientos as $item)
                                                        @if($item->tipoRequerimiento == 'ALMACENAMIENTO')
                                                            <tr class="even pointe">
                                                                <td>{{$item->descripcion}}</td>
                                                                <td>
                                                                    <div class="col-md-2 col-sm-2 ">
                                                                        <div class="checkbox">
                                                                            <label><input type="radio" name="respuesta_{{$item->id}}" value="1" class=" " required></label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="col-md-2 col-sm-2 ">
                                                                        <div class="checkbox">
                                                                            <label><input type="radio" name="respuesta_{{$item->id}}" value="0" class=" " required></label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <textarea name="observacion_{{$item->id}}" id="autocomplete-custom-append" onKeyPress="return fn_aceptaLETRAS(event)"  rows="5" class="form-control col-md-12 col-sm-12 col-xs-12" ></textarea>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @empty
                                                    @endforelse
                                                    </tbody>
                                            </table>
                                        </div>

                                        <div class="table-responsive">
                                            <table id="tbAlmaceammientoGLP" class="table table-striped jambo_table bulk_action" style="width:100%">
                                                <thead>
                                                <tr class="headings">
                                                    <th class="column-title cb-header-registe_description"><p class="cb-subTitle">ALMACENAMIENTO DE G.L.P.</p></th>
                                                    <th class="column-title cb-header-register__tbSi">SI</th>
                                                    <th class="column-title cb-header-register__tbNo">NO</th>
                                                    <th class="column-title cb-header-register__tbObservacion">OBSERVACIONES</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @forelse ($requerimientos as $item)
                                                    @if($item->tipoRequerimiento == 'ALMACENAMIENTO DE G.L.P.')
                                                        <tr class="even pointe">
                                                            <td>{{$item->descripcion}}</td>
                                                            @if( $item->descripcion != 'CANTIDAD')
                                                                <td>
                                                                    <div class="col-md-2 col-sm-2 ">
                                                                        <div class="checkbox">
                                                                            <label><input type="radio" name="respuesta_{{$item->id}}" value="1" class=" " required></label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="col-md-2 col-sm-2 ">
                                                                        <div class="checkbox">
                                                                            <label><input type="radio" name="respuesta_{{$item->id}}" value="0" class=" " required></label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            @else
                                                                <td colspan="2">
                                                                    <div class="form-group row">
                                                                        <input type="text" name="cantidad_{{$item->id}}" onKeyPress="return fn_aceptaNum(event)"  class="form-control col-md-12 col-sd-12" required>
                                                                    </div>
                                                                </td>
                                                            @endif
                                                            <td>
                                                                <textarea name="observacion_{{$item->id}}" rows="3" onKeyPress="return fn_aceptaLETRAS(event)"  class="form-control col-md-12 col-sm-12 col-xs-12" ></textarea>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @empty
                                                @endforelse
                                                </tbody>
                                            </table>
                                        <div>


                                       <div class="table-responsive">
                                            <table id="tbEquiposDeProteccion" class="table table-striped jambo_table bulk_action" style="width:100%">
                                                <thead>
                                                <tr class="headings">
                                                    <th class="column-title cb-header-registe_description"><p class="cb-subTitle">EQUIPOS DE PROTECCION Y CONTRA INCENDIOS</p></th>
                                                    <th class="column-title cb-header-register__tbSi">SI</th>
                                                    <th class="column-title cb-header-register__tbNo">NO</th>
                                                    <th class="column-title cb-header-register__tbObservacion">OBSERVACIONES</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @forelse ($requerimientos as $item)
                                                    @if($item->tipoRequerimiento == 'EQUIPOS DE PROTECCION Y CONTRA INCENDIOS')
                                                        <tr class="even pointe">
                                                            <td>{{$item->descripcion}}</td>
                                                            <td>
                                                                <div class="col-md-2 col-sm-2 ">
                                                                    <div class="checkbox">
                                                                        <label><input type="radio" name="respuesta_{{$item->id}}" value="1" class=" " required></label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="col-md-2 col-sm-2 ">
                                                                    <div class="checkbox">
                                                                        <label><input type="radio" name="respuesta_{{$item->id}}" value="0" class=" " required></label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <textarea name="observacion_{{$item->id}}" rows="5" onKeyPress="return fn_aceptaLETRAS(event)" class="form-control col-md-12 col-sm-12 col-xs-12" ></textarea>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @empty
                                                @endforelse
                                                </tbody>
                                            </table>
                                        </div>


                                        <div class="table-responsive">
                                            <table id="tbExtintores" class="table table-striped jambo_table bulk_action" style="width:100%">
                                                <thead>
                                                <tr class="headings">
                                                    <th class="column-title  cb-header-registe_description"><p class="cb-subTitle">EXTINTORES</p></th>
                                                    <th class="column-title  cb-header-register__tbSi">PQS</th>
                                                    <th class="column-title  cb-header-register__tbNo">CO2</th>
                                                    <th class="column-title  cb-header-register__tbObservacion">OBSERVACIONES</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @forelse ($requerimientos as $item)
                                                    @if($item->tipoRequerimiento == 'EXTINTORES')
                                                        <tr class="even pointe">
                                                            <td>{{$item->descripcion}}</td>
                                                            @if( $item->descripcion != 'CANTIDAD')
                                                                <td>
                                                                    <div class="col-md-2 col-sm-2 ">
                                                                        <div class="checkbox">
                                                                            <label><input type="radio" name="respuesta_{{$item->id}}" value="1" class=" " required> SI </label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="col-md-2 col-sm-2 ">
                                                                        <div class="checkbox">
                                                                            <label><input type="radio" name="respuesta_{{$item->id}}" value="0" class=" " required> NO </label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td rowspan="2">
                                                                    <textarea name="observacion_{{$item->id}}" rows="4" onKeyPress="return fn_aceptaLETRAS(event)" class="form-control col-md-12 col-sm-12 col-xs-12" ></textarea>
                                                                </td>
                                                            @else
                                                                <td>
                                                                      <input type="text" name="cantidad_{{$item->id}}" onKeyPress="return fn_aceptaNum(event)"   class="form-control" required>
                                                                </td>
                                                                <td>
                                                                     <input type="text" name="cantidadB_{{$item->id}}" onKeyPress="return fn_aceptaNum(event)"  class="form-control" required>
                                                                 </td>

                                                            @endif
                                                        </tr>
                                                    @endif
                                                @empty
                                                @endforelse
                                                </tbody>
                                            </table>
                                        </div>


                                        <div class="x_title cb-subTitle"><b>REQUERIMIENTOS SECUNDARIOS</b></div>
                                        
                                        <div class="table-responsive">
                                            <table id="tbRecursos" class="table table-striped jambo_table bulk_action" style="width:100%">
                                                <thead>
                                                <tr class="headings">
                                                    <th class="column-title cb-header-registe_description"><p class="cb-subTitle">RECURSOS</p></th>
                                                    <th class="column-title cb-header-register__tbSi">SI</th>
                                                    <th class="column-title cb-header-register__tbNo">NO</th>
                                                    <th class="column-title cb-header-register__tbObservacion">OBSERVACIONES</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @forelse ($requerimientos as $item)
                                                    @if($item->tipoRequerimiento == 'RECURSOS')
                                                        <tr class="even pointe">
                                                            <td>{{$item->descripcion}}</td>
                                                            <td>
                                                                <div class="col-md-2 col-sm-2 ">
                                                                    <div class="checkbox">
                                                                        <label><input type="radio" name="respuesta_{{$item->id}}" value="1" class=" " required></label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="col-md-2 col-sm-2 ">
                                                                    <div class="checkbox">
                                                                        <label><input type="radio" name="respuesta_{{$item->id}}" value="0" class=" " required></label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <textarea name="observacion_{{$item->id}}" rows="3" onKeyPress="return fn_aceptaLETRAS(event)" class="form-control col-md-12 col-sm-12 col-xs-12" ></textarea>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @empty
                                                @endforelse
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="table-responsive">
                                            <table id="tbCausales" class="table table-striped jambo_table bulk_action" style="width:100%">
                                                <thead>
                                                <tr class="headings">
                                                    <th class="column-title  cb-header-registe_description"><p class="cb-subTitle">CAUSALES PARA RETIRO DE PERMISO DE FUNCIONAMIENTOS</p></th>
                                                    <th class="column-title  cb-header-register__tbSi">SI</th>
                                                    <th class="column-title  cb-header-register__tbNo">NO</th>
                                                    <th class="column-title  cb-header-register__tbObservacion">OBSERVACIONES</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @forelse ($requerimientos as $item)
                                                    @if($item->tipoRequerimiento == 'CAUSALES PARA RETIRO DE PERMISO DE FUNCIONAMIENTOS')
                                                        <tr class="headings">
                                                            <td>{{$item->descripcion}}</td>
                                                            <td>
                                                                <div class="col-md-2 col-sm-2 ">
                                                                    <div class="checkbox">
                                                                        <label><input type="radio" name="respuesta_{{$item->id}}" value="1" class=" " required></label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="col-md-2 col-sm-2 ">
                                                                    <div class="checkbox">
                                                                        <label><input type="radio" name="respuesta_{{$item->id}}" value="0" class=" " required></label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <textarea name="observacion_{{$item->id}}"  rows="3" onKeyPress="return fn_aceptaLETRAS(event)" class="form-control col-md-12 col-sm-12 col-xs-12"></textarea>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @empty
                                                @endforelse

                                                </tbody>
                                            </table>


                                            <hr>
                                            <h2 style="color: #ca1404">Nota:
                                                <small style="color:#2a3f54;"> Además, de cumplir con el pago del permiso del cuerpo de bomberos, tendrá que haber cancelado las siguientes obligaciones
                                                </small>
                                            </h2>


                                        @forelse ($requerimientos as $item)
                                            @if($item->tipoRequerimiento == 'OTROS')
                                                <div class="form-group row">
                                                    <label class="col-md-3 col-sm-3  control-label">{{$item->descripcion}}</label>
                                                    <div class="col-md-9 col-sm-9 ">
                                                        <div class="radio">
                                                            <label><input type="radio" value="1" id="si" name="respuesta_{{$item->id}}" class=" " required> SI </label>
                                                            <label><input type="radio" value="0" id="no" name="respuesta_{{$item->id}}"  class=" " required> NO </label>
                                                            <input type="hidden" name="count" value="{{$item->id}}">
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
                                                <select class="form-control" name="tipoNegocio" id="tipoNegocio">
                                                    @forelse ($riego as $item)
                                                        <option value="{{$item->id}}">{{$item->descripcion}}</option>
                                                    @empty
                                                    @endforelse
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="control-label col-md-2 col-sm-2 ">OBSERVACI&Oacute;N</label>
                                            <div class="col-md-8 col-sm-8 ">
                                                <textarea name="decripcion_riego" id="decripcion_riego" value="" class="form-control col-md-10" required ></textarea>
                                            </div>
                                        </div>

                                        <br>

                                        <hr>
                                        <h2 style="color: #ca1404">Fotos:
                                            <small style="color:#2a3f54;"> Debe Ingresar 4 Fotografias de respaldo
                                            </small>
                                        </h2>



                                             <div class="item form-group">
                                                <label for="password" class="col-form-label col-md-3 label-align">Foto 1</label>
                                                <div class="col-md-6 col-sm-6">
                                                    <input type="file" name="foto1" class="form-control" required="required">
                                                </div>
                                             </div>
                                            <div class="item form-group">
                                                <label for="password" class="col-form-label col-md-3 label-align">Foto 2</label>
                                                <div class="col-md-6 col-sm-6">
                                                    <input type="file" name="foto2" class="form-control" required="required">
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label for="password" class="col-form-label col-md-3 label-align">Foto 3</label>
                                                <div class="col-md-6 col-sm-6">
                                                    <input type="file" name="foto3" class="form-control" required="required">
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label for="password" class="col-form-label col-md-3 label-align">Foto 4</label>
                                                <div class="col-md-6 col-sm-6">
                                                    <input type="file" name="foto4" class="form-control" required="required">
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label for="password" class="col-form-label col-md-3 label-align">Foto 5</label>
                                                <div class="col-md-6 col-sm-6">
                                                    <input type="file" name="foto5" class="form-control" required="required">
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label for="password" class="col-form-label col-md-3 label-align">Foto 6</label>
                                                <div class="col-md-6 col-sm-6">
                                                    <input type="file" name="foto6" class="form-control" required="required">
                                                </div>
                                            </div>



                                        <!--botones-->

                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <h2 style="color: #ca1404">Nota: <small style="color:#2a3f54;"> Antes de guardar, Verifique la informaci&oacute;n ingresada </small></h2>

                                            <div class="col-md-6 offset-md-3">
                                                <a href="/clients" class="btn btn-primary" data-dismiss="modal">Cancelar</a>
                                                <button type="submit"class="btn btn-success">Guardar Formulario</button>
                                             </div>
                                        </div>

                                        <input type="hidden" name="user_au" value="{{auth()->user()->id}}">
                                        <input type="hidden" name="role_au" value="{{auth()->user()->role_id}}">
                                        <input type="hidden" name="ruc_usuario" value="{{$client[0]->ruc}}">


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

