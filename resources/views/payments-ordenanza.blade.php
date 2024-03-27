@extends('layout')

@section('title', ucwords($data[0]->nombre))
@section('icono', $data[0]->icono)

@section('pagecontent')

    <!-- page content -->
    <style>
        .cb-header-register {
            display: flex;
            align-items: center;
        }

        .cb-header-register__img {
            height: 100px;
            margin-right: 1%;
            margin-left: 1%;
        }

        .cb-header-registe_description {
            padding: 2px;
            color: black;
            font-size: 11px;
            text-align: justify;
            margin-left: 10%;
        }

.row
{
margin-right: -50px;
margin-left: -100px;

}
        .cb-header-register__Nro {
            margin-left: 70%;
            color: #000000;
        }

        .cb-subTitle {
            color: #ca1404;
            font-weight: bold;
            margin: 12px 0;
            font-size: 13px;
        }

        .cb-header-register__tbDecripcion {
            width: 40%;
            text-align: justify;
        }

        .cb-header-register__tbSi,
        .cb-header-register__tbNo {
            width: 5%;
        }

        .cb-header-register__tbObservacion {
            width: 50%;
        }

        .ruc__pagos {
            width: 10%;
        }

        .ranSocial__pagos {
            width: 25%;
        }

        .repesLegar__pagos {
            width: 24%;
        }

        .saldo__pagos {
            width: 25%;
        }

        .mora__pagos {
            width: 5%;
        }

        .accion__pagos {
            width: 10%;
        }

        .td__pagos {
            width: 95%;
        }

        .cantidad__pagos {
            width: 10%;
        }

        .tipoPago___pagos {
            width: 55%;
        }

        .valor___pagos {
            width: 10%;
        }

        .boton___pagos {
            width: 15%;

        }
    </style>
    @if (session()->has('Respuesta'))
        <label id="Respuesta" style="display: none;">{{ session('Respuesta') }}</label>
        <script>
            toastr.success($("#Respuesta").text());
        </script>
    @endif

    @if (session()->has('Respuesta_erro'))
        <label id="Respuesta_erro" style="display: none;">{{ session('Respuesta_erro') }}</label>
        <script>
            toastr.error($("#Respuesta_erro").text());
        </script>
    @endif

    @if (session()->has('Respuesta_wn'))
        <label id="Respuesta_wn" style="display: none;">{{ session('Respuesta_wn') }}</label>
        <script>
            toastr.warning($("#Respuesta_wn").text(), 'Alerta', {
                timeOut: 5000
            });
        </script>
    @endif



    <div class="right_col" role="main">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_content">
                    <!--navegacion-->
                    @if (auth()->user()->hasRoles([3,1]))
                        <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#clients" role="tab"
                                    aria-controls="home" aria-selected="true">Pagos Ordenanza</a>
                            </li>
                         
                        </ul>
                    @endif


                    <!--contenido-->
                    <div class="tab-content" id="myTabContent">


                        <!---- 5 es contador acceso a pagar los impuestos y las solicitudes-->
                        @if (auth()->user()->hasRoles([3,1]))
                        <div class="tab-pane fade show active" id="clients" role="tabpanel" aria-labelledby="home-tab">
    <div class="page-title">
        <div class="title_left">
            <h2><i class="fa fa-usd"></i> Pago Valor de Ordenanza.</h2>
        </div>
    </div>
    <!-- Botón de agregar -->
    @if (auth()->user()->hasRoles([1]))
    <a href="#" class="btn btn-outline-primary" data-toggle="modal" data-target="#mdlOrdenanza__new">
                                    <i class="fa fa-user"></i> Agregar</a>
        @endif                   
    </div>



                                <div class="">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="x_panel">
                                            <p class="text-muted font-13 m-b-30"></p>
                                            <div class="table-responsive">
                                                <table id="tbPagosTasaAnual"
                                                    class="table table-striped jambo_table bulk_action" style="width:100%">
                                                    <thead>
                                                        <tr class="headings">
                                                        <th class="column-title ruc__pagos">ID</th>
                                                            <th class="column-title ruc__pagos">CI - RUC</th>
                                                            <th class="column-title ranSocial__pagos">RAZ&Oacute;N SOCIAL</th>
                                                            <th class="column-title ranSocial__pagos">OBSERVACION</th>

                                                            <th class="column-title ranSocial__pagos">ART. ORDENANZA</th>

                                                            <th class="column-title repesLegar__pagos">REP. LEGAL</th>
                                                            <th class="column-title repesLegar__pagos">VALOR</th>
