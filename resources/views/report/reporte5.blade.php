<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>REPORTE ESPECIES-{{ now()->toDateTimeString() }}</title>
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
            left: 570px;
            top: -30px;
        }

        .pf__items_nose {
            font-size: 11px;
            position: absolute;
            left: 200px;
            top: 20px;
        }

        .firmas {
            text-align: center;
            font-size: 12px;
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



   
   
        <center>
            <h5>REPORTE DE ESPECIES EXONERACIÓN</h5>
        </center>
        <p><label for="fechaDesde"> Desde:{{$fechas['r1']}}</label></p>
       <p> <label for="fechaDesde"> Hasta:{{$fechas['r2']}}</label></p>
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
            &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
        </span></th>
        <b>TOTAL RECAUDADO</b>: $ {{ $totalEspecies }}
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
    <div class="firmas" style="text-align: center;">___________________________________
 </div>
<div class="firmas" style="text-align: center;">
    <span style="font-weight: bold;">Recaudador(a) {{ strtoupper(auth()->user()->nombre . ' ' . auth()->user()->apellido) }}</span>
</div>
    

    <p class="pf__item_foter"> Abnegación y Disciplina</p>
    <p class="pf__item_foter_">
        Dirección Av. Principal Atacames sector los Almendros<br>
        E-mail: recaudacion@bomberosatacames.gob.ec<br>
        Teléfono:+593 062760233
    </p>




</body>

</html>
