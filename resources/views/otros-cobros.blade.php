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
                                                <h2><i class="fa fa-usd"></i> Otros Cobros</h2>
                                            </div>
                                            <div class="title_right" style="text-align: right">
                                                 <a href="#" class="btn btn-outline-primary" data-toggle="modal" data-target="#mdlNuevoPago"> <i class="fa fa-user"></i> Agregar</a>
                                             </div>
                                            </div>
                                        </div>

                                        <div class="x_content">
                                            <p class="text-muted font-13 m-b-30">Listado de pago de Impuestos de Tasa Anual Pendientes</p>
                                            <div class="table-responsive">
                                                <table id="tbClientesSecretario" class="table table-striped jambo_table bulk_action" style="width:100%">
                                                    <thead>
                                                    <tr class="headings">
                                                    <th class="column-title ruc__pagos">ID</th>
                                                        <th class="column-title ruc__pagos">CI - RUC</th>
                                                        <th class="column-title ranSocial__pagos">RAZ&Oacute;N SOCIAL</th>
                                                        <th class="column-title repesLegar__pagos">REP. LEGAL</th>
                                                        <th class="column-title saldo__pagos">TEL&Eacute;FONO</th>
                                                        <th class="column-title saldo__pagos">VALOR</th>
                                                        <th class="column-title saldo__pagos">FECHA</th>
                                                        <th class="column-title saldo__pagos">AÑO</th>
                                                        <th class="column-title accion__pagos" align="center"></th>
                                                        <th class="column-title accion__pagos" align="center"></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @forelse ($impuestos as $item)
                                                        <tr class="evenpointer">
                                                        <td><label class="ruc__tbpagos">{{$item->id}}</label></td>

                                                            <td><label class="ruc__tbpagos">{{$item->ruc}}</label></td>
                                                            <td><label class="razonSocial__tbpagos">{{$item->razonSocial}}</label></td>
                                                            <td><label class="repLegar___tbPagos">{{$item->representanteLegal}}</label></td>
                                                            <td><label class="valTasaAnual__tbPagos">{{$item->telefono}}</label> </td>
                                                            <td>
                                                                <label class="saldo__tbpagos">
                                                                @php

                                                                    $total     =  round ($item->valor , 2);
                                                                    echo $total;
                                                                @endphp
                                                                </label>
                                                            </td>
                                                            <td><label class="saldo__tbpagos">{{$item->created_at}}</label></td>
                                                            <td>
                                                                <label class="ruc__tbpagos">{{ $item->year_now }}</label>
                                                            </td>
                                                            <td>
                                                                <a class="btn btn-info" href="bill-DiferentPayments/{{ $item->id }}" target="_blank" > IMPRIMIR </a>
                                                            </td>
                                                            <td>
                                                            <form method="POST"
                                                                        action="{{ route('different-payments.update', $item->id) }}">
                                                                        <input type="hidden" name="_token"
                                                                            value="{{ csrf_token() }}">
                                                                        <input type="hidden" name="caso"
                                                                            value="revertir_permiso">
                                                                        {!! method_field('PUT') !!}
                                                                        <button type="submit"
                                                                            class="btn btn-danger btn-block">Revertir
                                                                            Permiso</button>
                                                                    </form>
                                                            </td>

                                                        </tr>
                                                    @empty
                                                    @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                    </div>

                </div>
            </div>
        </div>




        <!--- tasa anual--->
        <div class="modal fade"  id="mdlNuevoPago"  tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog" style="max-width:80%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" ><i class="fa fa-money"></i> Pago impuesto de Tasa Anual </h4>


                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
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
                                        <h2 style="text-align: center; font-weight: bold">ORDEN DE PAGO DE PERMISO DE FUNCIONAMIENTO CUERPO DE BOMBEROS</h2>
                                        <p style="text-align: right;">Atacames, {{ now()->toDateTimeString()  }}</p>
                                        <p style="text-align: right;">Permiso año {{date('Y')}} </p>
                                        <style>
                                            .margin_p{
                                                margin: -6px;
                                            }
                                        </style>


                                                <form method="POST" action="{{route('different-payments.store')}}">
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
                                                                            <label class="col-form-label col-md-4 col-sm-4 label-align" for="cedula">PROPIETARIO</label>
                                                                            <div class="col-md-9 col-sm-9">
                                                                                <input type="text" class="form-control" name="representanteLegal" id="representanteLegal"  onKeyPress="return fn_aceptaLETRAS(event)"   placeholder="PROPIETARIO" required>
                                                                            </div>
                                                                        </div>

                                                                        <div class="item form-group ">
                                                                            <label class="col-form-label col-md-4 col-sm-4 label-align" for="cedula">DIRECCI&Oacute;N</label>
                                                                            <div class="col-md-9 col-sm-9">
                                                                                <input type="text" class="form-control" name="direccion"   placeholder="DIRECCI&Oacute;N" required>
                                                                            </div>
                                                                        </div>

                                                                        <div class="item form-group ">
                                                                            <label class="col-form-label col-md-4 col-sm-4 label-align" for="cedula">TEL&Eacute;FONO</label>
                                                                            <div class="col-md-9 col-sm-9">
                                                                                <input type="text" class="form-control " name="telefono" onKeyPress="return fn_aceptaNum(event)"  placeholder="TEL&Eacute;FONO" required>
                                                                            </div>
                                                                        </div>

                                                                        <div class="item form-group ">
                                                                            <label class="col-form-label col-md-4 col-sm-4 label-align" for="formaspago">Formas de Pagos</label>
                                                                            <div class="col-md-9 col-sm-9">
                                                                                <select class="form-control" name="formaspago">
                                                                                    @forelse ($formasPago as $pago)
                                                                                        <option value="{{ $pago->id }}">{{ $pago->nombre }}</option> 
                                                                                    @empty
                                                                                        no hay registro
                                                                                    @endforelse
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="item form-group ">
                                                                            <label class="col-form-label col-md-4 col-sm-4 label-align" for="anioPago">Año Pago</label>
                                                                            <div class="col-md-9 col-sm-9">
                                                                                <select class="form-control" name="anioPago">
                                                                                <?php
                                                                                $fecha = now()->format('Y');
                                                                                for ($i=2013; $i <=$fecha ; $i++) { 
                                                                                echo '<option value="'.$i.'">'.$i.'</option>';
                                                                                }
                                                                            ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                        
                                                                        <div class="item form-group">
                                                            <label class="col-form-label col-md-4 col-sm-4 label-align"
                                                                for="cedula">N.T. CRÉDITO #</label>
                                                            <div class="col-md-10 col-sm-10">
                                                                <input type="hidden" class="form-control"
                                                                    name="valor__tbTitulo" id="valor__tbTitulo" value=""
                                                                    onKeyPress="return fn_aceptaNum(event)"
                                                                    placeholder="Valor ej. 10.50"
                                                                    style="text-align: center">
                                                                <input type="text" class="form-control"
                                                                    name="numTituloAdmin"
                                                                    id="numTituloAdmin" value=""
                                                                    onKeyPress="return fn_aceptaNum(event)" required
                                                                    placeholder=""
                                                                    style="text-align: center">
                                                            </div>
                                                        </div>

                                                                    </div>
                                                                    <div class="col-sm-1"></div>
                                                                </div>


                                                                <div class="row" style="border: 1px solid;">
                                                                    <div class="col-sm-1"></div>
                                                                    <div class="col-sm-19" style="text-align: left;padding: 10px">
                                                                        <div class="item form-group">
                                                                            <label class="col-form-label col-md-1 col-sm-1 label-align" for="cedula">Valor$</label>
                                                                            <div class="col-md-4 col-sm-4">
                                                                                <input type="text" class="form-control" name="valor" id="valor" value="" maxlength="6" onKeyPress="return fn_aceptaNum(event)" required placeholder="ej. 30.50" style="text-align: center" >
                                                                            </div>

                                                                             <label class="col-form-label col-md-3 col-sm-3 label-align" for="porcenjatetasa">Porcentaje Tazas </label>
                                                                            <div class="col-md-4 col-sm-4">
                                                                                <input type="text" class="form-control" name="porcenjatetasa" id="porcenjatetasa" required onKeyPress="return fn_aceptaNum(event)"  value="" placeholder="Ej. 2.842" style="text-align: center">
                                                                            </div>
                                                                        </div>
                                                                        <div class="item form-group ">
                                                                            <label class="col-form-label col-md-4 col-sm-4 label-align" for="anioPago">SERVICIO ADMINISTRATIVO(TITULO DE CRÉDITO):</label>
                                                                            <div class="col-md-9 col-sm-9">
                                                                            <label class="col-form-label col-md-4 col-sm-4 label-align" for="">$1.00</label>

                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-1"></div>
                                                                    <div class="col-sm-19" style="text-align: left;padding: 10px">
                                                                        <div class="item form-group">
                                                                            <label class="col-form-label col-md-2 col-sm-2 label-align" for="cedula">Tipo Descuento</label>
                                                                            <div class="col-md-3 col-sm-3">
                                                                            <select class="form-control" id="tipodescuento" name="tipodescuento">
                                                                                <option    value="50">Tercera Edad</option>
                                                                                <option  value="50">Discapacitados</option>
                                                                                <option  value="100">Artesanos Exonerados</option>
                                                                                <option  value="personalizado">Personalizado</option>
                                                                                 </select>                                                           
                                                             </div>

                                                                             <label class="col-form-label col-md-3 col-sm-3 label-align" for="porcentajedescuento">% Descuento </label>
                                                                            <div class="col-md-4 col-sm-4">
                                                                                <input type="text" class="form-control" name="porcentajedescuento" id="porcentajedescuento"  onKeyPress="return fn_aceptaNum(event)"  value="" placeholder="50" style="text-align: center">
                                                                            </div>
                                                                        </div>

                                                                        <center>
                                                                        <div class="col-sm-12" >
                                                                    <label id="" style="font-size: 42px;">$</label>
                                                                     <label id="valorCalculado" style="font-size: 42px;">0</label>
                                                                    </div>
                                                                             
                                            
                                                                                <div class="col-sm-12" >
                                                                  
                                                                  <div class="btn btn-success calcularValorPorcenjate">CALCULAR <i class="fa fa-calculator" style="font-size: 15px"></i></div>
                                                                
                                                            
          

                                                          </div>
                                                                            </center>
                                                                     </div>
                                                                    <div class="col-sm-1"></div>
                                                                </div>
                           

                                                                    <div class="col-sm-1"></div>
                                                                    <div class="col-sm-10" style="text-align: left;padding: 10px">
                                                                        <textarea class="form-control" name="decripcion_mp_1" required placeholder="Descripción, motivo de pago"  style="width: 99%"></textarea>
                 
                                                                    </div>
                                                                    <div class="col-sm-1"></div>
                                                                    <div class="col-sm-12" style="text-align: left;padding: 30px">
                                                                       
                                                                    <center>
                                                                    <input type="submit" value="FACTURAR" class="btn btn-info" style="font-size: 55px; text-align:center">

                                                                    </center>
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


                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary"  data-dismiss="modal" aria-label="Close">Salir</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
