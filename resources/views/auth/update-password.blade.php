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
                    <p class="text-center mt-5">Bienvenido al sistema Salud Domiciliaria, por favor actualiza tu contraseña</p>
                    <form method="POST" action="{{ route('guardar-password', auth()->user()->id) }}">
                        @csrf
                        @method('PATCH')
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <label for="password" class="">Contraseña</label>
                                <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password">
                            </div>
                            <div class="col-md-6">
                                <label for="password" class="">Confirme la contraseña</label>
                                <input id="conpassword" type="password" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary btn-block text-capitalize">
                                    Actualizar contraseña
                                </button>
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