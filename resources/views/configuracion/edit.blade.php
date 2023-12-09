@extends('layouts.back')

@section('breadcrumb')
<div class="row mt-5">
    <div class="col-md-12">
        <h4 class="card-title">Actualizar Perfil del @if(auth()->user()->tipo == 1) Paciente @else Profesional @endif</h4>
        <?php
            $msg = $_GET['msg'];
        ?>
        @if( $msg )
            <div class="alert alert-success">
                {{ $msg }}
            </div>
        @endif
    </div>
</div>
@endsection

@section('content')
    <div class="container">
        <form method="post" action="{{ route('configuracion.update', auth()->user()->id) }}">
            @csrf
            @method('PATCH')
            
            <nav class="nav nav-tabs nav-stacked">
                <a class="nav-link active" data-toggle="tab" href="#usuario">Datos de Usuario</a>
                <a class="nav-link" data-toggle="tab" href="#rol">Datos de @if(auth()->user()->tipo == 1) Paciente @else Profesional @endif</a>
            </nav>

            <div class="tab-content mt-5" >
                <div class="tab-pane show active" id="usuario" role="tabpanel" aria-labelledby="home-tab">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Número de identificación</label>
                                <input type="text" class="form-control" readonly value="{{ $user->num_identificacion }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nombre de usuario</label>
                                <input type="text" class="form-control" name="usuario" value="{{ $user->usuario }}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Correo electrónico</label>
                                <input type="email" class="form-control" name="correo_electronico" value="{{ $user->correo_electronico }}" required>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <label class="text-center">Si quieres cambiar tu contraseña ingresála a continuación: </label>
                    <div class="row">
                        <div class="col-md-6">
                            <input type="password" name="password" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="rol" role="tabpanel" aria-labelledby="pac-tab">
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <label>Nombre</label>
                            <input type="text" name="nombre" class="form-control" value="{{ $rol->nombre }}" required>
                        </div>
                        <div class="col-md-4">
                            <label>Apellidos</label>
                            <input type="text" name="apellidos" class="form-control" value="{{ $rol->apellidos }}" required>
                        </div>
                        <div class="col-md-4">
                            <label>Correo Electrónico</label>
                            <input type="email" name="correo_electronico" class="form-control" value="{{ $rol->correo_electronico }}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Celular</label>
                            <input type="tel" name="num_celular" class="form-control" value="{{ $rol->num_celular }}" required>
                        </div>
                        <div class="col-md-4">
                            <label>Ubicación</label>
                            <input type="text" name="ubicacion" class="form-control" value="{{ $rol->ubicacion }}" required>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 text-right">
                <a href="/historias" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>

@endsection