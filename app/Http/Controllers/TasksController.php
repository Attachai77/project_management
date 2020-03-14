<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class TasksController extends Controller
{
    public function create($project_id)
    {
        $project = \App\Project::findOrFail($project_id);
        $params = [
            'project'=>$project,
            'title'=>'<i class="fa fa-plus"></i> เพิ่มกิจกรรม'
        ];
        return view('task.create', $params);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'task_name' => 'required|string|max:512',
            'description' => 'max:1024',
        ],[
            'task_name.required' => 'กรุณากรอกชื่อกิจกรรม',
            'task_name.max' => 'กรุณากรอกชื่อกิจกรรมความยาวไม่เกิน 512 ตัวอักษร',
            'description.max' => 'กรุณากรอกรายละเอียดกิจกรรมความยาวไม่เกิน 1024 ตัวอักษร',
        ]);

        $data = [
            'task_name'=> $request->task_name,
            'description'=> $request->description,
            'project_id'=> $request->project_id,
            'created_uid'=> Auth::user()->id,
            'task_owner_id'=> Auth::user()->id,
            'status'=>1,
        ];

        if(!empty($request->input('start_date'))){
            $start_date = explode('/',$request->input('start_date'));
            $data['start_date'] = $start_date[2].'-'.$start_date[1].'-'.$start_date[0];
        }
        if(!empty($request->input('end_date'))){
            $end_date = explode('/',$request->input('end_date'));
            $data['end_date'] = $end_date[2].'-'.$end_date[1].'-'.$end_date[0];
        }

        // dd($data);
        $create = \App\Task::create($data);
        #dd($create);
        if ($create->exists) {
            return redirect()->route('tasks.show',[$create->id])
            ->with('success','เพิ่มข้อมูลกิจกรรมเรียบร้อย');
        }
        return redirect()->back()
            ->with('danger','มีบางอย่างผิดพลาด ไม่สามารถเพิ่มข้อมูลได้');
    }

    public function show($id)
    {
        $task = \App\Task::findOrFail($id);
        $project_members = \App\ProjectMember::where('project_id', $task->project_id)->pluck('user_id');
        $task_members = \App\TaskMember::where('task_id', $id)->pluck('user_id')->toArray();
        #dd($task_members);
        $params = [
            'task'=>$task,
            'project_members'=>$project_members,
            'task_members'=>$task_members,
            'title'=>'<i class="fa fa-info"></i> ข้อมูลกิจกรรม'
        ];
        return view('task.show', $params);
    }

    public function edit($id)
    {
        $task = \App\Task::findOrFail($id);
        $project = \App\Project::findOrFail($task->project_id);
        $project_members = \App\ProjectMember::where('project_id', $task->project_id)->pluck('user_id');
        $params = [
            'project'=>$project,
            'task'=>$task,
            'project_members' => $project_members,
            'title'=>'<i class="fas fa-edit"></i> แก้ไขกิจกรรม'
        ];
        return view('task.edit', $params);
    }

    public function update(Request $request, $id)
    {
        $data = [
            'task_name'=>$request->task_name,
            'task_owner_id'=>$request->task_owner_id,
            'start_date'=>$request->start_date,
            'end_date'=>$request->end_date,
            'description'=>$request->description,
            'updated_uid'=>Auth::user()->id
        ];

        if(!empty($request->input('start_date'))){
            $start_date = explode('/',$request->input('start_date'));
            $data['start_date'] = $start_date[2].'-'.$start_date[1].'-'.$start_date[0];
        }
        if(!empty($request->input('end_date'))){
            $end_date = explode('/',$request->input('end_date'));
            $data['end_date'] = $end_date[2].'-'.$end_date[1].'-'.$end_date[0];
        }

        $updated = \App\Task::where('id', $id)
            ->update($data);
        if ($updated) {
            $task = \App\Task::findOrFail($id);

            return redirect()->route('myProjectDetail', $task->project_id)
            ->with('success','แก้ไขข้อมูลกิจกรรมเรียบร้อย');
        }
        return redirect()->back()
            ->with('danger','ไม่สามารถแก้ไขข้อมูลกิจกรรมได้');
    }

    public function delete($id)
    {
        $deleted = \App\Task::where('id', $id)
            ->update([
                'deleted' => true,
                'updated_uid' => Auth::user()->id
                ]);
        if ($deleted) {
            return redirect()->back()
            ->with('success','กิจกรรมถูกลบเรียบร้อย');
        }
        return redirect()->back()
            ->with('danger','ไม่สามารถลบกิจกรรมได้');
    }

    public function addMember(Request $request, $id){
        if ($request->member_name === null) {
            return redirect()->back()
            ->with('danger','มีบางอย่างผิดพลาด ไม่สามารถเพิ่มผู้รับผิดชอบกิจกรรมได้');
        }

        $data = [
            'task_id'=>$request->task_id,
            'mission'=>$request->mission,
            'user_id'=>0,
            'created_uid'=>Auth::user()->id,
            'member_name'=>$request->member_name
        ];

        $create = \App\TaskMember::create($data);
        #dd($create);
        if ($create->exists) {
            return redirect()->route('tasks.show',$id)
            ->with('success','เพิ่มผู้รับผิดชอบกิจกรรมเรียบร้อย');
        }
        return redirect()->back()
            ->with('danger','มีบางอย่างผิดพลาด ไม่สามารถเพิ่มผู้รับผิดชอบกิจกรรมได้');
    }

    public function removeMember($task_member_id){
        $deleted = \App\TaskMember::where('id', $task_member_id)->delete();
        if ($deleted) {
            return redirect()->back()
            ->with('success','ผู้รับผิดชอบกิจกรรมถูกลบเรียบร้อย');
        }
        return redirect()->back()
            ->with('danger','ไม่สามารถลบผู้รับผิดชอบกิจกรรมได้');
    }

    public function doneTask($id)
    {
        $done = \App\Task::where('id', $id)
            ->update([
                'status' => 2,
                'updated_uid' => Auth::user()->id
                ]);
        if ($done) {
            $task = \App\Task::findOrFail($id);
            return redirect()->route('myProjectDetail', $task->project_id)
            ->with('success','ปรับสถานะกิจกรรมเป็นเสร็จแล้วเรียบร้อย');
        }
        return redirect()->back()
            ->with('danger','ไม่สามารถปรับสถานะกิจกรรมได้');
    }


}
