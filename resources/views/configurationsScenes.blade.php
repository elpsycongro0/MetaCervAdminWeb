@extends('adminlte::page')

@section('title', 'Configuration de entornos Virtuales')

@section('content_header')
    <h1>Configuration de entornos Virtuales</h1>
@stop

@section('content')
    <div>
        
            <ul class="list-group  mb-3">
                <li class="list-group-item" id="ruc">
                    <b>Acceso protegido con contraseña</b> 
                    @if($withPassword)
                    <div>Si</div>
                    @else
                    <div>No</div>
                    @endif
                    
                </li>
                <li class="list-group-item" id="ruc">
                    <b>Contraseña</b> <div>{{$password}}</div>
                </li>
            </ul>
    </div>
    <div>
        <a href="{{ route('admin.configurations.scenes-edit') }}" class="form-control btn btn-primary rounded submit px-3">Actualizar datos</a>
    </div>
@stop


