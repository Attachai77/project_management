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
}