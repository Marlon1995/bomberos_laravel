<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cierre Diario</title>
</head>
<body>

    <table class="table table-striped table-inverse table-responsive">
        <thead class="thead-inverse">
            <tr>
                <th colspan="32" class="title">
                    <center>
                        <h1> <strong> CIERRE CAJA DIARIO </strong> </h1>
                    </center>
                </th>
            </tr>
            <tr>
                <th rowspan="2" colspan="1">N°</th>
                <th rowspan="2" colspan="3" class="head" style="text-align: center"><strong>Fecha Y Hora</strong></th>
                <th rowspan="2" colspan="2" class="head" style="text-align: center"><strong>Año Permiso</strong></th>
                <th rowspan="2" colspan="2" class="head" style="text-align: center"><strong>N° Especie</strong></th>
                <th rowspan="2" colspan="2" class="head" style="text-align: center"><strong>CI - RUC</strong></th>
                <th rowspan="2" colspan="5" class="head" style="text-align: center"><strong>Razon Social</strong></th>
                <th rowspan="2" colspan="2" class="head" style="text-align: center"><strong>Forma Pago</strong></th>
                <th rowspan="2" colspan="2" class="head" style="text-align: center"><strong>N° Documento</strong></th>
                <th rowspan="2" colspan="2" class="head" style="text-align: center"><strong>Valor Permiso</strong></th>
                <th rowspan="2" colspan="2" class="head" style="text-align: center"><strong>Valor Especie</strong></th>
                <th rowspan="2" colspan="2" class="head" style="text-align: center"><strong>Descuento</strong></th>
                <th colspan="7" style="text-align: center">RECARGOS</th>
                <th rowspan="2" class="head" style="text-align: center">Total</th>
            </tr>
            <tr>

                <td class="head" style="text-align: center"><strong>2018</strong></td>
                <td class="head" style="text-align: center"><strong>2019</strong></td>
                <td class="head" style="text-align: center"><strong>I</strong></td>
                <td class="head" style="text-align: center"><strong>II</strong></td>
                <td class="head" style="text-align: center"><strong>III</strong></td>
                <td class="head" style="text-align: center"><strong>IV</strong></td>
            </tr>
            </thead>
            <tbody>
                @forelse ($reporte as $item)
                <tr>
                    <td colspan="1" class="body">{{ $i++}}</td>
                    <td colspan="3" class="body">{{ $item['fechaYHora'] }}</td>
                    <td colspan="1" class="body">{{ $item['anio'] }}</td>
                    <td colspan="1" class="body">{{ $item['numEspecie'] }}</td>
                    <td colspan="2" class="body">{{ $item['ruc'] }}</td>
                    <td colspan="5" class="body">{{ $item['razonSocial'] }}</td>
                    <td colspan="2" class="body">{{ $item['formaPago'] }}</td>
                    <td colspan="2" class="body">{{ $item['numTransaccion'] }}</td>
                    <td colspan="1" class="body">{{ $item['valorPermiso'] }}</td>
                    <td colspan="1" class="body">{{ $item['valorEspecie'] }}</td>
                    <td colspan="1" class="body">{{ $item['descuento'] }}</td>
                    <td colspan="1" class="body">{{ $item['2018'] }}</td>
                    <td colspan="1" class="body">{{ $item['2019'] }}</td>
                    <td colspan="1" class="body">{{ $item['I'] }}</td>
                    <td colspan="1" class="body">{{ $item['II'] }}</td>
                    <td colspan="1" class="body">{{ $item['III'] }}</td>
                    <td colspan="1" class="body">{{ $item['IV'] }}</td>
                    <td colspan="1" class="body">{{ $item['total'] }}</td>
                </tr>
                @empty
                    @forelse ($especie as $item)
                    <tr>
                        <td colspan="1" class="body">{{ $i++}}</td>
                        <td colspan="3" class="body">{{ $item['fechaYHora'] }}</td>
                        <td colspan="1" class="body">{{ $item['anio'] }}</td>
                        <td colspan="1" class="body">{{ $item['numEspecie'] }}</td>
                        <td colspan="2" class="body">{{ $item['ruc'] }}</td>
                        <td colspan="5" class="body">{{ $item['razonSocial'] }}</td>
                        <td colspan="2" class="body">{{ $item['formaPago'] }}</td>
                        <td colspan="2" class="body">{{ $item['numTransaccion'] }}</td>
                        <td colspan="1" class="body">{{ $item['valorPermiso'] }}</td>
                        <td colspan="1" class="body">{{ $item['valorEspecie'] }}</td>
                        <td colspan="1" class="body">{{ $item['descuento'] }}</td>
                        <td colspan="1" class="body">{{ $item['2018'] }}</td>
                        <td colspan="1" class="body">{{ $item['2019'] }}</td>
                        <td colspan="1" class="body">{{ $item['I'] }}</td>
                        <td colspan="1" class="body">{{ $item['II'] }}</td>
                        <td colspan="1" class="body">{{ $item['III'] }}</td>
                        <td colspan="1" class="body">{{ $item['IV'] }}</td>
                        <td colspan="1" class="body">{{ $item['total'] }}</td>
                    </tr>
                    @empty
                       No hay Datos
                    @endforelse
                @endforelse
            </tbody>
    </table>
    
    
</body>
</html>