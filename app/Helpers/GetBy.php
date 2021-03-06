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
        // 0=pending, 1=check, 2=plan , 3=inprogress , 4=done , 5=cancle, 6=reject
        if($status_id === null) return "";

        if($status_id === 0) return "<span class='badge badge-secondary'>โครงการร่าง</span>";
        if($status_id === 1) return "<span class='badge badge-info'>โครงการอยู่ระหว่างตรวจสอบ</span>";
        if($status_id === 2) return "<span class='badge badge-primary'>วางแผน</span>";
        if($status_id === 3) return "<span class='badge badge-warning'>โครงการที่กำลังกำเนินการ</span>";
        if($status_id === 4) return "<span class='badge badge-success'>โครงการที่ปิดแล้ว</span>";
        if($status_id === 5) return "<span class='badge badge-danger'>โครงการที่ยกเลิก</span>";
        if($status_id === 6) return "<span class='badge badge-danger'>โครงการที่ถูกตีกลับ</span>";
        if($status_id === 7) return "<span class='badge badge-success'>โครงการสรุป / รอปิดโครงการ</span>";

        return "";
    } 

    public static function getProfileImgByUSerId($user_id = null)
    {
        try {
            $user = \App\User::findOrfail($user_id);
            // if (\App\Helpers\Check::fileExist( $user->profile_img_path )) {
            // if (file_exists( $user->profile_img_path )) {
                return $user->profile_img_path; 
            // }else{
            //     return "/img/user-profile-default.jpg";
            // }
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

    public static function getProjectMemberCount($project_id){
        $member = DB::table('project_members')->where('project_id',$project_id)->count();
        return $member;
    }

    public static function getLastProjectLogReject($project_id)
    {
        try {
            $project_reject = \App\ProjectLog::where('project_id',$project_id)
            ->where('action','reject')
            ->latest()
            ->first();
            return $project_reject;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public static function getArrayIdMasterProject($field, $projectId){
        try {
            $items = DB::table('projects')->where('id',$projectId)->first();
            $lists = explode(',' , $items->$field);
            return $lists;
        } catch (\Throwable $th) {
            return [];
        }
    }

    public static function getNameMasterProject($table, $str){
        try {
            $ids = explode(',',$str);
            $items = DB::table($table)->whereIn('id',$ids)->pluck('name');
            return $items;
        } catch (\Throwable $th) {
            return [];
        }
    }

    public static function getFileIconByExt($ext, $path){
        try {
            if (in_array($ext, ["jpg","jpeg","gif","png"] )) {
                return $path;
            }

            if (in_array($ext, ["pdf"] )) {
                return 'icon/pdf-icon.png';
            }

            if (in_array($ext, ["doc","docx"] )) {
                return 'icon/docx-icon.png';
            }

            if (in_array($ext, ["xls","xlsx"] )) {
                return 'icon/excel-icon.png';
            }

            if (in_array($ext, ["ppt","pptx"] )) {
                return 'icon/point-icon.png';
            }

            return 'icon/file-logo.png';
        } catch (\Throwable $th) {
            return 'icon/file-logo.png';
        }
    }

}