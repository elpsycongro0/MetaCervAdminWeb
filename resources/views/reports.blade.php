@extends('adminlte::page')

@section('title', 'Reportes')

@section('content_header')
    <h1>Reportes</h1>
@stop

@section('content')
<div>
    <label for="startDate">Inicio:</label>
    <input type="date" id="startDate" name="trip-start">
    <label for="endDate">Fin:</label>
    <input type="date" id="endDate" name="trip-start">
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
          <ul class="list-group list-group-unbordered mb-3">
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
            <a class="btn btn-primary" id="modal-user_edit_button">Editar</a>
          </div>
        </div>

      </div>

    </div>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
            <!-- Line chart -->
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="far fa-chart-bar"></i>
                  Usuarios activos
                </h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <canvas id="activeUsersChart" width="200" height="100"></canvas>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <!-- Line chart -->
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="far fa-chart-bar"></i>
                  Registros
                </h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <canvas id="registerChart" width="200" height="100"></canvas>
              </div>
            </div>
          </div>
        </div>
    <div class="row">
      <div class="col-md-12">
      <!-- Line chart -->
            <div class="card card-primary card-outline" id="usersTableCard">
              <div class="overlay" hidden>
                <i class="fas fa-2x fa-sync-alt fa-spin"></i>
              </div>
              <div class="card-header">
                <h3 class="card-title">
                  <i class="far fa-chart-bar"></i>
                  Usuarios conectados
                </h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <table id="usersTable" class="table table-hover text-nowrap">
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
      <div class="col-md-12">
      <!-- Line chart -->
            <div class="card card-primary card-outline" id="userActivityCard">
              <div class="overlay" hidden>
                <i class="fas fa-2x fa-sync-alt fa-spin"></i>
              </div>
              <div class="card-header">
                <h3 class="card-title">
                  <i class="far fa-chart-bar"></i>
                  Actividad de usuario 
                </h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <button type="button" class="btn btn-default btn-sm float-right" id="showAllDetailButton" disabled> Mostrar todo </button>
                <table id="userActivityTable" class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>Acción</th>
                      <th>Parámetro</th>
                      <th>Hora</th> 
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
      </div>
    </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
</div>
@stop

@section('js')
<!-- chart -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js" integrity="sha512-OD9Gn6cAUQezuljS6411uRFr84pkrCtw23Hl5TYzmGyD0YcunJIPSBDzrV8EeCiFxGWWvtJOfVo5pOgB++Jsag==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- datatables -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

