@extends('layout')

@section('title', ucwords($data[0]->nombre))
@section('icono', $data[0]->icono)

@section('pagecontent')
    <!-- page content -->
    <style>
        .Neon {
            color: #494949;
            position: relative;
        }

        .Neon * {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        .Neon-input-dragDrop {
            display: block;
            width: 100%;
            margin: 0 auto 25px auto;
            padding: 15px;
            color: #8d9499;
            color: #97A1A8;
            background: #fff;
            border: 2px dashed #C8CBCE;
            text-align: center;
            -webkit-transition: box-shadow 0.3s, border-color 0.3s;
            -moz-transition: box-shadow 0.3s, border-color 0.3s;
            transition: box-shadow 0.3s, border-color 0.3s;
        }

        .Neon-input-dragDrop .Neon-input-icon {
            font-size: 48px;
            margin-top: -10px;
            -webkit-transition: all 0.3s ease;
            -moz-transition: all 0.3s ease;
            transition: all 0.3s ease;
        }

        .Neon-input-text h3 {
            margin: 0;
            font-size: 18px;
        }

        .Neon-input-text span {
            font-size: 12px;
        }

        .Neon-input-choose-btn.blue {
            color: #008BFF;
            border: 1px solid #008BFF;
        }

        .Neon-input-choose-btn {
            display: inline-block;
            padding: 8px 14px;
            outline: none;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
            white-space: nowrap;
            font-size: 12px;
            font-weight: bold;
            color: #8d9496;
            border-radius: 3px;
            border: 1px solid #c6c6c6;
            vertical-align: middle;
            background-color: #fff;
            box-shadow: 0px 1px 5px rgba(0, 0, 0, 0.05);
            -webkit-transition: all 0.2s;
            -moz-transition: all 0.2s;
            transition: all 0.2s;
        }
    </style>

    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Configuraci&oacute;n del Sistema</h3>
                </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
                <div class="col-9">
                    <div class="x_panel">

                        <div class="x_title">
                            <h2>Infromaci&oacute;n<small>{{ ucwords($data[0]->nombre) }}</small></h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <br />
                            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left"
                                method="POST" action="{{ route('system.update', $data[0]->id) }}"
                                enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                {!! method_field('PUT') !!}

                                <div class="row">
                                    <div class="col-9">

                                        <div class="item form-group">
                                            <label class="col-form-label col-md-2 col-sm-2 label-align"
                                                for="first-name">Nombre</label>
                                            <div class="col-md-10 col-sm-10 ">
                                                <input type="text" id="first-name" id="nombre" name="nombre"
                                                    required="required" class="form-control"
                                                    value="{{ ucwords($data[0]->nombre) }}">
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="col-form-label col-md-2 col-sm-2 label-align"
                                                for="last-name">T&eacute;rminos</label>
                                            <div class="col-md-10 col-sm-10 ">
                                                <textarea class=" form-control" name="terminos">{{ ucwords($data[0]->terminos) }}</textarea>
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label for="middle-name"
                                                class="col-form-label col-md-2 col-sm-2 label-align">Condiciones </label>
                                            <div class="col-md-10 col-sm-10 ">
                                                <textarea class="form-control" name="condiciones">{{ ucwords($data[0]->condiciones) }}</textarea>
                                            </div>
                                        </div>

                                        @if (session()->has('Respuesta'))
                                            <div class="alert alert-success" role="alert">
                                                {{ session('Respuesta') }}
                                            </div>
                                            <script>
                                                function explode() {
                                                    $('.alert').alert('close');
                                                }
                                                setTimeout(explode, 2500);
                                            </script>
                                        @endif

                                    </div>
                                    <div class="col-3">
                                        <div class="item form-group">
                                            <div class="Neon Neon-theme-dragdropbox">
                                                <div class="Neon-input-dragDrop">
                                                    <div class="Neon-input-inner">
                                                        <div class="Neon-input-icon">
                                                            <img src="./assets/img/icons/{{ $data[0]->icono }}" alt="Logo"
                                                                id="blah" style="width: 50px">
                                                        </div>
                                                        <div class="Neon-input-text">
                                                            Cargar &Iacute;cono
                                                            <input class="Neon-input-choose-btn blue" style="width: 85%"
                                                                name="icono" id="icono" type="file"
                                                                onchange="readURL(this);" required="required">
                                                            <script>
                                                                function readURL(input) {
                                                                    if (input.files && input.files[0]) {
                                                                        var reader = new FileReader();

                                                                        reader.onload = function(e) {
                                                                            $('#blah')
                                                                                .attr('src', e.target.result);
                                                                        };

                                                                        reader.readAsDataURL(input.files[0]);
                                                                    }
                                                                }
                                                            </script>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div>
                                                </div>


                                                <div class="item form-group">
                                                    <div class="col-md-12 col-sm-12  offset-md-12">
                                                        <button type="submit" class="btn btn-app"><i
                                                                class="fa fa-save"></i>Guardar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
    <!-- /page content -->


@endsection
@section('scrpts-jqrey')

@endsection
