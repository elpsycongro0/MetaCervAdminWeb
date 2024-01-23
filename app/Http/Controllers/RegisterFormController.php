<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\UserCompany;
use App\Models\PendantCompanyCreate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ValidateUser;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;

class RegisterFormController extends Controller
{
    public function emailForm($companyId)
    {
        session()->forget(['status','error']);
        
        $companyName = Company::find($companyId)->name;
        return view('emailForm', compact("companyId", "companyName"));
    }

    public function registerValidateForm(Request $request)
    {
        session()->forget(['status','error']);
        if(session()->get('errorRedirectMessage')!==null){
            session(['error' => session()->get('errorRedirectMessage')]);
            session()->forget(['errorRedirectMessage']);
        }

        $url = 'https://metacerv.com/10011299104-nc/php_sendVerificationCode.php';
        $data = $request->all();
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data)
            )
        );
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        $json_data = json_decode($result,true);
        if($json_data["success"]==2){
            session(['errorRedirectMessage' => 'El correo ya está registrado']);
            return redirect()->route('register-form', ['companyId' => $request->companyId]);
        }
        else if($json_data["success"]==3){
            session(['error' => 'Ya se envió el código de verificación']);
        }
        return view('validateEmailForm', compact("request"));
    }

    public function registerForm($companyId)
    {
        session()->forget(['status','error']);
        if(session()->get('errorRedirectMessage')!==null){
            session(['error' => session()->get('errorRedirectMessage')]);
            session()->forget(['errorRedirectMessage']);
        }

        $companyName = Company::find($companyId)->name;
        $email = request()->email;
        $user = User::where('email', $email)->first();
        $request = (object) array("email" => request()->email);
        if(is_null($user)) {
            return view('registerForm', compact("companyId", "companyName", "email"));
        }
        else {
            //insert into users_metausers table
            $newUserCompany = new UserCompany;
            $newUserCompany->user_id = $user->id;
            $newUserCompany->company_id = $companyId;
            $newUserCompany->save();
            return view('registerSuccess', compact("request", "companyName"));
            // return redirect()->route('register-form', ['companyId' => $request->companyId]);
        }

    }

    public function registerFormDirect()
    {
        session()->forget(['status','error']);
        if(session()->get('errorRedirectMessage')!==null){
            session(['error' => session()->get('errorRedirectMessage')]);
            session()->forget(['errorRedirectMessage']);
        }
        return view('registerFormDirect');
    }
    public function registerFormDirectISEM()
    {
        session()->forget(['status','error']);
        if(session()->get('errorRedirectMessage')!==null){
            session(['error' => session()->get('errorRedirectMessage')]);
            session()->forget(['errorRedirectMessage']);
        }
        return view('registerFormDirectISEM');
    }

    public function validateDirectRegister(Request $request)
    {
        session()->forget(['status','error']);
        if(session()->get('errorRedirectMessage')!==null){
            session(['error' => session()->get('errorRedirectMessage')]);
            session()->forget(['errorRedirectMessage']);
        }

        $email = request()->email;
        $user = User::where('email', $email)->first();
        if(!is_null($user)){
            session(['errorRedirectMessage' => 'El correo ya está registrado']);
            return redirect()->route('register-form-direct');
        }
        //insert into users table
        $user = new User;
        $user->firstname = request()->firstname;
        $user->lastname = request()->lastname;
        $user->company = request()->company;
        $user->role = request()->role;
        $user->email = request()->email;
        $user->phone = request()->phone;
        $user->register_event = 'Registro Directo Perumin';
        $user->save();
        
        return view('registerSuccessSimple', compact("request"));
    }
    public function validateDirectRegisterISEM(Request $request)
    {
        session()->forget(['status','error']);
        if(session()->get('errorRedirectMessage')!==null){
            session(['error' => session()->get('errorRedirectMessage')]);
            session()->forget(['errorRedirectMessage']);
        }

        $email = request()->email;
        $user = User::where('email', $email)->first();
        if(!is_null($user)){
            session(['errorRedirectMessage' => 'El correo ya está registrado']);
            return redirect()->route('register-form-direct-isem');
        }
        //insert into users table
        $user = new User;
        $user->firstname = request()->firstname;
        $user->lastname = request()->lastname;
        $user->company = request()->company;
        $user->role = request()->role;
        $user->email = request()->email;
        $user->phone = request()->phone;
        $user->register_event = 'Registro Directo ISEM';
        $user->save();
        
        return view('registerSuccessSimpleISEM', compact("request"));
    }

    public function validateCode(Request $request)
    {
        try {
            session()->forget(['status','error']);
            if(session()->get('errorRedirectMessage')!==null){
                session(['error' => session()->get('errorRedirectMessage')]);
                session()->forget(['errorRedirectMessage']);
            }
            //check verification code
            $validateUser = ValidateUser::where('email', $request->email)->first();
            if($validateUser === null){
                session(['error' => "El correo no está registrado"]);
                return view('validateEmailForm', compact("request"));
            }
            $validationCode  = $validateUser->validation_code;
            if($validationCode != $request->validation_code)
            {
                session(['error' => "Código de validación incorrecto"]);
                return view('validateEmailForm', compact("request"));
            }
            //check if email exists
            $emailExists = User::where('email', $request->email)->first();
            if(!$emailExists === null){
                session(['error' => "El correo ya está registrado"]);
                return view('validateEmailForm', compact("request"));
            }
            //update validate_user state
            $validateUser->validated=1;
            $validateUser->save();
            //insert into users table
            $newMetaUser = new User;
            $newMetaUser->firstname = $request->firstname;
            $newMetaUser->lastname = $request->lastname;
            $newMetaUser->company = $request->company;
            $newMetaUser->role = $request->role;
            $newMetaUser->email = $request->email;
            $newMetaUser->gender = $request->gender;
            $newMetaUser->register_event = $request->register_event;
            $newMetaUser->save();
            
            $companyName = Company::find($request->companyId)->name;
            //insert into users_metausers table
            $newUserCompany = new UserCompany;
            $newUserCompany->user_id = $newMetaUser->id;
            $newUserCompany->company_id = $request->companyId;
            $newUserCompany->save();

            return view('registerSuccess', compact("request", "companyName"));
        } catch (Exception $e) {
            session(['error' => "Error de red"]);
            return view('validateEmailForm', compact("request"));
        }
        
    }
    public function preRegister()
    {
        return view('preRegisterForm');
    }
    public function preRegisterStore(Request $request)
    {
        $pendantCompany = new PendantCompanyCreate;
        $pendantCompany->commercial_name = $request->commercialName;
        $pendantCompany->razon_social = $request->razonSocial;
        $pendantCompany->ruc = $request->ruc;
        $pendantCompany->email = $request->email;
        $pendantCompany->firstname = $request->firstname;
        $pendantCompany->lastname = $request->lastname;
        $pendantCompany->role = $request->role;
        $pendantCompany->phone = $request->phone;
        $pendantCompany->id_country = $request->id_country;

        $pendantCompany->save();
        return view('preRegisterSuccess');
    }
}
