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
        $projects = \App\Project::get()->where('deleted',false);

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

    public function members()
    {
        $members = \App\User::where('username','!=','master')
        ->where('deleted',false)
        ->get();
        $params = [
            'title' => '<i class="fas fa-user-friends"></i> สมาชิกทั้งหมด',
            'members'=>$members,
            'membersCount'=>$members->count(),
        ];
        return view('members', $params);
    }
}
