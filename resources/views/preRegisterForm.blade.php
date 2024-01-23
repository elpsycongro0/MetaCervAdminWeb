<!doctype html>
  <head>
    <title>Registro MetaCERV</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <link rel="stylesheet" href="{{ asset('css/stylePreRegForm.css') }}">
    <!-- <link rel="stylesheet" href="style.css"> -->

  </head>
  <body style="background-image: url('{{ asset('images/background.jpg') }}'); background-size: cover;">
  <!-- <body style="background-image: url('background.jpg'); background-size: cover;"> -->
  <section class="ftco-section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-10 col-lg-5">
          <div class="wrap">
            <div class="login-wrap p-4 p-md-5">
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
              <form class="signin-form" method="post" action="{{route('preRegister-store')}}"
              onsubmit="document.getElementById('submitButton').disabled = true;">
              @csrf

              
                  <h2 class="mb-2 custom-h2">Unete a MetaCERV!</h2>
                

                <h4 class="mb-4 custom-h22">Datos de empresa</h4>

                <div class="form-row">
                <div class="form-group col-md-6 d-flex justify-content-center align-items-center">
                  <img src="{{ asset('images/Edificios_512.png') }}" alt="Imagen" style="max-width: 60%; max-height: 60%;">
                </div>
                <div class="form-group col-md-6">
                  <div class="form-group">
                    <input type="text" class="form-control left-border" name="commercialName" required>
                    <label class="form-control-placeholder">Nombre comercial</label>
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control left-border" name="razonSocial" required>
                    <label class="form-control-placeholder">Razon social</label>
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control left-border" name="ruc" required>
                    <label class="form-control-placeholder">RUC</label>
                  </div>
                </div>
              </div>
              <h4 class="mb-4 custom-h22">Datos del usuario</h4>

              <div class="form-row">
                <div class="form-group col-md-6 d-flex justify-content-center align-items-center">
                  <div>
                    <img src="{{ asset('images/Persona_512.png') }}" alt="Imagen" style="max-width: 40%; max-height: 40%; margin-left: 120px;">
                  </div>
                </div>
                <div class="form-group col-md-6">
                  <div class="form-group">
                    <input type="email" class="form-control left-border" name="email" required>
                    <label class="form-control-placeholder">Correo electrónico</label>
                  </div>
                  <div class="form-group mt-3">
                    <input type="text" class="form-control left-border" name="firstname" required>
                    <label class="form-control-placeholder">Nombres</label>
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control left-border" name="lastname" required>
                    <label class="form-control-placeholder">Apellidos</label>
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control left-border" name="role" required>
                    <label class="form-control-placeholder">Rol en la empresa</label>
                  </div>
                  <div class="form-group">
                    <input type="tel" class="form-control left-border" name="phone" pattern="[0-9]*" required>
                    <label class="form-control-placeholder">Teléfono</label>
                  </div>
                  <div class="form-group">
                    <select class="form-control left-border" name="id_country" required>
                      <option value="">País</option>
                      <option value=1>Desconocido</option>
                      <option value=2>Afghanistan</option>
                      <option value=3>Albania</option>
                      <option value=4>Algeria</option>
                      <option value=5>Andorra</option>
                      <option value=6>Angola</option>
                      <option value=7>Antigua and Barbuda</option>
                      <option value=8>Argentina</option>
                      <option value=9>Armenia</option>
                      <option value=10>Australia</option>
                      <option value=11>Austria</option>
                      <option value=12>Azerbaijan</option>
                      <option value=13>Bahamas</option>
                      <option value=14>Bahrain</option>
                      <option value=15>Bangladesh</option>
                      <option value=16>Barbados</option>
                      <option value=17>Belarus</option>
                      <option value=18>Belgium</option>
                      <option value=19>Belize</option>
                      <option value=20>Benin</option>
                      <option value=21>Bhutan</option>
                      <option value=22>Bolivia</option>
                      <option value=23>Bosnia and Herzegovina</option>
                      <option value=24>Botswana</option>
                      <option value=25>Brazil</option>
                      <option value=26>Brunei</option>
                      <option value=27>Bulgaria</option>
                      <option value=28>Burkina Faso</option>
                      <option value=29>Burundi</option>
                      <option value=30>Cabo Verde</option>
                      <option value=31>Cambodia</option>
                      <option value=32>Cameroon</option>
                      <option value=33>Canada</option>
                      <option value=34>Central African Republic</option>
                      <option value=35>Chad</option>
                      <option value=36>Chile</option>
                      <option value=37>China</option>
                      <option value=38>Colombia</option>
                      <option value=39>Comoros</option>
                      <option value=40>Congo</option>
                      <option value=41>Costa Rica</option>
                      <option value=42>Cote d'Ivoire</option>
                      <option value=43>Croatia</option>
                      <option value=44>Cuba</option>
                      <option value=45>Cyprus</option>
                      <option value=46>Czechia</option>
                      <option value=47>Democratic Republic of the Congo</option>
                      <option value=48>Denmark</option>
                      <option value=49>Djibouti</option>
                      <option value=50>Dominica</option>
                      <option value=51>Dominican Republic</option>
                      <option value=52>Ecuador</option>
                      <option value=53>Egypt</option>
                      <option value=54>El Salvador</option>
                      <option value=55>Equatorial Guinea</option>
                      <option value=56>Eritrea</option>
                      <option value=57>Estonia</option>
                      <option value=58>Eswatini</option>
                      <option value=59>Ethiopia</option>
                      <option value=60>Fiji</option>
                      <option value=61>Finland</option>
                      <option value=62>France</option>
                      <option value=63>Gabon</option>
                      <option value=64>Gambia</option>
                      <option value=65>Georgia</option>
                      <option value=66>Germany</option>
                      <option value=67>Ghana</option>
                      <option value=68>Greece</option>
                      <option value=69>Grenada</option>
                      <option value=70>Guatemala</option>
                      <option value=71>Guinea</option>
                      <option value=72>Guinea-Bissau</option>
                      <option value=73>Guyana</option>
                      <option value=74>Haiti</option>
                      <option value=75>Holy See</option>
                      <option value=76>Honduras</option>
                      <option value=77>Hungary</option>
                      <option value=78>Iceland</option>
                      <option value=79>India</option>
                      <option value=80>Indonesia</option>
                      <option value=81>Iran</option>
                      <option value=82>Iraq</option>
                      <option value=83>Ireland</option>
                      <option value=84>Israel</option>
                      <option value=85>Italy</option>
                      <option value=86>Jamaica</option>
                      <option value=87>Japan</option>
                      <option value=88>Jordan</option>
                      <option value=99>Kazakhstan</option>
                      <option value=90>Kenya</option>
                      <option value=91>Kiribati</option>
                      <option value=92>Kuwait</option>
                      <option value=93>Kyrgyzstan</option>
                      <option value=94>Laos</option>
                      <option value=95>Latvia</option>
                      <option value=96>Lebanon</option>
                      <option value=97>Lesotho</option>
                      <option value=98>Liberia</option>
                      <option value=99>Libya</option>
                      <option value=100>Liechtenstein</option>
                      <option value=101>Lithuania</option>
                      <option value=102>Luxembourg</option>
                      <option value=103>Madagascar</option>
                      <option value=104>Malawi</option>
                      <option value=105>Malaysia</option>
                      <option value=106>Maldives</option>
                      <option value=107>Mali</option>
                      <option value=108>Malta</option>
                      <option value=109>Marshall Islands</option>
                      <option value=110>Mauritania</option>
                      <option value=111>Mauritius</option>
                      <option value=112>Mexico</option>
                      <option value=113>Micronesia</option>
                      <option value=114>Moldova</option>
                      <option value=115>Monaco</option>
                      <option value=116>Mongolia</option>
                      <option value=117>Montenegro</option>
                      <option value=118>Morocco</option>
                      <option value=119>Mozambique</option>
                      <option value=120>Myanmar</option>
                      <option value=121>Namibia</option>
                      <option value=122>Nauru</option>
                      <option value=123>Nepal</option>
                      <option value=124>Netherlands</option>
                      <option value=125>New Zealand</option>
                      <option value=126>Nicaragua</option>
                      <option value=127>Niger</option>
                      <option value=128>Nigeria</option>
                      <option value=129>North Korea</option>
                      <option value=130>North Macedonia</option>
                      <option value=131>Norway</option>
                      <option value=132>Oman</option>
                      <option value=133>Pakistan</option>
                      <option value=134>Palau</option>
                      <option value=135>Palestine State</option>
                      <option value=136>Panama</option>
                      <option value=137>Papua New Guinea</option>
                      <option value=138>Paraguay</option>
                      <option value=139>Peru</option>
                      <option value=140>Philippines</option>
                      <option value=141>Poland</option>
                      <option value=142>Portugal</option>
                      <option value=143>Qatar</option>
                      <option value=144>Romania</option>
                      <option value=145>Russia</option>
                      <option value=146>Rwanda</option>
                      <option value=147>Saint Kitts and Nevis</option>
                      <option value=148>Saint Lucia</option>
                      <option value=149>Saint Vincent and the Grenadines</option>
                      <option value=150>Samoa</option>
                      <option value=151>San Marino</option>
                      <option value=152>Sao Tome and Principe</option>
                      <option value=153>Saudi Arabia</option>
                      <option value=154>Senegal</option>
                      <option value=155>Serbia</option>
                      <option value=156>Seychelles</option>
                      <option value=157>Sierra Leone</option>
                      <option value=158>Singapore</option>
                      <option value=159>Slovakia</option>
                      <option value=160>Slovenia</option>
                      <option value=161>Solomon Islands</option>
                      <option value=162>Somalia</option>
                      <option value=163>South Africa</option>
                      <option value=164>South Korea</option>
                      <option value=165>South Sudan</option>
                      <option value=166>Spain</option>
                      <option value=167>Sri Lanka</option>
                      <option value=168>Sudan</option>
                      <option value=169>Suriname</option>
                      <option value=170>Sweden</option>
                      <option value=171>Switzerland</option>
                      <option value=172>Syria</option>
                      <option value=173>Tajikistan</option>
                      <option value=174>Tanzania</option>
                      <option value=175>Thailand</option>
                      <option value=176>Timor-Leste</option>
                      <option value=177>Togo</option>
                      <option value=178>Tonga</option>
                      <option value=179>Trinidad and Tobago</option>
                      <option value=180>Tunisia</option>
                      <option value=181>Turkey</option>
                      <option value=182>Turkmenistan</option>
                      <option value=183>Tuvalu</option>
                      <option value=184>Uganda</option>
                      <option value=185>Ukraine</option>
                      <option value=186>United Arab Emirates</option>
                      <option value=187>United Kingdom</option>
                      <option value=188>United States of America</option>
                      <option value=189>Uruguay</option>
                      <option value=190>Uzbekistan</option>
                      <option value=191>Vanuatu</option>
                      <option value=192>Venezuela</option>
                      <option value=193>Vietnam</option>
                      <option value=194>Yemen</option>
                      <option value=195>Zambia</option>
                      <option value=196>Zimbabwe</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="form-group text-center mt-4">
                <button type="submit" id="submitButton" class="btn btn-warning rounded-pill text-white px-5 py-3 font-weight-bold">Enviar</button>
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