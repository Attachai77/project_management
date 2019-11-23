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
}