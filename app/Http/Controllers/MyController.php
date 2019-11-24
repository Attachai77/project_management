<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyController extends Controller
{
    public function myProject()
    {
        $conditions = [];
        $conditions[] = ['deleted','=',false];

        $projects = \App\Project::where($conditions)
        ->orderBy('id','DESC')
        ->paginate(15);
        $params = [
            'title' => '<i class="fas fa-archive nav-icon"></i> โครงการของคุณ',
            'projects' => $projects
        ];
        return view('my/my_project', $params );
    }




}
