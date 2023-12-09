@extends('layouts.app')

@section('styles')
    <style>
        body {
            background-size: cover;
            background-image: url( {{ asset('img/bg-login.png') }} );
        }
    </style>
@endsection

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 offset-md-3  mt-5">
            <div class="card mt-5">
                <div class="card-body p-5">
                    <div class="text-center" style="margin-top: -170px; background: #FFF; border-radius: 100%; width: 200px; margin-left: auto; margin-right: auto">
                        <img src="{{ asset('img/logo.png') }}" class="img-fluid rounded" alt="logo" style="height: 200px">
                        <img src="{{ asset('img/as.png') }}" class="img-fluid rounded" alt="logo-as" style="height: 60px; margin-top: -40px">
                    </div>
                    <div class="row text-center mb-3">
                        <a href="/" class="btn-link text-danger text-capitalize">
                            <i class="fa fa-arrow-left"></i> Regresar al login
                        </a>
                    </div>
                    <p class="text-center">Bienvenido a la creación de usuario de Salud Domiciliario - Avance Software SAS, 
                        por favor completa el siguiente formulario para realizar tu solicitud</p>
                    <form method="POST" action="{{ route('post_login') }}">
                        @csrf

                        <nav class="nav nav-tabs nav-stacked">
                            <a class="nav-link active" data-toggle="tab" href="#usuario">Datos de Usuario</a>
                            <a class="nav-link" data-toggle="tab" href="#rol">Datos del perfil</a>
                        </nav>

                        <div class="tab-content mt-5" >
                            <div class="tab-pane show active" id="usuario" role="tabpanel" aria-labelledby="home-tab">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="email" class="">Tipo de usuario</label>
                                        <select name="tipo" class="form-control">
                                            <option value="">Seleccione</option> 
                                            <option value="0">Profesional</option> 
                                            <option value="1">Paciente</option> 
                                        </select>
                                    </div>
    
                                    <div class="col-md-6">
                                        <label class="">Número de identificación</label>
                                        <input id="num_identificacion" type="text" class="form-control" name="num_identificacion" required autocomplete="email" autofocus>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="rol" role="tabpanel" aria-labelledby="rol-tab">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="">Nombre</label>
                                        <input id="nombre" type="text" class="form-control" name="nombre" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="">Apellidos</label>
                                        <input id="apellidos" type="text" class="form-control" name="apellidos" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="">Correo electrónico</label>
                                        <input id="correo_electronico" type="email" class="form-control" name="correo_electronico" required >
                                    </div>
                                    <div class="col-md-6">
                                        <label class="">Número de celular</label>
                                        <input id="num_celular" type="tel" class="form-control" name="num_celular" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="">Ubicación</label>
                                        <input id="ubicacion" type="email" class="form-control" name="ubicacion" required >
                                    </div>
                                </div>
                                <hr>
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary btn-block text-capitalize">
                                        Crear usuario
                                    </button>
                                </div>
                            </div>
                        </div>
                        {{-- Errores --}}
                        <div class="col-md-12 mt-3 text-center">
                            <p id="error" class="text-danger text-center"></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        $("#conpassword").change(function(){
            console.log($("#password").val());
            console.log($("#conpassword").val());
            if($("#password").val() === $("#conpassword").val()){
                $("#error").hide();
            }
            else {
                $("#error").show();
                $("#error").text('Las contraseñas deben ser iguales');
            }
        })
    </script>
@endsection