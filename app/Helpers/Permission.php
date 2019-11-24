<?php

namespace App\Helpers;
use Request;
use Illuminate\Support\Facades\DB;

class Permission
{
    public static function checkRoleIdHasPermissionId($role_id =null , $permission_id =null){
        if(empty($role_id) || empty($permission_id)){ return false; }

        $has = \App\RoleHasPermission::get()
        ->where('role_id',$role_id)
        ->where('permission_id',$permission_id)
        ->first();
        return  !empty($has);
    }

    public static function checkUserIdHasPermissionId($user_id =null , $permission_id =null){
        if(empty($user_id) || empty($permission_id)){ return false; }

        $has = \App\ModelHasPermission::get()
        ->where('model_id',$user_id)
        ->where('permission_id',$permission_id)
        ->first();
        return  !empty($has);
    }

    public static function getRoleListNameByUserId($user_id =null)
    {
        $role_ids = \App\ModelHasRole::where('model_id',$user_id)
        ->pluck('role_id','role_id');

        $roles = \App\Role::whereIn('id', $role_ids)
        ->orderBy('id')
        ->pluck('display_name','id');

        return $roles;
    } 


    
}