<div class="modal fade" id="mod-create-historia" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-light">Crear historia</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" enctype="multipart/form-data" action="{{ route('historias.store') }}">
                @csrf
                <div class="modal-body text-left">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Paciente</label>
                                <input type="text" class="form-control" id="paciente" required>
                                <input type="hidden" id="id_paciente" name="id_paciente">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Consecutivo de historia</label>
                                <input type="text" class="form-control" name="consecutivo" id="consecutivo" required readonly>
                                <small id="error" class="text-danger"></small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Fecha</label>
                                <input type="date" class="form-control" name="fecha" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Hora</label>
                                <input type="time" class="form-control" name="hora" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Evolución final</label>
                                <textarea rows="2" class="form-control" name="evolucion" required></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Profesional que registra</label>
                                <input type="text" class="form-control" name="profesional"  value="{{ $usuario->nombre }}  {{ $usuario->apellidos }}" required readonly>
                            </div>
                        </div>
                        
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Información relevante del paciente</label>
                                <textarea rows="2" class="form-control" name="info_relevante" required></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Concepto del profesional</label>
                                <textarea rows="2" class="form-control" name="concepto" required></textarea>
                            </div>
                        </div>
                    </div>
    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Antecedentes del paciente</label>
                                <textarea rows="2" class="form-control" name="inf_antecedentes" required></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Recomendaciones al paciente</label>
                                <textarea rows="2" class="form-control" name="recomendaciones" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Imagen de visita al paciente</label>
                                <input type="file" name="imagen" class="form-control" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>