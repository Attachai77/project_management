<?php

namespace App\Http\Controllers;

use App\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class PermissionsController extends Controller
{
    public function index(Request $request)
    {
        $permissions = \App\Permission::where('deleted',false)->paginate(20);
        return view('backend.permissions.index', compact('permissions'))
            ->with('i', ($request->input('page', 1) - 1) * 20);
    }


    public function create()
    {
        $permission_groups = \App\PermissionGroup::where('deleted',false)
            ->pluck('group_name','id');
            // dd($permission_groups);
        return view('backend.permissions.create',compact('permission_groups'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:64|unique:permissions',
            'permission_group_id' => 'required|integer',
            'description' => 'required|string|max:255',
        ],[
            'name.max' => 'permission ความยาวไม่เกิน 64 ตัวอักษร',
            'name.unique' => 'ชื่อ Permission นี้มีในระบบแล้ว กรุณากรอกชื่ออื่น'
        ]);

        $data = [
            'name'=> $request->name,
            'description'=> $request->description,
            'permission_group_id'=> $request->permission_group_id,
            'guard_name'=> 'web'
        ];

        $create = \App\Permission::create($data);
        if ($create->exists) {
            return redirect()->route('permissions.index')
            ->with('success','เพิ่มข้อมูลเรียบร้อย');
        }
        return redirect()->route('permissions.index')
            ->with('danger','มีบางอย่างผิดพลาด ไม่สามารถเพิ่มข้อมูลได้');
    }


    public function show($id)
    {
        $permission = \App\Permission::find($id);
        return view('backend.permissions.show',compact('permission'));
    }

    public function edit($id)
    {
        $permission_groups = \App\PermissionGroup::where('deleted',false)
        ->pluck('group_name','id');

        $permission = \App\Permission::find($id);
        return view('backend.permissions.edit',compact('permission','permission_groups'));
    }

    public function update(Request $request, $id)
    {
        $updated = \App\Permission::where('id', $id)
            ->update([
                'permission_group_id'=> $request->permission_group_id,
                'description' => $request->description
            ]);

        if ($updated) {
            return redirect()->route('permissions.index')
            ->with('success','แก้ไขข้อมูลเรียบร้อย');
        }
        return redirect()->route('permissions.index')
            ->with('danger','มีบางอย่างผิดพลาด ไม่สามารถแก้ไขข้อมูลได้');
    }

    public function delete($id)
    {
        $deleted = \App\Permission::where('id', $id)->update(['deleted'=>true]);
        if ($deleted) {
            return redirect()->route('permissions.index')
            ->with('success','ลบข้อมูลเรียบร้อย');
        }
        return redirect()->route('permissions.index')
            ->with('danger','ไม่สามารถลบข้อมูลได้');
    }
}
