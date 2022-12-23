<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formulario de Inspección</title>
    <style>
        html,
        body {
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        }

        .rep_membrete {
            position: absolute;
            left: 10px;
        }

        .rep__logo {
            position: absolute;
            left: 46px;
            top: -10px;
            width: 110px;
        }

        .rep__titulo {
            position: absolute;
            left: 200px;
            font-weight: bold;
            font-size: 25px;
        }

        .rep__detalle_articulo {
            position: absolute;
            left: 200px;
            top: 55px;
            font-weight: bold;
            font-size: 10px;
            width: 50%;
        }

        .rep_caja_roja {
            background: #ca0c02;
            color: #ffffff;
            height: 15px;
            padding: 3px 3px;
        }

        .rep_caja_roja__titulo_1 {
            margin-left: 255px;
            font-size: 12px;
            font-weight: bold;
        }

        .num {
            font-size: 11px;
        }

        .rep_fecha {
            margin: 10px 0;
            font-size: 10px;
        }

        .rep_fecha_span {
            margin-right: 50px;
            font-weight: bold;
        }

        .rep_perfil_input {
            font-size: 10px;
            font-weight: bold;
            margin: 6px 0;
        }

        .rep_perfil_input span {
            font-weight: normal;
        }

        .rep_perfil_tabla {
            font-size: 11px;
        }

        .rep_perfil_tabla__titulo {
            font-size: 12px;
            margin: 7px;
        }

        .cb-header-registe_description_ {
            color: #ca0c02;
        }

        .cb-header-registe_description {
            width: 45%;
            margin-left: 2px;
        }

        .cb-header-register__resp {
            width: 10%;
        }

        .cb-header-register__tbObservacion {
            width: 45%;
        }

        table,
        tr,
        th,
        td {
            margin: 10px 0;
            border: 1px solid #000000;
        }

        td {
            padding: 1px 6px;
        }

        .imgFotoLocal {
            width: 250px;
            height: 250px;
            border: 1px solid black;
            margin: 3px 4px;
        }

        .cjaFotosLocal {
            margin: 0px 50px 0px;
            font-size: 14px;
        }

        .border_table {
            border: 0;
            font-size: 11px
        }

        .rep_footer {
            width: 100%;
        }

        .rep_footer__firmas {
            font-size: 10px;
        }

        .rep_footer__logo {
            opacity: .4;
            width: 10%
        }
    </style>
</head>

