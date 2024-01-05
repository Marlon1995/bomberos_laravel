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
                
                
                <th rowspan="2" colspan="2" class="head" style="text-align: center"><strong>CI - RUC</strong></th>
                <th rowspan="2" colspan="5" class="head" style="text-align: center"><strong>Razon Social</strong></th>
                <th rowspan="2" colspan="2" class="head" style="text-align: center"><strong>Forma Pago</strong></th>
                <th rowspan="2" colspan="2" class="head" style="text-align: center"><strong>Valor Permiso</strong></th>
                <th rowspan="2" colspan="2" class="head" style="text-align: center"><strong>Año</strong></th>
                <th rowspan="2" colspan="2" class="head" style="text-align: center"><strong>N° Permiso</strong></th>
                <th rowspan="2" colspan="2" class="head" style="text-align: center"><strong>N° Transaccion</strong></th>
               
            </tr>
           
            </thead>
            <tbody>
                @forelse ($reporte as $item)
                <tr>
                    
             
                    <td colspan="2" class="body">{{  $item['ruc'] }}</td>
                    <td colspan="5" class="body">{{ $item['razonSocial'] }}</td>
                    <td colspan="2" class="body">{{ $item['formaPago'] }}</td>
            
                    <td colspan="1" class="body">{{ $item['valor'] }}</td>
                  
                    <td colspan="1" class="body">{{ $item['year_now'] }}</td>
                    <td colspan="1" class="body">{{ $item['numPermisoFuncionamiento'] }}</td>
                    <td colspan="1" class="body">{{ $item['numTransaccion'] }}</td>
             
                </tr>
                @empty

                <tr>
                
                
                <th rowspan="2" colspan="7" class="head" style="text-align: center"><strong>ESPECIES</strong></th>

            </tr>
                    
                @endforelse
            </tbody>
    </table>
    
    
</body>
</html>