<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>REPORTE DIARIO-{{ now()->toDateTimeString() }}</title>
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
            padding: 8px;
        }

        td {
            font-size: 10px;
        }

        th {
            font-size: 11px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }

        table thead th,
        table tbody td,
        table tbody td label {
            font-size: 10px !important;
        }

        table tbody td a,
        table tbody th a,
        table tbody td button,
        table tbody td div {
            font-size: 10px !important;
        }

        .cabeza__title1 {
            font-size: 14px;
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
            left: 470px;
            top: -30px;
        }

        .pf__items_nose {
            font-size: 11px;
            position: absolute;
            left: 330px;
            top: 30px;
        }

        .firmas {
            text-align: center;
            font-size: 10px;
        }
    </style>

</head>

<body>



    <center><img src="./assets/img/icons/logo.png" alt="logo" height="60" width="60" class="lll"> </center>
    <div class="pf__items_nose">ACUERDO MINISTERIAL No. 1616 DEL 29 DE OCTUBRE DE 1997 <br>&nbsp;&nbsp; &nbsp; &nbsp;
        &nbsp;
        REGISTRO OFICIAL No. 741 DEL 29 DE ENERO DEL 2019 <br> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
        RUC: 0860050690001</div>
    <br><br><br><br>

    <p class="cabeza__title"><b>Perfil: </b> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
        &nbsp;{{ auth()->user()->role->role }} </p>
    <p class="cabeza__title"><b>Nombre: </b> &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
        {{ auth()->user()->nombre . ' ' . auth()->user()->apellido }}</p>
    <p class="cabeza__title"><b>Fecha: </b> &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
        {{ empty($reporte[0]->created_at) ? 'NO EXISTE INFORMACIÓN PARA LA FECHA' : $reporte[0]->created_at }}</p>
    <p class="cabeza__title"><b>Tipo Reporte: </b> &nbsp; REPORTE DIARIO PERMISOS</p>
    <br>




    <table>
        <tr>
            <th>RUC</th>
            <th>NOMBRE-LOCAL</th>
            <th>PROPIETARIO</th>
            <th>NºIGM</th>
            <th>AÑO</th>
            <th>FECHA</th>
            <th>VALOR</th>
            <th>V.ESPECIE</th>

            <th>TOTAL</th>
        </tr>

        {{ $total = 0 }}
        {{ $total_cantidad = 0 }}
        {{ $total_vespecie = 0 }}
        @forelse($fechas as $item)
            {{ $total = $total + $item->valor }}
            {{ $total_cantidad = $total_cantidad + $item->valor - 2 }}
            {{ $total_vespecie = $total_vespecie + 2 }}
            <tr>
                <td>{{ $item->ruc }}</td>
                <td>{{ $item->razonSocial }}</td>
                <td>{{ $item->representanteLegal }}</td>
                <td>{{ $item->numPermisoFuncionamiento }}</td>
                <td>{{ $item->anio }}</td>
                <td>{{ $item->created_at }}</td>

                <td>${{ $item->valor - 2 }}</td>
                <td>$2</td>

                <td>${{ $item->valor }}</td>

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
            <td><strong>${{ $total }}</strong></td>

        </tr>
    </table>

    <br>
    <div>
        <br>
        <br>

        <span
            style="color: #ffffff">______________________________________________________________________________________________
            &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
        </span></th>
        <b>TOTAL RECAUDADO</b>: $ {{ $total }}
    </div>


    <br>

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
    </style>
    <br>
    <br>
    <p class="pf__item_f_"><small>&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
            {{ strtoupper(auth()->user()->nombre . ' ' . auth()->user()->apellido) }} </small></p>
    <p class="pf__item_f_DETALLE_"><small>Recaudador(a), Unidad Financiera </small></p>


    <p class="pf__item_foter"> Abnegación y Disciplina</p>
    <p class="pf__item_foter_">
        Dirección Av. Principal Atacames sector Cocobamba<br>
        E-mail: administracion@bomberosatacames.gob.ec<br>
        Teléfono: +593 62731007
    </p>




</body>

</html>
