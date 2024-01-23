@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    <h1>Usuarios</h1>
@stop

@section('content')
    <div >
        <div class="card">
            <div class="card-body">
            <h5 class="card-title">Enlace de registro</h5>
            <p class="card-text">
                El enlace de registro para esta empresa es: <a href="{{ route('email-form', ['companyId' => Auth::user()->company_managed]) }}" target="_blank">{{ route('email-form', ['companyId' => Auth::user()->company_managed]) }}</a>
            </p>
            <button class="btn-sm btn-outline-secondary" onclick="copyLink()">Copiar enlace</button>
            <!-- <a href="#" class="card-link">Card link</a>
            <a href="#" class="card-link">Another link</a> -->
            </div>
        </div>
        
        <div class="modal fade" id="modal-default" style="display: none;" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Detalles de usuario</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                <ul class="list-group  mb-3">
                    <li class="list-group-item" id="modal-email">
                    <b>Email</b> <div class="float-right"></div>
                    </li>
                    <li class="list-group-item" id="modal-firstname">
                    <b>Nombre</b> <div class="float-right"></div>
                    </li>
                    <li class="list-group-item" id="modal-lastname">
                    <b>Apellido</b> <div class="float-right"></div>
                    </li>
                    <li class="list-group-item" id="modal-company">
                    <b>Empresa</b> <div class="float-right"></div>
                    </li>
                    <li class="list-group-item" id="modal-role">
                    <b>Rol</b> <div class="float-right"></div>
                    </li>
                    <li class="list-group-item" id="modal-country">
                    <b>Id país</b> <div class="float-right"></div>
                    </li>
                    <li class="list-group-item" id="modal-phone">
                    <b>teléfono</b> <div class="float-right"></div>
                    </li>
                    <li class="list-group-item" id="modal-privileges">
                    <b>Privilegios</b> <div class="float-right"></div>
                    </li>
                    <li class="list-group-item" id="modal-gender">
                    <b>Género</b> <div class="float-right"></div>
                    </li>
                </ul>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <a class="btn btn-primary" id="modal-user_edit_button">Editar</a>
                </div>
                </div>

            </div>
        </div>
        <div class="box">
            <div class="box-body">
                <div class="card-body table-responsive p-0">
                    <table id="usersTable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Email</th>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>Empresa</th>
                                <th>Rol</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
@stop
@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $('#usersTable').DataTable({
            "language": {
                "url": "{{ asset('json/Spanish.json') }}"
            },
            "ajax": {
                url: '{{route('admin.users.getall')}}',
                type: 'GET',
            },
            "columns":[
                { "data": "email","searchable":true },
                { "data": "firstname","searchable":true },
                { "data": "lastname","searchable":true },
                { "data": "company","searchable":true },
                { "data": "role","searchable":true },
                { "data": "action", orderable: false, searchable: false}
            ],
        });
    </script>
    <script>
        // var callPage = function (url) {
        //     var blockButton = event.srcElement;
        //     blockButton.setAttribute('disabled', '');
        //     if(blockButton.textContent.includes('Bloquear'))
        //         blockButton.textContent = 'Desbloquear';
        //     else
        //         blockButton.textContent = 'Bloquear';
        //     var xhr = new XMLHttpRequest();
        //     xhr.open('GET', url, true);
        //     xhr.send();
        //     setTimeout(() => {
        //         blockButton.removeAttribute('disabled');
        //     }, "1000");
        // };
        var showUserModal = function (user){
            document.querySelector('#modal-email').querySelector('.float-right').textContent = user['email'];
            document.querySelector('#modal-firstname').querySelector('.float-right').textContent = user['firstname'];
            document.querySelector('#modal-lastname').querySelector('.float-right').textContent = user['lastname'];
            document.querySelector('#modal-company').querySelector('.float-right').textContent = user['company'];
            document.querySelector('#modal-role').querySelector('.float-right').textContent = user['role'];
            document.querySelector('#modal-country').querySelector('.float-right').textContent = user['country'];
            document.querySelector('#modal-phone').querySelector('.float-right').textContent = user['phone'];
            document.querySelector('#modal-privileges').querySelector('.float-right').textContent = user['privileges'];
            document.querySelector('#modal-gender').querySelector('.float-right').textContent = user['gender'];
            var url = '{!! route("admin.users.edit", "_id") !!}';
            url = url.replace('_id', user['id']);
            document.querySelector('#modal-user_edit_button').href=url;
            if("{{ Auth::user()->id_privilege }}" <= user['id_privilege']){
                document.querySelector('#modal-user_edit_button').classList.add('disabled');
            } else{
                document.querySelector('#modal-user_edit_button').classList.remove('disabled');
            }
        }
        function copyLink() {
            var enlace = "{{ route('email-form', ['companyId' => Auth::user()->company_managed]) }}";
            navigator.clipboard.writeText(enlace);
            alert("Enlace copiado: " + enlace);
        }
    </script>
@stop