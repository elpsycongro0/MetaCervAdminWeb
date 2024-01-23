@extends('adminlte::page')

@section('title', 'Inicio')

@section('content_header')
    <h1>Bienvenido a la plataforma de MetaCERV</h1>
@stop

@section('content')
    <p>Desde aqui podrá administrar sus entornos virtuales.</p>


    <div class="modal fade" id="modal-default" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Alerta de seguridad</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div>Estas usando la contraseña por defecto, recomendamos cambiar la contraseña ahora</div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Recordarme luego</button>
                <a class="btn btn-primary" href='{!! route("admin.configurations.change-password") !!}'>Cambiar contraseña</a>
            </div>
            </div>

        </div>
    </div>
@stop
@section('js')
    @if(!$defaultPasswordChanged)
        <script>
            $(window).on('load', function() {
                $('#modal-default').modal('show');
            });
        </script>
    @endif
@stop