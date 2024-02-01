@extends('layout')

@section('title', ucwords($data[0]->nombre))
@section('icono', $data[0]->icono )

@section('pagecontent')

    @if ( session()->has('Respuesta') )       <label id="Respuesta" style="display: none;">{{ session('Respuesta') }}</label>
    <script>toastr.success($("#Respuesta").text()); </script>
    @endif

    @if ( session()->has('Respuesta_erro') )  <label id="Respuesta_erro" style="display: none;">{{ session('Respuesta_erro') }}</label>
    <script>toastr.error($("#Respuesta_erro").text()); </script>
    @endif

    @if ( session()->has('Respuesta_wn') )  <label id="Respuesta_wn" style="display: none;">{{ session('Respuesta_wn') }}</label>
    <script>toastr.warning($("#Respuesta_wn").text(), 'Alerta', {timeOut: 5000}); </script>
    @endif

    <style>
        .ui-pnotify-shadow{
            display: none;
        }
    </style>


    <div class="right_col" role="main">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_content">
                    <!--contenido-->
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="solicitudes" role="tabpanel" >
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="page-title">
                                        <div class="title_left">
                                            <h2><i class="fa fa-usd"></i> COBROS ORDENANZAS</h2>
                                        </div>
                                    </div>                                
                                    
                                    
                                    <div class="modal-body">
                                        <div class="form-group row" style="margin-left: 10px">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-sm-3" style="text-align: right">
                                                        <img src="/assets/img/icons/logo.png" width="100px">
                                                    </div>
                                                    <div class="col-sm-6" style="text-align: center">
                                                        <h2 style="margin: 2px; font-weight: bold;">ACUERDO MINISTERIAL N° 1616 DEL 29 DE OCTUBRE DE 1997</h2>
                                                        <p style="margin: 2px; font-weight: bold;">REGISTRO OFICIAL N° 741 DEL 29 DE ENERO DEL 2019</p>
                                                        <p style="margin: 2px; font-weight: bold;">RUC 08600506900001</p>
                                                        <p style="margin: 2px; font-weight: bold;">TELEFONO: 0602731-001</p>
                                                    </div>
                                                    <div class="col-sm-3"></div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-3"></div>
                                                    <div class="col-sm-6" style="text-align: center">
                                                        <h2 style="text-align: center; font-weight: bold">ORDEN DE PAGO DE PERMISO DE ORDENANZAS</h2>
                                                        <p style="text-align: right;">Atacames, {{ now()->toDateTimeString()  }}</p>
                                                        <p style="text-align: right;">Permiso año {{date('Y')}} </p>
                                                        <style>
                                                            .margin_p{
                                                                margin: -6px;
                                                            }
                                                        </style>


                                                        <form method="POST" action="agregar-cobro-ordenanza">
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                            <div class="container">
                                                                <div class="row" style="border: 1px solid;">
                                                                    <div class="col-sm-1"></div>
                                                                    <div class="col-sm-10" style="text-align: left;padding: 10px">

                                                                        <div class="item form-group ">
                                                                            <label class="col-form-label col-md-4 col-sm-4 label-align" for="cedula">RUC</label>
                                                                            <div class="col-md-9 col-sm-9">
                                                                                <input type="text" class="form-control" name="ruc" id="ruc"  onKeyPress="return fn_aceptaNum(event)"  placeholder="RUC" required>
                                                                            </div>
                                                                        </div>


                                                                        <div class="item form-group ">
                                                                            <label class="col-form-label col-md-4 col-sm-4 label-align" for="cedula">NOMBRE DEL LOCAL</label>
                                                                            <div class="col-md-9 col-sm-9">
                                                                                <input type="text" class="form-control" name="nombreLocal" id="nombreLocal"  placeholder="NOMBRE DEL LOCAL" required>
                                                                            </div>
                                                                        </div>

                                                                        <div class="item form-group ">
                                                                            <label class="col-form-label col-md-4 col-sm-4 label-align" for="cedula">REPRESENTANTE LEGAL- PROPIETARIO</label>
                                                                            <div class="col-md-9 col-sm-9">
                                                                                <input type="text" class="form-control" name="representanteLegal" id="representanteLegal"  onKeyPress="return fn_aceptaLETRAS(event)"   placeholder="PROPIETARIO" required>
                                                                            </div>
                                                                        </div>

                                                                   

                                                                     

                                                                        <div class="item form-group ">
                                                                            <label class="col-form-label col-md-4 col-sm-4 label-align" for="cedula">TELÉFONO</label>
                                                                            <div class="col-md-9 col-sm-9">
                                                                                <input type="text" class="form-control" name="telefono" id="telefono"  placeholder="TELEFONO" required>
                                                                            </div>
                                                                        </div>

                                                                        <div class="item form-group ">
                                                                            <label class="col-form-label col-md-4 col-sm-4 label-align" for="cedula">DIRECCIÓN</label>
                                                                            <div class="col-md-9 col-sm-9">
                                                                                <!-- <input type="text" class="form-control " name="num_permiso_funcionamiento"   placeholder="NÚMERO PERMISO FUNCIONAMIENTO" required> -->
                                                                                <input type="text" class="form-control" name="direccion" id="direccion"   placeholder="DIRECCIÓN" required>

                                                                            </div>
                                                                        </div>

                                                                        
                                                                    </div>
                                                                    <div class="col-sm-1"></div>
                                                                </div>


                                                                <div class="row" style="border: 1px solid;">
                                                                    <div class="col-sm-1"></div>
                                                                    <div class="col-sm-10" style="text-align: left;padding-top: 10px">
                                                                        <div class="item form-group ">
                                                                            <label class="col-form-label col-md-4 col-sm-2 label-align" for="cedula">Tipo Ordenanza</label>
                                                                            <div class="col-md-9 col-sm-4">
                                                                                <select class="form-control" id="tipoOrdenanza" name="tipoOrdenanza" >
                                                                                    <option  selected>Seleccionar Tipo Ordenanza</option>
                                                                                    <option  value="1">De las Gasolineras</option>
                                                                                    <option  value="2">Transporte de Combustibles</option>
                                                                                    <option  value="3">Espectáculos o eventos</option>
                                                                                    <option  value="4">Aprobación de planos</option>
                                                                                    <option  value="5">Infracciones y multas</option>
                                                                                </select>                                                                              
                                                                            </div>
                                                                        </div>                                                                        
                                                                    </div>
                                                                    <div class="col-sm-1"></div>
                                                                    
                                                                    <div class="col-sm-1"></div>
                                                                    <div class="col-sm-10" style="text-align: left;padding-top: 10px">
                                                                        <div class="item form-group combustibles-div" id="combustibles-div" style="display:none">
                                                                            <label class="col-form-label col-md-4 col-sm-2 label-align" for="cedula">Seleccionar tasa de servicios</label>
                                                                            <div class="col-md-9 col-sm-4">
                                                                                <select class="form-control" id="combustibles" name="combustibles" >
                                                                                    <option  value="" selected>Seleccionar Opción</option>
                                                                                    <option  value="1">Transporte de gas doméstico 14 KG</option>
                                                                                    <option  value="2">Transporte de gas GPL industrial desde 45 KG</option>
                                                                                    <option  value="3">Transporte de aceite automotriz e industrial</option>
                                                                                    <option  value="4">Transporte de combustible</option>
                                                                                    <option  value="5">Transporte de quimicos y materiales peligrosos</option>
                                                                                </select>                                                                              
                                                                            </div>
                                                                        </div>                                                                        
                                                                    </div>
                                                                    <div class="col-sm-1"></div>
                                                                    

                                                                    <div class="col-sm-1"></div>
                                                                    <div class="col-sm-10" style="text-align: left;padding-top: 10px">
                                                                        <div class="item form-group espectaculos-div" id="espectaculos-div" style="display:none">
                                                                            <label class="col-form-label col-md-4 col-sm-2 label-align" for="cedula">Seleccionar permiso ocasional</label>
                                                                            <div class="col-md-9 col-sm-4">
                                                                                <select class="form-control" id="espectaculos" name="combustibles" >
                                                                                    <option  value="" selected>Seleccionar Opción</option>
                                                                                    <option  value="1">Circos y afines</option>
                                                                                    <option  value="2">Juegos mecánicos y afines</option>
                                                                                    <option  value="3">Evento barrial</option>
                                                                                    <option  value="4">Parroquial, comunitario y otros</option>
                                                                                    <option  value="5">Espectáculos de fuego</option>
                                                                                    <option  value="6">Eventos de carácter nacional (públicos – privados)</option>
                                                                                    <option  value="7">Eventos de carácter internacional (públicos – privados)</option>
                                                                                </select>                                                                              
                                                                            </div>
                                                                        </div>                                                                        
                                                                    </div>
                                                                    <div class="col-sm-1"></div>

                                                                    <div class="col-sm-1"></div>
                                                                    <div class="col-sm-10" style="text-align: left;padding-top: 10px">
                                                                        <div class="item form-group planos-div" id="planos-div" style="display:none">
                                                                            <label class="col-form-label col-md-4 col-sm-2 label-align" for="cedula">Seleccionar tipo de planos</label>
                                                                            <div class="col-md-9 col-sm-4">
                                                                                <select class="form-control" id="planos" name="planos" >
                                                                                    <option  value="" selected>Seleccionar Opción</option>
                                                                                    <option  value="1">Viviendas</option>
                                                                                    <option  value="2">Edificaciones de uso residencial de 4 o más pisos</option>
                                                                                    <option  value="3">Uso comercial</option>
                                                                                    <option  value="4">Urbanizaciones, Conjuntos habitacionales u otros</option>
                                                                                    <option  value="5">Uso Industrial</option>
                                                                                </select>                                                                              
                                                                            </div>
                                                                        </div>                                                                        
                                                                    </div>
                                                                    <div class="col-sm-1"></div>

                                                                    <div class="col-sm-1"></div>
                                                                    <div class="col-sm-10" style="text-align: left;padding-top: 10px">
                                                                        <div class="item form-group infracciones-div" id="infracciones-div" style="display:none">
                                                                            <label class="col-form-label col-md-4 col-sm-2 label-align" for="cedula">Seleccionar tipo de planos</label>
                                                                            <div class="col-md-9 col-sm-4">
                                                                                <select class="form-control" id="infracciones" name="infracciones" >
                                                                                    <option  value="" selected>Seleccionar Opción</option>
                                                                                    <option  value="1">Rotura Sellos</option>
                                                                                    <option  value="2">Multa - Primera Citación</option>
                                                                                    <option  value="3">Multa - Segunda Citación</option>
                                                                                    <option  value="4">Multa - Tercera Citación</option>
                                                                                    <option  value="5">Multa - Clausura</option>
                                                                                </select>                                                                              
                                                                            </div>
                                                                        </div>                                                                        
                                                                    </div>
                                                                    <div class="col-sm-1"></div>
                                                                    
                                                                    
                                                                    <div class="col-sm-1"></div>
                                                                    <div class="col-sm-10" style="text-align: left;padding-top: 10px">
                                                                        <div class="item form-group" id="input-cantidad" style="display: none;">
                                                                            <label class="col-form-label col-md-4 col-sm-4 label-align" id="mensaje-input" for="cedula"></label>
                                                                            <div class="col-md-9 col-sm-9">
                                                                                <input type="text" class="form-control " id="cantidad" name="cantidad"   placeholder="Ej: 123" >
                                                                            </div>
                                                                        </div>
                                                                    </div>  
                                                                    <div class="col-sm-1"></div>
                                                                    
                                                                    <div class="col-sm-12" >
                                                                    
                                                                   
                                                                    <input type="hidden" class="form-control" name="valor" id="valor" required onKeyPress="return fn_aceptaNum(event)"  value="" placeholder="Ej. 2.842" style="text-align: center">

                                                                    </div>
                                                                    <div class="col-sm-12" >
                                                                    <label id="" style="font-size: 42px;">$</label>
                                                                     <label id="valorCalculado" style="font-size: 42px;">0</label>
                                                                    </div>
                                                                    <div class="col-sm-12" >
                                                                  
                                                                        <div class="btn btn-success calcularValorPorcenjate">CALCULAR <i class="fa fa-calculator" style="font-size: 15px"></i></div>
                                                                      
                                                                   
                                                                    
                                                                    <div class="col-sm-12" >
                                                                 
                                                                    <input type="submit" value="EMITIR" class="btn btn-info" style="font-size: 35px; text-align:center">

                                                                    </div>
                                                                    
                                                                    <div class="col-sm-1"></div>
                                
                

                                                                </div>
                                                            </div>
                                                        </form>


                                                    </div>
                                                    <div class="col-sm-3"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scrpts-jqrey')
    <script>
        var total_pagar = 0;
        var precio_ordenanza = 0;
        var cantidad=0;
        var tipo_ordenanza='';
        var tipo_subordenanza='';
        var tiene_rango=0;
        var salario_basico='450'

        $("#porcentajedescuento").hide();
        $("#input-cantidad").hide();


        var tbClientesSecretario;
         $("#tbClientesSecretario_InpBuscar").val("");

        fn_tbClienteSecretario_ini();
        function fn_tbClienteSecretario_ini() {
            tbClientesSecretario = $("#tbClientesSecretario").dataTable({
                pageLength: 10,
                order: [[1, "asc"]],
                "language": {
                    "lengthMenu": 'Mostrar'+
                    '<select style="width:60px" >'+
                    '<option>5</option>'+
                    '<option>10</option>'+
                    '<option>20</option>'+
                    '<option>25</option>'+
                    '<option value="-1">Todos</option>'+
                    '</select> registros por página',
                    "zeroRecords": "No se encontraron resultados en su busqueda",
                    "searchPlaceholder": "Buscar por..",
                    "info": " ",
                    "infoEmpty": "No existen registros",
                    "infoFiltered": "",
                    "search": "Buscar:",
                    "processing": "Procesando...:",
                    "paginate": {
                        "first": "Primero",
                        "last": "Último",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    },
                }
            });
        }
        
        $("#formaPago").change(function () {
            var $select  = $("select[id=formaPago]").val(); // 1 es efectivo

            if( $select == 1 ){
                $(".numTransaccion_1CAJA").hide();
            }else {
                $(".numTransaccion_1CAJA").show();

            $("#numTransaccion").val("0");
            }
        });

    
        $(".calcularValorPorcenjate").click( function () {   
            console.log(total_pagar)
            let inputValue = document.getElementById("cantidad").value; 
            
            if(precio_ordenanza > 0){
                total_pagar=inputValue*precio_ordenanza;
            }else{
                total_pagar=total_pagar;
            }

            if(tipo_ordenanza == 'transporte-combustible' && tiene_rango == 1 ){
                if(tipo_subordenanza=='t_aceite_automotriz'){
                    if(inputValue >= 1 && inputValue <= 1000 ){
                        total_pagar=50;
                    }else {
                        if(inputValue >= 1001 && inputValue <= 3000 ){
                            total_pagar=80;
                        }else{
                            if(inputValue >= 3001 ){
                                total_pagar=100;
                            }
                        }
                    }

                }else{
                    if(tipo_subordenanza=='t_combustible' || tipo_subordenanza=='t_quimicos_mp'){
                        if(inputValue >= 1 && inputValue <= 1000 ){
                            total_pagar=100;
                        }else {
                            if(inputValue >= 1001 && inputValue < 3000 ){
                                total_pagar=200;
                            }else{
                                if(inputValue >= 3001 ){
                                    total_pagar=250;
                                }
                            }
                        }
                    }
                }
                
            }else{
                if(tipo_ordenanza == 'espectaculos' && tiene_rango == 1){
                    if(tipo_subordenanza=='circos_y_afines'){
                        if(inputValue >= 0 && inputValue <= 500 ){
                            total_pagar=80;
                        }else {
                            if(inputValue >= 501 && inputValue <= 1500 ){
                                total_pagar=150;
                            }else{
                                if(inputValue >= 1501 && inputValue <= 5000 ){
                                    total_pagar=200;
                                }else{
                                    if(inputValue >= 5001){
                                        total_pagar=250;
                                    }
                                }
                            }
                        }

                    } else{
                        if(tipo_subordenanza=='juegos_mecanicos'){
                            if(inputValue >= 0 && inputValue <= 500 ){
                                total_pagar=100;
                            }else {
                                if(inputValue >= 501 && inputValue <= 1500 ){
                                    total_pagar=150;
                                }else{
                                    if(inputValue >= 1501 && inputValue <= 5000 ){
                                        total_pagar=200;
                                    }else{
                                        if(inputValue >= 5001){
                                            total_pagar=250;
                                        }
                                    }
                                }
                            }

                        }else{
                            if(tipo_subordenanza=='evento_barrial'){
                                if(inputValue >= 0 && inputValue <= 500 ){
                                    total_pagar=30;
                                }else {
                                    if(inputValue >= 501 && inputValue <= 1500 ){
                                        total_pagar=50;
                                    }else{
                                        if(inputValue >= 1501 && inputValue <= 5000 ){
                                            total_pagar=80;
                                        }else{
                                            if(inputValue >= 5001){
                                                total_pagar=100;
                                            }
                                        }
                                    }
                                }

                            }else{
                                if(tipo_subordenanza=='parroquia_com_otros'){
                                    if(inputValue >= 0 && inputValue <= 500 ){
                                        total_pagar=50;
                                    }else {
                                        if(inputValue >= 501 && inputValue <= 1500 ){
                                            total_pagar=75;
                                        }else{
                                            if(inputValue >= 1501 && inputValue <= 5000 ){
                                                total_pagar=100;
                                            }else{
                                                if(inputValue >= 5001){
                                                    total_pagar=150;
                                                }
                                            }
                                        }
                                    }

                                }else{
                                    if(tipo_subordenanza=='fuego'){
                                        if(inputValue >= 0 && inputValue <= 500 ){
                                            total_pagar=80;
                                        }else {
                                            if(inputValue >= 501 && inputValue <= 1500 ){
                                                total_pagar=150;
                                            }else{
                                                if(inputValue >= 1501 && inputValue <= 5000 ){
                                                    total_pagar=200;
                                                }else{
                                                    if(inputValue >= 5001){
                                                        total_pagar=250;
                                                    }
                                                }
                                            }
                                        }

                                    }else{
                                        if(tipo_subordenanza=='nacional'){
                                            if(inputValue >= 0 && inputValue <= 500 ){
                                                total_pagar=80;
                                            }else {
                                                if(inputValue >= 501 && inputValue <= 1500 ){
                                                    total_pagar=150;
                                                }else{
                                                    if(inputValue >= 1501 && inputValue <= 5000 ){
                                                        total_pagar=200;
                                                    }else{
                                                        if(inputValue >= 5001){
                                                            total_pagar=250;
                                                        }
                                                    }
                                                }
                                            }

                                        }else{
                                            if(tipo_subordenanza=='internacional'){
                                                if(inputValue >= 0 && inputValue <= 500 ){
                                                    total_pagar=150;
                                                }else {
                                                    if(inputValue >= 501 && inputValue <= 1500 ){
                                                        total_pagar=200;
                                                    }else{
                                                        if(inputValue >= 1501 && inputValue <= 5000 ){
                                                            total_pagar=250;
                                                        }else{
                                                            if(inputValue >= 5001){
                                                                total_pagar=350;
                                                            }
                                                        }
                                                    }
                                                }

                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }else{
                    if(tipo_ordenanza == 'planos'){
                        total_pagar=inputValue*precio_ordenanza;
                    }
                }
            }

            $("#valorCalculado").text(total_pagar);
            $("#valor").val(total_pagar).val();
        });

        $("#ruc").change(function () {
            var ruc = $("#ruc").val();
            if(ruc ==''){
                toastr.warning('Ingrese un número de RUC para la verificación');
                return true;
            }
            var endpoint = 'verificaRuc/'+ruc;

            $.ajax({
                async: false,
                type: "GET",
                dataType: "json",
                contentType: "application/x-www-form-urlencoded",
                url: endpoint,
                success: function( datos ){
                    if(datos[0].ruc == ruc){
                        toastr.success('El RUC: '+datos[0].ruc+ ', YA EXISTE');
                        $("#nombreLocal").val(datos[0].razonSocial);
                        $("#representanteLegal").val(datos[0].representanteLegal);
                        $("#telefono").val(datos[0].telefono);
                        $("#direccion").val(datos[0].referencia);
                        return true;
                    }

                    toastr.error('No existen coincidencias, '+datos[0].ruc);
                    $("#nombreLocal").val("");
                    $("#representanteLegal").val("");
                    return true;
                }
            });
        });

        $("#tipoOrdenanza").change(function () {
            var ordenanza =$("select[id=tipoOrdenanza]").val();
            switch (ordenanza){
                case '1':
                    reiniciar_select();
                    
                    $("#espectaculos-div").hide();
                    $("#combustibles-div").hide();
                    $("#infracciones-div").hide();
                    $("#planos-div").hide();
                    $("#input-cantidad").show();
                    $("#mensaje-input").text('Cantidad de surtidores');

                    precio_ordenanza = 120;
                    tipo_ordenanza='gasolinera';

                    break;
                case '2':
                    reiniciar_select();
                    $("#input-cantidad").hide();
                    $("#espectaculos-div").hide();
                    $("#combustibles-div").show();
                    $("#infracciones-div").hide();
                    $("#planos-div").hide();


                    tipo_ordenanza='transporte-combustible';

                    break;
                case '3':
                    reiniciar_select();
                    $("#input-cantidad").hide();
                    $("#combustibles-div").hide();
                    $("#espectaculos-div").show();
                    $("#infracciones-div").hide();

                    $("#planos-div").hide();


                    tipo_ordenanza='espectaculos'
                    break;
                case '4':
                    reiniciar_select();
                    $("#input-cantidad").hide();
                    $("#espectaculos-div").hide();
                    $("#combustibles-div").hide();
                    $("#infracciones-div").hide();

                    $("#planos-div").show();

                    tipo_ordenanza='planos'
                    break;
                case '5':
                    reiniciar_select();
                    $("#input-cantidad").hide();
                    $("#combustibles-div").hide();
                    $("#espectaculos-div").hide();
                    $("#planos-div").hide();
                    $("#infracciones-div").show();


                    tipo_ordenanza='infracciones_multas'
                    break;
                default:
                    console.log('no hay');
            } 
        });

        $("#combustibles").change(function () {
            var transporte =$("select[id=combustibles]").val();
            switch (transporte){
                case '1':
                    reiniciar_select();
                    $("#mensaje-input").text('Cantidad Cilindros');
                    $("#input-cantidad").show();
                    precio_ordenanza=0.75;

                    break;
                case '2':
                    reiniciar_select();
                    $("#mensaje-input").text('Cantidad Cilindros');
                    $("#input-cantidad").show();
                    precio_ordenanza=1.80;
                    break;
                case '3':
                    reiniciar_select();
                    $("#mensaje-input").text('Cantidad de Galones');
                    $("#input-cantidad").show();
                    tipo_subordenanza='t_aceite_automotriz';
                    tiene_rango=1;
                    break;
                case '4':
                    reiniciar_select();
                    $("#mensaje-input").text('Cantidad de Galones');
                    $("#input-cantidad").show();
                    tipo_subordenanza='t_combustible';
                    tiene_rango=1;
                    break;
                case '5':
                    reiniciar_select();
                    $("#mensaje-input").text('Cantidad de Galones');
                    $("#input-cantidad").show();
                    tipo_subordenanza='t_quimicos_mp';
                    tiene_rango=1;
                    break;
                default:
                    console.log('no hay');
            } 
        });

        $("#espectaculos").change(function () {
            var transporte =$("select[id=espectaculos]").val();
            switch (transporte){
                case '1':
                    reiniciar_select();
                    $("#mensaje-input").text('Cantidad Personas');
                    $("#input-cantidad").show();
                    tipo_subordenanza='circos_y_afines';
                    tiene_rango=1;
                    break;
                case '2':
                    reiniciar_select();
                    $("#mensaje-input").text('Cantidad Personas');
                    $("#input-cantidad").show();
                    tipo_subordenanza='juegos_mecanicos';
                    tiene_rango=1;
                    break;
                case '3':
                    reiniciar_select();
                    $("#mensaje-input").text('Cantidad Personas');
                    $("#input-cantidad").show();
                    tipo_subordenanza='evento_barrial';
                    tiene_rango=1;
                    break;
                case '4':
                    reiniciar_select();
                    $("#mensaje-input").text('Cantidad Personas');
                    $("#input-cantidad").show();
                    tipo_subordenanza='parroquia_com_otros';
                    tiene_rango=1;
                    break;
                case '5':
                    reiniciar_select();
                    $("#mensaje-input").text('Cantidad Personas');
                    $("#input-cantidad").show();
                    tipo_subordenanza='fuego';
                    tiene_rango=1;
                    break;
                case '6':
                    reiniciar_select();
                    $("#mensaje-input").text('Cantidad Personas');
                    $("#input-cantidad").show();
                    tipo_subordenanza='nacional';
                    tiene_rango=1;
                    break;
                case '7':
                    reiniciar_select();
                    $("#mensaje-input").text('Cantidad Personas');
                    $("#input-cantidad").show();
                    tipo_subordenanza='internacional';
                    tiene_rango=1;
                    break;
                default:
                    console.log('no hay');
            } 
        });

        $("#planos").change(function () {
            var transporte =$("select[id=planos]").val();
            switch (transporte){
                case '1':
                    reiniciar_select();
                    $("#mensaje-input").text('Metros Cuadrados');
                    $("#input-cantidad").show();
                    precio_ordenanza=0.25;

                    break;
                case '2':
                    reiniciar_select();
                    $("#mensaje-input").text('Metros Cuadrados');
                    $("#input-cantidad").show();
                    precio_ordenanza=0.25;
                    break;
                case '3':
                    reiniciar_select();
                    $("#mensaje-input").text('Metros Cuadrados');
                    $("#input-cantidad").show();
                    precio_ordenanza=0.50;

                    break;
                case '4':
                    reiniciar_select();
                    $("#mensaje-input").text('Metros Cuadrados');
                    $("#input-cantidad").show();
                    precio_ordenanza=0.50;

                    break;
                case '5':
                    reiniciar_select();
                    $("#mensaje-input").text('Metros Cuadrados');
                    $("#input-cantidad").show();
                    precio_ordenanza=0.75;

                    break;
                default:
                    console.log('no hay');
            } 
        });

        $("#infracciones").change(function () {
            var transporte =$("select[id=infracciones]").val();
            switch (transporte){
                case '1':
                    reiniciar_select();
                   
                    total_pagar = salario_basico;

                    break;
                case '2':
                    reiniciar_select();
                    
                    total_pagar = salario_basico*0.00;
                    break;
                case '3':
                    reiniciar_select();
                    
                    total_pagar = salario_basico*0.05 ;

                    break;
                case '4':
                    reiniciar_select();
                    
                    total_pagar = salario_basico*0.10 ;

                    break;
                case '5':
                    reiniciar_select();
                   
                    total_pagar=salario_basico;

                    break;
                default:
                    console.log('no hay');
            } 
        });
        
       
        const reiniciar_select = () =>{
            precio_ordenanza = 0;
            cantidad=0;
            total_pagar=0;
            $("#valorCalculado").text(total_pagar);
            $("#valor").val(total_pagar).val();
            $("#cantidad").val('').val();
        }


    
    
    </script>
@endsection


