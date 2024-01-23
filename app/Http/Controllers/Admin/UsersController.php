<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use DB;

class UsersController extends Controller
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
        return view('users', [
            'users' => User::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $metauser = MetaUser::create($request->all());
        return $request->all();
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
    public function edit(User $user)
    {
        if (Auth::user()->id_privilege <= $user->id_privilege && Auth::user()->id != $user->id) {
            return response('Unauthorized.', 401);
        }
        return view('editUsers', compact('user'));
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
        $user = User::find($id);
        if (Auth::user()->id_privilege < $request->id_privilege && !(Auth::user()->id_privilege == 4 || Auth::user()->id == $user->id)) {
            return response('Unauthorized.', 401);
        }
        $user->update($request->all());
        return redirect()->route('admin.users.index', $user->id);
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

    public function block()
    {
        $user = User::find(request()->id);
        $user->update(['active' => !($user->active)]);
        return "";
    }
    public function getall()
    {
        $authUser = Auth::user();
        $users = DB::table('tb_users')
        ->leftJoin('tb_users_companies', 'tb_users.id', '=', 'tb_users_companies.user_id')
        ->join('tb_privileges', 'tb_users.id_privilege', '=', 'tb_privileges.id')
        ->join('tb_countries', 'tb_users.id_country', '=', 'tb_countries.id')
        ->select(DB::raw('tb_users.id as id'),
            DB::raw('tb_users.email as email'), DB::raw('tb_users.firstname as firstname'), 
            DB::raw('tb_users.lastname as lastname'), DB::raw('tb_users.company as company'), 
            DB::raw('tb_users.role as role'), DB::raw('tb_users.id_country as id_country'),
            DB::raw('tb_countries.name as country'),DB::raw('tb_users.phone as phone'),
            DB::raw('tb_privileges.name as privileges'),DB::raw('tb_users.id_privilege as id_privilege'),
            DB::raw('CASE
                WHEN tb_users.gender = 1 THEN \'Hombre\'
                WHEN tb_users.gender = 0 THEN \'Mujer\'
                ELSE \'Unknown\'
                END AS gender
            ')
        );
        if($authUser->id_privilege == 4)
        {
            $users = $users->get();
        } 
        else if($authUser->id_privilege == 3)
        {
            $users = $users
            ->where('tb_users_companies.company_id', $authUser->company_managed)
            ->get();
        }
        else{
            $users=[];
        }
        return datatables()->of($users)
            ->addColumn('action', function($user){
                // return '<a href="'.route('admin.users.edit', $user->id).'" class="btn btn-default btn-sm">Editar</a>';
                return '<button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modal-default" onclick=\'showUserModal('.json_encode($user).')\'> Detalles </button>';
            })
            ->make(true);
    }
}
