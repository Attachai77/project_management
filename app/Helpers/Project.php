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

    public static function getProjectProgressPercent($id){
        $project = \App\Project::where('id',$id)->first();
        if ($project->status == 4) {
            return 100;
        }

        $tasks = \App\Task::where('project_id',$id)->get();
        
        if ($tasks->count() == 0) {
            return 0;
        }

        $tasksAll = $tasks->count();
        $tasksDone =  \App\Task::where('project_id',$id)->where('status',2)->count();

        $per = ($tasksDone / $tasksAll) * 100;
        return $per;
    }

}

