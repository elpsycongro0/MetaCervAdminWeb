<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class LogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function getLoginHistogram(Request $request)
    {
        $authUser = Auth::user();
        if($authUser->id_privilege == 4)
        {
            $logs = DB::table('tb_logs')
            ->leftJoin('tb_users_companies', 'tb_logs.user_id', '=', 'tb_users_companies.user_id')
            ->select(DB::raw('DATE(tb_logs.log_date) as date'), DB::raw('COUNT(DISTINCT tb_logs.user_id) as logins'))
            ->where([
                ['tb_logs.log_action', '=', 'login']
                ])
            ->whereDate('tb_logs.log_date', '>=', request()->startDate)
            ->whereDate('tb_logs.log_date', '<=', request()->endDate)
            ->groupBy('date')
            ->get();
        } 
        else if($authUser->id_privilege == 3)
        {
            $logs = DB::table('tb_logs')
            ->leftJoin('tb_users_companies', 'tb_logs.user_id', '=', 'tb_users_companies.user_id')
            ->select(DB::raw('DATE(tb_logs.log_date) as date'), DB::raw('COUNT(DISTINCT tb_logs.user_id) as logins'))
            ->where([
                ['tb_logs.log_action', '=', 'login'],
                ['tb_users_companies.company_id', '=', $authUser->company_managed]
                ])
            ->whereDate('tb_logs.log_date', '>=', request()->startDate)
            ->whereDate('tb_logs.log_date', '<=', request()->endDate)
            ->groupBy('date')
            ->get();
        }
        else{
            $logs=[];
        }

        
        return response()->json(compact('logs'));
    }
    public function getRegisterHistogram()
    {
        $authUser = Auth::user();
        if($authUser->id_privilege == 4)
        {
            $registers = DB::table('tb_users')
            ->select(DB::raw('DATE(date_register) as date'), DB::raw('count(*) as registers'))
            ->groupBy('date')
            ->get();
        } 
        else if($authUser->id_privilege == 3)
        {
            $registers = DB::table('tb_users')
            ->leftJoin('tb_users_companies', 'tb_users.id', '=', 'tb_users_companies.user_id')
            ->select(DB::raw('DATE(tb_users.date_register) as date'), DB::raw('count(*) as registers'))
            ->where([
                ['tb_users_companies.company_id', '=', $authUser->company_managed]
                ])
            ->groupBy('date')
            ->get();
        }
        else{
            $registers=[];
        }
        return response()->json(compact('registers'));
    }
    public function getValidatedRegisterHistogram()
    {
        $authUser = Auth::user();
        if($authUser->id_privilege == 4)
        {
            $registers = DB::table('tb_users')
            ->join('tb_validate_users', 'tb_users.email', '=', 'tb_validate_users.email')
            ->select(DB::raw('DATE(tb_users.date_register) as date'), DB::raw('count(*) as registers'))
            ->where('tb_validate_users.validated','1')
            ->groupBy('date')
            ->get();
        } 
        else if($authUser->id_privilege == 3)
        {
            $registers = DB::table('tb_users')
            ->join('tb_validate_users', 'tb_users.email', '=', 'tb_validate_users.email')
            ->leftJoin('tb_users_companies', 'tb_users.id', '=', 'tb_users_companies.user_id')
            ->select(DB::raw('DATE(tb_users.date_register) as date'), DB::raw('count(*) as registers'))
            ->where([
                ['tb_validate_users.validated','1'],
                ['tb_users_companies.company_id', '=', $authUser->company_managed]
                ])
            ->groupBy('date')
            ->get();
        }
        else{
            $registers=[];
        }

        return response()->json(compact('registers'));
    }
    public function getUsersInLogs()
    {
        $authUser = Auth::user();
        if($authUser->id_privilege == 4)
        {
            $users = DB::table('tb_logs')
            ->join('tb_users', 'tb_logs.user_id', '=', 'tb_users.id')
            ->select(DB::raw('tb_users.*'))
            ->whereDate('log_date', request()->date)
            ->groupBy('tb_users.id')
            ->get();
        } 
        else if($authUser->id_privilege == 3)
        {
            $users = DB::table('tb_logs')
            ->join('tb_users', 'tb_logs.user_id', '=', 'tb_users.id')
            ->leftJoin('tb_users_companies', 'tb_logs.user_id', '=', 'tb_users_companies.user_id')
            ->select(DB::raw('tb_users.*'))
            ->where([
                ['tb_users_companies.company_id', '=', $authUser->company_managed]
                ])
            ->whereDate('tb_logs.log_date', request()->date)
            ->groupBy('tb_users.id')
            ->get();
        }
        else{
            $users=[];
        }

        
        return datatables()->of($users)
            ->addColumn('action', function($user){
                // return '<a href="'.route('admin.users.edit', $user->id).'" class="btn btn-primary btn-sm">Editar</a>';
                return '<button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modal-default" onclick=\'showUserModal('.json_encode($user).')\'> Detalles </button>
                <a class="btn btn-default btn-sm" onclick="showActivityDetail('.$user->id.', \''.request()->date.'\', \''.$user->email.'\')" >Actividad</a>';
            })
            ->make(true);
    }
    public function getUserLogs()
    {
        $logs = DB::table('tb_logs');
        if(request()->date){
            $logs = $logs
            ->select(DB::raw('*'))
            ->where('user_id', request()->id)
            ->whereDate('log_date', request()->date)
            ->get();
        }
        else{
            $logs = $logs
            ->select(DB::raw('*'))
            ->where('user_id', request()->id)
            ->get();
        }
        
        return datatables()->of($logs)
            ->make(true);
    }
    public function getRegisteredUsers()
    {
        $authUser = Auth::user();
        if($authUser->id_privilege == 4)
        {
            $registers = DB::table('tb_users')
            ->select(DB::raw('*'))
            ->whereDate('date_register', request()->date)
            ->get();
        } 
        else if($authUser->id_privilege == 3)
        {
            $registers = DB::table('tb_users')
            ->leftJoin('tb_users_companies', 'tb_users.id', '=', 'tb_users_companies.user_id')
            ->select(DB::raw('tb_users.*'))
            ->whereDate('tb_users.date_register', request()->date)
            ->where([
                ['tb_users_companies.company_id', '=', $authUser->company_managed]
                ])
            ->get();
        }
        else{
            $registers=[];
        }
        return datatables()->of($registers)
            ->addColumn('action', function($user){
                return '<button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modal-default" onclick=\'showUserModal('.json_encode($user).')\'> Detalles </button>
                <a class="btn btn-default btn-sm" onclick="showActivityDetail('.$user->id.', \''.request()->date.'\', \''.$user->email.'\')" >Actividad</a>';
            })
            ->make(true);
    }
}
