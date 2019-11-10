<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{

    public function index()
    {
        $users = \App\User::where([])
            ->paginate(15);

        $params = [
            'title' => 'ผู้ใช้งาน',
            'users' => $users
        ];

        return view('backend/users/index' , $params);
    }

    public function create()
    {
        $params = [
            'title'=>'เพิ่มผู้ใช้งาน'
        ];
        return view('backend/users/create' , $params);
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        $user = \App\User::findOrFail($id);

        $profile = \App\User::findOrFail($id)->profile;
        
        $params = [
            'user'=>$user,
            'profile'=>$profile
        ];

        return view('backend.users.show', $params);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $deleteUser = App\Flight::find($id)->update('deleted', true);

        if ($deleteUser) {
            return redirect()->route('projects.index')
            ->with('success', 'ลบผู้ใช้งานสำเร็จ');            
        }
        return redirect()->route('projects.index')
            ->with('danger', 'มีบางอย่างผิดพลาด! ไม่สามารถลบผู้ใช้งานได้'); 
        
        // $flight = App\Flight::find($id);
        // $flight->name = 'New Flight Name';
        // $flight->save();
    }
}
