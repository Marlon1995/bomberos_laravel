<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formulario de Inspección</title>

</head>
<body>


<!-- page content -->
<style>
    html, body{
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    }
    .rep_membrete{
        position: absolute;
        left: 10px;
    }
    .rep__logo{
        position: absolute;
        left: 46px;
        top: -10px;
        width: 110px;
     }
    .rep__titulo{
        position: absolute;
        left: 200px;
        font-weight: bold;
        font-size: 25px;
     }
    .rep__detalle_articulo{
        position: absolute;
        left: 200px;
        top: 55px;
        font-weight: bold;
        font-size: 10px;
        width: 50%;
    }
    .rep_caja_roja{
        background: #ca0c02;
        color: #ffffff;
        height: 15px;
        padding: 3px 3px;
    }
    .rep_caja_roja__titulo_1{
        margin-left: 255px;
        font-size: 12px;
        font-weight: bold;
    }
    .num{
     font-size: 11px;
    }
    .rep_fecha{
        margin: 10px 0;
        font-size: 10px;
    }
    .rep_fecha_span{
        margin-right: 50px;
        font-weight: bold;
    }
    .rep_perfil_input{
        font-size: 10px;
        font-weight: bold;
        margin: 6px 0;
    }
    .rep_perfil_input span{
        font-weight: normal;
    }
    .rep_perfil_tabla{
        font-size: 11px;
    }
    .rep_perfil_tabla__titulo{
        font-size: 12px;
        margin: 7px;
    }
    .cb-header-registe_description_{
        color: #ca0c02;
    }

    .cb-header-registe_description{
        width: 45%;
        margin-left: 2px;
    }
    .cb-header-register__resp{
        width: 10%;
    }
    .cb-header-register__tbObservacion{
        width: 45%;
    }
    table, tr, th,td{
        margin: 10px 0;
        border: 1px solid #000000;
    }
    td{
        padding: 1px 6px;
    }
    .imgFotoLocal{
        width: 250px;
        height: 250px;
        border: 1px solid black;
        margin: 3px 4px;
    }
    .cjaFotosLocal{
        margin: 0px 50px 0px;
        font-size: 14px;
    }
