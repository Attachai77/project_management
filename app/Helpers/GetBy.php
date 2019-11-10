<?php

namespace App\Helpers;
use Request;
use Illuminate\Support\Facades\DB;

class GetBy
{
    public static function getFullnameById($user_id){
        if(empty($user_id)){ return "Invalid Id"; }

        $user = \App\UserProfile::get()->where('user_id',$user_id)->first();

        if(!$user){ return "ไม่มีข้อมูลผู้ใช้"; }

        return $user->firstname;
    }
}