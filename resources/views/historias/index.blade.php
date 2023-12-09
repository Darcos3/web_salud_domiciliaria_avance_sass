@extends('layouts.back')

@section('breadcrumb')
<div class="row mt-5">
    <div class="col-md-9">
        <h4 class="card-title">Historias del @if(auth()->user()->tipo == 1) Paciente @else Profesional @endif</h4>
    </div>
    <div class="col-md-3 text-right">
        @if(auth()->user()->tipo == 0)
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#mod-create-historia">
            Crear historia
            </button>
        @endif
        @include('historias.create')
    </div>
</div>
@endsection

@section('content')
    
    <div class="table-responsive">
        <table class="table table-bordered table-sm table-striped table-hover" id="historias">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Profesional</th>
                    <th>Paciente</th>
                    <th>Consecutivo</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Estado</th>
                    <th>Opcion</th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
            <tfoot>
                <tr>
                    <th>Id</th>
                    <th>Profesional</th>
                    <th>Paciente</th>
                    <th>Consecutivo</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Estado</th>
                    <th>Opcion</th>
                </tr>
            </tfoot>
        </table>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var table = $('#historias').DataTable({
                lengthMenu: [[10,25,50,100,-1], [10,25,50,100,'Todos']],
                processing: true,
                serverSide: true,
                searchable:true,
                type: 'GET',
                dataType: 'json',
                language: {
                    "lengthMenu": "Mostrar _MENU_ registros",
                    "zeroRecords": "No se encontraron resultados",
                    "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "sSearch": "Buscar:",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast":"Último",
                        "sNext":"Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "sProcessing":"Procesando...",
                },
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    
                ],
                ajax: {
                      url: "{{ route('historias.index') }}",
                      type: 'GET',
                        // success: function (textStatus, status) {
                        //     console.log(textStatus);
                        //     console.log(status);
                        // },
                        // error: function(xhr, textStatus, error) {
                        //     console.log(xhr.responseText);
                        //     console.log(xhr.statusText);
                        //     console.log(textStatus);
                        //     console.log(error);
                        // }
                },
                order: [[0, 'desc']],
                
                columns: [
                    {data: 'id', name: 'id'},
                    {data: "profesional", name:'profesional'},
                    {data: "paciente", name:'paciente'},
                    {data: 'consecutivo', name: 'consecutivo'},
                    {data: 'fecha', name: 'fecha'},
                    {data: 'hora', name: 'hora'},
                    {data: 'estado', name: 'estado'},
                    {data: 'action', name: 'action', orderable: true, searchable: true},
                ],
            });
        });

        $("#paciente").change( function(){
            let id = $("#paciente").val();

            $.ajax({
                url: '/historias-consecutivo?id='+id,
                context: document.body
            }).done(function(data) {
                console.log(data);
                if( data != 'false'){
                    $("#consecutivo").val(data.consecutivo);
                    $("#id_paciente").val(data.id);
                    $("#error").hide();
                }
                else {
                    $('#error').text('consecutivo no encontrado')
                }
            });
        })
    </script>
@endsection

