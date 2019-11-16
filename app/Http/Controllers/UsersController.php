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
        // $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request) {
        $users = User::paginate(20);
        return view('backend.users.index', compact('users'))
            ->with('i', ($request->input('page', 1) - 1) * 20);
    }


    public function create()
    {
        $roles = Role::pluck('display_name','id');
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
            'last_name' => 'required|string|max:64',
            'username' => 'required|string|max:32|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ],[
            'username.unique' => 'มีผู้ใช้ username นี้แล้ว กรุณากรอกข้อมูล username ใหม่อีกครั้ง',
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
        $roles = Role::pluck('display_name','id');

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


    public function destroy($id)
    {
        //
    }

}
