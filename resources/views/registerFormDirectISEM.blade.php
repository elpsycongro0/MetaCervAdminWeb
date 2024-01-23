<!doctype html>
  <head>
    <title>Registro ISEM</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <link rel="stylesheet" href="{{ asset('css/style2.css') }}">

  </head>
  <body style="background-image: url('{{ asset('images/backround2.png') }}'); background-size: cover;">
  <section class="ftco-section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-7 col-lg-5">
          <div class="wrap">
            <div class="login-wrap p-4 p-md-5">
              <div class="d-flex">
                <div class="w-100">
                  
                  <h3 class="mb-4">ISEM</h3>

                  <h3 class="mb-4">Registro</h3>
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
              <form class="signin-form" method="post" action="{{route('register-validate-form-direct-isem')}}"
                onsubmit="document.getElementById('submitButton').disabled = true;">
                @csrf
                <input type="hidden" name="register_event" value=''>
                <div class="form-group mt-3">
                  <input type="text" class="form-control" name="firstname" required>
                  <label class="form-control-placeholder" >Nombre</label>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="lastname" required>
                  <label class="form-control-placeholder" >Apellidos</label>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="company" required>
                  <label class="form-control-placeholder" >Empresa</label>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="role" required>
                  <label class="form-control-placeholder" >Cargo</label>
                </div>
                <div class="form-group">
                  <input type="email" class="form-control" name="email" required>
                  <label class="form-control-placeholder" >Correo electrónico</label>
                </div>
                <div class="form-group">
                  <input type="tel" class="form-control" name="phone" pattern="[0-9]*" required>
                  <label class="form-control-placeholder" >Teléfono</label>
                </div>
                <div class="form-group">
                  <button type="submit" id="submitButton" class="form-control btn btn-primary rounded submit px-3">Registrar</button>
                </div>
                
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  </body>
</html>