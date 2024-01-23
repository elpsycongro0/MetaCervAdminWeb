<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use App\Models\StructureGroup;
use App\Models\StructureRoom;
use App\Models\StructureCategory;
use App\Models\PendantCompanyCreate;
use App\Models\Scene;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use DB;

class CompaniesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('companies');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companiesCreate', [
            'categories' => StructureCategory::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        function formatName($name)
        {
            //quitar tildes
            $name = strtr(utf8_decode($name), utf8_decode('àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ'), 'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');
            //todo minusculas
            $name = mb_strtolower($name);
            //quitar todo menos vocales numeros y espacios
            $name = preg_replace("/[^a-zA-Z0-9\s]/", "", $name);
            //reemplazar espacios con subguiones
            $name = preg_replace("/[\s]/", "_", $name);
            return $name;
        }

        //validar ruc
        if (Company::where('ruc', $request->ruc)->exists()) {
            return redirect()->route('admin.companies.create')->with('errorMessage', 'El ruc de empresa ya fue registrado');
        }
        if (Company::where('commercial_name', $request->commercialName)->exists()) {
            return redirect()->route('admin.companies.create')->with('errorMessage', 'El nombre comercial de empresa ya fue registrado');
        }
        if (User::where('email', $request->email)->exists()) {
            return redirect()->route('admin.companies.create')->with('errorMessage', 'El usuario ya fue registrado');
        }

        //crear y guardar la empresa
        $newCompany = new Company;
        $newCompany->commercial_name = $request->commercialName;
        $newCompany->razon_social = $request->razonSocial;
        $newCompany->ruc = $request->ruc;
        $newCompany->save();
        //crear y guardar el usuario administrador
        $newAdminUser = new User;
        $newAdminUser->email = $request->email;
        $newAdminUser->firstname = $request->firstname;
        $newAdminUser->lastname = $request->lastname;
        $newAdminUser->company = $request->company;
        $newAdminUser->role = $request->role;
        $newAdminUser->phone = $request->phone;
        $newAdminUser->id_privilege = 3;//always admin
        $newAdminUser->gender = $request->gender;
        $newAdminUser->id_country = $request->id_country;
        $newAdminUser->company_managed = $newCompany->id;
        // $newAdminUser->password = Hash::make("password");
        // $generatedPassword = generateRandomString(6);
        // $newAdminUser->password = Hash::make($generatedPassword);
        $newAdminUser->save();
        //crear entrada en tb_structure_groups y tb_structure_rooms
        $newStructureGroup = new StructureGroup;
        $newStructureGroup->name = $request->commercialName;
        $newStructureGroup->id_category = $request->id_category;
        $newStructureGroup->with_password = 1;
        $newStructureGroup->available = 0;
        $newStructureGroup->v_target = 0;
        $newStructureGroup->save();

        $savedCompany = Company::find($newCompany->id);
        $savedCompany->structure_group_id = $newStructureGroup->id;
        $savedCompany->save();
        
        $newStructureRoom = new StructureRoom;
        $newStructureRoom->scene = $newStructureGroup->id."00_".formatName($request->commercialName);
        $newStructureRoom->id = 0;
        $newStructureRoom->name = $request->commercialName;
        $newStructureRoom->previous_scene = "0003_lobby";
        $newStructureRoom->with_password = 1;
        $newStructureRoom->password = "none";
        $newStructureRoom->id_group = $newStructureGroup->id;
        $newStructureRoom->save();
        
        $savedStructureGroup = StructureGroup::find($newStructureGroup->id);
        $savedStructureGroup->principal_scene = $newStructureGroup->id."00_".formatName($request->commercialName);
        $savedStructureGroup->save();
        
        //if was prefilled, unmark as created
        DB::table('tb_pendant_company_create')
        ->where('ruc', $request->ruc)
        ->update(array('created' => true));

        return redirect()->route('admin.companies.create')->with('message', 'Empresa creada correctamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        return view('editCompanies', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $company = Company::find($id);
        $company->update($request->all());
        return redirect()->route('admin.companies.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function deployments()
    {
        $pendantDeployments = Company::where('deployed', false)->get();
        $pendantCreations = PendantCompanyCreate::where('created', false)->get();
        return view('pendantDeployments', compact('pendantDeployments', 'pendantCreations'));
    }

    public function deploymentCreate(Request $request)
    {
        $preFillParams = $request->all();
        return view('companiesCreatePrefill', [
            'categories' => StructureCategory::all(),
            'preFillParams' => $preFillParams
        ]);
    }

    public function setAvailable(Request $request)
    {
        
        function generateRandomString($length = 6) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[random_int(0, $charactersLength - 1)];
            }
            return $randomString;
        }

        $company = Company::find($request->id);
        $structureGroup = StructureGroup::find($company->structure_group_id);

        //generate password for user 
        $generatedPassword = "a34ks4";//generateRandomString(6);//a34ks4
        $commercialName = $company->commercial_name;
        $category = StructureCategory::find($structureGroup->id_category)->name;
        $AdminUserId = User::where('company_managed', $company->id)->first()->id;
        $AdminUser = User::find($AdminUserId);
        // $AdminUser->password = Hash::make("password");
        $AdminUser->password = Hash::make($generatedPassword);
        $AdminUser->save();

        //create entry on scene table
        // $newScene = new Scene;
        // $newScene->name = $structureGroup->principal_scene;
        // $newScene->save();
        //update group
        // $structureGroup->available = true;
        // $structureGroup->v_target = 3;
        // $structureGroup->save();
        //update deployed on company to true
        $company->deployed = true;
        $company->save();
        //update room
        // $savedCompany = StructureRoom::find($structureGroup->principal_scene);
        // $savedCompany->v_target = 3;
        // $savedCompany->available = true;
        // $savedCompany->save();
        //send credentials mail
        $url = 'https://metacerv.com/10011299104-nc/sendCredencialsMail.php';
        
        $data = array('email'=>$AdminUser->email,
            'password'=>$generatedPassword);

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
        if($json_data["success"]!=1){
            //error sending email
        }
        //send instructions mail
        $url = 'https://metacerv.com/10011299104-nc/sendInstructionsMail.php';
        
        $data = array('email'=>$AdminUser->email,
            'category'=>$category,
            'commercialName'=>$commercialName);

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
        if($json_data["success"]!=1){
            //error sending email
        }
        //return to pendant deployments
        return redirect()->route('admin.companies.deployments');
    }

    public function getall()
    {
        $companies = DB::table('tb_companies')
        ->join('tb_users', 'tb_companies.id', '=', 'tb_users.company_managed')
        ->select(DB::raw('tb_companies.id as id'), DB::raw('tb_companies.commercial_name as commercial_name'), 
            DB::raw('tb_companies.ruc as ruc'), DB::raw('tb_users.email as email'), 
            DB::raw('tb_users.id as user_id'))
        ->get();

        return datatables()->of($companies)
            ->addColumn('action', function($company){
                // return '<a href="'.route('admin.users.edit', $user->id).'" class="btn btn-default btn-sm">Editar</a>';
                $user = User::find($company->user_id);
                return '<button 
                    type="button" 
                    class="btn btn-default btn-sm" 
                    data-toggle="modal" 
                    data-target="#modal-default" 
                    onclick=\'showUserModal('.json_encode($company).','.json_encode($user).')\'> 
                    Detalles 
                    </button>';
            })
            ->make(true);
    }
    
    
    
}
