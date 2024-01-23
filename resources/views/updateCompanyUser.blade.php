@extends('adminlte::page')

@section('title', 'Actualizar datos')

@section('content_header')
    <h1>Configuración</h1>
@stop

@section('content')
<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Actualizar datos</div>
                    <form action="{{ route('admin.config.update') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @elseif (session('error'))
                                <div class="alert alert-danger" role="alert">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <div class="mb-3">
                                <label for="companyName" class="form-label">Nombre de empresa</label>
                                <input name="name" type="text" class="form-control @error('old_password') is-invalid @enderror" id="companyName"
                                    value={{ $companyName }} required>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="comapnyEmail" class="form-label">Correo electrónico</label>
                                <input name="email" type="email" class="form-control @error('new_password') is-invalid @enderror" id="comapnyEmail"
                                    value={{ $companyEmail }} required>
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>

                        <div class="card-footer">
                            <button class="btn btn-primary">Actualizar</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop


