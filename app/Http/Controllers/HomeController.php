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
        $projects = \App\Project::all();

        $params = [
            'projects'=>$projects
        ];
        return view('dashboard', $params);
    }

    public function index()
    {
        return view('home');
    }
}