</style>




        <div class="rep_membrete">
            <img class="rep__logo" src="./assets/img/icons/{{ $data[0]->logo}}" >
            <div class="rep__titulo">&nbsp; CUERPO DE BOMBEROS<br>DEL CANT&Oacute;N ATACAMES</div>
            <p class="rep__detalle_articulo">ACUERDO MINISTERIAL No. 1616 DEL 29 DE OCTUBRE DE 1997 <br> &nbsp;&nbsp; &nbsp;
                                             REGISTRO OFICIAL No. 741 DEL 29 DE ENERO DEL 2019 <br> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                             RUC: 0860050690001   </p>
        </div>

        <br><br><br><br><br><br>

        <div class="rep_perfil_detalle">
            <span class="num"><b>Nro.</b> {{$client[0]->id}}</span>

            <div class="rep_caja_roja">
                <div class="rep_caja_roja__titulo_1">FORMULARIO DE INSPECCIÓN</div>
            </div>

            <div class="rep_fecha">
                <span class="rep_fecha_span">FECHA:  @php echo date("d/m/Y", strtotime( $client[0]->created_at  )) @endphp </span>
                <span class="rep_fecha_span">HORA:  @php echo date("H:i:s", strtotime( $client[0]->created_at  )) @endphp </span>

                @if( $client[0]->tipoFormulario == 1 )
                    <span class="rep_fecha_span">INSPECCIÓN: SI </span>
                    <span class="rep_fecha_span">RE INSPECCIÓN: NO</span>
                @endif
                @if( $client[0]->tipoFormulario == 2 )
                    <span class="rep_fecha_span">INSPECCIÓN: NO</span>
                    <span class="rep_fecha_span">RE INSPECCIÓN: SI</span>
                @endif


            </div>
            <div class="rep_caja_roja__titulo_1"> &nbsp; &nbsp; INFORMACIÓN GENERAL</div>

            <p class="rep_perfil_input">RUC: <span>{{$client[0]->ruc}}</span></p>
            <p class="rep_perfil_input">RAZÓN SOCIAL-NOMBRE COMERCIAL: &nbsp; &nbsp; &nbsp;
                                        <span>@php echo strtoupper($client[0]->razonSocial)  @endphp </span>
            </p>
            <p class="rep_perfil_input">REPRESENTANTE LEGAL- PROPIETARIO: <span> @php echo strtoupper($client[0]->representanteLegal)  @endphp</span> </p>
            <p class="rep_perfil_input">Nº. TELÉFONO: &nbsp; &nbsp; <span>{{$client[0]->telefono}}</span></p>
            <p class="rep_perfil_input">CORREO ELECTRÓNICO: <span> {{$client[0]->email}}</span></p>

            <p class="rep_perfil_input">PARROQUIA: &nbsp; &nbsp; &nbsp; &nbsp;<span>@php echo strtoupper($client[0]->parroquia)  @endphp </span> &nbsp; &nbsp; &nbsp; &nbsp;
                                        BARRIO: <span>@php echo strtoupper($client[0]->barrio)  @endphp </span> &nbsp; &nbsp; &nbsp; &nbsp;
                                        REFERENCIA: <span>@php echo strtoupper($client[0]->referencia)  @endphp </span>
            </p>
            <p class="rep_perfil_input">CATEGOR&Iacute;A: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<span>{{$client[0]->categoria}}</span> &nbsp; &nbsp; &nbsp; &nbsp;
                                        DENOMINACI&Oacute;N: <span>{{$client[0]->denominacion}}</span>
            </p>
            <p class="rep_perfil_input">RIESGO: <span> {{$client[0]->riesgo}}</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; OBSERVACIÓN: <span>{{ empty($client[0]->descripcion) ? ' --' : $client[0]->descripcion }}</span></p>
         </div>

        <div class="rep_caja_roja">
            <div class="rep_caja_roja__titulo_1">REQUERIMIENTOS ESENCIALES</div>
        </div>

        <div class="rep_perfil_tabla">
        <p class="rep_perfil_tabla__titulo"><b>RIESGOS DE INCENDIO </b></p>

            <table id="tbInstacionesElectricas" class="table table-striped table-bordered" style="width:100%">
                <thead>
                <tr>
                    <th class="cb-header-registe_description"><span class="cb-header-registe_description_">INSTALACIONES EL&Eacute;CTRICAS</span></th>
                    <th class="cb-header-register__resp"> RESPUESTA</th>
                    <th class="cb-header-register__tbObservacion">OBSERVACIONES</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($requerimientos as $item)
                    @if($item->tipoRequerimiento == 'INSTALACIONES ELECTRICAS')
                        <tr>
                            <td>{{$item->descripcion}}</td>
                            <td>
                                @if( $item->respuesta == 1 )
                                    &nbsp; &nbsp; &nbsp;  SI
                                @endif
                                @if( $item->respuesta == 0 )
                                    &nbsp; &nbsp; &nbsp; NO
                                @endif
                            </td>
                            <td>{{$item->observacion}}</td>
                        </tr>
                    @endif
                @empty
                @endforelse
                </tbody>
            </table>

            <table id="tbAlmacenamiento" class="table table-striped table-bordered" style="width:100%" border="1">
                <thead>
                <tr>
                    <th class="cb-header-registe_description"><span class="cb-header-registe_description_">INSTALACIONES EL&Eacute;CTRICAS</span></th>
                    <th class="cb-header-register__resp"> RESPUESTA</th>
                    <th class="cb-header-register__tbObservacion">OBSERVACIONES</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($requerimientos as $item)
                    @if($item->tipoRequerimiento == 'ALMACENAMIENTO')
                        <tr>
                            <td>{{$item->descripcion}}</td>
                            <td>
                                @if( $item->respuesta == 1 )
                                    &nbsp; &nbsp; &nbsp;  SI
                                @endif
                                @if( $item->respuesta == 0 )
                                    &nbsp; &nbsp; &nbsp; NO
                                @endif
                            </td>
                            <td>{{$item->observacion}}</td>
                        </tr>
                    @endif
                @empty
                @endforelse
                </tbody>
            </table>

            <table id="tbAlmaceammientoGLP" class="table table-striped table-bordered" style="width:100%" border="1">
                <thead>
                <tr>
                    <th class="cb-header-registe_description"><span class="cb-header-registe_description_">ALMACENAMIENTO DE G.L.P.</span></th>
                    <th class="cb-header-register__resp"> RESPUESTA</th>
                    <th class="cb-header-register__tbObservacion">OBSERVACIONES</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($requerimientos as $item)
                    @if($item->tipoRequerimiento == 'ALMACENAMIENTO DE G.L.P.')
                        <tr>
                            <td>{{$item->descripcion}}</td>
                            <td>

                                @if( $item->descripcion != 'CANTIDAD' )
                                    @if( $item->respuesta == 1 )
                                        &nbsp; &nbsp; &nbsp;  SI
                                    @endif
                                    @if( $item->respuesta == 0 )
                                        &nbsp; &nbsp; &nbsp; NO
                                    @endif
                                @endif
                                @if( $item->descripcion == 'CANTIDAD' )
                                    &nbsp; &nbsp; &nbsp; {{$item->cantidad }}
                                @endif
                            </td>
                            <td>{{$item->observacion}}</td>
                        </tr>
                    @endif
                @empty
                @endforelse
                </tbody>
            </table>

            <table id="tbEquiposDeProteccion" class="table table-striped table-bordered" style="width:100%" border="1">
                <thead>
                <tr>
                    <th class="cb-header-registe_description"><span class="cb-header-registe_description_">EQUIPOS DE PROTECCION Y CONTRA INCENDIOS</span></th>
                    <th class="cb-header-register__resp"> RESPUESTA</th>
                    <th class="cb-header-register__tbObservacion">OBSERVACIONES</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($requerimientos as $item)
                    @if($item->tipoRequerimiento == 'EQUIPOS DE PROTECCION Y CONTRA INCENDIOS')
                        <tr>
                            <td>{{$item->descripcion}}</td>
                            <td>

                                @if( $item->descripcion != 'CANTIDAD' )
                                    @if( $item->respuesta == 1 )
                                        &nbsp; &nbsp; &nbsp;  SI
                                    @endif
                                    @if( $item->respuesta == 0 )
                                        &nbsp; &nbsp; &nbsp; NO
                                    @endif
                                @endif
                            </td>
                            <td>{{$item->observacion}}</td>
                        </tr>
                    @endif
                @empty
                @endforelse
                </tbody>
            </table>


        </div>
