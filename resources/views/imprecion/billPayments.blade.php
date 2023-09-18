<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>COMPROBANTE DE PAGO</title>

</head>
<body>

<style>
    html, body {
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    }

    .pf__header {
        display: flex;

    }


    .pf__items_logo {
        position: absolute;
        left: 50px;
        top: 10px;
        width: 100px;
    }

    .pf__items_titulo {
        position: absolute;
        left: 100px;
        font-weight: bold;
        top: -30px;
        font-size: 18px;
        font-family: Arial;
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    }

    .pf_registroAcuerdo{
        position: absolute;
        left: 190px;
        top: 15px;
        font-size: 10px;
        font-family: Arial;
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    }

    .pf__items_dirrecon {
        position: absolute;
        left: 180px;
        top: 5px;
        font-size: 10px;
    }

    .pf__items_pago {
        position: absolute;
        left: 250px;
        top: 60px;
        font-size: 13px;
    }

    .pf__items_logo_ecu {
        position: absolute;
        left: -10px;
        top: 50px;
        font-size: 13px;
    }

    .pf__items_PERMISODE {
        position: absolute;
        left: 260px;
        top: 125px;
        font-size: 13px;
        font-weight: bold;
    }
    .pf__item_fg {
        position: absolute;
        left: 465px;
        top: 70px;
        font-size: 11.5px;
    }


    .tbFactura{
       height: 100px;
       width: 600px;
        position: absolute;
        left: 70px;
        top: 200px;
        font-size: 10px;
        font-weight: bold;
    }
    .tbDatos{
       
        position: absolute;
        left: 70px;
        top: 80px;
        font-size: 11px;
        font-weight: bold;
    }
    .pf__item_a {
        position: absolute;
        left: 10px;
        top: 125px;
        font-size: 12px;
    }

    .pf__item_b {
        position: absolute;
        left: 10px;
        top: 140px;
        font-size: 12px;
    }

    .pf__item_c {
        position: absolute;
        left: 10px;
        top: 155px;
        font-size: 12px;
    }

    .pf__item_d {
        position: absolute;
        left: 10px;
        top: 175px;
        font-size: 11.5px;
        text-align: justify;
    }

    .pf__item_e {
        position: absolute;
        left: 10px;
        top: 230px;
        font-size: 11.5px;
        text-align: justify;
    }

    .pf__item_f {
        position: absolute;
        left: 480px;
        top: 450px;
        font-size: 10px;
    }

    .pf__item_f_DETALLE{
        position: absolute;
        left: 500px;
        top: 460px;
        font-weight: bold;
        font-size: 10px;
    }

    .pf__item_f_ {
        position: absolute;
        left: 70px;
        top: 450px;
        font-size: 10px;
    }

    .pf__item_f_DETALLE_ {
        position: absolute;
        left: 73px;
        top: 460px;
        font-weight: bold;
        font-size: 10px;
    }
  
    .pf__item_foter{
        position: absolute;
        left: 10px;
        top: 480px;
        font-size: 10px;
    }
    
    .pf__item_foter_{
        position: absolute;
        left: 10px;
        top: 490px;
        font-size: 10px;
    }
    .pf__item_foter_fecha{
        position: absolute;
        left: 70px;
        top:380px;
        font-size: 10px;
    }
    .pf__item_foter_fecha2{
        position: absolute;
        left: 450px;
        top: 380px;
        font-size: 10px;
    }


    .pf__item_g {
        position: absolute;
        left: 30px;
        top: 295px;
        font-size: 11.5px;
    }

    .pf__item_h {
        position: absolute;
        left: 35px;
        top: 310px;
        font-size: 11.5px;
    }

    .original{
        position: absolute;
        left: 150px;
        top: 150px;
        font-size: 42px;
        font-weight: bold;
        color: red;
        opacity: .2;

    }



    hr{
        position: absolute;
        left: 0;
        top: 85px;
        background: #000000;
        width: 100%;

    }

    .dos_hr{
        position: absolute;
        left: 0;
        top: 460px;
        background: #000000;
        width: 100%;
    }
    .tbFactura_trtdlabel{
        font-size: 10px;
    }
</style>

