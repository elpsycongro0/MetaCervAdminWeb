<?php

namespace App\Http\Controllers;
use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $company = Company::find(Auth::user()->company_managed);
        return view('home', ['defaultPasswordChanged'=>$company->default_password_changed]);
    }

    public function reports()
    {
        return view('reports');
    }

    public function reportScene()
    {
        return view('reportsScene');
    }

    public function testDb()
    {
        return view('testDb');
    }
    

}