<script>
  // define charts
  var ctx1 = document.getElementById("activeUsersChart").getContext("2d");
  var activeUsersChart = new Chart(ctx1, {
    type: "line",
    options: {
      onClick: (e) => {
        const activeElements = activeUsersChart.getElementsAtXAxis(e);
        if(activeElements.length){
          const xval = activeUsersChart.scales['x-axis-0'].ticks[activeElements[0]._index];
          showUsers(activeElements[0]._index);
        }
      }
    },
    data: {
      labels: [],
      datasets: [{
        label: 'Conexiones por día',
        data: [],
        fill: false,
        borderColor: 'rgb(75, 192, 192)',
        tension: 0.1
      }]
    }
  });
  var ctx2 = document.getElementById("registerChart").getContext("2d");
  var registerChart = new Chart(ctx2, {
    type: "line",
    options: {
      onClick: (e) => {
        const activeElements = registerChart.getElementsAtXAxis(e);
        if(activeElements.length){
          const xval = registerChart.scales['x-axis-0'].ticks[activeElements[0]._index];
          showRegisteredUsers(activeElements[0]._index);
        }
      }
    },
    data: {
      labels: [],
      datasets: [{
        label: 'Registros',
        data: [],
        fill: false,
        borderColor: 'rgb(75, 192, 192)',
        tension: 0.1
      },
      {
        label: 'Registros validados',
        data: [],
        fill: false,
        borderColor: 'rgb(74, 191, 74)',
        tension: 0.1
      }]
    }
  });
  //get data function
  function join(date, options, separator) {
    function format(option) {
      let formatter = new Intl.DateTimeFormat('es', option);
      return formatter.format(date);
    }
    return options.map(format).join(separator);
  }
  function formatDateShort(date) {
    let options = [{ day: 'numeric' }, { month: 'short' }];
    let separator = '-';
    function format(option) {
      let formatter = new Intl.DateTimeFormat('es', option);
      return formatter.format(date);
    }
    return options.map(format).join(separator);
  }
  function formatDate(date) {
    let options = [{ year: 'numeric' }, { month: 'numeric' }, { day: 'numeric' }];
    let separator = '-';
    function format(option) {
      let formatter = new Intl.DateTimeFormat('es', option);
      return formatter.format(date);
    }
    return options.map(format).join(separator);
  }
  var getData = function () {
    var startInputDate = document.getElementById("startDate").valueAsDate;
    var startDate = new Date(startInputDate.getUTCFullYear(), startInputDate.getUTCMonth(), startInputDate.getUTCDate());
    var endInputDate = document.getElementById("endDate").valueAsDate;
    var endDate = new Date(endInputDate.getUTCFullYear(), endInputDate.getUTCMonth(), endInputDate.getUTCDate());
    var days = [];
    for (var i = new Date(startDate.getTime()); i <= endDate; i.setDate(i.getDate() + 1)) {
      days[formatDateShort(i)] = 0;
    }
    
    var activeUsersChartData={};
    Object.assign(activeUsersChartData, days);
    activeUsersChart.data.labels = Object.keys(activeUsersChartData);
    activeUsersChart.data.datasets[0].data = [];
    activeUsersChart.update();
    var url = '{!! route("admin.logs.logins", ["startDate" => "_startdate", "endDate" => "_enddate"]) !!}';
    url = url.replace('_startdate', formatDate(startDate));
    url = url.replace('_enddate', formatDate(endDate));
    $.ajax({
      url: url,
      success: function (data) {
        for (var i = 0; i < data['logs'].length; i++) {
          const logDate = new Date(Date.parse(data['logs'][i]['date']+" GMT-5"));
          let logDateStr = formatDateShort(logDate);
          if (typeof activeUsersChartData[logDateStr] !== 'undefined') {
            activeUsersChartData[logDateStr] = data['logs'][i]['logins'];
          }
        }
        activeUsersChart.data.labels = Object.keys(activeUsersChartData);
        activeUsersChart.data.datasets[0].data = Object.values(activeUsersChartData);
        activeUsersChart.update();
      }
    });

    var registerChartData={};
    Object.assign(registerChartData, days);
    registerChart.data.labels = Object.keys(registerChartData);
    registerChart.data.datasets[0].data = [];
    registerChart.update();
    $.ajax({
      url: "{{route('admin.logs.registers')}}",
      success: function (data) {
        for (var i = 0; i < data['registers'].length; i++) {
          const logDate = new Date(Date.parse(data['registers'][i]['date']+" GMT-5"));
          let logDateStr = formatDateShort(logDate);
          if (typeof registerChartData[logDateStr] !== 'undefined') {
            registerChartData[logDateStr] = data['registers'][i]['registers'];
          }
        }
        registerChart.data.labels = Object.keys(registerChartData);
        registerChart.data.datasets[0].data = Object.values(registerChartData);
        registerChart.update();
      }
    });

    var registerChartData2={};
    Object.assign(registerChartData2, days);
    registerChart.data.labels = Object.keys(registerChartData2);
    registerChart.data.datasets[1].data = [];
    registerChart.update();
    $.ajax({
      url: "{{route('admin.logs.validated-registers')}}",
      success: function (data) {
        for (var i = 0; i < data['registers'].length; i++) {
          const logDate = new Date(Date.parse(data['registers'][i]['date']+" GMT-5"));
          let logDateStr = formatDateShort(logDate);
          if (typeof registerChartData2[logDateStr] !== 'undefined') {
            registerChartData2[logDateStr] = data['registers'][i]['registers'];
          }
        }
        registerChart.data.labels = Object.keys(registerChartData2);
        registerChart.data.datasets[1].data = Object.values(registerChartData2);
        registerChart.update();
      }
    });
  };
  //init date fields
  document.getElementById('endDate').valueAsDate = new Date();
  document.getElementById('startDate').valueAsDate = new Date(new Date().setDate(new Date().getDate() - 7));

  const startDateObject = document.getElementById('startDate');
  const endDateObject = document.getElementById('endDate');
  startDateObject.addEventListener('change', getData);
  endDateObject.addEventListener('change', getData);
  getData();
