<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\Permission;
use App\Role;
use App\ModelHasRole;
use App\ModelHasPermission;

class UsersController extends Controller
{
    public function __construct(){
        // $this->middleware('permission:user-list');
        // $this->middleware('permission:user-create', ['only' => ['create','store']]);
        // $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
        // $this->middleware('permission:user-delete', ['only' => ['delete']]);
    }

    public function index(Request $request) {
        $conditions = [];
        if(Auth::user()->username !== "master"){
            $conditions[] = ['username','!=','master'];
        }

        $users = User::where([
            'deleted'=>false,
            'active'=>true
            ])
            ->where($conditions)
            ->paginate(20);
            
        return view('backend.users.index', compact('users'))
            ->with('i', ($request->input('page', 1) - 1) * 20);
    }


    public function create()
    {
        $conditions = [];
        if(Auth::user()->username !== "master"){
            $conditions[] = ['name','!=','master'];
        }

        $roles = Role::where('deleted',false)
        ->where($conditions)
        ->pluck('display_name','id');
        return view('backend.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        if($request->password == null){
            $request->request->add(['password' => 'password']);
            $request->request->add(['password_confirmation' => 'password']);
        }

        $validated = $request->validate([
            'first_name' => 'required|string|max:64',
            'last_name' => 'max:64',
            'username' => 'required|string|max:32|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ],[
            'first_name.max' => 'กรุณากรอกชื่อความยาวไม่เกิน 64 ตัวอักษร',
            'last_name.max' => 'กรุณากรอกนามสกุลความยาวไม่เกิน 64 ตัวอักษร',
            'username.unique' => 'มีผู้ใช้ username นี้แล้ว กรุณากรอกข้อมูล username ใหม่อีกครั้ง',
            'email.required' => 'กรุณากรอกข้อมูลอีเมล',
            'email.email' => 'ข้อมูลอีเมลไม่ถูกต้อง กรุณากรอกข้อมูลใหม่อีกครั้ง',
            'password.min' => 'รหัสผ่านต้องมีความยาวอย่างน้อย 6 ตัวอักษร',
            'password.confirmed' => 'การยืนยันรหัสผ่านไม่ถูกต้อง กรุณากรอกข้อมูลใหม่อีกครั้ง',
        ]);

        $request['password'] = Hash::make($request['password']);
        $request['created_uid'] = Auth::user()->id;
        $role_id = $request->input('role_id');

        $request->request->remove('default_password');
        $request->request->remove('password_confirmation');
        $request->request->remove('role_id');
        $user = User::create($request->all());

        $user->assignRole($role_id);

        return redirect()->route('users.index')
            ->with('success','Add user successfully');
    }


    public function show($id)
    {
        $user = User::find($id);
        $roles = $user->getRoleNames();
        return view('backend.users.show',compact('user','roles'));
    }


    public function edit($id)
    {
        $user = User::find($id);
        $user_roles = ModelHasRole::where('model_id',$id)->pluck('role_id','role_id')->toArray(); 

        $conditions = [];
        if(Auth::user()->username !== "master"){
            $conditions[] = ['name','!=','master'];
        }
        $roles = Role::where('deleted',false)
        ->where($conditions)
        ->pluck('display_name','id');

        return view('backend.users.edit',compact('user','user_roles', 'roles'));
    }


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:64',
            //'username' => 'required|string|max:32|unique:users,username,'.$id,
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
        ]);

        if(!empty($request['password'])){
            $validated = $request->validate([
                'password' => 'required|string|min:6|confirmed',
            ]);
            $request['password'] = Hash::make($request['password']);
        }else{
            $request = array_except($request,array('password'));
        }
        // dd($request->all());

        
        $user_data = User::find($id)->toArray();
        $user_data['first_name'] = $request->first_name;
        $user_data['last_name'] = $request->last_name;
        $user_data['email'] = $request->email;
        $user_data['updated_uid'] = Auth::user()->id;
        #dd($user_data);

        $user = User::find($id);
        $user->update($user_data);

        ModelHasRole::where('model_id',$id)->delete();
        $user->assignRole($request->input('role_id'));

        #dd($request->input('permission'));
        ModelHasPermission::where('model_id',$id)->delete();
        if(!empty($request->input('permission'))){
            $user->givePermissionTo($request->input('permission'));
        }
        
        return redirect()->route('users.index')
            ->with('success','User updated successfully');
    }


    public function delete($id)
    {
        $deleted = User::where('id', $id)
            ->update(['deleted' => true]);
        if ($deleted) {
            return redirect()->route('users.index')
            ->with('success','ผู้ใช้งานถูกลบแล้ว');
        }
        return redirect()->route('users.index')
            ->with('danger','ไม่สามารถลบผู้ใช้งานได้');
    }

    public function resetPassword($id)
    {
        $deleted = User::where('id', $id)
            ->update(['password' => Hash::make('password') ]);
        if ($deleted) {
            return redirect()->route('users.edit',$id)
                ->with('success','รีเซตรหัสผ่านเรียบร้อย');
        }
        return redirect()->back()
            ->with('danger','ไม่สามารถรีเซตรหัสผ่านผู้ใช้ได้ กรุณาลองใหม่อีกครั้ง');
    }

    public function assignPermission(Request $request, $id)
    {
        if ($request->isMethod('POST')) {
            $permission_ids = $request->permission_id;
            $user_id = $id;

            \App\ModelHasPermission::where('model_id',$user_id)->delete();

            if (!empty($permission_ids)) {
                foreach ($permission_ids as $key => $permission_id) {
                    $data = [
                        'permission_id'=>$permission_id,
                        'model_id'=>$user_id,
                        'model_type'=>'App\User',
                    ];
                    \App\ModelHasPermission::create($data);
                }
            }
            return redirect()->route('users.index')
            ->with('success','กำหนดสิทธิ์การใช้งานเพอ่มเติมให้ผู้ใช้เรียบร้อย');
        }

        $user = \App\User::findOrFail($id);
        $permission_groups = \App\PermissionGroup::where('deleted',false)
        ->get();

        $params = [
            'title'=>'กำหนดสิทธิ์เพิ่มเติมให้กับผู้ใช้',
            'user'=>$user,
            'permission_groups'=>$permission_groups
        ];
        return view('backend.users.assign_permission', $params );
    }

}
