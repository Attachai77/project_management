<?php

namespace App\Helpers;
use Request;
use Illuminate\Support\Facades\DB;

class ListData
{
    public static function getOfficerNameList(){

        $role_officer = \App\Role::where('name','officer')->first();
        if($role_officer == null){
            return [];
        }

        $officcer_id = \App\ModelHasRole::where('role_id',$role_officer->id)->pluck('model_id');
        if($officcer_id == null){
            return [];
        }

        $userOfiicers = \App\User::whereIn('id',$officcer_id)
        ->where('deleted',false)
        ->get();
        if($userOfiicers == null){
            return [];
        }

        $res = [];
        foreach ($userOfiicers as $key => $user) {
            $res[$user->id] = $user->first_name.' '.$user->last_name; 
        }

        return $res;
    }

    public static function getProjectTypeList(){
        $list = DB::table('project_types')->pluck('name','id');
        return $list;
    }

    public static function getProjectUniversity(){
        $list = DB::table('project_university_consistencies')->pluck('name','id');
        return $list;
    }

    public static function getProjectFaculty(){
        $list = DB::table('project_faculty_consistencies')->pluck('name','id');
        return $list;
    }

    public static function getProjectStudent(){
        $list = DB::table('project_student_consistencies')->pluck('name','id');
        return $list;
    }
}