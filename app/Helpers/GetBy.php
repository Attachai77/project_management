<?php

namespace App\Helpers;
use Request;
use Illuminate\Support\Facades\DB;

class GetBy
{

    public static function getProjectStatusByStatusId($status_id = null)
    {
        if($status_id === null) return "";

        if($status_id === 0) return "เปิดโครงการ";
        if($status_id === 1) return "โครงการที่จะทำ";
        if($status_id === 2) return "กำลังดำเนินการ";
        if($status_id === 3) return "โครงการที่ปิดแล้ว";
        if($status_id === 4) return "โครงการที่ยกเลิก";

        return "";
    } 

    public static function getProjectStatusBladeByStatusId($status_id = null)
    {
        if($status_id === null) return "";

        if($status_id === 0) return "<span class='badge badge-secondary'>เปิดโครงการ</span>";
        if($status_id === 1) return "<span class='badge badge-info'>โครงการที่จะทำ</span>";
        if($status_id === 2) return "<span class='badge badge-warning'>กำลังดำเนินการ</span>";
        if($status_id === 3) return "<span class='badge badge-success'>โครงการที่ปิดแล้ว</span>";
        if($status_id === 4) return "<span class='badge badge-danger'>โครงการที่ยกเลิก</span>";

        return "";
    } 

    public static function getProfileImgByUSerId($user_id = null)
    {
        try {
            $user = \App\User::findOrfail($user_id);
            if (\App\Helpers\Check::fileExist( $user->profile_img_path )) {
                return $user->profile_img_path; 
            }else{
                return "/img/user-profile-default.jpg";
            }
        } catch (\Throwable $th) {
            return "/img/user-profile-default.jpg";
        }
    } 

    public static function getProjectPositionNameById($position_id = null)
    {
        try {
            $project_position = \App\ProjectPosition::findOrFail($position_id);
            return @$project_position->position_name;
        } catch (\Throwable $th) {
            return "";
        }
    }
}