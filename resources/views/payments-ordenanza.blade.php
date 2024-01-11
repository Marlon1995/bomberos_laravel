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
                    @if (auth()->user()->hasRoles([3]))
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
                        @if (auth()->user()->hasRoles([3]))
                            <div class="tab-pane fade show active" id="clients" role="tabpanel" aria-labelledby="home-tab">
                                <div class="page-title">
                                    <div class="title_left">
                                        <h2><i class="fa fa-usd"></i> Pago de impuesto de Tasa Anualdffsd. </h2>
                                    </div>
                                    
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
                                                            <th class="column-title ranSocial__pagos">ART. ORDENANZA</th>

                                                            <th class="column-title repesLegar__pagos">REP. LEGAL</th>
<!--                                                             <th class="column-title saldo__pagos">CATEGORIA</th>
                                                            <th class="column-title saldo__pagos">DENOMINACION</th> -->
                                                            <th class="column-title accion__pagos" align="center"></th>

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
                                                                        class="razonSocial__tbpagos">{{ $item->descripcion }}</label>
                                                                </td>
                                                                <td><label
                                                                        class="repLegar___tbPagos">{{ $item->representanteLegal }}</label>
                                                                       
                                                                </td>

                                                                <td>
                                                                    <form method="POST"
                                                                        action="{{ route('payments-ordenanzas.destroy', $item->id) }}">

                                                                        @if ($item->estado==7)
                                                                       
                                                                        <div data-toggle="modal"
                                                                            data-ruc_patototal="{{ $item->id }}"
                                                                            data-idCli="{{ $item->id }}"
                                                                            data-target="#mdlPagos"
                                                                            class="btn btn-info btn-xs btn-block pagar__pagos">
                                                                            Facturar </div>
                                                                        @endif
                                                                        <input type="hidden" name="_token"
                                                                            value="{{ csrf_token() }}">
                                                                        {!! method_field('DELETE') !!}
                                                                        <button type="submit"
                                                                            class="btn btn-danger btn-xs btn-block ">Anular</button>
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


                            <div class="tab-pane fade show" id="solicitudes" role="tabpanel">
                                <div class="page-title">
                                    <div class="title_left">
                                        <h2><i class="fa fa-usd"></i> Pago de Anticipos</h2>
                                    </div>
                                
                                </div>
                                <div class="">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="x_panel">
                                            <p class="text-muted font-13 m-b-30"></p>
                                            <div class="table-responsive">
                                                <table id="tbPagosSolicitudes"
                                                    class="table table-striped jambo_table bulk_action" style="width:100%">
                                                    <thead>
                                                        <tr class="headings">
                                                            <th class="column-title ruc__pagos">CI - RUC</th>
                                                            <th class="column-title ranSocial__pagos">RAZ&Oacute;N SOCIAL
                                                            </th>
                                                            <th class="column-title repesLegar__pagos">REP. LEGAL</th>
