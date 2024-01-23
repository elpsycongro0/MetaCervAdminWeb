@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Editar Usuario</h1>
@stop

@section('content')
    <div>
    <form action="{{ route('admin.configurations.company-update') }}" class="signin-form" method="post">
        @csrf
                <input type="hidden" name="register_event" value=''>
                <div class="form-group mt-3">
                  <label class="form-control-placeholder" >Nombre</label>
                  <input type="text" class="form-control" name="name" value="{{$company->name}}" required>
                </div>
                <div class="form-group">
                  <label class="form-control-placeholder" >RUC</label>
                  <input type="text" class="form-control" name="ruc" value="{{$company->ruc}}" required>
                </div>
                <div class="form-group">
                  <button type="submit" id="submitButton" class="form-control btn btn-primary rounded submit px-3">Actualizar</button>
                </div>
                
              </form>
    </div>
@stop
@section('js')
    
@stop