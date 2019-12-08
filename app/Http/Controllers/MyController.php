<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyController extends Controller
{
    public function myProject()
    {
        $conditions = [];
        $conditions[] = ['deleted','=',false];

        $myProjectMembers = \App\ProjectMember::where('user_id', Auth::user()->id)->pluck('project_id','project_id')->toArray();
        $myProjectOwner = \App\Project::where('project_owner_id', Auth::user()->id)->pluck('id','id')->toArray();
        $myProjects = array_merge($myProjectMembers,$myProjectOwner);

        $projects = \App\Project::where($conditions)
        ->whereIn('id', $myProjects)
        ->orderBy('id','DESC')
        ->paginate(15);

        $params = [
            'title' => '<i class="fas fa-archive nav-icon"></i> โครงการของคุณ',
            'projects' => $projects,
            'myProjectCount' => $projects->count()
        ];
        return view('my/my_project', $params );
    }




}
