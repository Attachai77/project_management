<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        $users = \App\User::take(9)
        ->where('username','!=','master')
        ->where('deleted',false)
        ->select('id','first_name','last_name')->get();
        #dd($users);
        $projects = \App\Project::all();

        $params = [
            'projects'=>$projects,
            'users'=>$users
        ];
        return view('dashboard', $params);
    }

    public function index()
    {
        return view('home');
    }
}
