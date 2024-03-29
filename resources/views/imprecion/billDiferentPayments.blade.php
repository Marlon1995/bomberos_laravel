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
        left: 75px;
        font-weight: bold;
        top: -20px;
        font-size: 20px;
        font-family: Arial;
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    }

    .pf_registroAcuerdo{
        position: absolute;
        left: 190px;
        top: 35px;
        font-size: 10px;
        font-family: Arial;
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    }

    .pf__items_dirrecon {
        position: absolute;
        left: 180px;
        top: 8px;
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
        top: 115px;
        font-size: 13px;
        font-weight: bold;
    }
    .pf__item_fg {
        position: absolute;
        left: 465px;
        top: 130px;
        font-size: 11.5px;
    }


    .tbFactura{
        position: absolute;
        left: 70px;
        top: 180px;
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
        top: 420px;
        font-size: 11.5px;
    }

    .pf__item_f_DETALLE{
        position: absolute;
        left: 475px;
        top: 430px;
        font-weight: bold;
        font-size: 11.5px;
    }

    .pf__item_f_ {
        position: absolute;
        left: 180px;
        top: 420px;
        font-size: 11.5px;
    }

    .pf__item_f_DETALLE_ {
        position: absolute;
        left: 175px;
        top: 430px;
        font-weight: bold;
        font-size: 11.5px;
    }
    .pf__item_foter{
        position: absolute;
        left: 5px;
        top: 465px;
        font-size: 11.5px;
    }
    .pf__item_foter_{
        position: absolute;
        left: 420px;
        top: 465px;
        font-size: 11.5px;
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
        font-size: 8px;
    }

    .tbFactura{
       
       position: absolute;
       left: 150px;
       top: 170px;
       font-size: 11px;
       font-weight: bold;
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
            TEL&Eacute;FONO: 062731007</div>
        <br>
        <hr>
        <div class="pf__items_PERMISODE"><i>COMPROBANTE DE PAGO</i> </div>
        <p class="pf__item_fg"><small>&nbsp;&nbsp;&nbsp; Atacames, {{ $client[0]->created_at  }}</small></p>




        </div>


        <table class="tbFactura" >

        
            <tr>
                <td style="width: 75px">

                
                    <table border="1">
                        <tr>
                            <td>NOMBRE DEL LOCAL</td>
                            <td >{{$client[0]->razonSocial}}</td>
                        </tr>
                        <tr>
                            <td>PROPIETARIO O REPRESENTANTE</td>
                            <td>{{$client[0]->representanteLegal}}</td>
                        </tr>
                        <tr>
                            <td>DIRECCIÓN</td>
                            <td>{{ substr($client[0]->direccion,0,50)}}</td>
                        </tr>
                        <tr>
                            <td>RUC</td>
                            <td>{{$client[0]->ruc}}</td>
                        </tr>
                        <tr>
                            <td>TELÉFONO</td>
                            <td>{{$client[0]->telefono}}</td>
                        </tr>
                        <!-- <tr><td>CATEGORIA</td></tr> -->
                        <tr>
                            <td>AÑO A CANCELAR</td>
                            <td>Permiso año {{ $client[0]->year_now }}</td>
                        </tr>
                        <tr>
                            <td>VALOR ESTABLECIDO</td>
                            <td>
                                $ {{ floatval($client[0]->valor) }}
                            </td>
                        </tr>
                        <tr>
                            <td>SERVICIO ADMINISTRATIVO (TITULO DE CREDITO)</td>
                            <td>
                                $ 1.00
                            </td>
                        </tr>
                       
                        <tr>
                            <td><label class="tbFactura_trtdlabel">Recargo de Interés por Mora de conformidad al art. 21 del Código Tributario </label> </td>
                            <td style="padding-top:4px !important;padding-bottom:4px !important">
                                $ @php
                                    $resultado =  ((($client[0]->valor) * $client[0]->porcenjatetasa)/100);
                                    echo $resultado;
                                @endphp

                            </td>
                        </tr>
                        <tr>
                            <td>VALOR TOTAL A PAGAR</td>
                            <td>$ @php
                                    $resultado =  ((($client[0]->valor) * $client[0]->porcenjatetasa)/100);
                                    $total     =   ($client[0]->valor+1 + round($resultado , 3));
                                    echo $total;
                                @endphp

                            </td>
                        </tr>



                    </table>
                </td>
                <!-- <td style="width: 200px">
                    <table border="1">
                        <tr><td>{{$client[0]->razonSocial}}</td></tr>
                        <tr><td>{{$client[0]->representanteLegal}}</td></tr>
                        <tr><td>{{ substr($client[0]->direccion,0,50)}}</td></tr>
                         <tr><td>{{$client[0]->ruc}}</td></tr>
                        <tr><td>{{$client[0]->telefono}}</td></tr>
                        <tr><td>Permiso año {{ $client[0]->year_now }}</td></tr>
                        <tr><td>
                                $ {{ floatval($client[0]->valor) }}
                            </td>
                        </tr>

                        <tr><td> $ 0.00</td></tr>

                        <tr><td style="padding-top:4px !important;padding-bottom:4px !important">
                                $ @php
                                    $resultado =  ((($client[0]->valor) * $client[0]->porcenjatetasa)/100);
                                    echo $resultado;
                                @endphp

                            </td>
                        </tr>

                        <tr><td>$ @php
                                    $resultado =  ((($client[0]->valor) * $client[0]->porcenjatetasa)/100);
                                    $total     =   ($client[0]->valor + round($resultado , 3));
                                    echo $total;
                                @endphp

                            </td></tr>


                    </table>
                </td> -->
            </tr>
        </table>
        <p class="pf__item_f"><small>&nbsp;&nbsp;&nbsp; {{strtoupper($client[0]->representanteLegal) }} </small></p>
        <p class="pf__item_f_DETALLE"><small>&nbsp;&nbsp;&nbsp;  CONTRIBUYENTE</small></p>



    <p class="pf__item_f_"><small>&nbsp;&nbsp;&nbsp; {{strtoupper(  auth()->user()->nombre.' '.auth()->user()->apellido  ) }} </small></p>
    <p class="pf__item_f_DETALLE_"><small>&nbsp;&nbsp;&nbsp;  RECAUDADOR(A)</small></p>


    <hr class="dos_hr">


    <p class="pf__item_foter"> Abnegación y Disciplina</p>
    <p  class="pf__item_foter_"> Dirección Av. Principal Atacames sector los Almendros <br> E-mail: recaudacion@bomberosatacames.gob.ec </p>


    </div>
</div>







</body>
</html>