<!--                                                             <th class="column-title saldo__pagos">CATEGORIA</th>
                                                            <th class="column-title saldo__pagos">DENOMINACION</th> -->
                                                            <th class="column-title repesLegar__pagos" > ESTADO</th>
                                                            <th class="column-title repesLegar__pagos" > </th>
                                                         

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse($impuestos  as $item)
                                                            <tr class="even pointer">
                                                            <td><label
                                                                        class="ruc__tbpagos">{{ $item->id }}</label>
                                                                </td>
                                                                <td><label
                                                                        class="ruc__tbpagos">{{ $item->ruc }}</label>
                                                                </td>
                                                                <td><label
                                                                        class="razonSocial__tbpagos">{{ $item->razonSocial }}</label>
                                                                </td>
                                                                <td><label
                                                                        class="razonSocial__tbpagos">{{ $item->observacion }}</label>
                                                                </td>
                                                                <td><label
                                                                        class="razonSocial__tbpagos">{{ $item->descripcion }}</label>
                                                                </td>
                                                                <td><label
                                                                        class="ruc__tbpagos">{{ $item->representanteLegal }}</label>
                                                                       
                                                                </td>
                                                                <td><label
                                                                        class="ruc__tbpagos">$ {{ $item->valor+3 }}</label>
                                                                       
                                                                </td>
                                                             
                                                               
                                                                       
                                                                @if (auth()->user()->hasRoles([3]))   

                                                          

                                                                @if($item->estado==7)

                                                                <td>
        @csrf
        <div data-toggle="modal"
                                                                            data-ruc_patototal="{{ $item->id }}"
                                                                            data-idCli="{{ $item->id }}"
                                                                            data-target="#mdlPagos"
                                                                            class="btn btn-info btn-xs btn-block pagar__pagos">
                                                                            Facturar </div>
       
</td>
<td></td>
@endif
@if($item->estado==8)

<td>
PAGADO

</td>
<td></td>
@endif

@if($item->estado==4)

<td>
NO EMITIDO

</td>
<td></td>
@endif
@endif
@if (auth()->user()->hasRoles([1]))   
                                                    @if ($item->estado==4)     
                                                    <td>
    <form method="POST" action="{{ route('emitir-ordenanza', ['id' => $item->id]) }}">
        @csrf
        <button class="btn btn-primary btn-xs btn-block">
            EMITIR <i class="fa fa-check"></i>
        </button>
    </form>
</td>

<td>
<div data-toggle="modal"
                                                                            data-ruc_patototal="{{ $item->id }}"
                                                                            data-idCli="{{ $item->id }}"
                                                                            data-target="#mdlPagos_editar"
                                                                            class="btn btn-warning btn-xs btn-block editar_ordenanza">
                                                                            Editar </div>
       
</td>
                                        @endif            

                                                    @if($item->estado==7)

                                                                <td>
                                                                    <form method="POST"
                                                                        action="{{ route('payments-ordenanzas.destroy', $item->id) }}">

                                                                        
                                                                        <input type="hidden" name="_token"
                                                                            value="{{ csrf_token() }}">
                                                                        {!! method_field('DELETE') !!}
                                                                        <button type="submit" class="btn btn-danger btn-xs btn-block">
                                                                              ANULAR <i class="fa fa-trash"></i>
                                                                                                </button>
                                                                    </form>
                                                                </td>
                                                                <td></td>
                                                                @endif

                                                                @if($item->estado==8)

<td>
   PAGADO
