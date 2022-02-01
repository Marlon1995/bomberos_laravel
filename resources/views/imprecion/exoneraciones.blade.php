<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PERMISO EXONERACION</title>
</head>
<body>




<!---

 <style>
    .pf__items_logo {
        position: absolute;
        left: -65px;
        top: -75px;
        width: 118%;
    }
</style>
<img src="./assets/índice.jpeg"  class="pf__items_logo">
--->

<style>
    html, body {
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    }
    .pf__items_logo2 {
        position: absolute;
        left: 425px;
        top: -12px;
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
        top: 200px;
        font-size: 12px;
    }
    .pf__atentamente{
        position: absolute;
        left: 150px;
        top: 820px;
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




@if(Str::contains($tipo, 'artesa') || Str::contains($tipo, 'ARTES') || Str::contains($tipo, 'CALI') || Str::contains($tipo, 'calif')) 


<div class="pf__item_fecha2">
   <small>&nbsp;&nbsp;&nbsp; Atacames, {{ now()->toDateTimeString()  }}</small>
</div>

        <div class="pf__item_a">
            <b>Ing.</b> 
            <br>
            <p>Karen Garcia</p>
             <p><b>FINANCIERA DEL CBCA</b></p>
             <p>En su despacho.-</p>
        </div>

      

    


        <div class="pf__item_d">
            De mis consideraciones Yo <b>{{substr($client[0]->representanteLegal, 0,50)}}</b> con cédula  <b>{{$client[0]->ruc}}</b> 
            propietario del negocio o establecimiento <b>{{substr($client[0]->razonSocial, 0,50)}}</b> ubicado en el Cantón 
            <b>ATACAMES PARROQUIA {{(strtoupper($client[0]->direccion))}} </b>
            <br></br>
            <br></br>
            Solicito a usted, se me considere:
            <br></br>
            <br></br>
            Se sirva a disponer a quien corresponda la exoneración del impuesto del permiso de Funcionamiento del Cuerpo de Bomberos, por concepto de <b>ARTESANO CALIFICADO</b>
            , de los años {{now()->year}}, derecho que me corresponde de conformidad al <b>Art. 9</b> en el numeral <b>12</b> de la <b>LEY DE ARTESANO CALIFICADO.</b>
            <br></br> 
            <br></br> 
            Por la atención que usted, le brinde al presente le anticipo mis agradecimientos.

            Atentamente
        </div>
      

    

        <div class="pf__atentamente">
        Sr(a).<b> {{substr($client[0]->representanteLegal, 0,50)}}</b>
        <br></br>
            <b>PROPIETARIO</b>
            <br></br>
            C.C. {{$client[0]->ruc}}
        </div>





@elseif(Str::contains($tipo, 'discapaci') || Str::contains($tipo, 'DISCA') ||  Str::contains($tipo, 'DIS') ||  Str::contains($tipo, 'dis')) 


<div class="pf__item_fecha2">
   <small>&nbsp;&nbsp;&nbsp; Atacames, {{ now()->toDateTimeString()  }}</small>
</div>

        <div class="pf__item_a">
            <b>Ing.</b> 
            <br>
            <p>Karen Garcia</p>
             <p><b>FINANCIERA DEL CBCA</b></p>
             <p>En su despacho.-</p>
        </div>

      

    


        <div class="pf__item_d">
            De mis consideraciones Yo <b>{{substr($client[0]->representanteLegal, 0,50)}}</b> con cédula  <b>{{$client[0]->ruc}}</b> 
            propietario del negocio o establecimiento <b>{{substr($client[0]->razonSocial, 0,50)}}</b> ubicado en el Cantón 
            <b>ATACAMES PARROQUIA {{(strtoupper($client[0]->direccion))}} </b>
            <br></br>
            <br></br>
            Solicito a usted, se me considere:
            <br></br>
            <br></br>
            Se sirva a disponer a quien corresponda la exoneración del impuesto del permiso de Funcionamiento del Cuerpo de Bomberos, por concepto de <b>DISCAPACIDAD</b>
            , de los años {{now()->year}}, derecho que me corresponde de conformidad al <b>Art. 47</b> en el numeral <b>4</b> de la <b>CONSTITUCIÓN DE LA REPÚBLICA DEL ECUADOR.</b>
            <br></br> 
            <br></br> 
            Por la atención que usted, le brinde al presente le anticipo mis agradecimientos.

            Atentamente
        </div>
      

    

        <div class="pf__atentamente">
        Sr(a).<b> {{substr($client[0]->representanteLegal, 0,50)}}</b>
        <br></br>
            <b>PROPIETARIO</b>
            <br></br>
            C.C. {{$client[0]->ruc}}
        </div>





@elseif(Str::contains($tipo, 'tercera') || Str::contains($tipo, 'TERCERA') || Str::contains($tipo, 'EDAD') || Str::contains($tipo, 'edad')) 


<div class="pf__item_fecha2">
   <small>&nbsp;&nbsp;&nbsp; Atacames, {{ now()->toDateTimeString()  }}</small>
</div>

        <div class="pf__item_a">
            <b>Ing.</b> 
            <br>
            <p>Karen Garcia</p>
             <p><b>FINANCIERA DEL CBCA</b></p>
             <p>En su despacho.-</p>
        </div>

      

    


        <div class="pf__item_d">
            De mis consideraciones Yo <b>{{substr($client[0]->representanteLegal, 0,50)}}</b> con cédula  <b>{{$client[0]->ruc}}</b> 
            propietario del negocio o establecimiento <b>{{substr($client[0]->razonSocial, 0,50)}}</b> ubicado en el Cantón 
            <b>ATACAMES PARROQUIA {{(strtoupper($client[0]->direccion))}} </b>
            <br></br>
            <br></br>
            Solicito a usted, se me considere:
            <br></br>
            <br></br>
            Se sirva a disponer a quien corresponda la exoneración del impuesto del permiso de Funcionamiento del Cuerpo de Bomberos, por concepto de <b>TERCERA EDAD</b>
            , de los años {{now()->year}}, derecho que me corresponde de conformidad al <b>Art. 37</b> en el numeral de la <b>CONSTITUCIÓN DE LA REPÚBLICA DEL ECUADOR.</b>
            <br></br> 
            <br></br> 
            Por la atención que usted, le brinde al presente le anticipo mis agradecimientos.

            Atentamente
        </div>
      

    

        <div class="pf__atentamente">
        Sr(a).<b> {{substr($client[0]->representanteLegal, 0,50)}}</b>
        <br></br>
            <b>PROPIETARIO</b>
            <br></br>
            C.C. {{$client[0]->ruc}}
        </div>



@endif


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