<body>
    <div class="rep_membrete">
        <img class="rep__logo" src="./assets/img/icons/{{ $data[0]->logo }}">
        <div class="rep__titulo">&nbsp; CUERPO DE BOMBEROS<br>DEL CANT&Oacute;N ATACAMES</div>
        <p class="rep__detalle_articulo">ACUERDO MINISTERIAL No. 1616 DEL 29 DE OCTUBRE DE 1997 <br> &nbsp;&nbsp; &nbsp;
            REGISTRO OFICIAL No. 741 DEL 29 DE ENERO DEL 2019 <br> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            RUC: 0860050690001 </p>
    </div>

    <br><br><br><br><br><br>

    <div class="rep_perfil_detalle">
        <span class="num"><b>Nro.</b> {{ $client[0]->id }}</span>

        <div class="rep_caja_roja">
            <div class="rep_caja_roja__titulo_1">FORMULARIO DE INSPECCIÓN</div>
        </div>

        <div class="rep_fecha">
            <span class="rep_fecha_span">FECHA: @php echo date("d/m/Y", strtotime( $client[0]->created_at  )) @endphp </span>
            <span class="rep_fecha_span">HORA: @php echo date("H:i:s", strtotime( $client[0]->created_at  )) @endphp </span>

            @if ($client[0]->tipoFormulario == 1)
                <span class="rep_fecha_span">INSPECCIÓN: SI </span>
                <span class="rep_fecha_span">RE INSPECCIÓN: NO</span>
            @endif
            @if ($client[0]->tipoFormulario == 2)
                <span class="rep_fecha_span">INSPECCIÓN: NO</span>
                <span class="rep_fecha_span">RE INSPECCIÓN: SI</span>
            @endif

        </div>
        <div class="rep_caja_roja__titulo_1"> &nbsp; &nbsp; INFORMACIÓN GENERAL</div>

        <p class="rep_perfil_input">RUC: <span>{{ $client[0]->ruc }}</span></p>
        <p class="rep_perfil_input">RAZÓN SOCIAL-NOMBRE COMERCIAL: &nbsp; &nbsp; &nbsp;
            <span>@php echo strtoupper($client[0]->razonSocial)  @endphp </span>
        </p>
        <p class="rep_perfil_input">REPRESENTANTE LEGAL- PROPIETARIO: <span> @php echo strtoupper($client[0]->representanteLegal)  @endphp</span> </p>
        <p class="rep_perfil_input">Nº. TELÉFONO: &nbsp; &nbsp; <span>{{ $client[0]->telefono }}</span></p>
        <p class="rep_perfil_input">CORREO ELECTRÓNICO: <span> {{ $client[0]->email }}</span></p>

        <p class="rep_perfil_input">PARROQUIA: &nbsp; &nbsp; &nbsp; &nbsp;<span>@php echo strtoupper($client[0]->parroquia)  @endphp </span> &nbsp; &nbsp;
            &nbsp; &nbsp;
            BARRIO: <span>@php echo strtoupper($client[0]->barrio)  @endphp </span> &nbsp; &nbsp; &nbsp; &nbsp;
            REFERENCIA: <span>@php echo strtoupper($client[0]->referencia)  @endphp </span>
        </p>
        <p class="rep_perfil_input">RIESGO: <span> {{ $inspecciones_sec[0]->riesgo }}</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            OBSERVACIÓN: <span>{{ empty($inspecciones_sec[0]->observacion) ? ' --' : $inspecciones_sec[0]->observacion }}</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
            BCI: <span>{{ $inspecciones_sec[0]->valor_bci == 1 ? 'SI' : 'NO' }}</span></p>
    </div>

    <div class="rep_caja_roja">
        <div class="rep_caja_roja__titulo_1">REQUERIMIENTOS ESENCIALES</div>
    </div>

