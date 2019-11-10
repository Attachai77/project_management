<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectsController extends Controller
{

    public function index()
    {
        $conditions = [];

        $projects = \App\Project::where($conditions)
        ->orderBy('id','DESC')
        ->paginate(15);

        #dd($projects);
        $params = [
            'title' => 'โครงการทั้งหมด',
            'projects' => $projects
        ];
        return view('project/index', $params );
    }

    public function create()
    {
        $params = [
            'title' => 'สร้างโครงการ'
        ];
        return view('project/create', $params );
    }


    public function store(Request $request)
    {
        $isError = false;
        $errorMsg = "";
        

        DB::beginTransaction();

        $data = [
            'project_name'=>$request->input('project_name'),
            'adviser'=>$request->input('adviser'),
            'budget'=>$request->input('budget'),
            'location'=>$request->input('location'),
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
                $purpose_data = [
                    'project_id'=>$project_id,
                    'purpose_name'=>$purpose,
                    'created_uid'=>0
                ];

                $purpose_saved = \App\ProjectPurpose::create($purpose_data);
                if (!$purpose_saved->exists) {
                    $isError = true;
                    $errorMsg = "ไม่สามารถบันทึกข้อมูลจุดประสงค์โครงการได้ กรุณาตรวจสอบข้อมูลให้ถูกต้อง";
                }
            }
        }

        if (!$isError && $request->input('expecteds')[0]) {
            foreach ($request->input('expecteds') as $key => $expected) {
                $expected_data = [
                    'project_id'=>$project_id,
                    'expected_name'=>$expected,
                    'created_uid'=>0
                ];

                $expected_saved = \App\ProjectExpected::create($expected_data);
                if (!$expected_saved->exists) {
                    $isError = true;
                    $errorMsg = "ไม่สามารถบันทึกข้อมูลผลที่คาดว่าจะได้รับได้ กรุณาตรวจสอบข้อมูลให้ถูกต้อง";
                }
            }
        }

        if (!$isError && $request->input('supports')[0]) {
            foreach ($request->input('supports') as $key => $support) {
                $support_data = [
                    'project_id'=>$project_id,
                    'name'=>$support,
                    'created_uid'=>0
                ];

                $support_saved = \App\ProjectSupport::create($support_data);
                if (!$support_saved->exists) {
                    $isError = true;
                    $errorMsg = "ไม่สามารถบันทึกข้อมูลผู้สนับสนุนได้ กรุณาตรวจสอบข้อมูลให้ถูกต้อง";
                }
            }
        }

        if ($isError) {
            DB::rollBack();
            return redirect()->back()->with('danger', $errorMsg);
        }else{
            DB::commit();
            // return redirect()->route('projects.index')->with('success', 'บันทึกข้อมูลโครงการสำเร็จ');
            return redirect()->route('projects.afterCreated', [$project_id])->with('success', 'บันทึกข้อมูลโครงการสำเร็จ');
        }

        
    }

    public function show($id)
    {
        return view('project/show', []);
    }

    public function edit($id)
    {
        return view('project/edit', []);
    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {
        //
    }

    public function afterCreated($project_id = NULL)
    {
        $project = \App\Project::find($project_id);
        $project_expecteds = \App\ProjectExpected::get()->where('project_id',$project_id);
        $project_purposes = \App\ProjectPurpose::get()->where('project_id',$project_id);
        $project_supports = \App\ProjectSupport::get()->where('project_id',$project_id);

        $params = [
            'project'=>$project,
            'project_expecteds'=>$project_expecteds,
            'project_purposes'=>$project_purposes,
            'project_supports'=>$project_supports
        ];
        // dd($params);

        return view('project.after_created' , $params);
    }


}
