<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class MyController extends Controller
{

    public function myProject(Request $request, $project_status)
    {
        $title = "โครงการของคุณ";
        $conditions = [];
        $conditions[] = ['deleted','=',false];

        // 0=pending, 1=check, 2=plan , 3=inprogress , 4=done , 5=cancle, 6=reject
        if ($project_status === 'pending') {
            $conditions[] = ['status','=',0];
            $conditions[] = ['project_owner_id','=',Auth::user()->id];
            $title = "โครงการร่าง";
        }elseif ($project_status === 'checking') {
            $conditions[] = ['status','=',1];
            $title = "โครงการที่อยู่ระหว่างการตรวจสอบ";
            $conditions[] = ['project_owner_id','=',Auth::user()->id];
        }elseif ($project_status === 'plan') {
            $conditions[] = ['status','=',2];
            $title = "โครงการที่อยู่ระหว่างการวางแผน";
        }elseif ($project_status === 'inprogress') {
            $conditions[] = ['status','=',3];
            $title = "โครงการที่กำลังดำเนินการ";
        }elseif ($project_status === 'success') {
            $conditions[] = ['status','=',4];
            $title = "โครงการที่ปิดแล้ว";
        }elseif ($project_status === 'cancle') {
            $conditions[] = ['status','=',5];
            $title = "โครงการที่ยกเลิก";
        }elseif ($project_status === 'reject') {
            $conditions[] = ['status','=',6];
            $title = "โครงการที่ถูกตีกลับ";
        }

        $myProjectMembers = \App\ProjectMember::where('user_id', Auth::user()->id)->pluck('project_id','project_id')->toArray();
        $myProjectOwner = \App\Project::where('project_owner_id', Auth::user()->id)->pluck('id','id')->toArray();
        $myProjects = array_merge($myProjectMembers,$myProjectOwner);

        $projects = \App\Project::where($conditions)
        ->whereIn('id', $myProjects)
        ->orderBy('id','DESC')
        ->paginate(15);

        $params = [
            'title' => '<i class="fas fa-archive nav-icon"></i> '.$title,
            'title_s' => $title,
            'projects' => $projects,
            'myProjectCount' => $projects->count(),
            'project_status' => $project_status
        ];
        return view('my/my_project', $params );
    }

    public function myProjectDetail($id)
    {
        $project = \App\Project::find($id);
        $tasks = \App\Task::where('project_id',$id)
            ->where('deleted',false)
            ->get();
        // dd($tasks);
        $params = [
            'project'=>$project,
            'tasks'=>$tasks,
            'title'=>"<i class=\"fas fa-archive nav-icon\"></i> ".$project->project_name
        ];
        return view('my/project_detail', $params );
    }

    public function sentCheck($id)
    {
        $sentCheck = \App\Project::where('id', $id)
            ->update([
                'status' => 1,
                'updated_uid' => Auth::user()->id
                ]);
        if ($sentCheck) {
            return redirect()->route('my_projects', 'check')
            ->with('success','ระบบได้ส่งโครงการเพื่อตรวจสอบเรียบร้อย');
        }
        return redirect()->back()
            ->with('danger','ไม่สามารถส่งโครงการเพื่อตรวจสอบได้');
    }


}
