<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProjectsController extends Controller
{

    public function index()
    {
        $conditions = [];
        $conditions[] = ['deleted','=',false];

        $projects = \App\Project::where($conditions)
        ->orderBy('id','DESC')
        ->paginate(15);
        $params = [
            'title' => '<i class="fas fa-list-alt nav-icon"></i> โครงการทั้งหมด',
            'projects' => $projects
        ];
        return view('project/index', $params );
    }

    public function create()
    {
        $proviser_role = \App\Role::where('name','manager')->get()->first();
        $proviser_id = [];
        if(@$proviser_role->users){
            foreach($proviser_role->users as $item){
                $proviser_id[] = $item->model_id;
            }
        }

        $proviser_list = \App\User::whereIn('id',$proviser_id)->get();
        $params = [
            'title' => '<i class="fa fa-plus"></i> สร้างโครงการ',
            'proviser_list'=>$proviser_list
        ];
        return view('project/create', $params );
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'project_name' => 'required|string|max:255',
            'budget' => 'numeric'
        ],[
            'project_name.max' => 'กรุณากรอกชื่อความยาวไม่เกิน 255 ตัวอักษร',
            'budget.numeric' => 'กรุณากรอกข้อมูลงบประมาณเป็นตัวเลข'
        ]);

        $isError = false;
        $errorMsg = "";
        DB::beginTransaction();

        $data = [
            'project_name'=>$request->input('project_name'),
            'adviser'=>$request->input('adviser'),
            'budget'=>$request->input('budget'),
            'location'=>$request->input('location'),
            'project_owner_id'=>Auth::user()->id,
            'created_uid'=>Auth::user()->id,
            'project_description'=>$request->project_description,
        ];

        if(!empty($request->input('start_date'))){
            $start_date = explode('/',$request->input('start_date'));
            $data['start_date'] = $start_date[2].'-'.$start_date[1].'-'.$start_date[0];
        }
        if(!empty($request->input('end_date'))){
            $end_date = explode('/',$request->input('end_date'));
            $data['end_date'] = $end_date[2].'-'.$end_date[1].'-'.$end_date[0];
        }


        $project = \App\Project::create($data);
        if (!$project->exists) {
            $isError = true;
            $errorMsg = "ไม่สามารถบันทึกข้อมูลโครงการได้ กรุณาตรวจสอบข้อมูลให้ถูกต้อง";
        }else{
            $project_id = $project->id;
        }

        if (!$isError && $request->input('purposes')[0]) {
            foreach ($request->input('purposes') as $key => $purpose) {
                if ($purpose !== null) {
                    $purpose_data = [
                        'project_id'=>$project_id,
                        'purpose_name'=>$purpose,
                        'created_uid'=>Auth::user()->id
                    ];

                    $purpose_saved = \App\ProjectPurpose::create($purpose_data);
                    if (!$purpose_saved->exists) {
                        $isError = true;
                        $errorMsg = "ไม่สามารถบันทึกข้อมูลจุดประสงค์โครงการได้ กรุณาตรวจสอบข้อมูลให้ถูกต้อง";
                    }
                }
            }
        }

        if (!$isError && $request->input('expecteds')[0]) {
            foreach ($request->input('expecteds') as $key => $expected) {
                if ($expected !== null) {
                    $expected_data = [
                        'project_id'=>$project_id,
                        'expected_name'=>$expected,
                        'created_uid'=>Auth::user()->id
                    ];

                    $expected_saved = \App\ProjectExpected::create($expected_data);
                    if (!$expected_saved->exists) {
                        $isError = true;
                        $errorMsg = "ไม่สามารถบันทึกข้อมูลผลที่คาดว่าจะได้รับได้ กรุณาตรวจสอบข้อมูลให้ถูกต้อง";
                    }
                }
            }
        }

        if (!$isError && $request->input('supports')[0]) {
            foreach ($request->input('supports') as $key => $support) {
                if ($support !== null) {
                    $support_data = [
                        'project_id'=>$project_id,
                        'name'=>$support,
                        'created_uid'=>Auth::user()->id
                    ];
    
                    $support_saved = \App\ProjectSupport::create($support_data);
                    if (!$support_saved->exists) {
                        $isError = true;
                        $errorMsg = "ไม่สามารถบันทึกข้อมูลผู้สนับสนุนได้ กรุณาตรวจสอบข้อมูลให้ถูกต้อง";
                    }
                }
            }
        }

        if ($isError) {
            DB::rollBack();
            return redirect()->back()->with('danger', $errorMsg);
        }else{
            DB::commit();
            return redirect()->route('projects.index')->with('success', 'บันทึกข้อมูลโครงการสำเร็จ');
            // return redirect()->route('projects.edit', [$project_id])->with('success', 'บันทึกข้อมูลโครงการสำเร็จ');
        }

        
    }

    public function show($id)
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
        return view('project/show', $params );
    }

    public function edit($project_id)
    {
        $project = \App\Project::find($project_id);
        $project_expecteds = \App\ProjectExpected::get()->where('project_id',$project_id);
        $project_purposes = \App\ProjectPurpose::get()->where('project_id',$project_id);
        $project_supports = \App\ProjectSupport::get()->where('project_id',$project_id);

        $params = [
            'title' => '<i class="fas fa-edit"></i> แก้ไขข้อมูลโครงการ',
            'project'=>$project,
            'project_expecteds'=>$project_expecteds,
            'project_purposes'=>$project_purposes,
            'project_supports'=>$project_supports
        ];

        return view('project/edit', $params);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'project_name' => 'required|string|max:255',
            'budget' => 'numeric'
        ],[
            'project_name.max' => 'กรุณากรอกชื่อความยาวไม่เกิน 255 ตัวอักษร',
            'budget.numaric' => 'กรุณากรอกข้อมูลงบประมาณเป็นตัวเลข'
        ]);

        $isError = false;
        $errorMsg = "";
        DB::beginTransaction();

        $data = [
            'project_name'=>$request->input('project_name'),
            'adviser'=>$request->input('adviser'),
            'budget'=>$request->input('budget'),
            'location'=>$request->input('location'),
            'project_owner_id'=>Auth::user()->id,
            'updated_uid'=>Auth::user()->id,
            'project_description'=>$request->project_description,
        ];

        if(!empty($request->input('start_date'))){
            $start_date = explode('/',$request->input('start_date'));
            $data['start_date'] = $start_date[2].'-'.$start_date[1].'-'.$start_date[0];
        }
        if(!empty($request->input('end_date'))){
            $end_date = explode('/',$request->input('end_date'));
            $data['end_date'] = $end_date[2].'-'.$end_date[1].'-'.$end_date[0];
        }


        $project = \App\Project::where('id',$id)->update($data);
        if (!$project) {
            $isError = true;
            $errorMsg = "ไม่สามารถบันทึกการแก้ไขข้อมูลโครงการได้ กรุณาตรวจสอบข้อมูลให้ถูกต้อง";
        }else{
            $project_id = $id;
        }

        if(!$isError){
            \App\ProjectPurpose::where('project_id',$id)->delete();
            \App\ProjectExpected::where('project_id',$id)->delete();
            \App\ProjectSupport::where('project_id',$id)->delete();
        }

        if (!$isError && sizeof($request->input('purposes')) > 0) {
            foreach ($request->input('purposes') as $key => $purpose) {
                if ($purpose !== null) {
                    $purpose_data = [
                        'project_id'=>$project_id,
                        'purpose_name'=>$purpose,
                        'created_uid'=>Auth::user()->id
                    ];

                    $purpose_saved = \App\ProjectPurpose::create($purpose_data);
                    if (!$purpose_saved->exists) {
                        $isError = true;
                        $errorMsg = "ไม่สามารถบันทึกข้อมูลจุดประสงค์โครงการได้ กรุณาตรวจสอบข้อมูลให้ถูกต้อง";
                    }
                }
            }
        }

        if (!$isError && sizeof($request->input('expecteds')) >0 ) {
            foreach ($request->input('expecteds') as $key => $expected) {
                if ($expected !== null) {
                    $expected_data = [
                        'project_id'=>$project_id,
                        'expected_name'=>$expected,
                        'created_uid'=>Auth::user()->id
                    ];

                    $expected_saved = \App\ProjectExpected::create($expected_data);
                    if (!$expected_saved->exists) {
                        $isError = true;
                        $errorMsg = "ไม่สามารถบันทึกข้อมูลผลที่คาดว่าจะได้รับได้ กรุณาตรวจสอบข้อมูลให้ถูกต้อง";
                    }
                }
            }
        }

        if (!$isError && sizeof($request->input('supports'))>0 ) {
            foreach ($request->input('supports') as $key => $support) {
                if ($support !== null) {
                    $support_data = [
                        'project_id'=>$project_id,
                        'name'=>$support,
                        'created_uid'=>Auth::user()->id
                    ];
    
                    $support_saved = \App\ProjectSupport::create($support_data);
                    if (!$support_saved->exists) {
                        $isError = true;
                        $errorMsg = "ไม่สามารถบันทึกข้อมูลผู้สนับสนุนได้ กรุณาตรวจสอบข้อมูลให้ถูกต้อง";
                    }
                }
            }
        }

        if ($isError) {
            DB::rollBack();
            return redirect()->back()->with('danger', $errorMsg);
        }else{
            DB::commit();
            return redirect()->route('projects.index')->with('success', 'บันทึกการแก้ไขข้อมูลโครงการสำเร็จ');
        }
        return view('project/index' );
    }

    public function delete($id)
    {
        $deleted = \App\Project::where('id', $id)
            ->update([
                'deleted' => true,
                'updated_uid' => Auth::user()->id
                ]);
        if ($deleted) {
            return redirect()->back()
            ->with('success','โครงการถูกลบเรียบร้อย');
        }
        return redirect()->back()
            ->with('danger','ไม่สามารถลบข้อมูลโครงการได้');
    }

    public function projectMember(Request $request, $id)
    {
        if ($request->isMethod('POST')) {
            $data = [
                'project_id'=>$id,
                'user_id'=>$request->user_id,
                'position_id'=>$request->position_id,
                'created_uid'=>Auth::user()->id
            ];

            $saved = \App\ProjectMember::create($data);
            if (!$saved->exists) {
                return redirect()->back()->with('danger', "ไม่สามารถเพิ่มสมาชิกโครงการได้ กรุณาตรวจสอบข้อมูลให้ถูกต้อง");
            }else{
                return redirect()->back()->with('success', "เพิ่มสมาชิกโครงการเรียบร้อย");
            }

        }

        $project = \App\Project::find($id);
        $positions = \App\ProjectPosition::where('deleted',false)->pluck('position_name','id');
        $project_members = \App\ProjectMember::where('deleted',false)
        ->where('project_id', $id)
        ->get();
        // dd($project_members);

        $params = [
            'project'=>$project,
            'title'=>'<i class="fas fa-users"></i> กำหนดสมาชิกและตำแหน่งโครงการ',
            'positions'=>$positions,
            'project_members'=>$project_members
        ];
        return view('project/project_member', $params);
    }

    public function deleteProjectMember($id)
    {
        $deleted = \App\ProjectMember::where('id',$id)
        ->update(['deleted'=>true]);

        if (!$deleted) {
            return redirect()->back()->with('danger', "ไม่สามารถลบสมาชิกโครงการได้ กรุณาตรวจสอบความถูกต้อง");
        }else{
            return redirect()->back()->with('success', "ลบสมาชิกโครงการเรียบร้อย");
        }
    }

    public function projectChecking()
    {
        $project_checks = \App\Project::where('deleted',false)
            ->where('status',1)
            // ->where('adviser_id',Auth::user()->id)
            ->orderBy('updated_at','DESC')
            ->paginate(15);

        $params = [
            'title' => '<i class="fas fa-pen-square"></i> โครงการที่รอตรวจสอบ',
            'project_checks' => $project_checks,
            'myProjectCount' => $project_checks->count(),
            'title_s' => 'โครงการที่รอตรวจสอบ',
            'project_status' => 'check'
        ];
        return view('proviser/project_checks', $params );
    }

    public function approveProject($id)
    {
        $approveProject = \App\Project::where('id', $id)
            ->update([
                'status' => 2,
                'updated_uid' => Auth::user()->id
                ]);
        if ($approveProject) {
            return redirect()->route('projectChecking')
            ->with('success','ตรวจสอบโครงการเรียบร้อย');
        }
        return redirect()->back()
            ->with('danger','ไม่สามารถตรวจสอบโครงการได้');
    }

    public function rejectProject($id, $status_id)
    {
        $rejectProject = \App\Project::where('id', $id)
            ->update([
                'status' => $status_id,
                'updated_uid' => Auth::user()->id
                ]);
        if ($rejectProject) {
            return redirect()->route('projectChecking')
            ->with('success','ตรวจสอบโครงการเรียบร้อย');
        }
        return redirect()->back()
            ->with('danger','ไม่สามารถตรวจสอบโครงการได้');
    }

}