<!--                                                             <th class="column-title saldo__pagos">CATEGORIA</th>
                                                            <th class="column-title saldo__pagos">DENOMINACION</th> -->
                                                            <th class="column-title accion__pagos" align="center"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse($impuestos  as $item)
                                                            <tr class="even pointer">
                                                                <td><label
                                                                        class="ruc__tbpagos">{{ $item->ruc }}</label>
                                                                </td>
                                                                <td><label
                                                                        class="razonSocial__tbpagos">{{ $item->razonSocial }}</label>
                                                                </td>
                                                                <td><label
                                                                        class="repLegar___tbPagos">{{ $item->representanteLegal }}</label>
                                                                </td>
                                                                <td>
                                                                    <div data-toggle="modal"
                                                                        data-idCli="{{ $item->id }}"
                                                                        data-target="#mdlPagoSolicitud__pagos"
                                                                        class="btn btn-info mdlPagarSolicitud"> FACTURAR
                                                                    </div>
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
                        @endif






                        <!---3 es secretaria--->
                        @if (auth()->user()->hasRoles([5]))
                            <div class="tab-pane fade show active" id="solicitudes" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="page-title">
                                            <div class="title_left">
                                                <h2><i class="fa fa-file-text-o"></i> Solicitud de Descuentos</h2>
                                            </div>
                                            <div class="title_right">
                                               
                                            </div>
                                        </div>

                                        <div class="x_content">
                                            <p class="text-muted font-13 m-b-30">Listado de pago de Impuestos de Tasa Anual
                                                Pendientes</p>
                                            <div class="table-responsive">
                                                <table id="tbClienteSecretario"
                                                    class="table table-striped jambo_table bulk_action" style="width:100%">
                                                    <thead>
                                                        <tr class="headings">
                                                            <th class="column-title ruc__pagos">CI - RUC</th>
                                                            <th class="column-title ranSocial__pagos">RAZ&Oacute;N SOCIAL
                                                            </th>
                                                            <th class="column-title repesLegar__pagos">REP. LEGAL</th>
                                                            <!-- <th class="column-title saldo__pagos">CATEGORIA</th> -->
                                                            <!-- <th class="column-title saldo__pagos">DENOMINACION</th> -->
                                                            <th class="column-title accion__pagos" align="center"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse ($impuestos as $item)
                                                            <tr class="evenpointer">
                                                                <td><label
                                                                        class="ruc__tbpagos">{{ $item->ruc }}</label>
                                                                </td>
                                                                <td><label
                                                                        class="razonSocial__tbpagos">{{ $item->razonSocial }}</label>
                                                                </td>
                                                                <td><label
                                                                        class="repLegar___tbPagos">{{ $item->representanteLegal }}</label>
                                                                </td>
                                                                <td>
                                                                    <div class="btn btn-info btnmdlSolicitud__pagos"
                                                                        data-toggle="modal"
                                                                        data-ruc_patototal="{{ $item->id }}"
                                                                        data-idCli="{{ $item->id }}"
                                                                        data-target="#mdlSolicitud__pagos"> DESCUENTO </div>
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
                        @endif

                    </div>

                </div>
            </div>
        </div>






        <!-- /page contsent -->

        <!--- tasa anual--->
        <div class="modal fade" id="mdlPagos" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" style="max-width:80%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><i class="fa fa-money"></i> Pago de Ordenanza </h4>
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
                                        <p style="margin: 2px; font-weight: bold;">RUC 08600506900001</p>
                                        <p style="margin: 2px; font-weight: bold;">TELEFONO: 0602731-001</p>
                                    </div>
                                    <div class="col-sm-3"></div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-6" style="text-align: center">
                                        <h2 style="text-align: center; font-weight: bold">ORDEN DE PAGO DE PERMISO DE
                                            FUNCIONAMIENTO CUERPO DE BOMBEROS</h2>
                                        <p style="text-align: right;">Atacames, {{ now()->toDateTimeString() }}</p>
                                        <p style="text-align: right;">Permiso año {{ date('Y') }} </p>
                                        <style>
                                            .margin_p {
                                                margin: -6px;
                                            }
                                        </style>



                                        <div class="container">
                                            <div class="row" style="border: 1px solid;">
                                                <div class="col-sm-1"></div>
                                                <div class="col-sm-5" style="text-align: left;padding: 10px">
                                                    <p class="margin_p"><b>NOMBRE DEL LOCAL</b></p>
                                                    <p class="margin_p"><b>REPRESENTANTE /PROPIETARIO</b></p>
                                                    <p class="margin_p"><b>RUC</b></p>
                                                    <p class="margin_p"><b>DIRECCI&Oacute;N</b></p>
                                                    <p class="margin_p"><b>TEL&Eacute;FONO</b></p>
                                                    <p class="margin_p"><b>RAZÓN</b></p>
                                                    <!-- <p class="margin_p"><b>CATEGORIA</b></p> -->

                                                </div>
                                                <div class="col-sm-5" style="text-align: left;padding: 10px">
                                                    <p class="margin_p" id="razonSocial__MdPagos"></p>
                                                    <p class="margin_p" id="repLegar__MdPagos"></p>
                                                    <p class="margin_p" id="ruc__mdPAgos"></p>
                                                    <p class="margin_p" id="direccion__MdPagos"></p>
                                                    <p class="margin_p" id="telefono__MdPagos"></p>
                                                    <p class="margin_p" id="ordenanza__MdPagos"></p>

                                                    <!-- <p class="margin_p" id="catgoria__MdPagos"></p> -->
                                                </div>
                                                <div class="col-sm-1"></div>
                                            </div>
                                            <div class="row" style="border: 1px solid;">
                                                <div class="col-sm-1"></div>
                                                <div class="col-sm-6" style="text-align: left;padding: 10px">
                                                    <p class="margin_p"><b>T. Anticipos:
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </b> <label
                                                            id="anticipos__mdpagos"></label></p>
                                                    <p class="margin_p"><b>T. Descuentos:
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </b><label
                                                            id="descuentos__mdpagos"></label></p>
                                                    <p class="margin_p"><b>Recargo: &nbsp;&nbsp; </b><label
                                                            id="RecargoTrimestral__mdpagos"></label></p>
                                                    <p class="margin_p"><b>Total:
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </b><label
                                                            id="TasaAnual__mdpagos"></label></p>

                                                    <p class="margin_p"><b>Valor Especie:
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </b><label>$ 2.00</label>
                                                    </p>
                                                    <p class="margin_p"><label><b>Servicio Admistrativo: $1.00</label></p>
                                                    

                                                    <p class="margin_p"><b>Valor P. Exoneracion:
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </b><label id="permiso">$
                                                            1.00</label></p>

                                                            <p style="font-size: 20px; font-weight: bold"><b>TOTAL: $</b> <label id="saldo__mdpagos"></label></p>


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

                                                        <div class="item form-group numTransaccion_1CAJA">
                                                            <label class="col-form-label col-md-4 col-sm-4 label-align"
                                                                for="cedula">Porcentaje Recargo: </label>
                                                            <div class="col-md-10 col-sm-10">
                                                                <input type="text" class="form-control datepicker"
                                                                    name="valor_porcentaje" id="valor_porcentaje" required
                                                                    placeholder="1.46% ">
                                                                <input type="hidden" name="recargo_valor" id="recargo_valor">

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
        <!-- fin  -->


        <!---descuentos-->
        <div class="modal fade" id="mdlSolicitud__pagos" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" style="max-width:80%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><i class="fa fa-money"></i> Solicitud de Descuento</h4>
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
                                        <p style="margin: 2px; font-weight: bold;">RUC 08600506900001</p>
                                        <p style="margin: 2px; font-weight: bold;">TELEFONO: 0602731-001</p>
                                    </div>
                                    <div class="col-sm-3"></div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-6" style="text-align: center">
                                        <h2 style="text-align: center; font-weight: bold">ORDEN DE PAGO DE PERMISO DE
                                            FUNCIONAMIENTO CUERPO DE BOMBEROS</h2>
                                        <p style="text-align: right;">Atacames, {{ now()->toDateTimeString() }}</p>
                                        <p style="text-align: right;">Permiso año {{ date('Y') }} </p>
                                        <style>
                                            .margin_p {
                                                margin: -6px;
                                            }
                                        </style>
                                        <div class="container">
                                            <div class="row" style="border: 1px solid;">
                                                <div class="col-sm-1"></div>
                                                <div class="col-sm-5" style="text-align: left;padding: 10px">
                                                    <p class="margin_p"><b>NOMBRE DEL LOCAL</b></p>
                                                    <p class="margin_p"><b>REPRESENTANTE /PROPIETARIO</b></p>
                                                    <p class="margin_p"><b>RUC</b></p>
                                                    <p class="margin_p"><b>DIRECCI&Oacute;N</b></p>
                                                    <p class="margin_p"><b>TEL&Eacute;FONO</b></p>
                                                    <!-- <p class="margin_p"><b>CATEGORIA</b></p> -->

                                                </div>
                                                <div class="col-sm-5" style="text-align: left;padding: 10px">
                                                    <p class="margin_p" id="razonSocial__MdPagos_m"></p>
                                                    <p class="margin_p" id="repLegar__MdPagos_m"></p>
                                                    <p class="margin_p" id="ruc__mdPAgos_m"></p>
                                                    <p class="margin_p" id="direccion__MdPagos_m"></p>
                                                    <p class="margin_p" id="telefono__MdPagos_m"></p>
                                                    <!-- <p class="margin_p" id="catgoria__MdPagos_m"></p> -->
                                                </div>
                                                <div class="col-sm-1"></div>
                                            </div>
                                            <div class="row" style="border: 1px solid;">
                                                <div class="col-sm-1"></div>
                                                <div class="col-sm-5" style="text-align: left;padding: 10px">
                                                    <p class="margin_p"><b>T. Anticipos:
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </b> <label
                                                            id="anticipos__mdpagos_m"></label></p>
                                                    <p class="margin_p"><b>T. Descuentos:
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </b>$ <label
                                                            id="descuentos__mdpagos_m"></label></p>
                                                    <p class="margin_p"><b>T. Impuesto BCE: &nbsp;&nbsp; </b><label
                                                            id="RecargoTrimestral__mdpagos_m"></label></p>
                                                    <p class="margin_p"><b>T. Tasa Anual:
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </b><label
                                                            id="TasaAnual__mdpagos_m"></label></p>
