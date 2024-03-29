<!doctype html>
<head>
  <meta http-equiv="Content-Type" content="text/html"; charset="UTF-8" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</head>
<body>
  <section class="vh-100" style="background-color: #eee;">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-lg-12 col-xl-11">
          <div class="card text-black" style="border-radius: 25px;">
            <div class="card-body p-md-5">
              <div class="row justify-content-center">
                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-2">
                  @if (session('status'))
                  <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                  </div>
                  @elseif (session('error'))
                  <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                  </div>
                  @endif
                  <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Ingresa el código de verificación</p>
                  <p class="text-center h5 mb-5 mx-1 mx-md-4 mt-4">Hemos enviado un código de verificación de 6 dígitos al correo: {{ $request->email }}</p>

                  <form class="mx-1 mx-md-4" action="{{ route('validate-code') }}" method="post" 
                    onsubmit="document.getElementById('submitButton').disabled = true;">
                    @csrf
                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <input type="text" name="validation_code" class="form-control" maxlength="6" pattern="[0-9]+" required/>
                        <label class="form-label" for="form3Example1c">Código</label>
                      </div>
                    </div>

                    
                    <input type="hidden" name="firstname" value="{{ $request->firstname }}" />
                    <input type="hidden" name="lastname" value="{{ $request->lastname }}" />
                    <input type="hidden" name="company" value="{{ $request->company }}" />
                    <input type="hidden" name="role" value="{{ $request->role }}" />
                    <input type="hidden" name="email" value="{{ $request->email }}" />
                    <input type="hidden" name="gender" value="{{ $request->gender }}" />
                    <input type="hidden" name="companyId" value="{{ $request->companyId }}">
                    <input type="hidden" name="register_event" value="Web Platform Register">

                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4" >
                      <button type="submit" id="submitButton" class="btn btn-primary btn-lg">Validar</button>
                    </div>

                  </form>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


</body>
