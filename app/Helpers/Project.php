<?php

namespace App\Helpers;
use Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Project
{

    public static function countAllProjectAdviser() 
    {
        $projects = \App\Project::where('deleted',false)
            ->where('status','!=', 0)
            ->count();
        return $projects;
    }

    public static function countProjectCheckingAdviser() 
    {
        $projects = \App\Project::where('deleted',false)
            ->where('status', 1)
            ->where('adviser_id', Auth::user()->id )
            ->count();
        return $projects;
    }

    public static function countProjectAdviseStatus($status) 
    {
        $projects = \App\Project::where('deleted',false)
            ->where('status', $status)
            ->count();
        return $projects;
    }

    public static function countAllMyProjectOfficer() 
    {
        $projectMembers = \App\ProjectMember::where('user_id', Auth::user()->id)
            ->pluck('project_id', 'project_id');

        $my_projects = \App\Project::whereIn('id', $projectMembers )
            ->where('deleted', false)
            ->count();
        return $my_projects;
    }

    public static function countMyProjectOfficerByStatus($status) 
    {
        $projectMembers = \App\ProjectMember::where('user_id', Auth::user()->id)
            ->pluck('project_id', 'project_id');

        $my_projects = \App\Project::whereIn('id', $projectMembers )
            ->where('deleted', false)
            ->where('status', $status)
            ->count();
        return $my_projects;
    }

}