</script>
<script>
  var usersTable = $('#usersTable').DataTable({
      "language":{"url":"{{ asset('json/Spanish.json') }}"},
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
  var userActivityTable = $('#userActivityTable').DataTable({
      "language":{"url":"{{ asset('json/Spanish.json') }}"},
      "columns":[
          { "data": "log_action","searchable":true },
          { "data": "log_parameter","searchable":true },
          { "data": "log_date","searchable":true }
      ],
  });
  var showUsers = function (chartIndex) {
    var usersTableCard = document.querySelector('#usersTableCard');
    var startInputDate = document.getElementById("startDate").valueAsDate;
    var startDate = new Date(startInputDate.getUTCFullYear(), startInputDate.getUTCMonth(), startInputDate.getUTCDate());
    startDate.setDate(startDate.getDate() + chartIndex);
    usersTableCard.querySelector('.card-title').textContent = "Usuarios conectado el "+formatDateShort(startDate);
    usersTableCard.querySelector('.overlay').hidden = false;
    var url = '{!! route("admin.logs.getUsersInLogs", ["date" => "_date"]) !!}';
    url = url.replace('_date', formatDate(startDate));
    usersTable.ajax.url( url ).load(() => {
      usersTableCard.querySelector('.overlay').hidden = true;
    });
  }
  var showRegisteredUsers = function(chartIndex) {
    var usersTableCard = document.querySelector('#usersTableCard');
    var startInputDate = document.getElementById("startDate").valueAsDate;
    var startDate = new Date(startInputDate.getUTCFullYear(), startInputDate.getUTCMonth(), startInputDate.getUTCDate());
    startDate.setDate(startDate.getDate() + chartIndex);
    usersTableCard.querySelector('.card-title').textContent = "Usuarios registrados el "+formatDateShort(startDate);
    usersTableCard.querySelector('.overlay').hidden = false;
    var url = '{!! route("admin.logs.getRegisteredUsers", ["date" => "_date"]) !!}';
    url = url.replace('_date', formatDate(startDate));
    usersTable.ajax.url( url ).load(() => {
      usersTableCard.querySelector('.overlay').hidden = true;
    });
  }
  var showActivityDetail = function(id, date, email){
    var userActivityCard = document.querySelector('#userActivityCard');
    var cardTitle = "Actividad de usuario ("+email+")"
    if(date){
      cardTitle = cardTitle+" el día "+date;
    }
    userActivityCard.querySelector('.card-title').textContent = cardTitle;
    userActivityCard.querySelector('.overlay').hidden = false;
    var url = '{!! route("admin.logs.getUserLogs", ["id" => "_id","date" => "_date"]) !!}';
    url = url.replace('_id', id);
    url = url.replace('_date', date);
    userActivityTable.ajax.url( url ).load(() => {
      userActivityCard.querySelector('.overlay').hidden = true;
    });

    var showAllDetailButton = document.querySelector('#showAllDetailButton');
    if(date){
      showAllDetailButton.removeAttribute('disabled');
    } else{
      showAllDetailButton.setAttribute('disabled', '');
    }
    showAllDetailButton.setAttribute('onclick',"showActivityDetail("+id+", '', \'"+email+"\')");
    // showAllDetailButton.onclick = ;
  }
  var showUserModal = function (user){
    document.querySelector('#modal-email').querySelector('.float-right').textContent = user['email'];
    document.querySelector('#modal-firstname').querySelector('.float-right').textContent = user['firstname'];
    document.querySelector('#modal-lastname').querySelector('.float-right').textContent = user['lastname'];
    document.querySelector('#modal-company').querySelector('.float-right').textContent = user['company'];
    document.querySelector('#modal-role').querySelector('.float-right').textContent = user['role'];
    document.querySelector('#modal-id_country').querySelector('.float-right').textContent = user['id_country'];
    document.querySelector('#modal-phone').querySelector('.float-right').textContent = user['phone'];
    document.querySelector('#modal-id_privilege').querySelector('.float-right').textContent = user['id_privilege'];
    document.querySelector('#modal-gender').querySelector('.float-right').textContent = user['gender'];
    var url = '{!! route("admin.users.edit", "_id") !!}';
    url = url.replace('_id', user['id']);
    document.querySelector('#modal-user_edit_button').href=url;
    if("{{ Auth::user()->id_privilege }}" <= user['id_privilege']){
      document.querySelector('#modal-user_edit_button').classList.add('disabled');
    }else{
      document.querySelector('#modal-user_edit_button').classList.remove('disabled');
    }
  }
  showUsers(7);
</script>
    
    
@stop