<!--                                                     <p class="margin_p"><b>Valor Tasa Anual: &nbsp;&nbsp;&nbsp;
                                                        </b><label id="TotalTasaAnual__m_"></label></p> -->

                                                </div>
                                                <div class="col-sm-5" style="text-align: center;">
                                                    <br><br>
                                                    <p style="font-size: 20px; font-weight: bold"><b>TOTAL: </b>$ <label
                                                            id="saldo__mdpagos_m" name="saldo__mdpagos_m"></label></p>
                                                </div>

                                                <div class="col-sm-1"></div>
                                            </div>

                                            <form method="POST" action="{{ route('payments.update', 2) }}"
                                                enctype="multipart/form-data">
                                                <input type="hidden" name="tipoPago" value="2">
                                                <input type="hidden" name="valor_tasa" value="">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="hidden" name="id__tbPagos" id="id__tbPagos" value="">
                                                {!! method_field('PUT') !!}
                                                <div class="row" style="border: 1px solid;">
                                                    <div class="col-sm-1"></div>
                                                    <div class="col-sm-5" style="text-align: left;padding: 10px">


                                                        <div class="item form-group">
                                                            <label class="col-form-label col-md-4 col-sm-4 label-align"
                                                                for="cedula">Porcentaje </label>
                                                            <div class="col-md-10 col-sm-10">
                                                                <input type="text" name="cliend_idmp"
                                                                    id="valor__mdlSolicutudPago_mp" value="" required
                                                                    placeholder="Porcentaje % ej. 10.5"
                                                                    style="text-align: center"
                                                                    onKeyPress="return fn_aceptaNum(event)">
                                                                <input type="hidden" name="valor__tbPagos"
                                                                    id="valor__tbPagos_mp" value="0">
                                                                <input type="hidden" name="cliend_idmp" id="cliend_idmp"
                                                                    value="">
                                                            </div>
                                                        </div>
                                                        <div class="item form-group">
                                                            <label class="col-form-label col-md-4 col-sm-4 label-align"
                                                                for="cedula">Tipo Descuento </label>
                                                            <div class="col-md-10 col-sm-10">
                                                                <select class="form-control" id="tipodescuento"
                                                                    name="tipodescuento">
                                                                    <option value="x">Seleccione</option>
                                                                    <option value="50">Tercera Edad</option>
                                                                    <option value="50">Discapacitados</option>
                                                                    <option value="100">Artesanos Exonerados</option>
                                                                    <option value="personalizado">Personalizado</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="item form-group">
                                                            <label class="col-form-label col-md-4 col-sm-4 label-align"
                                                                for="cedula">Respaldo </label>
                                                            <div class="col-md-10 col-sm-10">
                                                                <input type="file" name="documentoRespaldo" required>
                                                            </div>
                                                        </div>



                                                    </div>

                                                    <div class="col-sm-5" style="text-align: center;">
                                                        <p style="font-size: 20px; font-weight: bold"><b>VALOR: </b><label
                                                                name="saldo__mdpagos_mp" id="saldo__mdpagos_mp"></label></p>
                                                    </div>

                                                    <div class="col-sm-1"></div>
                                                </div>

                                                <div class="row" style="border: 1px solid;">
                                                    <div class="col-sm-1"></div>
                                                    <div class="col-sm-10" style="text-align: left;padding: 10px">
                                                        <textarea class="form-control" name="decripcion_mp" placeholder="Descripción" required style="width: 99%"></textarea>
                                                    </div>
                                                    <div  class="d-grid gap-4 col-8 mx-auto">
                                                        <input type="submit" value="GENERAR" class="btn btn-info" style="font-size: 30px">
                                                    </div>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                    <div class="col-sm-3"></div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal"
                            aria-label="Close">Salir</button>
                    </div>
                </div>
            </div>
        </div>



        <!---anticipos---->
        <div class="modal fade" id="mdlPagoSolicitud__pagos" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" style="max-width:80%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><i class="fa fa-money"></i> Pago de Anticipos </h4>
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
                                        <p style="margin: 2px; font-weight: bold;">RUC 08600506900001</p>
                                        <p style="margin: 2px; font-weight: bold;">TELEFONO: 0602731-001</p>
                                    </div>
                                    <div class="col-sm-3"></div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-6" style="text-align: center">
                                        <h2 style="text-align: center; font-weight: bold">ORDEN DE PAGO DE PERMISO DE
                                            FUNCIONAMIENTO CUERPO DE BOMBEROS</h2>
                                        <p style="text-align: right;">Atacames, {{ now()->toDateTimeString() }}</p>
                                        <p style="text-align: right;">Permiso año {{ date('Y') }} </p>
                                        <style>
                                            .margin_p {
                                                margin: -6px;
                                            }
                                        </style>
                                        <div class="container">
                                            <div class="row" style="border: 1px solid;">
                                                <div class="col-sm-1"></div>
                                                <div class="col-sm-5" style="text-align: left;padding: 10px">
                                                    <p class="margin_p"><b>NOMBRE DEL LOCAL</b></p>
                                                    <p class="margin_p"><b>REPRESENTANTE /PROPIETARIO</b></p>
                                                    <p class="margin_p"><b>RUC</b></p>
                                                    <p class="margin_p"><b>DIRECCI&Oacute;N</b></p>
                                                    <p class="margin_p"><b>TEL&Eacute;FONO</b></p>
                                                    <!-- <p class="margin_p"><b>CATEGORIA</b></p> -->

                                                </div>
                                                <div class="col-sm-5" style="text-align: left;padding: 10px">
                                                    <p class="margin_p" id="razonSocial__MdPagos_a"></p>
                                                    <p class="margin_p" id="repLegar__MdPagos_a"></p>
                                                    <p class="margin_p" id="ruc__mdPAgos_a"></p>
                                                    <p class="margin_p" id="direccion__MdPagos_a"></p>
                                                    <p class="margin_p" id="telefono__MdPagos_a"></p>
                                                    <!-- <p class="margin_p" id="catgoria__MdPagos_a"></p> -->
                                                </div>
                                                <div class="col-sm-1"></div>
                                            </div>
                                            <div class="row" style="border: 1px solid;">
                                                <div class="col-sm-1"></div>
                                                <div class="col-sm-5" style="text-align: left;padding: 10px">
                                                    <p class="margin_p"><b>T. Anticipos:
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </b>$ <label
                                                            id="anticipos__mdpagos_a"></label></p>
                                                    <p class="margin_p"><b>T. Descuentos:
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </b><label
                                                            id="descuentos__mdpagos_a"></label></p>
                                                    <p class="margin_p"><b>T. Impuesto BCE: &nbsp;&nbsp; </b><label
                                                            id="RecargoTrimestral__mdpagos_a"></label></p>
                                                    <p class="margin_p"><b>T. Tasa Anual:
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </b><label
                                                            id="TasaAnual__mdpagos_a"></label></p>
