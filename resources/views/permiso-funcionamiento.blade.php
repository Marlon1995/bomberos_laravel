<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PERMISO DE FUNCIONAMIENTO</title>
</head>
<body>

<!--
 <style>
    .pf__items_logo {
        position: absolute;
        left: -65px;
        top: -75px;
        width: 118%;
        background-image: url('./assets/images/Logo1.png')
    }
</style>
<img src="./assets/images/Logo1.png"  class="pf__items_logo2">-->


<style>
    html, body {
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    }
    .pf__items_logo2 {
        position: absolute;
        left: 125px;
        top: 80px;
        width: 20%;
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
    .pf__item_e {
        position: absolute;
        left: 130px;
        top: 555px;
        font-size: 12px;
        text-align: justify;
    }
    .pf__item_f {
        position: absolute;
        left: 130px;
        top: 615px;
        font-size: 12px;
    }
    .pf__item_fecha{
        position: absolute;
        left: 480px;
        top: 655px;
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
            <b>CLIENTE Y/O PROPIETARIO</b> &nbsp; &nbsp;
            {{substr($client[0]->representanteLegal, 0,50)}}
        </div>

        <div class="pf__item_di">
            <b>DIRECCIÓN:</b>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            {{substr($client[0]->parroquia.', '.$client[0]->barrio.', '.$client[0]->referencia, 0,60)}}
        </div>

        <div class="pf__item_tele_">
            <b>TELF:</b>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;
            {{substr($client[0]->telefono, 0,10)}}
        </div>


        <div class="pf__item_d">
            Conste por medio de la presente haber cancelado el <b>PERMISO DE FUNCIONAMIENTO</b>
            en esta Dependencia, de conformidad a lo que dispone el <b>Artículo 35 de la Ley de Defensa contra incendios </b>vigente,
            permiso que se deberá ser renovado cada año.
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
<p  class="pf__item_foter_" >
    Dirección Av. Principal Atacames sector Cocobamba<br>
    E-mail: administracion@bomberosatacames.gob.ec<br>
    Teléfono: +593 62731007
</p>




</body>
</html>