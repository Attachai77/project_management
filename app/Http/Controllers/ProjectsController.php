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
            'title' => 'โครงการทั้งหมด',
            'projects' => $projects
        ];
        return view('project/index', $params );
    }

    public function create()
    {
        $params = [
            'title' => '<i class="fa fa-plus"></i> สร้างโครงการ'
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
            // return redirect()->route('projects.index')->with('success', 'บันทึกข้อมูลโครงการสำเร็จ');
            return redirect()->route('projects.edit', [$project_id])->with('success', 'บันทึกข้อมูลโครงการสำเร็จ');
        }

        
    }

    public function show($id)
    {
        return view('project/show', []);
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
            return redirect()->route('projects.index')
            ->with('success','โครงการถูกลบเรียบร้อย');
        }
        return redirect()->route('projects.index')
            ->with('danger','ไม่สามารถลบข้อมูลโครงการได้');
    }

    public function projectMember($id)
    {

    }

    public function projectTask($id)
    {

    }



}
