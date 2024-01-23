<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use App\Models\StructureGroup;
use App\Models\StructureRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;

class ConfigController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function profileConfigurations()
    {
        $user = Auth::user();
        return view('configurationsProfile', compact('user'));
    }

    public function changePassword()
    {
        return view('updatePassword');
    }

    public function updateCompanyUser()
    {
        $authUser = Auth::user();
        return view('updateCompanyUser', ['companyName' => $authUser->name, 'companyEmail' => $authUser->email]);
    }

    public function update(Request $request)
    {
        $authUser = Auth::user();
        $companyUser = User::find($authUser->id);
        $companyUser->update($request->all());
        
        return redirect()->route('admin.configurations.profile');
    }
    public function updatePassword(Request $request)
    {
        session()->forget(['status','error']);
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
            'new_password_confirmation' => 'required',
        ]);
        $authUser = Auth::user();
        $companyUser = User::find($authUser->id);
        $company = Company::find(Auth::user()->company_managed);
        $hashedPassword = Hash::make($request->new_password);

        $hasher = app('hash');
        if ($hasher->check($request->old_password, $authUser->password)) {
            if ($request->new_password == $request->new_password_confirmation) {
                $companyUser->update(['password' => $hashedPassword]);
                $company->update(['default_password_changed' => true]);
                session(['status' => 'Contraseña actualizada con éxito']);
            }
            else{
                session(['error' => 'Las contraseñas nuevas no coinciden']);
            }
        }
        else{
            session(['error' => 'Contraseña antigua incorrecta']);
        }
        return redirect()->route('admin.configurations.change-password');
    }
    // COMPANY CONFIGURATIONS
    public function companyConfigurations()
    {
        $user = Auth::user();
        $company = Company::find(Auth::user()->company_managed);
        return view('configurationsCompany', compact('user', 'company'));
    }
    public function companyConfigurationsEdit()
    {
        $user = Auth::user();
        $company = Company::find(Auth::user()->company_managed);
        return view('editCompanyProfile', compact('company'));
    }
    public function companyConfigurationsUpdate(Request $request)
    {
        $company = Company::find(Auth::user()->company_managed);
        $company->update($request->all());
        return redirect()->route('admin.configurations.company');
    }

    public function scenesConfigurations()
    {
        $user = Auth::user();
        $company = Company::find(Auth::user()->company_managed);
        $structureGroup = StructureGroup::find($company->structure_group_id);
        $structureRoom = StructureRoom::where('scene', $structureGroup->principal_scene)->first();

        $withPassword = $structureRoom->with_password;
        $password = $structureRoom->password;
        return view('configurationsScenes', ['withPassword'=>$withPassword, 'password'=>$password]);
    }

    public function scenesConfigurationsEdit()
    {
        $company = Company::find(Auth::user()->company_managed);
        $structureGroup = StructureGroup::find($company->structure_group_id);
        $structureRoom = StructureRoom::where('scene', $structureGroup->principal_scene)->first();

        $withPassword = $structureRoom->with_password;
        $password = $structureRoom->password;
        return view('editConfigurationsScenes', ['withPassword'=>$withPassword, 'password'=>$password]);
    }

    public function scenesConfigurationsUpdate(Request $request)
    {
        $company = Company::find(Auth::user()->company_managed);
        $structureGroup = StructureGroup::find($company->structure_group_id);
        $structureRoom = StructureRoom::find($structureGroup->principal_scene);
        // return ($structureRoom->toArray());
        $boolWithPassword = true;
        if($request->with_password == "0") $boolWithPassword = false;

        $structureGroup->with_password = $boolWithPassword;
        $structureGroup->save();

        $structureRoom->with_password = $boolWithPassword;
        $structureRoom->password = $request->password;
        $structureRoom->save();
        // $structureRoom->update([
        //     'with_password' =>  $boolWithPassword,
        //     'password' => $request->password
        // ]);

        return redirect()->route('admin.configurations.scenes');
    }
    
}
