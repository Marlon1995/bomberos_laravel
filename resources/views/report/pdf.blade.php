<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte Clientes</title>
    <style>
        html, body{
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        }
        .rep_caja_roja__titulo_1{
            margin-left: 255px;
            font-size: 12px;
            font-weight: bold;
        }
        tr, th,td{
            margin: 10px 0;
            border: 1px solid black;
        }
        .border_table 
        { 
            border: 0; 
            font-size: 11px
        }
    
        </style>
</head>

<body>
    <div class="container" align="center">
        <img src="./assets/images/Logo1.png" width="100" height="100">
        <h3 style="text-align: center">
            ACUERDO MINISTERIAL No. 1616 DEL 29 DE OCTUBRE DE 1997 <br>
            REGISTRO OFICIAL No. 741 DEL 29 DE ENERO DEL 2019 <br>
            RUC: {{ auth()->user()->cedula }}001
        </h3>
        <hr>
        <table>
            <tr>
                <td> <span> <strong>Perfil:</strong> </span> </td>
                <td><span>{{ auth()->user()->role->role }}</span> </td>
            </tr>
            <tr>
                <td> <span><strong>Nombre:</strong></span> </td>
                <td><span>{{ auth()->user()->nombre . ' ' . auth()->user()->apellido }}</span></td>
            </tr>
            <tr>
                <td> <span><strong>Fecha:</strong></span></td>
                <td><span>{{ empty($reporte[0]->created_at) ? 'NO EXISTE INFORMACIÓN PARA LA FECHA' : $reporte[0]->created_at }}</span></td>
            </tr>
            <tr>
                <td> <span><strong>Tipo Reporte:</strong></span></td>
                <td><span>INSPECCIONADOS</span></td>
            </tr>
        </table>
        <hr>
    </div>

    <table class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th><span style="text-align: center;">ALMACENAMIENTO</span></th>
            </tr>
            <tr>
                <th>Razon Social</th>
                <th>Representante Legal</th>
                <th>Categoria</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($reporte as $item)
                @if ($item->descripcion == 'Almacenamiento')
                    <tr>
                        <td>{{ $item->razonSocial }}</td>
                        <td>{{ $item->representanteLegal }}</td>
                        <td>{{ $item->descripcion }}</td>
                    </tr>
                @endif
            @empty
                <h1>No hay registros</h1>
            @endforelse
        </tbody>
    </table>

    <table class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th><span style="text-align: center;">COMERCIO</span></th>
            </tr>
            <tr>
                <th>Razon Social</th>
                <th>Representante Legal</th>
                <th>Categoria</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($reporte as $item)
                @if ($item->descripcion == 'Comercio')
                    <tr>
                        <td>{{ $item->razonSocial }}</td>
                        <td>{{ $item->representanteLegal }}</td>
                        <td>{{ $item->descripcion }}</td>
                    </tr>
                @endif
            @empty
                <h1>No hay registros</h1>
            @endforelse
        </tbody>
    </table>    

</body>

</html>
