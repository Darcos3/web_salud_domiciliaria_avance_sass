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
                    <form method="POST" action="{{ route('post_login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="">Tipo de usuario</label>
                            <select name="tipo" class="form-control" required>
                                <option value="">Seleccione el tipo de usuario</option> 
                                <option value="0">Profesional</option> 
                                <option value="1">Paciente</option> 
                            </select>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="">Número de identificación</label>
                            <input id="num_identificacion" type="text" class="form-control" name="num_identificacion" required autocomplete="email" autofocus>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password">
                        </div>

                        <div class="row">
                            <button type="submit" class="btn btn-primary btn-block text-capitalize">
                                iniciar sesion
                            </button>
                            <br><br>
                        </div>
                        <div class="row ">
                            <div class="col-md-12 text-center mt-3">
                                <label class="">------ ¿Aún no tienes cuenta? Registrate ------</label><br>
                                <a href="/registro" class="btn btn-dark btn-sm text-capitalize">
                                    Registrate como usuario
                                </a>
                                <br><br>
                                @if(session()->get('msg'))
                                    <div class="alert alert-dark">
                                        {{ session()->get('msg') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
