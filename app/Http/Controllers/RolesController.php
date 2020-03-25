<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Artisan;

class RolesController extends Controller
{

    public function index(Request $request)
    {
        $title = "# กลุ่มผู้ใช้งาน (Role)";
        $roles = \App\Role::where('deleted',false)->paginate(20);
        return view('backend.roles.index', compact('roles','title'))
            ->with('i', ($request->input('page', 1) - 1) * 20);
    }


    public function create()
    {
        // $permissions = \App\Permission::pluck('display_name','id');
        return view('backend.roles.create');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:32|unique:roles',
            'display_name' => 'required|string|max:32|unique:roles',
            'description' => 'max:255',
        ],[
            'name.max' => 'กรุณากรอกชื่อความยาวไม่เกิน 32 ตัวอักษร',
            'name.unique' => 'ชื่อกลุ่มผู้ใช้นี้มีในระบบแล้ว กรุณากรอกชื่ออื่น',
            'display_name.max' => 'กรุณากรอกชื่อแสดงความยาวไม่เกิน 32 ตัวอักษร',
            'display_name.unique' => 'ชื่อแสดงกลุ่มผู้ใช้นี้มีในระบบแล้ว กรุณากรอกชื่ออื่น',
            'description.max' => 'กรุณากรอกคำอธบายคามยาวไม่เกิน 255 ตัวอักษร'
        ]);

        $data = [
            'name'=> $request->name,
            'display_name'=> $request->display_name,
            'description'=> $request->description,
            'guard_name'=> 'web',
            'created_uid'=> Auth::user()->id
        ];

        $create = \App\Role::create($data);
        if ($create->exists) {
            return redirect()->route('roles.index')
            ->with('success','เพิ่มข้อมูลกลุ่มผู้ใช้เรียบร้อย');
        }
        return redirect()->route('roles.index')
            ->with('danger','มีบางอย่างผิดพลาด ไม่สามารถเพิ่มข้อมูลได้');
    }


    public function show($id)
    {
        $role = \App\Role::find($id);
        return view('backend.roles.show',compact('role'));
    }


    public function edit($id)
    {
        $role = \App\Role::find($id);
        return view('backend.roles.edit',compact('role'));
    }


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'display_name' => 'required|string|max:32',
            'description' => 'max:255',
        ],[
            'display_name.max' => 'กรุณากรอกชื่อแสดงความยาวไม่เกิน 32 ตัวอักษร',
            'description.max' => 'กรุณากรอกคำอธบายคามยาวไม่เกิน 255 ตัวอักษร'
        ]);

        $updated = \App\Role::where('id', $id)
            ->update([
                'display_name' => $request->display_name,
                'description' => $request->description,
                'updated_uid' => Auth::user()->id
            ]);

        if ($updated) {
            return redirect()->route('roles.index')
            ->with('success','แก้ไขข้อมูลกลุ่มผู้ใช้เรียบร้อย');
        }
        return redirect()->route('roles.index')
            ->with('danger','มีบางอย่างผิดพลาด ไม่สามารถแก้ไขข้อมูลกลุ่มผู้ใช้ได้');
    }

    public function delete($id)
    {
        $deleted = \App\Role::where('id', $id)
            ->update([
                'deleted' => true,
                'updated_uid' => Auth::user()->id
                ]);
        if ($deleted) {
            return redirect()->route('roles.index')
            ->with('success','กลุ่มผู้ใช้ถูกลบเรียบร้อย');
        }
        return redirect()->route('roles.index')
            ->with('danger','ไม่สามารถลบข้อมูลกลุ่มผู้ใช้ได้');
    }

    public function assignPermission(Request $request, $id){

        if ($request->isMethod('POST')) {
            $permission_ids = $request->permission_id;
            $role_id = $id;

            \App\RoleHasPermission::where('role_id',$role_id)->delete();

            if (!empty($permission_ids)) {
                foreach ($permission_ids as $key => $permission_id) {
                    $data = [
                        'permission_id'=>$permission_id,
                        'role_id'=>$role_id,
                    ];
                    \App\RoleHasPermission::create($data);
                }
            }
            
            Artisan::call('permission:cache-reset');
            return redirect()->route('roles.index')
            ->with('success','กำหนดสิทธิ์การใช้งานให้กลุ่มผู้ใช้เรียบร้อย');
        }


        $role = \App\Role::find($id);
        $permission_groups = \App\PermissionGroup::where('deleted',false)
        ->get();

        $params = [
            'role'=>$role,
            'title'=>'กำหนดสิทธิ์ให้กับกลุ่มผู้ใช้',
            'permission_groups'=>$permission_groups
        ];
        return view('backend.roles.assign_permission',$params );
    }


    

}
