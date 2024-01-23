@extends('adminlte::page')

@section('title', 'Configuration de empresa')

@section('content_header')
    <h1>Configuración de perfil de empresa</h1>
@stop

@section('content')
    <div>
            <ul class="list-group  mb-3">
                <li class="list-group-item" id="name">
                    <b>Nombre comercial</b> <div>{{$company->commercial_name}}</div>
                </li>
                <li class="list-group-item" id="name">
                    <b>Razon Social</b> <div>{{$company->razon_social}}</div>
                </li>
                <li class="list-group-item" id="ruc">
                    <b>RUC</b> <div>{{$company->ruc}}</div>
                </li>
            </ul>
    </div>
@stop


