@extends('layouts.back')

@section('breadcrumb')
<div class="row mt-5">
    <div class="col-md-9">
        <h4 class="card-title">Historia del Paciente No. {{ $historia->id }} </h4>
    </div>
</div>
@endsection

@section('content')
    <div class="container">
        <form method="post" enctype="multipart/form-data" action="{{ route('historias.update', $historia->id) }}">
            @csrf
            @method('PATCH')
            <div class="modal-body text-left">
                <div class="row">
                    <div class="col-md-6">
                        <img src="{{ asset('/storage/historias/'.$historia->imagen) }}" class="img fluid rounded mb-2" style="width: 400px; heigth:350px">
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Consecutivo de historia</label>
                            <input type="text" class="form-control" value="{{ $historia->consecutivo }}" readonly>
                        </div>
                        <br>
                        <div class="form-group">
                            <label>Paciente</label>
                            <input type="text" class="form-control" readonly value="{{ $paciente->nombre }} {{ $paciente->apellidos }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Fecha</label>
                            <input type="date" class="form-control" name="fecha" value="{{ $historia->fecha }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Hora</label>
                            <input type="time" class="form-control" name="hora" value="{{ $historia->hora }}" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Evolución final</label>
                            <textarea rows="2" class="form-control" name="evolucion" required>{{ $historia->evolucion_final }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Profesional que registra</label>
                            <input type="text" class="form-control" name="profesional"  value="{{ $profesional->nombre }}  {{ $profesional->apellidos }}" required readonly>
                        </div>
                    </div>
                    
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Información relevante del paciente</label>
                            <textarea rows="2" class="form-control" name="info_relevante" required>{{ $historia->inf_relevante }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Concepto del profesional</label>
                            <textarea rows="2" class="form-control" name="concepto" required>{{ $historia->concepto_profesional }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Antecedemtes del paciente</label>
                            <textarea rows="2" class="form-control" name="inf_antecedentes" required>{{ $historia->inf_antecedentes }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Recomendaciones al paciente</label>
                            <textarea rows="2" class="form-control" name="recomendaciones" required>{{ $historia->recomendaciones }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Imagen de visita al paciente</label>
                            <input type="file" name="imagen" class="form-control">
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