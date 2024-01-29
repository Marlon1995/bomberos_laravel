<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>INSPECCIONES POR PARROQUIA</title>
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
            <p class="cabeza__title"><b>Rango de Fecha:</b> &nbsp; {{ $rangos['r1'] }} al {{ $rangos['r2'] }}</p>

        <p class="cabeza__title"><b>Tipo Reporte: </b> &nbsp;PERMISOS POR PARROQUIA</p>

        <center>
            <h5>PERMISOS POR PARROQUIA </h5>
        </center>
        <table>
            <tr>
                <th>N°</th>
                <th>FECHA</th>
                <th>PARROQUIA</th>
                <th>CI - RUC</th>
                <th>RAZÓN SOCIAL</th>
                <th>DIRECCIÓN</th>
                <th>SECTOR</th>
                <th>TELÉFONO</th>
                <th>EMAIL</th>
                <th>VALOR</th>
               



            </tr>

            {{ $total_pago = 0 }}
            {{ $total_vpagos = 0 }}
            {{ $total_especie = 0 }}
            {{ $total_recargo = 0 }}
            {{ $total_admin = 0 }}
            {{ $x = 1 }}

            @forelse($reporte as $item)
                {{ $total_pago = 0}}
                {{ $total_vpagos = $total_vpagos + $item->valor  }}
                {{ $total_especie = $total_especie + 2 }}
                {{ $total_admin = $total_admin + 1 }}
                {{ $total_recargo = $total_recargo + $item->recargo  }}
                <tr>
                    <td>{{ $x++ }}</td>
                    <td>{{ $item->created_at }}</td>
                    <td>{{ $item->parroquia }}</td>
                    <td>{{ $item->ruc }}</td>
                    <td>{{ $item->razonSocial }}</td>
                    <td>{{ $item->referencia }}</td>
                    <td>{{ $item->barrio }}</td>
                    <td>{{ $item->telefono }}</td>
                    <td>{{ $item->email }}</td>

              
                    <td>${{ round($item->valor + $item->recargo+2+1, 2) }}</td>

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
                <td><strong>${{ round($total_vpagos+$total_admin+$total_especie, 2) }}</strong></td>
       
            </tr>
        </table>

      





      

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

            .firmas {
                text-align: center;
                font-size: 12px;
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

        
        <div class="firmas" style="text-align: center;">___________________________________
 </div>
 
<div class="firmas" style="text-align: center;">
    <span style="font-weight: bold;">Recaudador(a),Unidad Financiera </span>
    <br/>
    <span> {{ auth()->user()->nombre . ' ' . auth()->user()->apellido }}</span>
</div>

        <br>
    </div>
    <div id="footer">
        <p class="page pf__item_foter_"> Abnegación y Disciplina</p>
        <p class="page pf__item_foter_">
            Dirección Av. Principal Atacames sector los Almendros<br>
            E-mail: recaudacion@bomberosatacames.gob.ec<br>
            Teléfono:+593 062760233
        </p>
    </div>



</body>

</html>