<!--                                                     <p class="margin_p"><b>Valor Tasa Anual: &nbsp;&nbsp;&nbsp;
                                                        </b><label id="TotalTasaAnual__mdpagos_a"></label></p> -->


                                                </div>
                                                <div class="col-sm-5" style="text-align: center;">
                                                    <br><br>
                                                    <p style="font-size: 20px; font-weight: bold"><b>TOTAL: </b>$ <label
                                                            id="saldo__mdpagos_a"></label></p>
                                                </div>
                                                <div class="col-sm-1"></div>
                                            </div>

                                            <form method="POST" action="{{ route('payments.update', 2) }}">
                                                <input type="hidden" name="tipoPago" value="1">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="hidden" name="cliend_ida" id="cliend_ida" value="">

                                                {!! method_field('PUT') !!}
                                                <div class="row" style="border: 1px solid; padding: 10px">
                                                    <div class="col-sm-1"></div>
                                                    <div class="col-sm-5" style="text-align: left;padding: 10px">

                                                        <select class="form-control" name="formaPago" id="formaPago">
                                                            @forelse ($formasPago as $fp)
                                                                <option value="{{ $fp->id }}">{{ $fp->nombre }}
                                                                </option>
                                                            @empty
                                                            @endforelse
                                                        </select>
                                                        <input type="text" class="form-control" name="numTransaccion"
                                                            id="numTransaccion" onKeyPress="return fn_aceptaNum(event)"
                                                            value="" placeholder="N&uacute;mero de Transacci&oacute;n"
                                                            style="margin: 5px 0px">

                                                    </div>



                                                    <div class="col-sm-5" style="text-align: center;">
                                                        <p style="font-size: 20px; font-weight: bold"><b>VALOR: </b></p>
                                                        <input type="text" class="form-control" name="valor__tbPagos"
                                                            id="valor__tbPagos_a" value=""
                                                            onKeyPress="return fn_aceptaNum(event)" required
                                                            placeholder="Valor ej. 10.50" style="text-align: center">
                                                    </div>
                                                    <div class="col-sm-1"></div>
                                                </div>

                                                <div class="row" style="border: 1px solid;">
                                                    <div class="col-sm-1"></div>
                                                    <div class="col-sm-10" style="text-align: left;padding: 10px">
                                                        <textarea class="form-control" name="decripcion_mp" placeholder="Descripción" style="width: 99%"></textarea>
                                                    </div>
                                                    <div  class="d-grid gap-4 col-8 mx-auto">
                                                        <input type="submit" value="GENERAR" class="btn btn-info" style="font-size: 30px">
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                    <div class="col-sm-3"></div>
                                </div>

                            </div>
                        </div>
                    </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal"
                            aria-label="Close">Salir</button>
                    </div>
                </div>
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

           

            console.log(endpoint);

            $.ajax({
                async: false,
                type: "GET",
                dataType: "json",
                contentType: "application/x-www-form-urlencoded",
                url: endpoint,
                success: function(datos) {
                    $("#razonSocial__MdPagos").text(datos['cliente']['razonSocial']);
                    $("#repLegar__MdPagos").text(datos['cliente']['representanteLegal']);
                    $("#ruc__mdPAgos").text(datos['cliente']['ruc']);
                    $("#direccion__MdPagos").text(datos['cliente']['direccion']);
                    $("#telefono__MdPagos").text(datos['cliente']['telefono']);
                    $("#ordenanza__MdPagos").text(datos['cliente']['descripcion']);
                    /* $("#catgoria__MdPagos").text(datos['cliente']['categoria']); */
                    var $valor = datos['cliente']['saldo'] + 2;
                    if ($valor == 2) {
                        $("#permiso").text('$ ' + 2.00);
                        $valor = datos['cliente']['saldo'] + 2 + 2;

                    }

                    //hola
                    else {
                        $("#permiso").text('$ ' + 0.00);

                        $valor = datos['cliente']['saldo'] + 2+1;
                    }

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






        ///aticipo
        $(".mdlPagarSolicitud").on('click', function() {
            //anticipo
            var cli_id = $(this).attr("data-idCli");
            $("#cliend_ida").val(cli_id);
            var endpoint = 'resumenPagoOrdenanzas/' + cli_id;
            $.ajax({
                async: false,
                type: "GET",
                dataType: "json",
                contentType: "application/x-www-form-urlencoded",
                url: endpoint,
                success: function(datos) {
                    console.log("MArlon:"+datos);
                    $("#razonSocial__MdPagos_a").text(datos['cliente']['razonSocial']);
                    $("#repLegar__MdPagos_a").text(datos['cliente']['representanteLegal']);
                    $("#ruc__mdPAgos_a").text(datos['cliente']['ruc']);
                    $("#direccion__MdPagos_a").text(datos['cliente']['direccion']);
                    $("#telefono__MdPagos_a").text(datos['cliente']['telefono']);
                    /* $("#catgoria__MdPagos_a").text(datos['cliente']['categoria']); */
                    $("#saldo__mdpagos_a").text(datos['cliente']['saldo']);
                    $(".TasaAnual__mdpagos_m").val(datos['cliente']['saldo']);
                    $("#anticipos__mdpagos_a").text(datos['Pagos']['anticipos']);
                    $("#descuentos__mdpagos_a").text('$ ' + datos['Pagos']['descuentos']);
                    $("#RecargoTrimestral__mdpagos_a").text('$ ' + datos['Pagos']['RecargoTrimestral']);
                    $("#TasaAnual__mdpagos_a").text('$ ' + datos['Pagos']['TasaAnual']);
                    /* $("#TotalTasaAnual__mdpagos_a").text('$ ' + datos['Pagos']['TasaAnualR']); */

                },
                error: function(d) {
                    toastr.error('Algo  salió mal, Reintente');
                }
            });

        })
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
    </script>


    <script src="http://momentjs.com/downloads/moment.min.js"></script>

@endsection
