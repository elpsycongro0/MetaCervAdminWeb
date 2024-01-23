@extends('adminlte::page')

@section('title', 'Configuration de perfil')

@section('content_header')
    <h1>Configuración de perfil</h1>
@stop

@section('content')
    <div>
        
            <ul class="list-group  mb-3">
                <li class="list-group-item" id="modal-email">
                    <b>Email</b> <div>{{$user->email}}</div>
                </li>
                <li class="list-group-item" id="modal-firstname">
                    <b>Nombre</b> <div>{{$user->firstname}}</div>
                </li>
                <li class="list-group-item" id="modal-lastname">
                    <b>Apellido</b> <div>{{$user->lastname}}</div>
                </li>
                <li class="list-group-item" id="modal-company">
                    <b>Empresa</b> <div>{{$user->company}}</div>
                </li>
                <li class="list-group-item" id="modal-role">
                    <b>Rol</b> <div>{{$user->role}}</div>
                </li>
                <li class="list-group-item" id="modal-phone">
                    <b>teléfono</b> <div>{{$user->phone}}</div>
                </li>
            </ul>
        
        <!-- <form action="" class="signin-form" method="post">
            @csrf
            <input type="hidden" name="register_event" value=''>
            <div class="form-group mt-3">
            <input type="text" class="form-control" name="firstname" value={{$user->name}} required>
            <label class="form-control-placeholder" >Nombre de empresa</label>
            </div>
            <div class="form-group">
            <input type="text" class="form-control" name="lastname" value={{$user->email}} required>
            <label class="form-control-placeholder" >Correo</label>
            <div class="form-group">
            <button type="submit" id="submitButton" class="form-control btn btn-primary rounded submit px-3">Actualizar</button>
            </div>
                    
        </form> -->
    </div>
    <div>
        <a href="{{ route('admin.users.edit', $user->id) }}" class="form-control btn btn-primary rounded submit px-3">Actualizar datos</a>
        <br><br>
        <a href="{{route('admin.configurations.change-password')}}" class="form-control btn btn-primary rounded submit px-3">Cambiar contraseña</a>
    </div>
@stop