<!--     <div class="rep_perfil_tabla">
        <p class="rep_perfil_tabla__titulo"><b>RIESGOS DE INCENDIO </b></p>
    </div> -->

    <table id="tbConstruccion" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr class="headings" style="text-align:center;">
                <th class="column-title cb-header-register__tbConcepto" style="width:50%;">CONCEPTO</th>
                <th class="column-title cb-header-register__tbCoeficiente" style="width:25%;">COEFICIENTE</th>
                <th class="column-title cb-header-register__tbPuntos" style="width:25%;">PUNTOS</th>
            </tr>

            <tr class="headings">
                <th class="column-title cb-header-registe_construccion" colspan="3" 
                    style="text-align:center;">
                    <p class="cb-subTitle cb-header-registe_description_">CONSTRUCCI&Oacute;N</p>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr class="even pointe" style="text-align:center;font-weight:900;">
                <td colspan="3">Nº de pisos - Altura</td>
            </tr>
            @forelse ($inspecciones as $i => $item)
                @if ($item->tipoRequerimiento == 'CONSTRUCCION_NA')
                    @if ($i == 0)
                    <tr class="even pointe" style="text-align:center;">
                        <td>{{ $item->descripcion }}</td>
                        <td>{{ $item->puntos }}</td>
                        <td rowspan="4">{{ $item->respuesta }}</td>
                    </tr>
                    @else
                    <tr class="even pointe" style="text-align:center;">
                        <td>{{ $item->descripcion }}</td>
                        <td>{{ $item->puntos }}</td>
                    </tr>
                    @endif
                @endif
            @empty
            @endforelse

            <tr class="even pointe" style="text-align:center;font-weight:900;">
                <td colspan="3">Superficie mayor sector Incendios</td>
            </tr>
            @forelse ($inspecciones as $i => $item)
                @if ($item->tipoRequerimiento == 'CONSTRUCCION_SMSI')
                    @if ($i == 4)
                    <tr class="even pointe" style="text-align:center;">
                        <td>{{ $item->descripcion }}</td>
                        <td>{{ $item->puntos }}</td>
                        <td rowspan="6">{{ $item->respuesta }}</td>
                    </tr>
                    @else
                    <tr class="even pointe" style="text-align:center;">
                        <td>{{ $item->descripcion }}</td>
                        <td>{{ $item->puntos }}</td>
                    </tr>
                    @endif
                @endif
            @empty
            @endforelse

            <tr class="even pointe" style="text-align:center;font-weight:900;">
                <td colspan="3">Resistencia al fuego</td>
            </tr>
            @forelse ($inspecciones as $i => $item)
                @if ($item->tipoRequerimiento == 'CONSTRUCCION_RF')
                    @if ($i == 10)
                    <tr class="even pointe" style="text-align:center;">
                        <td>{{ $item->descripcion }}</td>
                        <td>{{ $item->puntos }}</td>
                        <td rowspan="3">{{ $item->respuesta }}</td>
                    </tr>
                    @else
                    <tr class="even pointe" style="text-align:center;">
                        <td>{{ $item->descripcion }}</td>
                        <td>{{ $item->puntos }}</td>
                    </tr>
                    @endif
                @endif
            @empty
            @endforelse

            <tr class="even pointe" style="text-align:center;font-weight:900;">
                <td colspan="3">Falsos techos</td>
            </tr>
            @forelse ($inspecciones as $i => $item)
                @if ($item->tipoRequerimiento == 'CONSTRUCCION_FT')
                    @if ($i == 13)
                    <tr class="even pointe" style="text-align:center;">
                        <td>{{ $item->descripcion }}</td>
                        <td>{{ $item->puntos }}</td>
                        <td rowspan="3">{{ $item->respuesta }}</td>
                    </tr>
                    @else
                    <tr class="even pointe" style="text-align:center;">
                        <td>{{ $item->descripcion }}</td>
                        <td>{{ $item->puntos }}</td>
                    </tr>
                    @endif
                @endif
            @empty
            @endforelse
        </tbody>
    </table>

    <table id="tbFactoresSituacion" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr class="headings" style="text-align:center;">
                <th class="column-title cb-header-register__tbConcepto" style="width:50%;">CONCEPTO</th>
                <th class="column-title cb-header-register__tbCoeficiente" style="width:25%;">COEFICIENTE</th>
                <th class="column-title cb-header-register__tbPuntos" style="width:25%;">PUNTOS</th>
            </tr>

            <tr class="headings">
                <th class="column-title cb-header-registe_construccion" colspan="3" 
                    style="text-align:center;">
                    <p class="cb-subTitle cb-header-registe_description_">FACTORES DE SITUACI&Oacute;N</p>
                </th>
            </tr>
        </thead>

        <tbody>
            <tr class="even pointe" style="text-align:center;font-weight:900;">
                <td colspan="3">Distancia de los bomberos</td>
            </tr>
            @forelse ($inspecciones as $i => $item)
                @if ($item->tipoRequerimiento == 'FACTORES_DB')
                    @if ($i == 16)
                    <tr class="even pointe" style="text-align:center;">
                        <td>{{ $item->descripcion }}</td>
                        <td>{{ $item->puntos }}</td>
                        <td rowspan="5">{{ $item->respuesta }}</td>
                    </tr>
                    @else
                    <tr class="even pointe" style="text-align:center;">
                        <td>{{ $item->descripcion }}</td>
                        <td>{{ $item->puntos }}</td>
                    </tr>
                    @endif
                @endif
            @empty
            @endforelse

            <tr class="even pointe" style="text-align:center;font-weight:900;">
                <td colspan="3">Accesibilidad de edificios</td>
            </tr>
            @forelse ($inspecciones as $i => $item)
                @if ($item->tipoRequerimiento == 'FACTORES_AE')
                    @if ($i == 21)
                    <tr class="even pointe" style="text-align:center;">
                        <td>{{ $item->descripcion }}</td>
                        <td>{{ $item->puntos }}</td>
                        <td rowspan="4">{{ $item->respuesta }}</td>
                    </tr>
                    @else
                    <tr class="even pointe" style="text-align:center;">
                        <td>{{ $item->descripcion }}</td>
                        <td>{{ $item->puntos }}</td>
                    </tr>
                    @endif
                @endif
            @empty
            @endforelse
        </tbody>
    </table>

    <table id="tbFactoresSituacion" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr class="headings" style="text-align:center;">
                <th class="column-title cb-header-register__tbConcepto" style="width:50%;">CONCEPTO</th>
                <th class="column-title cb-header-register__tbCoeficiente" style="width:25%;">COEFICIENTE</th>
                <th class="column-title cb-header-register__tbPuntos" style="width:25%;">PUNTOS</th>
            </tr>

            <tr class="headings">
                <th class="column-title cb-header-registe_construccion" colspan="3" 
                    style="text-align:center;">
                    <p class="cb-subTitle cb-header-registe_description_">PROCESOS</p>
                </th>
            </tr>
        </thead>

        <tbody>
            <tr class="even pointe" style="text-align:center;font-weight:900;">
                <td colspan="3">Peligro de activaci&oacute;n</td>
            </tr>
            @forelse ($inspecciones as $i => $item)
                @if ($item->tipoRequerimiento == 'PROCESOS_PA')
                    @if ($i == 25)
                    <tr class="even pointe" style="text-align:center;">
                        <td>{{ $item->descripcion }}</td>
                        <td>{{ $item->puntos }}</td>
                        <td rowspan="3">{{ $item->respuesta }}</td>
                    </tr>
                    @else
                    <tr class="even pointe" style="text-align:center;">
                        <td>{{ $item->descripcion }}</td>
                        <td>{{ $item->puntos }}</td>
                    </tr>
                    @endif
                @endif
            @empty
            @endforelse

            <tr class="even pointe" style="text-align:center;font-weight:900;">
                <td colspan="3">Carga t&eacute;rmica</td>
            </tr>
            @forelse ($inspecciones as $i => $item)
                @if ($item->tipoRequerimiento == 'PROCESOS_CT')
                    @if ($i == 28)
                    <tr class="even pointe" style="text-align:center;">
                        <td>{{ $item->descripcion }}</td>
                        <td>{{ $item->puntos }}</td>
                        <td rowspan="3">{{ $item->respuesta }}</td>
                    </tr>
                    @else
                    <tr class="even pointe" style="text-align:center;">
                        <td>{{ $item->descripcion }}</td>
                        <td>{{ $item->puntos }}</td>
                    </tr>
                    @endif
                @endif
            @empty
            @endforelse

            <tr class="even pointe" style="text-align:center;font-weight:900;">
                <td colspan="3">Combustibilidad</td>
            </tr>
            @forelse ($inspecciones as $i => $item)
                @if ($item->tipoRequerimiento == 'PROCESOS_C')
                    @if ($i == 31)
                    <tr class="even pointe" style="text-align:center;">
                        <td>{{ $item->descripcion }}</td>
                        <td>{{ $item->puntos }}</td>
                        <td rowspan="3">{{ $item->respuesta }}</td>
                    </tr>
                    @else
                    <tr class="even pointe" style="text-align:center;">
                        <td>{{ $item->descripcion }}</td>
                        <td>{{ $item->puntos }}</td>
                    </tr>
                    @endif
                @endif
            @empty
            @endforelse

            <tr class="even pointe" style="text-align:center;font-weight:900;">
                <td colspan="3">Orden y limpieza</td>
            </tr>
            @forelse ($inspecciones as $i => $item)
                @if ($item->tipoRequerimiento == 'PROCESOS_OL')
                    @if ($i == 34)
                    <tr class="even pointe" style="text-align:center;">
                        <td>{{ $item->descripcion }}</td>
                        <td>{{ $item->puntos }}</td>
                        <td rowspan="3">{{ $item->respuesta }}</td>
                    </tr>
                    @else
                    <tr class="even pointe" style="text-align:center;">
                        <td>{{ $item->descripcion }}</td>
                        <td>{{ $item->puntos }}</td>
                    </tr>
                    @endif
                @endif
            @empty
            @endforelse

            <tr class="even pointe" style="text-align:center;font-weight:900;">
                <td colspan="3">Almacenamiento en altura</td>
            </tr>
            @forelse ($inspecciones as $i => $item)
                @if ($item->tipoRequerimiento == 'PROCESOS_AA')
                    @if ($i == 37)
                    <tr class="even pointe" style="text-align:center;">
                        <td>{{ $item->descripcion }}</td>
                        <td>{{ $item->puntos }}</td>
                        <td rowspan="3">{{ $item->respuesta }}</td>
                    </tr>
                    @else
                    <tr class="even pointe" style="text-align:center;">
                        <td>{{ $item->descripcion }}</td>
                        <td>{{ $item->puntos }}</td>
                    </tr>
                    @endif
                @endif
            @empty
            @endforelse
        </tbody>
    </table>

    <table id="tbFactoresSituacion" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr class="headings" style="text-align:center;">
                <th class="column-title cb-header-register__tbConcepto" style="width:50%;">CONCEPTO</th>
                <th class="column-title cb-header-register__tbCoeficiente" style="width:25%;">COEFICIENTE</th>
                <th class="column-title cb-header-register__tbPuntos" style="width:25%;">PUNTOS</th>
            </tr>

            <tr class="headings">
                <th class="column-title cb-header-registe_construccion" colspan="3" 
                    style="text-align:center;">
                    <p class="cb-subTitle cb-header-registe_description_">FACTOR DE CONCENTRACI&Oacute;N</p>
                </th>
            </tr>
        </thead>

        <tbody>
            <tr class="even pointe" style="text-align:center;font-weight:900;">
                <td colspan="3">Factor de concentraci&oacute;n</td>
            </tr>
            @forelse ($inspecciones as $i => $item)
                @if ($item->tipoRequerimiento == 'FACTOR_FC')
                    @if ($i == 40)
                    <tr class="even pointe" style="text-align:center;">
                        <td>{{ $item->descripcion }}</td>
                        <td>{{ $item->puntos }}</td>
                        <td rowspan="3">{{ $item->respuesta }}</td>
                    </tr>
                    @else
                    <tr class="even pointe" style="text-align:center;">
                        <td>{{ $item->descripcion }}</td>
                        <td>{{ $item->puntos }}</td>
                    </tr>
                    @endif
                @endif
            @empty
            @endforelse
        </tbody>
    </table>

    <table id="tbFactoresSituacion" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr class="headings" style="text-align:center;">
                <th class="column-title cb-header-register__tbConcepto" style="width:50%;">CONCEPTO</th>
                <th class="column-title cb-header-register__tbCoeficiente" style="width:25%;">COEFICIENTE</th>
                <th class="column-title cb-header-register__tbPuntos" style="width:25%;">PUNTOS</th>
            </tr>

            <tr class="headings">
                <th class="column-title cb-header-registe_construccion" colspan="3" 
                    style="text-align:center;">
                    <p class="cb-subTitle cb-header-registe_description_">PROPAGABILIDAD</p>
                </th>
            </tr>
        </thead>

        <tbody>
            <tr class="even pointe" style="text-align:center;font-weight:900;">
                <td colspan="3">Vertical</td>
            </tr>
            @forelse ($inspecciones as $i => $item)
                @if ($item->tipoRequerimiento == 'PROPAGABILIDAD_V')
                    @if ($i == 43)
                    <tr class="even pointe" style="text-align:center;">
                        <td>{{ $item->descripcion }}</td>
                        <td>{{ $item->puntos }}</td>
                        <td rowspan="3">{{ $item->respuesta }}</td>
                    </tr>
                    @else
                    <tr class="even pointe" style="text-align:center;">
                        <td>{{ $item->descripcion }}</td>
                        <td>{{ $item->puntos }}</td>
                    </tr>
                    @endif
                @endif
            @empty
            @endforelse

            <tr class="even pointe" style="text-align:center;font-weight:900;">
                <td colspan="3">Horizontal</td>
            </tr>
            @forelse ($inspecciones as $i => $item)
                @if ($item->tipoRequerimiento == 'PROPAGABILIDAD_H')
                    @if ($i == 46)
                    <tr class="even pointe" style="text-align:center;">
                        <td>{{ $item->descripcion }}</td>
                        <td>{{ $item->puntos }}</td>
                        <td rowspan="3">{{ $item->respuesta }}</td>
                    </tr>
                    @else
                    <tr class="even pointe" style="text-align:center;">
                        <td>{{ $item->descripcion }}</td>
                        <td>{{ $item->puntos }}</td>
                    </tr>
                    @endif
                @endif
            @empty
            @endforelse
        </tbody>
    </table>

    <table id="tbFactoresSituacion" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr class="headings" style="text-align:center;">
                <th class="column-title cb-header-register__tbConcepto" style="width:50%;">CONCEPTO</th>
                <th class="column-title cb-header-register__tbCoeficiente" style="width:25%;">COEFICIENTE</th>
                <th class="column-title cb-header-register__tbPuntos" style="width:25%;">PUNTOS</th>
            </tr>

            <tr class="headings">
                <th class="column-title cb-header-registe_construccion cb-header-registe_description_" colspan="3" 
                    style="text-align:center;padding:15px 0px;">
                    DESTRUCTIBILIDAD
                </th>
            </tr>
        </thead>

        <tbody>
            <tr class="even pointe" style="text-align:center;font-weight:900;">
                <td colspan="3">Por calor</td>
            </tr>
            @forelse ($inspecciones as $i => $item)
                @if ($item->tipoRequerimiento == 'DESTRUCTIBILIDAD_PC')
                    @if ($i == 49)
                    <tr class="even pointe" style="text-align:center;">
                        <td>{{ $item->descripcion }}</td>
                        <td>{{ $item->puntos }}</td>
                        <td rowspan="3">{{ $item->respuesta }}</td>
                    </tr>
                    @else
                    <tr class="even pointe" style="text-align:center;">
                        <td>{{ $item->descripcion }}</td>
                        <td>{{ $item->puntos }}</td>
                    </tr>
                    @endif
                @endif
            @empty
            @endforelse

            <tr class="even pointe" style="text-align:center;font-weight:900;">
                <td colspan="3">Por humo</td>
            </tr>
            @forelse ($inspecciones as $i => $item)
                @if ($item->tipoRequerimiento == 'DESTRUCTIBILIDAD_PH')
                    @if ($i == 52)
                    <tr class="even pointe" style="text-align:center;">
                        <td>{{ $item->descripcion }}</td>
                        <td>{{ $item->puntos }}</td>
                        <td rowspan="3">{{ $item->respuesta }}</td>
                    </tr>
                    @else
                    <tr class="even pointe" style="text-align:center;">
                        <td>{{ $item->descripcion }}</td>
                        <td>{{ $item->puntos }}</td>
                    </tr>
                    @endif
                @endif
            @empty
            @endforelse

            <tr class="even pointe" style="text-align:center;font-weight:900;">
                <td colspan="3">Por corrosi&oacute;n</td>
            </tr>
            @forelse ($inspecciones as $i => $item)
                @if ($item->tipoRequerimiento == 'DESTRUCTIBILIDAD_PCO')
                    @if ($i == 55)
                    <tr class="even pointe" style="text-align:center;">
                        <td>{{ $item->descripcion }}</td>
                        <td>{{ $item->puntos }}</td>
                        <td rowspan="3">{{ $item->respuesta }}</td>
                    </tr>
                    @else
                    <tr class="even pointe" style="text-align:center;">
                        <td>{{ $item->descripcion }}</td>
                        <td>{{ $item->puntos }}</td>
                    </tr>
                    @endif
                @endif
            @empty
            @endforelse

            <tr class="even pointe" style="text-align:center;font-weight:900;">
                <td colspan="3">Por agua</td>
            </tr>
            @forelse ($inspecciones as $i => $item)
                @if ($item->tipoRequerimiento == 'DESTRUCTIBILIDAD_PA')
                    @if ($i == 58)
                    <tr class="even pointe" style="text-align:center;">
                        <td>{{ $item->descripcion }}</td>
                        <td>{{ $item->puntos }}</td>
                        <td rowspan="3">{{ $item->respuesta }}</td>
                    </tr>
                    @else
                    <tr class="even pointe" style="text-align:center;">
                        <td>{{ $item->descripcion }}</td>
                        <td>{{ $item->puntos }}</td>
                    </tr>
                    @endif
                @endif
            @empty
            @endforelse
        </tbody>
    </table>

    <table id="tbFactoresSituacion" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr class="headings" style="text-align:center;">
                <th class="column-title cb-header-register__tbConcepto" style="width:50%;">CONCEPTO</th>
                <th class="column-title cb-header-register__tbCoeficiente" style="width:12.5%;">SV</th>
                <th class="column-title cb-header-register__tbPuntos" style="width:12.5%;">CV</th>
                <th class="column-title cb-header-register__tbPuntos" style="width:25%;">PUNTOS</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($inspecciones as $i => $item)
                @if ($item->tipoRequerimiento == 'GENERALES_Y')
                    <tr class="even pointe" style="text-align:center;">
                        <td>{{ $item->descripcion }}</td>
                        <td>{{ $item->puntos }}</td>
                        <td>{{ $item->puntos_01 }}</td>
                        <td>{{ $item->respuesta }}</td>
                    </tr>
                @endif
            @empty
            @endforelse
        </tbody>
    </table>

    <p style="color: #ca1404">Nota: <small style="color:#2a3f54;"> Además, de cumplir con el pago del permiso del cuerpo
            de bomberos, tendrá que haber cancelado las siguientes obligaciones:</small></p>
    <div class="rep_perfil_tabla">

        @forelse ($requerimientos as $item)
            @if ($item->tipoRequerimiento == 'OTROS')
                <div>
                    {{ $item->descripcion }} : &nbsp;&nbsp;&nbsp;
                    <span>
                        @if ($item->respuesta == 1)
                            SI
                        @endif
                        @if ($item->respuesta == 0)
                            NO
                        @endif

                    </span>
                </div>
            @endif
        @empty
        @endforelse
    </div>
    <!-- ENCONTRAR ERROR-->
    @if (!empty($fotosLocal[0]->path))

        <div style="height: 230px; "></div>

        <table class="border_table">
            <tr>
                <td class="border_table">
                    <p class="cjaFotosLocal">Fotos de Inspección</p>
                </td>
                <td class="border_table">
                    <table class="border_table">
                        <tr>
                            <td class="border_table">
                                @if (!empty($fotosLocal[0]->path))
                                    <img src="./imgFormularios/{{ $fotosLocal[0]->path }}" class="imgFotoLocal">
                                @endif
                            </td>
                            <td class="border_table">
                                @if (!empty($fotosLocal[1]->path))
                                    <img src="./imgFormularios/{{ $fotosLocal[1]->path }}" class="imgFotoLocal">
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="border_table">
                                @if (!empty($fotosLocal[2]->path))
                                    <img src="./imgFormularios/{{ $fotosLocal[2]->path }}" class="imgFotoLocal">
                                @endif
                            </td>
                            <td class="border_table">
                                @if (!empty($fotosLocal[3]->path))
                                    <img src="./imgFormularios/{{ $fotosLocal[3]->path }}" class="imgFotoLocal">
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="border_table">
                                @if (!empty($fotosLocal[4]->path))
                                    <img src="./imgFormularios/{{ $fotosLocal[4]->path }}" class="imgFotoLocal">
                                @endif
                            </td>
                            <td class="border_table">
                                @if (!empty($fotosLocal[5]->path))
                                    <img src="./imgFormularios/{{ $fotosLocal[5]->path }}" class="imgFotoLocal">
                                @endif
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    @endif

    <table class="table table-striped|sm|bordered|hover|inverse table-inverse table-responsive">
        <thead class="thead-inverse|thead-default">
            <tr>
                <th class="border_table" colspan="2">________________________</th>
                <th></th>
                <th class="border_table" colspan="2">________________________</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="border_table" colspan="2">
                    @php echo 'Inspector(a). '.strtoupper( auth()->user()->nombre.' '.auth()->user()->apellido ) @endphp
                </td>
                <td></td>
                <td class="border_table" colspan="2">
                    @php echo 'Sr(a). '.strtoupper($client[0]->representanteLegal); @endphp
                </td>
            </tr>
            <tr>
                <td class="border_table" colspan="2">INSPECTOR-RESPONSABLE</td>
                <td></td>
                <td class="border_table" colspan="2">PROPIETARIO /ADMINISTRADOR</td>
            </tr>
        </tbody>
    </table>

    <div class="rep_footer">
        <img class="rep_footer__logo" src="./assets/img/icons/{{ $data[0]->logo }}">
    </div>

</body>

</html>
