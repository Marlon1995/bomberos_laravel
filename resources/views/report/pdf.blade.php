<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte Clientes</title>
    <style>
        body {
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        }

        .container {
            text-align: center;
            margin-top: 20px;
        }

        .logo {
            width: 50px;
            height: 50px;
        }

        h3 {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            margin: 10px 0;
        }

        hr {
            margin: 20px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid black;
            padding: 5px; /* Ajusta el padding según tus necesidades */
            text-align: center;
            font-size: 10px; /* Tamaño de fuente más pequeño */
        }

        th {
            background-color: #f2f2f2;
        }

        .empty-message {
            text-align: center;
            font-size: 18px;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
      <!--  <img src="./assets/images/Logo1.png" alt="Logo" class="logo"> -->
        <h3>
            ACUERDO MINISTERIAL No. 1616 DEL 29 DE OCTUBRE DE 1997 <br>
            REGISTRO OFICIAL No. 741 DEL 29 DE ENERO DEL 2019 <br>
            RUC: {{ auth()->user()->cedula }}001
        </h3>
        <hr>
        <h3>
            CONTROL DE INSPECCIONES DIARIAS
        </h3>
        <hr>
        <table>
          
            <tr>
                <td><strong>Inspector:</strong></td>
                <td>{{ auth()->user()->nombre . ' ' . auth()->user()->apellido }}</td>
            </tr>
            <tr>
                <td><strong>Fecha:</strong></td>
                <td>{{ empty($reporte )? 'NO EXISTE INFORMACIÓN PARA LA FECHA' : $rangos['r1'] .' al '.  $rangos['r2']        }}</td>
            </tr>
            <tr>
                <td><strong>Tipo Reporte:</strong></td>
                <td>LOCALES INSPECCIONADOS</td>
            </tr>
        </table>
        <hr>
    </div>

    @if(count($reporte) > 0)
    <table>
        <thead>
            <tr>
            <th>Item</th>
                <th>Fecha Inspección</th>
                <th>RUC</th>
                <th>Nombre Local</th>
                <th>Contribuyente</th>
                <th>Dirección</th>
                <th>Teléfono</th>
            </tr>
        </thead>
        <tbody>
        {{$i=1 }}
            @forelse ($reporte as $item)
            <tr>
            <td>{{$i++ }}</td>
                <td>{{$item->fecha_inspeccion }}</td>
                <td>{{ $item->ruc }}</td>
                <td>{{ $item->razonSocial }}</td>
                <td>{{ $item->representanteLegal }}</td>
                <td>{{ $item->parroquia . '/ ' . $item->barrio . '/ ' . $item->referencia }}</td>
                <td>{{ $item->telefono }}</td>
            </tr>
            @empty
            @endforelse
        </tbody>
    </table>
    @else
    <div class="empty-message">
        <h1>No hay registros</h1>
    </div>
    @endif
</body>

</html>
