<!DOCTYPE html>
<head>
  <title>Registro MetaCERV</title>
  <meta http-equiv="Content-Type" content="text/html"; charset="UTF-8" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</head>
<section class="vh-100" style="background-image: url('{{ asset('images/background.jpg') }}'); background-size: cover;">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-12 col-xl-11">
        <div class="card text-black" style="border-radius: 25px;">
          <div class="card-body p-md-5">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-2">

                <p class="text-center h3 fw-bold mb-5 mx-1 mx-md-4 mt-4">Se ha registrado correctamente {{$request->email}} en metaCERV</p>
                <p class="text-center fw-bold mx-1 mx-md-4 mt-4">Puede cerrar esta pestaña</p>
                
              </div>
              <div class="col-md-10 col-lg-6 col-xl-7 d-flex flex-column align-items-center order-1 order-lg-1">
                
                <img src="{{ asset('images/metacerv.jpg') }}"
                  class="img-fluid w-100" alt="Metacerv">

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>