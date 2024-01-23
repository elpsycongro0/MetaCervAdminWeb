@extends('adminlte::page')

@section('title', 'Configuration de entornos Virtuales')

@section('content_header')
    <h1>Configuration de entornos Virtuales</h1>
@stop

@section('content')
    <div>        
            <ul class="list-group  mb-3">
                <!-- <li class="list-group-item" id="ruc">
                    <b>Acceso protegido con contraseña</b> 
                    <div>Si</div>
                </li>
                <li class="list-group-item" id="ruc">
                    <b>Contraseña</b> 
                    <div></div>
                </li> -->
            </ul>
            <table id="showBooksIn" class="table table-bordered">
            <thead>
                <tr>
                    <th>Empresa</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            @foreach($pendantDeployments as $row)
            <tr>
                <td>{{$row['commercial_name']}}</td>
                <td>No habilitado</td>
                <td>
                <a class="btn btn-default btn-sm" href="{{ route('admin.companies.setAvailable', [
                        'id'=>$row['id']
                        ])}}">
                        Habilitar
                    </a>
                </td>
            </tr>
            @endforeach
            @foreach($pendantCreations as $row)
            <tr>
                <td>{{$row['commercial_name']}}</td>
                <td>No creado</td>
                <td>
                    <a class="btn btn-default btn-sm" href="{{ route('admin.companies.deploymentCreate', [
                        'commercialName'=>$row['commercial_name'], 
                        'razonSocial'=>$row['razon_social'],
                        'ruc'=>$row['ruc'],
                        'email'=>$row['email'],
                        'firstname'=>$row['firstname'],
                        'lastname'=>$row['lastname'],
                        'company'=>$row['commercial_name'],
                        'role'=>$row['role'],
                        'phone'=>$row['phone'],
                        'gender'=>$row['gender'],
                        'id_country'=>$row['id_country']
                        ])}}">
                        Crear
                    </a>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
    <div>
        <!-- <a href="{{ route('admin.configurations.scenes-edit') }}" class="form-control btn btn-primary rounded submit px-3">Actualizar datos</a> -->
    </div>
@stop