<br><br><br>

        <div class="rep_perfil_tabla">
            <p class="rep_perfil_tabla__titulo"><b>EXTINTORES </b></p>

            <table id="tbExtintores" class="table table-striped table-bordered" style="width:100%" border="1">
                <thead>
                <tr>
                    <th class="cb-header-registe_description"><span class="cb-header-registe_description_">EXTINTORES</span></th>
                    <th class="cb-header-register__resp"> P.Q.S.</th>
                    <th class="cb-header-register__resp"> C. O. 2</th>
                    <th class="cb-header-register__tbObservacion">OBSERVACIONES</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($requerimientos as $item)
                    @if($item->tipoRequerimiento == 'EXTINTORES')
                        <tr>
                            <td>{{$item->descripcion}}</td>

                            @if( $item->descripcion != 'CANTIDAD' )
                                <td colspan="2">
                                    @if( $item->respuesta == 1 )
                                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  SI
                                    @endif
                                    @if( $item->respuesta == 0 )
                                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; NO
                                    @endif
                                </td>
                                <td rowspan="2" rows="4">
                                    {{ $item->observacion }}
                                </td>

                            @endif

                            @if( $item->descripcion == 'CANTIDAD' )
                                <td>
                                    &nbsp; &nbsp; &nbsp; {{$item->cantidad }}
                                </td>
                                <td>
                                    &nbsp; &nbsp; &nbsp; {{$item->cantidadB }}
                                </td>

                            @endif

                        </tr>
                    @endif
                @empty
                @endforelse
                </tbody>
            </table>

            <table id="tbInstacionesElectricas" class="table table-striped table-bordered" style="width:100%">
                <thead>
                <tr>
                    <th class="cb-header-registe_description"><span class="cb-header-registe_description_">INSTALACIONES EL&Eacute;CTRICAS</span></th>
                    <th class="cb-header-register__resp"> RESPUESTA</th>
                    <th class="cb-header-register__tbObservacion">OBSERVACIONES</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($requerimientos as $item)
                    @if($item->tipoRequerimiento == 'INSTALACIONES ELECTRICAS')
                        <tr>
                            <td>{{$item->descripcion}}</td>
                            <td>
                                @if( $item->respuesta == 1 )
                                    &nbsp; &nbsp; &nbsp;  SI
                                @endif
                                @if( $item->respuesta == 0 )
                                    &nbsp; &nbsp; &nbsp; NO
                                @endif
                            </td>
                            <td>{{$item->observacion}}</td>
                        </tr>
                    @endif
                @empty
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="rep_caja_roja">
            <div class="rep_caja_roja__titulo_1">REQUERIMIENTOS SECUNDARIOS</div>
        </div>

        <div class="rep_perfil_tabla">

            <table id="tbRecursos" class="table table-striped table-bordered" style="width:100%">
                <thead>
                <tr>
                    <th class="cb-header-registe_description"><span class="cb-header-registe_description_">RECURSOS</span></th>
                    <th class="cb-header-register__resp"> RESPUESTA</th>
                    <th class="cb-header-register__tbObservacion">OBSERVACIONES</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($requerimientos as $item)
                    @if($item->tipoRequerimiento == 'RECURSOS')
                        <tr>
                            <td>{{$item->descripcion}}</td>
                            <td>
                                @if( $item->respuesta == 1 )
                                    &nbsp; &nbsp; &nbsp;  SI
                                @endif
                                @if( $item->respuesta == 0 )
                                    &nbsp; &nbsp; &nbsp; NO
                                @endif
                            </td>
                            <td>{{$item->observacion}}</td>
                        </tr>
                    @endif
                @empty
                @endforelse
                </tbody>
            </table>

            <table id="tbCausales" class="table table-striped table-bordered" style="width:100%">
                <thead>
                <tr>
                    <th class="cb-header-registe_description"><span class="cb-header-registe_description_">CAUSALES PARA RETIRO DE PERMISO DE FUNCIONAMIENTOS</span></th>
                    <th class="cb-header-register__resp"> RESPUESTA</th>
                    <th class="cb-header-register__tbObservacion">OBSERVACIONES</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($requerimientos as $item)
                    @if($item->tipoRequerimiento == 'CAUSALES PARA RETIRO DE PERMISO DE FUNCIONAMIENTOS')
                        <tr>
                            <td>{{$item->descripcion}}</td>
                            <td>
                                @if( $item->respuesta == 1 )
                                    &nbsp; &nbsp; &nbsp;  SI
                                @endif
                                @if( $item->respuesta == 0 )
                                    &nbsp; &nbsp; &nbsp; NO
                                @endif
                            </td>
                            <td>{{$item->observacion}}</td>
                        </tr>
                    @endif
                @empty
                @endforelse
                </tbody>
            </table>

        </div>


                            <p style="color: #ca1404">Nota: <small style="color:#2a3f54;"> Además, de cumplir con el pago del permiso del cuerpo de bomberos, tendrá que haber cancelado  las siguientes obligaciones:</small></p>
                        <div class="rep_perfil_tabla">

                            @forelse ($requerimientos as $item)
                                @if($item->tipoRequerimiento == 'OTROS')

                                    <div>
                                        {{$item->descripcion}} : &nbsp;&nbsp;&nbsp;
                                        <span>
                                             @if( $item->respuesta == 1 )
                                                SI
                                            @endif
                                            @if( $item->respuesta == 0 )
                                                NO
                                            @endif

                                        </span>
                                    </div>

                                @endif
                            @empty
                            @endforelse
                        </div>



