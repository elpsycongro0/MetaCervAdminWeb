@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    <h1>Empresas</h1>
@stop

@section('content')
    <div >
        
        
        <div class="modal fade" id="modal-default" style="display: none;" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Detalles de empresa</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul class="list-group  mb-3">
                        <li class="list-group-item" id="modal-name">
                        <b>Nombre</b> <div class="float-right"></div>
                        </li>
                        <li class="list-group-item" id="modal-ruc">
                        <b>RUC</b> <div class="float-right"></div>
                        </li>
                    </ul>
                    <b>Administrador</b>
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
                        <li class="list-group-item" id="modal-id_country">
                        <b>Id país</b> <div class="float-right"></div>
                        </li>
                        <li class="list-group-item" id="modal-phone">
                        <b>teléfono</b> <div class="float-right"></div>
                        </li>
                        <li class="list-group-item" id="modal-id_privilege">
                        <b>Privilegios</b> <div class="float-right"></div>
                        </li>
                        <li class="list-group-item" id="modal-gender">
                        <b>Género</b> <div class="float-right"></div>
                        </li>
                    </ul>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <div>
                        Editar:
                        <a class="btn btn-primary" id="modal-company_edit_button">Empresa</a>
                        <a class="btn btn-primary" id="modal-user_edit_button">Administrador</a>
                    </div>
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
                                <th>Nombre</th>
                                <th>Ruc</th>
                                <th>Administrador</th>
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
                url: '{{route('admin.companies.getall')}}',
                type: 'GET',
            },
            "columns":[
                { "data": "commercial_name","searchable":true },
                { "data": "ruc","searchable":true },
                { "data": "email","searchable":true },
                { "data": "action", orderable: false, searchable: false}
            ],
        });
    </script>
    <script>
        var showUserModal = function (company, user){
            document.querySelector('#modal-name').querySelector('.float-right').textContent = company['name'];
            document.querySelector('#modal-ruc').querySelector('.float-right').textContent = company['ruc'];
            document.querySelector('#modal-email').querySelector('.float-right').textContent = user['email'];
            document.querySelector('#modal-firstname').querySelector('.float-right').textContent = user['firstname'];
            document.querySelector('#modal-lastname').querySelector('.float-right').textContent = user['lastname'];
            document.querySelector('#modal-company').querySelector('.float-right').textContent = user['company'];
            document.querySelector('#modal-role').querySelector('.float-right').textContent = user['role'];
            document.querySelector('#modal-id_country').querySelector('.float-right').textContent = user['id_country'];
            document.querySelector('#modal-phone').querySelector('.float-right').textContent = user['phone'];
            document.querySelector('#modal-id_privilege').querySelector('.float-right').textContent = user['id_privilege'];
            document.querySelector('#modal-gender').querySelector('.float-right').textContent = user['gender'];

            var urlUserEdit = '{!! route("admin.users.edit", "_id") !!}';
            urlUserEdit = urlUserEdit.replace('_id', user['id']);
            document.querySelector('#modal-user_edit_button').href = urlUserEdit;
            var urlCompanyEdit = '{!! route("admin.companies.edit", "_id") !!}';
            urlCompanyEdit = urlCompanyEdit.replace('_id', company['id']);
            document.querySelector('#modal-company_edit_button').href= urlCompanyEdit;
        }
        function copyLink() {
            var enlace = "{{ route('email-form', ['companyId' => Auth::user()->company_managed]) }}";
            navigator.clipboard.writeText(enlace);
            alert("Enlace copiado: " + enlace);
        }
    </script>
@stop