</td>
<td></td>
@endif
@endif
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


              
                        @endif







                    </div>

                </div>
            </div>
        </ddiv>
        <div class="modal fade" id="mdlPagos_editar" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" style="max-width:80%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><i class="fa fa-money"></i> PAGO PERMISO DE FUNCIONAMIENTO </h4>
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
                                        <h2 style="margin: 2px; font-weight: bold;">ACUERDO MINISTERIAL N° 1616 DEL 29 DE
                                            OCTUBRE DE 1997</h2>
                                        <p style="margin: 2px; font-weight: bold;">REGISTRO OFICIAL N° 741 DEL 29 DE ENERO
                                            DEL 2019</p>
                                        <p style="margin: 2px; font-weight: bold;">RUC: 08600506900001</p>
                                        <p style="margin: 2px; font-weight: bold;">TELÉFONO: 0602760-223</p>
                                        <p style="margin: 2px; font-weight: bold;">DIRECCIÓN: AV. PRINCIPAL/ATACAMES/LOS ALMENDROS</p>

                                    </div>
                                    <div class="col-sm-3"></div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-6" style="text-align: center">
                                       
                                        <p style="text-align: right;">Atacames, {{ now()->toDateTimeString() }}</p>
                                       
                                        <style>
                                            .margin_p {
                                                margin: -6px;
                                            }
                                        </style>



                                        <div class="container">
                                           
                                       
                                        <form method="POST" action="{{ route('actualizar-ordenanza', ['id' => $item->id]) }}">


                                          
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                            <div class="container">
                                                                <div class="row" style="border: 1px solid;">
                                                                    <div class="col-sm-1"></div>
                                                                    <div class="col-sm-10" style="text-align: left;padding: 10px">

                                                                        <div class="item form-group ">
                                                                            <label class="col-form-label col-md-4 col-sm-4 label-align" for="cedula">RUC</label>
                                                                            <div class="col-md-9 col-sm-9">
                                                                                <input type="text" class="form-control" name="ruc_edit" id="ruc_edit"  onKeyPress="return fn_aceptaNum(event)"  placeholder="RUC" required>
                                                                            </div>
                                                                        </div>


                                                                        <div class="item form-group ">
                                                                            <label class="col-form-label col-md-4 col-sm-4 label-align" for="cedula">NOMBRE DEL LOCAL</label>
                                                                            <div class="col-md-9 col-sm-9">
                                                                                <input type="text" class="form-control" name="nombreLocal_edit" id="nombreLocal_edit"  placeholder="NOMBRE DEL LOCAL" required>
                                                                            </div>
                                                                        </div>

                                                                        <div class="item form-group ">
                                                                            <label class="col-form-label col-md-4 col-sm-4 label-align" for="cedula">REPRESENTANTE LEGAL- PROPIETARIO</label>
                                                                            <div class="col-md-9 col-sm-9">
                                                                                <input type="text" class="form-control" name="representanteLegal_edit" id="representanteLegal_edit"  onKeyPress="return fn_aceptaLETRAS(event)"   placeholder="PROPIETARIO" required>
                                                                            </div>
                                                                        </div>
                                                                        

                                                                   

                                                                     

                                                                        <div class="item form-group ">
                                                                            <label class="col-form-label col-md-4 col-sm-4 label-align" for="cedula">TELÉFONO</label>
                                                                            <div class="col-md-9 col-sm-9">
                                                                                <input type="text" class="form-control" name="telefono_edit" id="telefono_edit"  placeholder="TELEFONO" required>
                                                                            </div>
                                                                        </div>

                                                                        <div class="item form-group ">
                                                                            <label class="col-form-label col-md-4 col-sm-4 label-align" for="cedula">DIRECCIÓN</label>
                                                                            <div class="col-md-9 col-sm-9">
                                                                                <!-- <input type="text" class="form-control " name="num_permiso_funcionamiento"   placeholder="NÚMERO PERMISO FUNCIONAMIENTO" required> -->
                                                                                <input type="text" class="form-control" name="direccion_edit" id="direccion_edit"   placeholder="DIRECCIÓN" required>

                                                                            </div>
                                                                        </div>
                                                                        <div class="item form-group ">
                                                                            <label class="col-form-label col-md-4 col-sm-4 label-align" for="cedula">OBSERVACIÓN</label>
                                                                            <div class="col-md-9 col-sm-9">
                                                                                <!-- <input type="text" class="form-control " name="num_permiso_funcionamiento"   placeholder="NÚMERO PERMISO FUNCIONAMIENTO" required> -->
                                                                                <input type="text" class="form-control" name="observacion_edit" id="observacion_edit"   placeholder="VEHICULO PLACA PDO675" required>
   
                                                                             
                                                                            </div>
                                                                        </div>

                                                                        
                                                                    </div>
                                                                  
                                                                </div>


                                                            </div>
                                                               
                                                                    
                                                                  
                                                                <div class="col-sm-1"></div>
                                                                    <div class="col-sm-12" >
                                                                  
                                                                      
                                                                   
                                                                    
                                                                    <div class="col-sm-12" >
                                                                 
                                                                    <input type="submit" value="ACTUALIZAR" class="btn btn-info" style="font-size: 35px; text-align:center">

                                                                    </div>
                                                                    
                                                                    <div class="col-sm-1"></div>
                                
                

                                                                </div>
                                                          
                                                        </form>





                                        </div>
                                    </div>
                                    <div class="col-sm-3"></div>
                                </div>
                            </div>
                        </div>
                    </div>

        <!-- fin tasa anual -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal"
                            aria-label="Close">Salir</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="mdlPagos" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" style="max-width:80%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><i class="fa fa-money"></i> PAGO PERMISO DE FUNCIONAMIENTO </h4>
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
                                        <h2 style="margin: 2px; font-weight: bold;">ACUERDO MINISTERIAL N° 1616 DEL 29 DE
                                            OCTUBRE DE 1997</h2>
                                        <p style="margin: 2px; font-weight: bold;">REGISTRO OFICIAL N° 741 DEL 29 DE ENERO
                                            DEL 2019</p>
                                        <p style="margin: 2px; font-weight: bold;">RUC: 08600506900001</p>
                                        <p style="margin: 2px; font-weight: bold;">TELÉFONO: 0602760-223</p>
                                        <p style="margin: 2px; font-weight: bold;">DIRECCIÓN: AV. PRINCIPAL/ATACAMES/LOS ALMENDROS</p>

                                    </div>
                                    <div class="col-sm-3"></div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-6" style="text-align: center">
                                       
                                        <p style="text-align: right;">Atacames, {{ now()->toDateTimeString() }}</p>
                                       
                                        <style>
                                            .margin_p {
                                                margin: -6px;
                                            }
                                        </style>



                                        <div class="container">
                                            <div class="row" style="border: 0px solid;">
                                                <div class="col-sm-1"></div>
                                                <div class="col-sm-5" style="text-align: left;">
                                                    <p class="margin_p"><b>NOMBRE DEL ESTABLECIMIENTO: </b></p>
                                                    <p class="margin_p"><b>CONTRIBUYENTE:</b></p>
                                                    <p class="margin_p"><b>RUC: </b></p>
                                                    <p class="margin_p"><b>DIRECCI&Oacute;N:</b></p>
                                                    <p class="margin_p"><b>TEL&Eacute;FONO:</b></p><br>
                                                    <p class="margin_p"><h2><b>AÑO:</b> {{ date('Y') }}</b></h2></p>

                                                    <!-- <p class="margin_p"><b>CATEGORIA</b></p> -->

                                                </div>
                                                <div class="col-sm-5" style="text-align: left;padding: 5px">
                                                    <p class="margin_p" id="razonSocial__MdPagos"></p>
                                                    <p class="margin_p" id="repLegar__MdPagos"></p>
                                                    <p class="margin_p" id="ruc__mdPAgos"></p>
                                                    <p class="margin_p" id="direccion__MdPagos"></p>
                                                    <p class="margin_p" id="telefono__MdPagos"></p><br>
                                                  
                                                    
                                                    <!-- <p class="margin_p" id="catgoria__MdPagos"></p> -->
                                                </div>
                                                <div class="col-sm-1"></div>
                                            </div>
                                            <h2 style="text-align: center; font-weight: bold">PERMISO DE FUNCIONAMIENTO</h2>
                                            <div class="row" style="border: 1px solid;">
                                                <div class="col-sm-1"></div>
                                                <div class="col-sm-6" style="text-align: left;padding: 10px">

                                                <p class="margin_p"><label><b>TASA DE PERMISO DE FUNCIONAMIENTO: </b></label></p>
                                                    <p class="margin_p"><label><b>RECARGO:</b></label></p>
                                                    <p class="margin_p"><label><b>DESCUENTO: </b></label></p>
                                                    <p class="margin_p"><label><b>ANTICIPO:</b></label></p>
                                                    <p class="margin_p"><label><b>ESPECIE:</b></label></p>
                                                    <p class="margin_p"><label><b>SERVICIO ADMINISTRATIVO(TITULO DE CRÉDITO):</b></label></p>
                                                    <p class="margin_p"  style="font-size: 20px; font-weight: bold"><label><b><h2>TOTAL:</h2></b></label></p>

                                                </div>

                                                <div class="col-sm-5" style="text-align: right;padding: 10px">
                                                <p class="margin_p" ><label id="TasaAnual__mdpagos"></label></p>
                                                <p class="margin_p" ><label id="RecargoTrimestral__mdpagos"></label></p>
                                                <p class="margin_p" ><label id="descuentos__mdpagos"></label></p>
                                                <p class="margin_p" ><label id="anticipos__mdpagos"></label></p>
                                                <p class="margin_p" ><label>$ 2.00</label></p>
                                                <p class="margin_p" ><label>$ 1.00</label></p><br>
                                                <p style="font-size: 20px; font-weight: bold">$ <label id="saldo__mdpagos"></label></p>                                 
                                                </div>
                                              
                                            </div>
                                       


                                            <form method="POST" action="{{ route('payments-ordenanzas.update', 2) }}">
                                                <input type="hidden" name="tipoPago" value="3">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="hidden" name="cliend_ida" id="cliend_idmp_1" value="">

                                                {!! method_field('PUT') !!}
                                                <div class="row" style="border: 1px solid;">
                                                    <div class="col-sm-1"></div>
                                                    <div class="col-sm-19" style="text-align: left;padding: 10px">


                                                        <div class="item form-group">
                                                            <label class="col-form-label col-md-4 col-sm-4 label-align"
                                                                for="cedula">F.Pago</label>
                                                            <div class="col-md-10 col-sm-10">
                                                                <select class="form-control" name="formaPago"
                                                                    id="formaPago_1">
                                                                    @forelse ($formasPago as $fp)
                                                                        <option value="{{ $fp->id }}">
                                                                            {{ $fp->nombre }}</option>
                                                                    @empty
                                                                    @endforelse
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="item form-group numTransaccion_1CAJA">
                                                            <label class="col-form-label col-md-4 col-sm-4 label-align"
                                                                for="cedula">N. Trans #</label>
                                                            <div class="col-md-10 col-sm-10">
                                                                <input type="text" class="form-control numTransaccion_1"
                                                                    name="numTransaccion" id="numTransaccion_1"
                                                                    onKeyPress="return fn_aceptaNum(event)" value=""
                                                                    placeholder="N&uacute;mero de Transacci&oacute;n">
                                                            </div>
                                                        </div>

                                                     

                                                        <div class="item form-group">
                                                            <label class="col-form-label col-md-4 col-sm-4 label-align"
                                                                for="cedula">N. P. F #</label>
                                                            <div class="col-md-10 col-sm-10">
                                                                <input type="hidden" class="form-control"
                                                                    name="valor__tbPagos" id="valor__tbPagos_a_1" value=""
                                                                    onKeyPress="return fn_aceptaNum(event)"
                                                                    placeholder="Valor ej. 10.50"
                                                                    style="text-align: center">
                                                                <input type="text" class="form-control"
                                                                    name="numPermisoFuncionamiento"
                                                                    id="numPermisoFuncionamiento_1" value=""
                                                                    onKeyPress="return fn_aceptaNum(event)" required
                                                                    placeholder="Número de Permiso de Funcionamiento"
                                                                    style="text-align: center">
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
                                                    <div class="col-sm-10" style="text-align: left;padding: 10px">
                                                        <textarea class="form-control" name="decripcion_mp_1" placeholder="Descripción" style="width: 99%"></textarea>
                                                    </div>
                                                    <div class="col-sm-1"></div>
                                                    <div class="d-grid gap-4 col-8 mx-auto">
                                                        <input class="btn btn-info" type="submit" value="FACTURAR" style="font-size: 30px">
                                                    </div>
                                                </div>
                                                <!--<input type="submit" value="FACTURAR" class="btn btn-info" style="font-size: 50px">-->

                                            </form>





                                        </div>
                                    </div>
                                    <div class="col-sm-3"></div>
                                </div>
                            </div>
                        </div>
                    </div>

        <!-- fin tasa anual -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal"
                            aria-label="Close">Salir</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="mdlOrdenanza__new" tabindex="-1" role="dialog" aria-hidden="true" >


  

        <div class="modal-dialog modal-lg"  role="document">


   
                <div class="modal-content">
               
                                    
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
                                                                        <div class="item form-group ">
                                                                            <label class="col-form-label col-md-4 col-sm-4 label-align" for="cedula">OBSERVACIÓN</label>
                                                                            <div class="col-md-9 col-sm-9">
                                                                                <!-- <input type="text" class="form-control " name="num_permiso_funcionamiento"   placeholder="NÚMERO PERMISO FUNCIONAMIENTO" required> -->
                                                                                <input type="text" class="form-control" name="observacion" id="observacion"   placeholder="VEHICULO PLACA PDO675" required>
   
                                                                             
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
                                                                 
                                                                    <input type="submit" value="REGISTRAR" class="btn btn-info" style="font-size: 35px; text-align:center">

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

                     
          

       
        <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary" data-dismiss="modal" aria-label="Close">Salir</button>
            </div>
          
        </div>
        </div>
                 
                    
       
              


        <div class="modal fade" id="mdlOrdenanza__edit" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" style="max-width:80%;">




        <div class="modal-content">
       
                            
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
                                                                        <input type="text" class="form-control" name="ruc_edit" id="ruc_edit"  onKeyPress="return fn_aceptaNum(event)"  placeholder="RUC" required>
                                                                    </div>
                                                                </div>


                                                                <div class="item form-group ">
                                                                    <label class="col-form-label col-md-4 col-sm-4 label-align" for="cedula">NOMBRE DEL LOCAL</label>
                                                                    <div class="col-md-9 col-sm-9">
                                                                        <input type="text" class="form-control" name="nombreLocal_edit" id="nombreLocal_edit"  placeholder="NOMBRE DEL LOCAL" required>
                                                                    </div>
                                                                </div>

                                                                <div class="item form-group ">
                                                                    <label class="col-form-label col-md-4 col-sm-4 label-align" for="cedula">REPRESENTANTE LEGAL- PROPIETARIO</label>
                                                                    <div class="col-md-9 col-sm-9">
                                                                        <input type="text" class="form-control" name="representanteLegal_edit" id="representanteLegal_edit"  onKeyPress="return fn_aceptaLETRAS(event)"   placeholder="PROPIETARIO" required>
                                                                    </div>
                                                                </div>
                                                                

                                                           

                                                             

                                                                <div class="item form-group ">
                                                                    <label class="col-form-label col-md-4 col-sm-4 label-align" for="cedula">TELÉFONO</label>
                                                                    <div class="col-md-9 col-sm-9">
                                                                        <input type="text" class="form-control" name="telefono_edit" id="telefono_edit"  placeholder="TELEFONO" required>
                                                                    </div>
                                                                </div>

                                                                <div class="item form-group ">
                                                                    <label class="col-form-label col-md-4 col-sm-4 label-align" for="cedula">DIRECCIÓN</label>
                                                                    <div class="col-md-9 col-sm-9">
                                                                        <!-- <input type="text" class="form-control " name="num_permiso_funcionamiento"   placeholder="NÚMERO PERMISO FUNCIONAMIENTO" required> -->
                                                                        <input type="text" class="form-control" name="direccion_edit" id="direccion_edit"   placeholder="DIRECCIÓN" required>

                                                                    </div>
                                                                </div>
                                                                <div class="item form-group ">
                                                                    <label class="col-form-label col-md-4 col-sm-4 label-align" for="cedula">OBSERVACIÓN</label>
                                                                    <div class="col-md-9 col-sm-9">
                                                                        <!-- <input type="text" class="form-control " name="num_permiso_funcionamiento"   placeholder="NÚMERO PERMISO FUNCIONAMIENTO" required> -->
                                                                        <input type="text" class="form-control" name="observacion_edit" id="observacion_edit"   placeholder="VEHICULO PLACA PDO675" required>

                                                                     
                                                                    </div>
                                                                </div>

                                                                
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

             
  