<div class="container">
    <div class="pf__header">
       <!--
        <img class="pf__items_logo" src="https://www.bomberosatacames.gob.ec/wp-content/uploads/2019/11/cropped-logo-1-3.png" alt="Logo de Bomberos" title="Image" class="CToWUd">
        -->
        <div class="pf__items_titulo">&nbsp;&nbsp;CUERPO DE BOMBEROS DEL CANTÓN ATACAMES</div>
        <div class="pf__items_dirrecon">ACUERDO MINISTERIAL No. 1616 DEL 29 DE OCTUBRE DE 1997 </div>
        <div class="pf_registroAcuerdo">REGISTRO OFICIAL No. 741 DEL 29 DE ENERO DEL 2019 <br> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            RUC: 0860050690001 <br>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;
            TEL&Eacute;FONO: 062731007&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;DIRECCIÓN: AV PRINCIPAL/ATACAMES/SECTOR LOS ALMENDROS </div>
        <br>
       




    </div>
    <table class="tbDatos"  >
      
            <td style="width: 75px">
                <table border="0">
                    <tr><td>NOMBRE DEL ESTABLECIMIENTO:</td></tr>
                    <tr><td>CONTRIBUYENTE:</td></tr>
                    <tr><td>RUC:</td></tr>
                    <tr><td>DIRECCIÓN:</td></tr>
                    <tr><td>TELÉFONO:</td></tr>
                    <tr><td>AÑO A CANCELAR:</td><td>{{ $client[0]->year_now }}</td></tr>
                    



                </table>
            </td>
            <td style="width: 350px">
                <table border="0">
                   
                    <tr><td>{{$client[0]->razonSocial}}</td></tr>
                    <tr><td>{{$client[0]->representanteLegal}}</td></tr>
                    <tr><td>{{$client[0]->ruc}}</td></tr>
                    <tr><td>{{ substr( strtoupper($client[0]->parroquia.'/'.$client[0]->barrio.'/'.$client[0]->referencia),0,70) }}</td></tr>
                    <tr><td>{{$client[0]->telefono}}</td></tr>
                    <tr><td >No. EMISIÓN: 000001</td></tr>

                </table>
            </td>
    </table>
      
    <table class="tbFactura" >
        <td style="width: 300px">
            <br></br>
            <p ><h3 style="text-align: center;">PERMISO DE FUNCIONAMIENTO</h3></p>    
                <table border="1">
                <tr><td style="text-align:center">RUBROS</td><td  style="width: 300px; text-align:center">VALORES</td></tr>
                    <tr><td>VALOR ESTABLECIDO</td><td style="width: 300px; text-align:center"> @php
                           
                           $especie=0;
                           if ( $client[0]->tipos_pago == 'TOTAL'){
                           $especie = 2;
                         
                           }

                       @endphp
                       $ {{$client[0]->valor - $especie}}</td></tr>
                    <tr><td>VALOR ESPECIE</td><td style="width: 300px; text-align:center">$ {{$especie}}</td></tr>
                    <tr><td>SERVICIO ADMINISTRATIVO (TITULO DE CREDITO)</td><td style="width: 300px; text-align:center">$ 1.00</td></tr>
                    @php
                     if($client[0]->valor<=4)
                     $permiso = 2;
                     else
                     $permiso = 0;
                     @endphp
                     @php
                     if($client[0]->recargo!='')
                     $recargo = $client[0]->recargo;
                     else
                     $recargo = 0;
                     @endphp
                    <tr> <td>VALOR P. EXONERACION</td><td style="width: 300px; text-align:center">$ {{$permiso}}</td></tr>
                    <tr><td><label class="tbFactura_trtdlabel">RECARGO TASA ACTIVA REF.BCE. ORD.#74 CON <br> FECHA 31 DE OCTUBRE 2018</label> </td><td style="width: 300px; text-align:center">${{$recargo}}</td></tr>
                    <tr><td>VALOR TOTAL A PAGAR</td><td style="width: 300px; text-align:center">$ {{round($client[0]->valor+$client[0]->recargo+$permiso+1,2) }}</td></tr>

                    </table>
                    </td>
               
           
           
    
    </table>
    <p class="pf__item_foter_fecha"><small> Fecha Emisión: {{ $client[0]->created_at  }}</small></p>
    <p class="pf__item_foter_fecha2"><small> Fecha Impresión: {{ date('Y-m-d H:i:s')}}</small></p>


    <p class="pf__item_f"><small> {{trim($client[0]->representanteLegal) }} </small></p>
    <p class="pf__item_f_DETALLE"><small> CONTRIBUYENTE</small></p>



    <p class="pf__item_f_"><small>&nbsp;&nbsp;&nbsp; Tnlga. {{strtoupper(  auth()->user()->nombre.' '.auth()->user()->apellido  ) }} </small></p>
    <p class="pf__item_f_DETALLE_"><small>&nbsp;&nbsp;&nbsp;  RECAUDADOR(A)</small></p>


  


    <p class="pf__item_foter"> CBA - Abnegación y Disciplina</p>
    <p  class="pf__item_foter_"> E-mail: administracion@bomberosatacames.gob.ec </p>


</div>
</div>







</body>
</html>