<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Caja Diaria</title>
</head>
<body>

<style>
    .head{
        text-align: center;
        align:center;
        font-weight: bold;
    }
    .title{
        text-align: center;
        align:center;
        font-size: 24px;
    }
    .body{
        text-align: center;
    }
table {
  border: #b2b2b2 1px solid;
}
td {
  border: black 1px solid;
}
th {
  border: black 1px solid;
}
</style>





            <table>
            <tr>
            <th  colspan="27"  class="title" > 
            <center>  <h1>  <strong> CIERRE CAJA DIARIO </strong> </h1> </center> 
            
            </th>
               
                   
                </tr>
                <tr>
                    <td rowspan="2" colspan="1" >N°</td>
                    <td rowspan="2" colspan="3" class="head"> <strong> FECHA Y HORA</strong> </td>
                    <td rowspan="2" colspan="1" class="head"><strong> AÑO PERMISO</strong> </td>
                    <td rowspan="2" colspan="1" class="head"><strong> N° ESPECIE</strong> </td>
                    <td rowspan="2" colspan="2" class="head"><strong> CI-RUC</strong> </td>
                    <td rowspan="2" colspan="5" class="head"><strong> RAZÓN SOCIAL</strong> </td>
                    <td rowspan="2" colspan="2" class="head"><strong> FORMA PAGO</strong> </td>
                    <td rowspan="2" colspan="2" class="head"><strong> N° DOCUMENTO/ TRANS</strong> </td>
                    <td rowspan="2" colspan="1" class="head"><strong> VALOR PERMISO</strong> </td>
                    <td rowspan="2" colspan="1" class="head"><strong> VALOR ESPECIE</strong> </td>
                    <td rowspan="2" colspan="1" class="head"><strong> DESCUENTO</strong> </td>
                    <td colspan="6" class="head" ><strong>RECARGOS</strong></td>
                    <td rowspan="2" class="head"><strong>TOTAL</strong></td>
                </tr>
                <tr>
        
                    <td class="head"><strong>2018</strong></td>
                    <td class="head"><strong>2019</strong></td>
                    <td class="head"><strong>I</strong></td>
                    <td class="head"><strong>II</strong></td>
                    <td class="head"><strong>III</strong></td>
                    <td class="head"><strong>IV</strong></td>
                </tr>

                @php  $i = ''; 
                $valor_permiso=0;
                $valor_especie= 0;
                $valor_descuento= 0;
                $valor_2018= 0;
                $valor_2019= 0;
                $valor_I= 0;
                $valor_II= 0;
                $valor_III= 0;
                $valor_IV= 0;
                $valor_total= 0;
                @endphp

                
                @forelse( $reporte as  $item )

                <tr>
                    <td colspan="1" class="body">{{$i++}}</td>
                    <td colspan="3" class="body">{{$item['fechaYHora']}}</td>
                    <td colspan="1" class="body">{{$item['anio']}}</td>
                    <td colspan="1" class="body">{{$item['numEspecie']}}</td>
                    <td colspan="2" class="body">{{$item['ruc']}}</td>
                    <td colspan="5" class="body">{{$item['razonSocial']}}</td>
                    <td colspan="2" class="body">{{$item['formaPago']}}</td>
                    <td colspan="2" class="body">{{$item['numTransaccion']}}</td>
                    <td colspan="1" class="body">{{$item['valorPermiso']}}</td>
                    <td colspan="1" class="body">{{$item['valorEspecie']}}</td>
                    <td colspan="1" class="body">{{$item['descuento']}}</td>
                    <td colspan="1" class="body">{{$item['2018']}}</td>
                    <td colspan="1" class="body">{{$item['2019']}}</td>
                    <td colspan="1" class="body">{{$item['I']}}</td>
                    <td colspan="1" class="body">{{$item['II']}}</td>
                    <td colspan="1" class="body">{{$item['III']}}</td>
                    <td colspan="1" class="body">{{$item['IV']}}</td>
                    <td colspan="1" class="body">{{$item['total']}}</td>
                </tr>
                @php
                $valor_permiso=$valor_permiso+$item['valorPermiso']; 
                $valor_especie=$valor_especie+$item['valorEspecie'];
                $valor_descuento= $valor_descuento+$item['descuento'];
                $valor_2018= $valor_2018+$item['2018'];
                $valor_2019= $valor_2019+$item['2019'];
                $valor_I= $valor_I+$item['I'];
                $valor_II= $valor_II+$item['II'];
                $valor_III= $valor_III+$item['III'];
                $valor_IV= $valor_IV+$item['IV'];
                $valor_total= $valor_total+$item['total'];
                @endphp
                @empty

              
                @endforelse
         
                <tr>
                    <td colspan="1" class="body"></td>
                    <td colspan="3" class="body"></td>
                    <td colspan="1" class="body"></td>
                    <td colspan="1" class="body"></td>
                    <td colspan="2" class="body"></td>
                    <td colspan="5" class="body"></td>
                    <td colspan="2" class="body"></td>
                    <td colspan="2" class="body"><strong>TOTALES</strong></td>
                    <td colspan="1" class="body"><strong>{{$valor_permiso}}</strong> </td>
                    <td colspan="1" class="body"> <strong>{{$valor_especie}}</strong></td>
                    <td colspan="1" class="body"> <strong>{{$valor_descuento}}</strong></td>
                    <td colspan="1" class="body"> <strong>{{$valor_2018}}</strong></td>
                    <td colspan="1" class="body"> <strong>{{$valor_2019}}</strong></td>
                    <td colspan="1" class="body"> <strong>{{$valor_I}}</strong></td>
                    <td colspan="1" class="body"><strong>{{$valor_II}}</strong></td>
                    <td colspan="1" class="body"> <strong>{{$valor_III}}</strong></td>
                    <td colspan="1" class="body"> <strong>{{$valor_IV}}</strong></td>
                    <td colspan="1" class="body"> <strong>{{$valor_total}}</strong></td>
                   
                </tr>
                
            </table>
     


</body>
</html>
