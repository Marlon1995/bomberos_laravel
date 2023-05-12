<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CIERRE DE CAJA DIARIO-{{ now()->toDateTimeString() }}</title>
    <style>
        html {
            font-family: 'Oswald', sans-serif;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 5px;
        }

        td {
            font-size: 9px;
        }

        th {
            font-size: 9px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }


        table thead th,
        table tbody td,
        table tbody td label {
            font-size: 9px !important;
        }

        table tbody td a,
        table tbody th a,
        table tbody td button,
        table tbody td div {
            font-size: 9px !important;
        }

        .cabeza__title1 {
            font-size: 11px;
            font-weight: bold;
            position: relative;
            left: 175px;
            top: -10px;
        }

        .cabeza__title {
            margin: 1px;
            font-size: 10px;
        }

        .lll {
            position: absolute;
            left: 300px;
            top: -150px;
        }

        .pf__items_nose {
            font-size: 9px;
            position: absolute;
            left: 200px;
            top: -50px;
        }
    </style>

</head>

<body>
    <div id="content">
        <center><img src="./assets/img/icons/logo.png" alt="logo" height="80" width="80" class="lll">
        </center>
        <div class="pf__items_nose">ACUERDO MINISTERIAL No. 1616 DEL 29 DE OCTUBRE DE 1997 <br>&nbsp;&nbsp; &nbsp; &nbsp;
            &nbsp;
            REGISTRO OFICIAL No. 741 DEL 29 DE ENERO DEL 2019 <br> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            RUC: 0860050690001</div>
        <br>



        <p class="cabeza__title"><b>Perfil: </b> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            &nbsp;{{ auth()->user()->role->role }} </p>
        <p class="cabeza__title"><b>Nombre: </b> &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
            {{ auth()->user()->nombre . ' ' . auth()->user()->apellido }}</p>
        <p class="cabeza__title"><b>Fecha: </b> &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            {{ empty($reporte[0]->created_at) ? 'NO EXISTE INFORMACIÓN PARA LA FECHA' : $reporte[0]->created_at }}
        </p>
        <p class="cabeza__title"><b>Tipo Reporte: </b> &nbsp;CIERRE DE CAJA DIARIO</p>

        <center>
            <h5>PAGOS TOTALES</h5>
        </center>
        <table>
            <tr>
                <th>N°</th>
                <th>FECHA</th>
                <th>AÑO PERMISO</th>
                <th>N° ESPECIE</th>
                <th>CI - RUC</th>
                <th>RAZÓN SOCIAL</th>
                <th>FORMA PAGO</th>
                <th>N° DOCUMENTO</th>
                <th>TIPO DE PAGO</th>
                <th>VALOR</th>
                <th>RECARGO</th>
                <th>ESPECIE</th>
                <th>TOTAL</th>


            </tr>

            {{ $total_pago = 0 }}
            {{ $total_vpagos = 0 }}
            {{ $total_especie = 0 }}
            {{ $total_recargo = 0 }}
            {{ $x = 1 }}

            @forelse($reporte as $item)
                {{ $total_pago = $total_pago + $item->valor }}
                {{ $total_vpagos = $total_vpagos + $item->valor - 2 }}
                {{ $total_especie = $total_especie + 2 }}
                {{ $total_recargo = $total_recargo + $item->recargo }}
                <tr>
                    <td>{{ $x++ }}</td>
                    <td>{{ date('Y-m-d', strtotime($item->created_at)) }}</td>
                    <td>{{ $item->year_now }}</td>
                    <td>{{ $item->numPermisoFuncionamiento }}</td>
                    <td>{{ $item->ruc }}</td>
                    <td>{{ $item->razonSocial }}</td>
                    <td>{{ $item->formaspago }}</td>
                    <td>{{ $item->numTransaccion }}</td>
                    <td>{{ $item->tipos_pago }}</td>
                    <td>${{ round($item->valor - 2, 2) }}</td>
                    <td>${{ $item->recargo }}</td>
                    <td>${{ 2 }}</td>
                    <td>${{ round($item->valor + $item->recargo, 2) }}</td>

                </tr>
            @empty
            @endforelse

            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td> <strong>TOTALES</strong></td>
                <td><strong>${{ round($total_vpagos, 2) }}</strong></td>
                <td><strong>${{ round($total_recargo, 4) }}</strong></td>
                <td><strong>${{ round($total_especie, 2) }}</strong></td>
                <td><strong>${{ round($total_pago + $total_recargo, 2) }}</strong></td>

            </tr>
        </table>

        <br><br>
        <center>
            <h5>PAGOS ORDENANZAS</h5>
        </center>
        <table>
            <tr>
                <th>N°</th>
                <th>FECHA</th>
                <th>AÑO PERMISO</th>
                <th>N° ESPECIE</th>
                <th>CI - RUC</th>
                <th>RAZÓN SOCIAL</th>
                <th>FORMA PAGO</th>
                <th>N° DOCUMENTO</th>
                <th>TIPO DE PAGO</th>
                <th>VALOR</th>
                <th>RECARGO</th>
                <th>ESPECIE</th>
                <th>TOTAL</th>


            </tr>

            {{ $total_pago_or = 0 }}
            {{ $total_vpagos_or = 0 }}
            {{ $total_especie_or = 0 }}
            {{ $total_recargo_or = 0 }}
            {{ $x = 1 }}

            @forelse($reporte_ordenanzas as $item)
                {{ $total_pago_or = $total_pago_or + $item->valor }}
                {{ $total_vpagos_or = $total_vpagos_or + $item->valor - 2 }}
                {{ $total_especie_or = $total_especie_or + 2 }}
                {{ $total_recargo_or = $total_recargo_or + $item->recargo }}
                <tr>
                    <td>{{ $x++ }}</td>
                    <td>{{ date('Y-m-d', strtotime($item->created_at)) }}</td>
                    <td>{{ $item->year_now }}</td>
                    <td>{{ $item->numPermisoFuncionamiento }}</td>
                    <td>{{ $item->ruc }}</td>
                    <td>{{ $item->razonSocial }}</td>
                    <td>{{ $item->formaspago }}</td>
                    <td>{{ $item->numTransaccion }}</td>
                    <td>{{ $item->tipos_pago }}</td>
                    <td>${{ round($item->valor - 2, 2) }}</td>
                    <td>${{ $item->recargo }}</td>
                    <td>${{ 2 }}</td>
                    <td>${{ round($item->valor + $item->recargo, 2) }}</td>

                </tr>
            @empty
            @endforelse

            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td> <strong>TOTALES</strong></td>
                <td><strong>${{ round($total_vpagos_or, 2) }}</strong></td>
                <td><strong>${{ round($total_recargo_or, 4) }}</strong></td>
                <td><strong>${{ round($total_especie_or, 2) }}</strong></td>
                <td><strong>${{ round($total_pago_or + $total_recargo_or, 2) }}</strong></td>

            </tr>
        </table>

        <br><br>

        <center>
            <h5>OTROS COBROS</h5>
        </center>
        <table>
            <tr>
                <th>N°</th>
                <th>FECHA</th>
                <th>AÑO PERMISO</th>
                <th>CI - RUC</th>
                <th>RAZÓN SOCIAL</th>
                <th>FORMA PAGO</th>
                <th>TIPO DE PAGO</th>
                <th>VALOR</th>
                <th>RECARGO</th>
                <th>TOTAL</th>

            </tr>

            {{ $total = 0 }}
            {{ $total_votros = 0 }}
            {{ $total_procentaje = 0 }}
            {{ $y = 1 }}
            @forelse($cobros as $item)
                {{ $total = $total + round($item->valor + $item->valor * ($item->porcenjatetasa / 100), 2) }}
                {{ $total_votros = $total_votros + round($item->valor, 2) }}
                {{ $total_procentaje = $total_procentaje + round($item->valor * ($item->porcenjatetasa / 100), 2) }}

                <tr>
                    <td>{{ $y++ }}</td>
                    <td>{{ date('Y-m-d', strtotime($item->created_at)) }}</td>
                    <td>{{ $item->year_now }}</td>
                    <td>{{ $item->ruc }}</td>
                    <td>{{ $item->razonSocial }}</td>
                    <td>{{ $item->tipos_pago }}</td>
                    <td>OTROS COBROS</td>
                    <td>${{ $item->valor }}</td>
                    <td>${{ round($item->valor * ($item->porcenjatetasa / 100), 2) }}</td>
                    <td>$ {{ round($item->valor + $item->valor * ($item->porcenjatetasa / 100), 2) }}</td>


                </tr>
            @empty
            @endforelse
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><strong>TOTALES</strong></td>
                <td><strong>${{ round($total_votros, 2) }}</strong></td>
                <td><strong>${{ round($total_procentaje, 2) }}</strong></td>
                <td><strong>${{ $total }}</strong></td>

            </tr>
        </table>





        <center>
            <h5>ESPECIES</h5>
        </center>
        <table>
            <tr>
                <th>N°</th>
                <th>FECHA</th>
                <th>CI - RUC</th>
                <th>RAZÓN SOCIAL</th>
                <tH>PROPIETARIO O REPRESENTANTE</tH>
                <th>#ESPECIE</th>
                <th>CANTIDAD</th>
                <th>VALOR</th>
                <th>TOTAL</th>

            </tr>

            {{ $totalEspecies = 0 }}
            {{ $total_cantidad = 0 }}
            {{ $total_vespecie = 0 }}
            {{ $z = 1 }}
            @forelse($especie as $item)
                <tr>
                    {{ $totalEspecies = $totalEspecies + $item->cantidad * $item->valor }}
                    {{ $total_cantidad = $total_cantidad + $item->cantidad }}
                    {{ $total_vespecie = $total_vespecie + $item->valor }}
                    <td>{{ $z++ }}</td>
                    <td>{{ date('Y-m-d', strtotime($item->created_at)) }}</td>
                    <td>{{ $item->ruc }}</td>
                    <td>{{ $item->razonSocial }}</td>
                    <td>{{ $item->representanteLegal }}</td>
                    <td>{{ $item->especie }}</td>
                    <td>{{ $item->cantidad }}</td>
                    <td>${{ $item->valor }}</td>
                    <td>${{ round($item->cantidad * $item->valor, 2) }}</td>


                </tr>
            @empty
            @endforelse
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><strong>TOTALES</strong></td>
                <td><strong>${{ round($total_cantidad, 2) }}</strong></td>
                <td><strong>${{ round($total_vespecie, 2) }}</strong></td>
                <td><strong>${{ $totalEspecies }}</strong></td>

            </tr>
        </table>


        <br>
        <div>
            <br>
            <br>

            <span
                style="color: #ffffff">______________________________________________________________________________________________
                &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
            </span></th>
            <b>TOTAL RECAUDADO</b>: $ {{ round($total + $total_pago+$total_pago_or + $totalEspecies + $total_recargo, 2) }}
        </div>


        <br>
        <style>
            .pf__item_f_ {
                text-align: center;
                font-size: 11.5px;
            }

            .pf__item_f_DETALLE_ {
                text-align: center;
                font-weight: bold;
                font-size: 10.5px;
            }

            .pf__item_foter {

                font-size: 10.5px;
            }

            .pf__item_foter_ {
                text-align: right;
                font-size: 10.5px;
            }

            .firmas {
                text-align: center;
                font-size: 10px;
            }

            @page {
                margin: 180px 50px;
            }

            #footer {
                position: fixed;
                left: 0px;
                bottom: -180px;
                right: 0px;
                height: 100px;
            }

            #footer .page:after {
                content: counter(page, upper-roman);
            }
        </style>


        <br>
        <br>
        <br>

        <div class="firmas">__________________________
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </div>
        <div class="firmas">Recaudador(a) Tnlga. Patricia Pincay 
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </div>


        <br>
    </div>
    <div id="footer">
        <p class="page pf__item_foter_"> Abnegación y Disciplina</p>
        <p class="page pf__item_foter_">
            Dirección Av. Principal Atacames sector Cocobamba<br>
            E-mail: administracion@bomberosatacames.gob.ec<br>
            Teléfono: +593 62731007
        </p>
    </div>



</body>

</html>
