@extends('adminlte::page')

@section('title', 'Configuration de entornos Virtuales')

@section('content_header')
    <h1>Configuration de entornos Virtuales</h1>
@stop

@section('content')
    <div>
        <form action="{{ route('admin.configurations.scenes-update') }}" class="signin-form" method="post">
            @csrf
            <div class="form-group mt-3">
                <label class="form-control-placeholder" >Acceso protegido con contraseña</label>
                <select class="custom-select rounded-0" name="with_password" required>
                    @if($withPassword)
                    <option value="1" selected>Si</option>
                    <option value="0">No</option>
                    @else
                    <option value="1">Si</option>
                    <option value="0" selected>No</option>
                    @endif
                </select>
            </div>
            <div class="form-group">
                <label class="form-control-placeholder" >Contraseña</label>
                <input type="text" class="form-control" name="password" value="{{$password}}" required>
            </div>
            <div class="form-group">
                <button type="submit" id="submitButton" class="form-control btn btn-primary rounded submit px-3">Actualizar</button>
            </div> 
        </form>
    </div>
@stop


