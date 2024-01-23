<html style="height: 100%;">
  <head>
    <title>Registro {{ $companyName }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  </head>
  <body style="height: 100%;">
  
  <div class="h-100 d-flex align-items-center justify-content-center">
  <div>
  <div class="row justify-content-center">
    <div class="col-md-7 col-lg-5">
      <div class="wrap">
        <div class="login-wrap p-4 p-md-5">
          <div class="d-flex">
            <div class="w-100">
              <h4 >{{ $companyName }}</h4>
              
              <h3 class="mb-4">Registrate</h3>
              <p>Para acceder a los entornos virtuales de esta empresa debes enlazar una cuenta de MetaCERV existente o crear una cuenta</p>
            </div>
          </div>
          <div class="alert alert-danger" role="alert" style="display: <?php echo (isset($data) and $data["alert"])?"block": "none"?>">
            <?php echo (isset($data) and $data["alertMessage"])?$data["alertMessage"]: ""?>
          </div>
          @if (session('status'))
          <div class="alert alert-success" role="alert">
            {{ session('status') }}
          </div>
          @elseif (session('error'))
          <div class="alert alert-danger" role="alert">
            {{ session('error') }}
          </div>
          @endif
          <form class="signin-form" method="get" action="{{route('register-form', ['companyId' => $companyId])}}"
            onsubmit="document.getElementById('submitButton').disabled = true;">
            @csrf
            <div class="form-group">
              <input type="email" class="form-control" name="email" required>
              <label class="form-control-placeholder" >Correo electrónico</label>
            </div>
            <input type="hidden" name="companyId" value="{{ $companyId }}" />
            <div class="form-group">
              <button type="submit" id="submitButton" class="form-control btn btn-primary rounded submit px-3">
                Registrar
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
  </div>
  
  </body>
</html>