@if( !empty($fotosLocal[0]->path) )

    <div style="height: 230px; "></div>



    <table class="border_table">
        <tr>
            <td  class="border_table"><p class="cjaFotosLocal">Fotos de Inspección</p></td>
        </tr>
        <tr>
            <td class="border_table">
                <table class="border_table">
                    <tr>
                        <td class="border_table">
                            @if( !empty($fotosLocal[0]->path) )
                                <img src="./imgFormularios/{{$fotosLocal[0]->path}}" class="imgFotoLocal">
                            @endif
                        </td>
                        <td class="border_table">
                            @if( !empty($fotosLocal[1]->path) )
                                <img src="./imgFormularios/{{$fotosLocal[1]->path}}" class="imgFotoLocal">
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td  class="border_table">
                            @if( !empty($fotosLocal[2]->path) )
                                <img src="./imgFormularios/{{$fotosLocal[2]->path}}" class="imgFotoLocal">
                            @endif
                        </td>
                        <td class="border_table">
                            @if( !empty($fotosLocal[3]->path) )
                                <img src="./imgFormularios/{{$fotosLocal[3]->path}}" class="imgFotoLocal">
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="border_table">
                            @if( !empty($fotosLocal[4]->path) )
                                <img src="./imgFormularios/{{$fotosLocal[4]->path}}" class="imgFotoLocal">
                            @endif
                        </td>
                        <td class="border_table">
                            @if( !empty($fotosLocal[5]->path) )
                                <img src="./imgFormularios/{{$fotosLocal[5]->path}}" class="imgFotoLocal">
                            @endif
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
@endif

<style>.border_table { border: 0; font-size: 11px}  .rep_footer{ width: 100%; } .rep_footer__firmas{ font-size: 10px; } .rep_footer__logo{ opacity: .4; width: 10%} </style>

    <table class="border_table">
        <tr>
            <td class="border_table" colspan="2">________________________</td>
            <td class="border_table" style="color: #ffffff">________________________</td>
            <td class="border_table" colspan="2">________________________</td>
        </tr>
        <tr>
            <td class="border_table"  colspan="2">
                @php echo 'Inspector(a). '.strtoupper($inspector[0]->nombre.' '.$inspector[0]->apellido ) @endphp
            </td>
            <td class="border_table"></td>
            <td class="border_table" colspan="2">
                @php echo 'Sr(a). '.strtoupper($client[0]->representanteLegal); @endphp
            </td>
        </tr>

        <tr>
            <td class="border_table" colspan="2">INSPECTOR-RESPONSABLE</td>
            <td class="border_table" style="color: #ffffff">________________________</td>
            <td class="border_table" colspan="2">PROPIETARIO /ADMINISTRADOR</td>
        </tr>

    </table>

    <div class="rep_footer">
        <img class="rep_footer__logo" src="./assets/img/icons/{{ $data[0]->logo}}" >
    </div>

</body>
</html>
