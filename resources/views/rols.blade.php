@extends('layout')

@section('title', ucwords($data[0]->nombre))
@section('icono', $data[0]->icono )

@section('pagecontent')
 <!-- page content -->
 <div class="right_col" role="main">
        <div class="">
          <div class="page-title">
            <div class="title_left">
              <h4>Administrar Roles </h4>
            </div>

            <div class="title_right">
              <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Buscar por..">
                  <span class="input-group-btn">
                    <button class="btn btn-secondary" type="button">Buscar</button>
                  </span>
                </div>
              </div>
            </div>
          </div>

          <div class="clearfix"></div>

          <div class="row">
            <div class="col-md-10 col-sm-10 col-xs-10">
              <div class="x_panel">
                <div class="x_title">
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <p class="text-muted font-13 m-b-30">
                        <a href="#" class="btn btn-outline-primary" data-toggle="modal" data-target="#exampleModal"> <i class="fa fa-user"></i> Agregar</a>
                         Listado de roles registrados
                </p>
                    @if ( session()->has('Respuesta') )
                        <div class="alert alert-success" role="alert" style="width: 60%;">
                            {{ session('Respuesta') }}
                        </div>
                        <script>
                            function explode(){
                                $('.alert').alert('close');
                            }
                            setTimeout(explode, 3000);
                        </script>
                    @endif

                  <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                      <tr>
                        <th>Key</th>
                        <th>Role</th>
                        <th>Descripci&oacute;n</th>
                        <th>Estado</th>
                        <th>Editar</th>
                       </tr>
                    </thead>
                    <tbody>
                    @forelse ($rols as $item)
                        @if( $item->id != 1 )

                        <tr>
                            <td>{{ $item->key }} </td>
                            <td>{{ $item->role }} </td>
                            <td>{{ $item->descripcion }} </td>
                            <td>
                                @if( $item->estado ==  2 )
                                    <form method="POST" action="{{ route('rols.destroy', $item->id )}}">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        {!! method_field('DELETE') !!}
                                        <button type="submit"class="btn btn-outline-success btn-xs btn-block ">Activado</button>
                                    </form>
                                @endif
                                @if( $item->estado ==  1)
                                    <form method="POST" action="{{ route('rols.update', $item->id )}}">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        {!! method_field('PUT') !!}
                                        <button type="submit"class="btn btn-outline-danger btn-xs btn-block">Desactivado</button>
                                    </form>
                                @endif

                           </td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-warning btnEditarPerfil"  data-toggle="modal" data-target="#exampleModal"><i class="fa fa-pencil"></i></button>
                                </div>
                            </td>
                          </tr>
                    @endif
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
<!-- /page content -->



<style>
.modal-dialog {
    max-width: 55%!important;
 }
</style>
<!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    Roles de Usuario
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_content">



                                    <form class="form-horizontal form-label-left" method="POST" action="{{ route('rols.store')}}">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                        <span class="section"> Roles </span>

                                        <div class="item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="perfil"> Key </label>
                                            <div class="col-md-6 col-sm-6">
                                                <input type="text" id="key" name="key" class="form-control" required="required">
                                            </div>
                                         </div>

                                        <div class="item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="perfil"> Role </label>
                                            <div class="col-md-6 col-sm-6">
                                                <input type="text" id="role" name="role" class="form-control" required="required">
                                            </div>
                                        </div>


                                        <div class="item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="descripcion"> Descripcci&oacute;n </label>
                                            <div class="col-md-6 col-sm-6">
                                              <textarea class="form-control" name="descripcion" required="required"></textarea>                                            </div>
                                            {{-- <div class="alert">please put something here</div> --}}
                                        </div>


                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-6 offset-md-3">
                                                <button class="btn btn-primary" data-dismiss="modal">Cancel</button>
                                                <button id="send" type="submit" class="btn btn-success">Guardar</button>
                                            </div>
                                        </div>
                                    </form>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- fin -->

 @endsection
 @section('scrpts-jqrey')
    <script>
        $('#exampleModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
             var modal = $(this);

            });
    </script>
 @endsection

