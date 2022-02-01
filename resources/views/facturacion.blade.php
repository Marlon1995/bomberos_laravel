@extends('facturacion-layout')

@section('title', ucwords($data[0]->nombre))
@section('icono', $data[0]->icono )

@section('pagecontent')

    <style>
        .td__pagos{
            width: 92%;
        }
        .cantidad__pagos{
            width: 10%;
        }
        .tipoPago___pagos{
            width: 55%;
        }
        .valor___pagos{
            width: 10%;
        }
        .boton___pagos{
            width: 15%;

        }
    </style>
     <div class="modal-content"  >
            <div class="modal-header">
                <h4 class="modal-title" ><i class="fa fa-usd"></i> PAGOS     | TASAS POR CONCESION DE PERMISOS DE FUNCIONAMIENTO ANUALES</h4>
                <a href="/payments" class="btn btn-outline-primary">Cerrar </a>
            </div>
            <div class="modal-body">
                <div class="form-group row" style="margin: 9px;">
                    <table width="100%">
                        <tr>
                           <td>
                                <table border="0" align="left" class="td__pagos">
                                    <tr><th><b>Raz&oacute;n Social___________</b> Desarrollo de Software y Talleres</th></tr>
                                    <tr><th><b>Representante Legal__</b> Jeison Isidro Caguana Guaman</th></tr>
                                    <tr><th><b>Denominaci&oacute;n_________</b> Comercial</th></tr>
                                    <tr><th><b>Categor&iacute;a_____________</b> AAA</th></tr>
                                     <tr><th><b>Riesgo________________</b> AEI</th></tr>
                                </table>
                            </td>
                            <td>
                                <h4>Estado de Cuenta </h4>
                                <table border="0" align="left"  class="table td__pagos" style="text-align: center">
                                    <tr>
                                        <th>Saldo: $10,00</th>
                                        <th>Multa: $0,00</th>
                                        <th>Mora: $0,00</th>
                                        <th>Anticipo: $0,00</th>
                                        <th>Descuento: %50</th>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                    <tr>
                                        <th  class="cantidad__pagos">Cantidad</th>
                                        <th  class="tipoPago___pagos">Descripcion</th>
                                        <th  class="valor___pagos">V.Unit</th>
                                        <th  class="valor___pagos">V.Total</th>
                                        <th  class="boton___pagos">Accion</th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="text" name="" id="" class="form-control" value="1">
                                        </td>
                                        <td>
                                            <select name="" id="" class="form-control">
                                                <option value="">Pago</option>
                                                <option value="">Mora</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" name="" id="" class="form-control" value="1">
                                        </td>
                                        <td>
                                            <input type="text" name="" id="" class="form-control" value="1">
                                        </td>
                                        <td>
                                            <button class="btn btn-outline-primary">Agregar</button>
                                            <!--button class="btn btn-outline-success">Modificar</button-->
                                        </td>
                                    </tr>

                                </table>
                            </td>
                            <td>
                                <table border="0" align="left" class="td__pagos" style="margin-left: 15px">
                                    <tr><th><b>TOTAL</b>_______$ 23,00</th></tr>
                                    <tr><th><b>IVA 12%</b>_____$ 2,00</th></tr>
                                    <tr><th><b>TOTAL + IVA</b>_$ 23,00</th></tr>
                                    <tr>
                                        <td><br></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <button class="btn btn-outline-success"><i class="fa fa-check"></i> Pagar</button>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <br><br><br><br><br>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>




@endsection