@section('scrpts-jqrey')
    <script>
$("#porcentajedescuento").hide();
        var tbClientesSecretario;
         $("#tbClientesSecretario_InpBuscar").val("");

        fn_tbClienteSecretario_ini();
        function fn_tbClienteSecretario_ini() {
            tbClientesSecretario = $("#tbClientesSecretario").dataTable({
                pageLength: 10,
                order: [[0, "desc"]],
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
                }          ,
    columnDefs: [
        {
            targets: 0, // Indica la posición de la columna que quieres ocultar (en este caso, la columna 0)
            visible: false
        }
        // Puedes agregar más definiciones de columnas según sea necesario
    ]
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
       $("#porcentajedescuento").hide();

        $("#tipodescuento").change( function () {
            if($("#tipodescuento").val()=='personalizado')      {
                $("#porcentajedescuento").show();
                $("#porcenjatetasa").attr('disabled',false);
            }

            else if($("#tipodescuento").val()=='100')
            {

                $("#porcenjatetasa").attr('disabled',true);

            }
            else
            {
                $("#porcenjatetasa").attr('disabled',false);
            }
    
            });

        $(".calcularValorPorcenjate").click( function () {
            var valor=$("#valor").val();
            console.log("valor: " + valor);
            var descuento=0;
            var tasa=$("#porcenjatetasa").val();
            console.log("tasa: " + tasa);
            if($("#tipodescuento").val()=='personalizado')  
                {
             
                 descuento=$("#porcentajedescuento").val();
            }

            else
             {
                descuento=$("#tipodescuento").val();
             }
            var total=0.0;
            var t=0.0;
            var resultado=0.0;
      
            t=parseFloat(tasa/100);
            //alert(valor);
            total=parseFloat(valor)+(parseFloat(valor)*parseFloat(t));

            resultado=  Math.round( (parseFloat(total)-(parseFloat(total)*parseFloat(descuento/100)))* 100) / 100;




            if($("#tipodescuento").val()=='100')
            {
                     var valdes=2;

                $("#porcenjatetasa").val(0);
                $("#valorCalculado").text(parseFloat(valdes));
            }
            else{
                $("#valorCalculado").text(resultado+1);
            }

            

     
            

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
                        return true;
                    }

                    toastr.error('No existen coincidencias, '+datos[0].ruc);
                    $("#nombreLocal").val("");
                    $("#representanteLegal").val("");
                    return true;
                }
            });
        });

    </script>
@endsection


