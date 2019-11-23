<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class PermissionGroupsController extends Controller
{

    public function index(Request $request)
    {
        $permissionGroups = \App\PermissionGroup::where('deleted',false)->paginate(20);
        return view('backend.permission_groups.index', compact('permissionGroups'))
            ->with('i', ($request->input('page', 1) - 1) * 20);
    }


    public function create()
    {
        return view('backend.permission_groups.create');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'group_name' => 'required|string|max:64|unique:permission_groups'
        ],[
            'group_name.max' => 'กรุณากรอกชื่อความยาวไม่เกิน 64 ตัวอักษร',
            'group_name.unique' => 'ชื่อกลุ่ม Permission นี้มีในระบบแล้ว กรุณากรอกชื่ออื่น'
        ]);

        $data = [
            'group_name'=> $request->group_name,
            'created_uid'=> Auth::user()->id
        ];

        $create = \App\PermissionGroup::create($data);
        if ($create->exists) {
            return redirect()->route('permission_groups.index')
            ->with('success','เพิ่มข้อมูลเรียบร้อย');
        }
        return redirect()->route('permission_groups.index')
            ->with('danger','มีบางอย่างผิดพลาด ไม่สามารถเพิ่มข้อมูลได้');
    }


    public function show($id)
    {
        $group = \App\PermissionGroup::find($id);
        return view('backend.permission_groups.show',compact('group'));
    }

    public function edit($id)
    {
        $group = \App\PermissionGroup::find($id);
        return view('backend.permission_groups.edit',compact('group'));
    }

    public function update(Request $request, $id)
    {
        $updated = \App\PermissionGroup::where('id', $id)
            ->update([
                'group_name' => $request->group_name,
                'updated_uid' => Auth::user()->id
            ]);

        if ($updated) {
            return redirect()->route('permission_groups.index')
            ->with('success','แก้ไขข้อมูลเรียบร้อย');
        }
        return redirect()->route('permission_groups.index')
            ->with('danger','มีบางอย่างผิดพลาด ไม่สามารถแก้ไขข้อมูลได้');
    }

    public function delete($id)
    {
        $deleted = \App\PermissionGroup::where('id', $id)
            ->update([
                'deleted' => true,
                'updated_uid' => Auth::user()->id
                ]);
        if ($deleted) {
            return redirect()->route('permission_groups.index')
            ->with('success','ลบข้อมูลเรียบร้อย');
        }
        return redirect()->route('permission_groups.index')
            ->with('danger','ไม่สามารถลบข้อมูลได้');
    }
}