<div class="modal-footer">
        <button type="button" class="btn btn-outline-primary" data-dismiss="modal" aria-label="Close">Salir</button>
    </div>
  
</div>
</div>
     
    


        

@endsection
@section('scrpts-jqrey')
    <script>
        $(document).ready(function() {
        var tbClienteSecretario;
        var tbPagosTasaAnual;
        var tbPagosSolicitudes;

        fn_tbClienteSecretario_ini();
        fn_tbPagosTasaAnual_ini();
        fn_tbPagosSolicitudes_ini();

        $("#tbClientesSecretario_InpBuscar").val("");
        $("#tbPagosTasaAnual_buscador").val("");
        $("#tbPagoSolicitudes_buscador").val("");

        function fn_tbClienteSecretario_ini() {
            tbClienteSecretario = $("#tbClienteSecretario").dataTable({
            
                pageLength: 10,
                order: [
                    [0, "desc"]
                ],
                "language": {
                    "lengthMenu": 'Mostrar' +
                        '<select style="width:60px" >' +
                        '<option>5</option>' +
                        '<option>10</option>' +
                        '<option>20</option>' +
                        '<option>25</option>' +
                        '<option value="-1">Todos</option>' +
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
                },
    columnDefs: [
        {
            targets: 0, // Indica la posición de la columna que quieres ocultar (en este caso, la columna 0)
            visible: false
        }
        // Puedes agregar más definiciones de columnas según sea necesario
    ]
            });
        }
        $("#tbClientesSecretario_InpBuscar").on('keyup', function(event) {
            tbClienteSecretario.search(this.value).draw();
        });


        function fn_tbPagosTasaAnual_ini() {
            tbPagosTasaAnual = $("#tbPagosTasaAnual").dataTable({
             
                pageLength: 10,
                order: [
                    [0, "ASC"]
                ],
                drawCallback: function(settings) {
                    //CARGANDO
                },
                select: true,
                "language": {
                    "lengthMenu": 'Mostrar' +
                        '<select style="width:60px" >' +
                        '<option>5</option>' +
                        '<option>10</option>' +
                        '<option>20</option>' +
                        '<option>25</option>' +
                        '<option value="-1">Todos</option>' +
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
                },
                
    columnDefs: [
        {
            targets: 0, // Indica la posición de la columna que quieres ocultar (en este caso, la columna 0)
            visible: false
        }
        // Puedes agregar más definiciones de columnas según sea necesario
    ]
            });
        }
        $("#tbPagosTasaAnual_buscador").on('keyup', function(event) {
            tbPagosTasaAnual.search(this.value).draw();
        });

        function fn_tbPagosSolicitudes_ini() {
            tbPagosSolicitudes = $("#tbPagosSolicitudes").dataTable({
           
                pageLength: 10,
                order: [
                    [1, "desc"]
                ],
                "language": {
                    "lengthMenu": 'Mostrar' +
                        '<select style="width:60px" >' +
                        '<option>5</option>' +
                        '<option>10</option>' +
                        '<option>20</option>' +
                        '<option>25</option>' +
                        '<option value="-1">Todos</option>' +
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
        $("#tbPagoSolicitudes_buscador").on('keyup', function(event) {
            tbPagosSolicitudes.search(this.value).draw();
        });
    });




        /// pago total de tasa anual
        $(".pagar__pagos").on('click', function() {
      

            var cli_id = $(this).attr("data-idCli");

          
            var endpoint = 'resumenPagoOrdenanzas/' + cli_id;
            $("#cliend_idmp_1").val(cli_id);

           

            $.ajax({
                async: false,
                type: "GET",
                dataType: "json",
                contentType: "application/x-www-form-urlencoded",
                url: endpoint,
                success: function(datos) {

                

                    console.log(datos);
                    $("#razonSocial__MdPagos").text(datos['cliente']['razonSocial']);
                    $("#repLegar__MdPagos").text(datos['cliente']['representanteLegal']);
                    $("#ruc__mdPAgos").text(datos['cliente']['ruc']);
                    $("#direccion__MdPagos").text(datos['cliente']['direccion']);
                    $("#telefono__MdPagos").text(datos['cliente']['telefono']);
                    $("#ordenanza__MdPagos").text(datos['cliente']['descripcion']);
                    /* $("#catgoria__MdPagos").text(datos['cliente']['categoria']); */
                 
                
                  
                        $("#permiso").text('$ ' + 0.00);

                        $valor = datos['Pagos']['TasaAnual'] + 2+1;
                  

                    var $total_tasa = datos['Pagos']['TasaAnual'];

                    var $total = $valor


                    $("#anticipos__mdpagos").text('$ ' + datos['Pagos']['anticipos']);
                    $("#descuentos__mdpagos").text('$ ' + datos['Pagos']['descuentos']);
                    //AQUI
                    $("#RecargoTrimestral__mdpagos").text('$ ' + 0);
                    $("#saldo__mdpagos").text($total.toFixed(2));
                    // dd(fecha_inicio,fecha_actual);




                    $('#valor_porcentaje').on('change', function(e) {
                        var valor_porcentaje = $('#valor_porcentaje').val();

                        var $recargo = $total_tasa * (valor_porcentaje / 100);

                        $("#RecargoTrimestral__mdpagos").text('$ ' + $recargo.toFixed(4));

                        $("#recargo_valor").val($recargo.toFixed(4));

                        var $total_global = $total + $recargo;
                        $("#saldo__mdpagos").text($total_global.toFixed(2));
                    });

                    $("#TasaAnual__mdpagos").text('$ ' + datos['Pagos']['TasaAnual']);
                    $("#valor__tbPagos_a_1").val(datos['cliente']['saldo']);
                    $(".TasaAnual__mdpagos_m").val(datos['cliente']['saldo']);

                    /* $("#TotalTasaAnual__mdpagos").text($total_tasa); */



                },
                error: function(d) {
                    toastr.error('Algo  salió mal, Reintente');
                }
            });
        });


        $(".editar_ordenanza").on('click', function() {
      

      var cli_id = $(this).attr("data-idCli");

    
      var endpoint = 'resumenPagoOrdenanzas/' + cli_id;
      $("#cliend_idmp_1").val(cli_id);

     

      $.ajax({
          async: false,
          type: "GET",
          dataType: "json",
          contentType: "application/x-www-form-urlencoded",
          url: endpoint,
          success: function(datos) {

          

              console.log(datos);
              $("#nombreLocal_edit").val(datos['cliente']['razonSocial']);
              $("#representanteLegal_edit").val(datos['cliente']['representanteLegal']);
              $("#ruc_edit").val(datos['cliente']['ruc']);
              $("#direccion_edit").val(datos['cliente']['direccion']);
              $("#telefono_edit").val(datos['cliente']['telefono']);
              $("#observacion_edit").val(datos['cliente']['observacion']);
            //  $("#ordenanza_edit").val(datos['cliente']['descripcion']);
              /* $("#catgoria__MdPagos").text(datos['cliente']['categoria']); */
           
          
            
               







           



          },
          error: function(d) {
              toastr.error('Algo  salió mal, Reintente');
          }
      });
  });

        $("#formaPago_1").change(function() {
            var $select = $("select[id=formaPago_1]").val(); // 1 es efectivo

            if ($select == 1) {
                $(".numTransaccion_1CAJA").hide();
            } else {
                $(".numTransaccion_1CAJA").show();
            }
            $(".numTransaccion_1").val("0");
        });




        ///desceunto
        $(".btnmdlSolicitud__pagos").on('click', function() {

            var cli_id = $(this).attr("data-idCli");
            var endpoint = 'resumenPagoOrdenanzas/' + cli_id;
            $("#cliend_idmp").val(cli_id);

            $.ajax({
                async: false,
                type: "GET",
                dataType: "json",
                contentType: "application/x-www-form-urlencoded",
                url: endpoint,
                success: function(datos) {
                    $("#razonSocial__MdPagos_m").text(datos['cliente']['razonSocial']);
                    $("#repLegar__MdPagos_m").text(datos['cliente']['representanteLegal']);
                    $("#ruc__mdPAgos_m").text(datos['cliente']['ruc']);
                    $("#direccion__MdPagos_m").text(datos['cliente']['direccion']);
                    $("#telefono__MdPagos_m").text(datos['cliente']['telefono']);
                    /* $("#catgoria__MdPagos_m").text(datos['cliente']['categoria']); */
                    $("#saldo__mdpagos_m").text(datos['cliente']['saldo']);
                    $("#valor_tasa").val(datos['cliente']['saldo']);
                    $(".TasaAnual__mdpagos_m").val(datos['cliente']['saldo']);
                    $("#anticipos__mdpagos_m").text('$ ' + datos['Pagos']['anticipos']);
                    $("#descuentos__mdpagos_m").text(datos['Pagos']['descuentos']);
                    $("#RecargoTrimestral__mdpagos_m").text('$ ' + datos['Pagos']['RecargoTrimestral']);
                    $("#TasaAnual__mdpagos_m").text('$ ' + datos['Pagos']['TasaAnual']);
                    $("#TotalTasaAnual__m_").text('$ ' + datos['Pagos']['TasaAnualR']);



                },
                error: function(d) {
                    toastr.error('Algo  salió mal, Reintente');
                }
            });
        });


        var total = 0;
        var saldoPendiente = 0;
        var porcentaje = 0;
        $("#tipodescuento").change(function() {
            if ($("#tipodescuento").val() == 'personalizado') {


                $("#valor__mdlSolicutudPago_mp").keyup(function() {
                    porcentaje = $("#valor__mdlSolicutudPago_mp").val();
                    saldoPendiente = $("#saldo__mdpagos_m").text();

                    (porcentaje == '') ? porcentaje = 0: porcentaje;

                    total = ((porcentaje * saldoPendiente) / 100);



                    $("#valor__tbPagos").text(total.toFixed(3));
                    $("#valor__tbPagos").val(total.toFixed(3));

                    if (total == 'NaN') {
                        $("#valor__tbPagos_mp").val(0);
                        $("#saldo__mdpagos_mp").text(0);
                        $("#descuentos__mdpagos_m").text(0);
                        return true;
                    }

                    $("#valor__tbPagos_mp").val(total.toFixed(3));
                    $("#saldo__mdpagos_mp").text(total.toFixed(3));


                });
            } else if ($("#tipodescuento").val() == '100') {
                //$("#saldo__mdpagos_mp").text(2);

                $("#valor__mdlSolicutudPago_mp").val(100);
                porcentaje = $("#valor__mdlSolicutudPago_mp").val();
                saldoPendiente = $("#saldo__mdpagos_m").text();

                (porcentaje == '') ? porcentaje = 0: porcentaje;

                total = ((porcentaje * saldoPendiente) / 100);



                //$("#valor__tbPagos").text(total);

                if (total == 'NaN') {
                    $("#valor__tbPagos_mp").val(0);
                    $("#saldo__mdpagos_mp").text(0);
                    $("#descuentos__mdpagos_m").text(0);
                    return true;
                }

                $("#valor__tbPagos_mp").val(total.toFixed(3));
                $("#saldo__mdpagos_mp").text(total);
            } else {

                $("#valor__mdlSolicutudPago_mp").val(50);
                porcentaje = $("#valor__mdlSolicutudPago_mp").val();
                saldoPendiente = $("#saldo__mdpagos_m").text();

                (porcentaje == '') ? porcentaje = 0: porcentaje;

                total = ((porcentaje * saldoPendiente) / 100);



                $("#valor__tbPagos").text(total.toFixed(3));
                $("#valor__tbPagos").val(total.toFixed(3));

                if (total == 'NaN') {
                    $("#valor__tbPagos_mp").val(0);
                    $("#saldo__mdpagos_mp").text(0);
                    $("#descuentos__mdpagos_m").text(0);
                    return true;
                }

                $("#valor__tbPagos_mp").val(total.toFixed(3));
                $("#saldo__mdpagos_mp").text(total.toFixed(3));

            }

        });






       
       
        $("#valor__tbPagos_a").keyup(function() {
            var total = $("#valor__tbPagos_a").val();
            var saldoPendiente = $("#saldo__mdpagos_a").text();


            if (parseFloat(saldoPendiente) < parseFloat(total)) {
                toastr.error("Error, El valor ingresado no puede superar al valor del SALDO PENDIENTE");
                $("#valor__tbPagos_a").val('');
                return true;
            } else
            if (parseFloat(saldoPendiente) == parseFloat(total)) {
                toastr.warning("El valor ingresado es igual al SALDO PENDIENTE, no aplica anticipo.");
                $("#valor__tbPagos_a").val('');
                return true;
            }

            if (total == 'NaN' || total == '') {
                $("#valor__tbPagos_a").val('');
                return true;
            }



        });

        $("#formaPago").change(function() {
            var $select = $("select[id=formaPago]").val(); // 1 es efectivo

            if ($select == 1) {
                $("#numTransaccion").hide();
            } else {
                $("#numTransaccion").show();
            }
            $("#numTransaccion").val("0");
        });





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


    <script src="http://momentjs.com/downloads/moment.min.js"></script>

@endsection
