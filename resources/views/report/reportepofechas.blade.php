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
            font-size: 12px !important;
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
            left: 300px;
            top: -30px;
        }

        .pf__items_nose {
            font-size: 11px;
            position: absolute;
            left: 150px;
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

    <p class="cabeza__title"><b>Perfil: </b> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
        &nbsp;{{ auth()->user()->role->role }} </p>
    <p class="cabeza__title"><b>Nombre: </b> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
        {{ auth()->user()->nombre . ' ' . auth()->user()->apellido }}</p>
    <p class="cabeza__title"><b>Rango de Fecha:</b> &nbsp; {{ $rangos['r1'] }} al {{ $rangos['r2'] }}</p>
    <p class="cabeza__title"><b>Tipo Reporte: </b> &nbsp; &nbsp; &nbsp; REPORTE POR RANGO DE FECHAS</p>


    <br>

    <table>
        <tr>
            <th>CI - RUC</th>
            <th>RAZÓN SOCIAL</th>
            <th>NOMBRE PROPIETARIO</th>
            <th>FORMA PAGO</th>
            <th>TIPO DE PAGO</th>
            <th>VALOR</th>
            <th>FECHA</th>
        </tr>

        {{ $total = 0 }}
        @forelse($reporte as $item)
            {{ $total = $total + $item->valor }}

            <tr>
                <td>{{ $item->ruc }}</td>
                <td>{{ $item->razonSocial }}</td>
                <td>{{ $item->representanteLegal }}</td>
                <td>{{ $item->formaspago }}</td>
                <td>{{ $item->tipos_pago }}</td>
                <td>$ {{ $item->valor }}</td>
                <td>{{ date('Y-m-d', strtotime($item->created_at)) }}</td>
            </tr>
        @empty
        @endforelse
    </table>

    <br>
    <div>
        <span style="color: #ffffff">_____________________________________________________</span></th>
        <b>TOTAL</b>: $ {{ $total }}
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
    </style>
    <br>
    <br>
    <br>
    <div class="firmas" style="text-align: center;">___________________________________
 </div>
<div class="firmas" style="text-align: center;">
    <span style="font-weight: bold;">Recaudador(a),Unidad Financiera {{ strtoupper(auth()->user()->nombre . ' ' . auth()->user()->apellido) }}</span>
</div>


    <p class="pf__item_foter"> Abnegación y Disciplina</p>
    <p class="pf__item_foter_">
        Dirección Av. Principal Atacames sector los Almendros<br>
        E-mail: recaudacion@bomberosatacames.gob.ec<br>
        Teléfono:+593 062760233
    </p>

</body>

</html>
