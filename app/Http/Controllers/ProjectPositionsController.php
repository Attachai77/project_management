<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectPositionsController extends Controller
{

    public function index(Request $request)
    {
        $title = "# ข้อมูลตำแหน่งโครงการ";
        $positions = \App\ProjectPosition::where('deleted',false)->paginate(20);
        return view('backend.project_positions.index', compact('positions','title'))
            ->with('i', ($request->input('page', 1) - 1) * 20);
    }


    public function create()
    {
        return view('backend.project_positions.create');
    }


    public function store(Request $request)
    {
        // dd($request->position_name);
        $validated = $request->validate([
            'position_name' => 'required|string|max:64|unique:project_positions'
        ],[
            'position_name.max' => 'กรุณากรอกชื่อความยาวไม่เกิน 64 ตัวอักษร',
            'position_name.unique' => 'ชื่อนี้มีในระบบแล้ว กรุณากรอกชื่ออื่น'
        ]);

        $data = [
            'position_name'=> $request->position_name,
            'created_uid'=> Auth::user()->id
        ];

        $create = \App\ProjectPosition::create($data);
        if ($create->exists) {
            return redirect()->route('project_positions.index')
            ->with('success','เพิ่มข้อมูลตำแหน่งเรียบร้อย');
        }
        return redirect()->route('project_positions.index')
            ->with('danger','มีบางอย่างผิดพลาด ไม่สามารถเพิ่มข้อมูลได้');
    }


    public function show($id)
    {
        $position = \App\ProjectPosition::find($id);
        return view('backend.project_positions.show',compact('position'));
    }


    public function edit($id)
    {
        $position = \App\ProjectPosition::find($id);
        return view('backend.project_positions.edit',compact('position'));
    }


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'position_name' => 'required|string|max:64|unique:project_positions'
        ],[
            'position_name.max' => 'กรุณากรอกชื่อความยาวไม่เกิน 64 ตัวอักษร',
            'position_name.unique' => 'ชื่อนี้มีในระบบแล้ว กรุณากรอกชื่ออื่น'
        ]);

        $updated = \App\ProjectPosition::where('id', $id)
            ->update([
                'position_name' => $request->position_name,
                'updated_uid' => Auth::user()->id
            ]);

        if ($updated) {
            return redirect()->route('project_positions.index')
            ->with('success','แก้ไขข้อมูลกลุ่มตำแหน่งเรียบร้อย');
        }
        return redirect()->route('project_positions.index')
            ->with('danger','มีบางอย่างผิดพลาด ไม่สามารถแก้ไขข้อมูลตำแหน่งได้');
    }

    public function delete($id)
    {
        $deleted = \App\ProjectPosition::where('id', $id)
            ->update([
                'deleted' => true,
                'updated_uid' => Auth::user()->id
                ]);
        if ($deleted) {
            return redirect()->route('project_positions.index')
            ->with('success','ตำแหน่งถูกลบเรียบร้อย');
        }
        return redirect()->route('project_positions.index')
            ->with('danger','ไม่สามารถลบข้อมูลตำแหน่งได้');
    }

}
