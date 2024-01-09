<!doctype html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" rel="stylesheet">
    <link href="/assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <title>PERMISO DE FUNCIONAMIENTO</title>
</head>
<body>


 <style>
    .pf__items_logo {
        position: absolute;
        left: -65px;
        top: 75px;
        width: 58%;
        background-image: url('./assets/images/Logo1.png')
    }
</style>
<img src="./assets/images/Logo1.png"  class="pf__items_logo2">


<style>
    html, body {
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    }
    .pf__items_logo2 {
        position: absolute;
        left: 500px;
        top: 850px;
        width: 10%;
    }
    .pf__items_titulo {
        position: absolute;
        left: 50px;
        top: 12px;
        font-size: 15px;
        font-family: Arial;
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    }
    .pf__items_dirrecon {
        position: absolute;
        left: 60px;
        top: 28px;
        font-size: 12px;
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
    .pf__item_foter_22 {
        position: relative;
        left: 240px;
        top: 280px;
        font-size: 12px;
    }

    .pf__item_a {
        position: relative;
        left: 130px;
        top: 340px;
        font-size: 12px;
    }

    .pf__item_b {
        position: absolute;
        left: 130px;
        top: 360px;
        font-size: 12px;
    }
    .pf__item_c {
        position: absolute;
        left: 130px;
        top: 380px;
        font-size: 12px;
    }
    .pf__item_di{
        position: absolute;
        left: 130px;
        top: 400px;
        font-size: 12px;
    }
    .pf__item_tele_{
        position: absolute;
        left: 130px;
        top: 420px;
        font-size: 12px;
    }
    .pf__item_d {
        position: absolute;
        left: 130px;
        top: 475px;
        font-size: 12px;
        text-align: justify;
        width: 540px;
    }
    .pf__item_d_2 {
        position: absolute;
        left: 130px;
        top: 600px;
        font-size: 12px;
        text-align: justify;
        width: 540px;
    }
    .pf__item_e {
        position: absolute;
        left: 130px;
        top: 700px;
        font-size: 12px;
        text-align: justify;
    }
    .pf__item_f {
        position: absolute;
        left: 130px;
        top: 750px;
        font-size: 12px;
    }
    .pf__item_fecha{
        position: absolute;
        left: 480px;
        top: 800px;
        font-size: 12px;
    }

    .pf__item_fecha2{
        position: absolute;
        left: 480px;
        top: 100px;
        font-size: 12px;
    }
    .pf__atentamente{
        position: absolute;
        left: 300px;
        top: 670px;
        font-size: 10px;
    }
    .pf__item_g {
        position: absolute;
        left: 160px;
        top: 770px;
        font-size: 11.5px;
    }
    .pf__item_h {
        position: absolute;
        left: 170px;
        top: 657px;
        font-size: 11.5px;
    }

</style>

<div class="pf__item_a">
            <b>RUC:</b> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            {{ $client[0]->ruc }}
        </div>

        <div class="pf__item_b">
            <b>NOMBRE DEL LOCAL:</b> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            {{ substr($client[0]->razonSocial, 0,50) }}
        </div>

        <div class="pf__item_c">
            <b>CONTRIBUYENTE:</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            {{substr($client[0]->representanteLegal, 0,50)}}
        </div>

        <div class="pf__item_di">
            <b>DIRECCIÓN:</b>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            {{substr($client[0]->parroquia.', '.$client[0]->barrio.', '.$client[0]->referencia, 0,60)}}
        </div>


        <div class="pf__item_tele_">
        <br>
            <b>TELF:</b>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;
            {{substr($client[0]->telefono, 0,10)}}
        </div>


        <div class="pf__item_d">
            Conste por medio de la presente haber cancelado el <b>PERMISO DE FUNCIONAMIENTO</b>
            en esta Dependencia, conformidad a lo que establece la Ordenanza Municipal Cantón Atacames, para el cobro de valores del Cuerpo de Bomberos, por concepto de tasas de servicios para prevención, mitigación y extinción de incendios dentro de la jurisdicción cantonal, aprobada mediante Edición Especial Nº 713 - Registro Oficial, de fecha 13 de enero de 2023 vigente, permiso que se deberá ser renovado.
        </div>
      
        <div class="pf__item_d_2">
        <b>{{ $client[0]->descripcion }}</b>
        </div>

        <div class="pf__item_e">
            <b>NOTA: </b>Los establecimientos de atencion al publico deberán proveerse del Equipo contra incendios.
        </div>

        <div class="pf__item_f">
           
            <b>PERMISO VÁLIDO HASTA DICIEMBRE 31 DEL {{substr($client[0]->anio,0,4)}}</b>
        </div>

<div class="pf__item_fecha">
    <small>&nbsp;&nbsp;&nbsp; Atacames, {{ now()->toDateTimeString()  }}</small>
 </div>





<style>
    .pf__item_foter{
        position: absolute;
        left: 150px;
        top: 920px;
        font-size: 10.5px;
    }
    .pf__item_foter_{
        position: absolute;
        left: 375px;
        top: 920px;
        text-align: right;
        font-size: 10.5px;
    }
</style>

<p class="pf__item_foter"> Abnegación y Disciplina</p>
<p  class="pf__item_foter_" ><i class="fa fa-bar-chart"></i>
    Dirección Av. Principal Atacames sector los Almendros<br>
    E-mail: recaudacion@bomberosatacames.gob.ec<br>
    Teléfono:+593 062760233
</p>



<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" type="text/javascript"></script>



</body>
</html>