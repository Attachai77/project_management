<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MasterProjectRolesController extends Controller
{

    public function index()
    {
        $ms_project_roles = \App\MasterProjectRole::get();

        $params = [
            'ms_project_roles'=>$ms_project_roles
        ];
        return view('backend/master_project_role/index', $params );
    }


    public function create()
    {
        return view('backend/master_project_role/create' ,[] );
    }


    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
