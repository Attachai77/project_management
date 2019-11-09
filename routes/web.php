<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['middleware' => ['auth']], function() {

    Route::resource('projects','ProjectsController');
    Route::resource('ms_project_roles','MasterProjectRolesController');


    Route::get('projects/afterCreated/{id}', 'ProjectsController@afterCreated')->name('projects.afterCreated')->where('id', '[0-9]+');

    
    Route::get('/', function () {
        // return view('welcome');
        $projects = \App\Project::all();
        #dd($projects);
        $params = [
            'title' => 'โครงการทั้งหมด',
            'projects' => $projects
        ];
        return view('home_page' , $params);
    });

    Route::get('/lte', function () {
        return view('_blank');
    });

    Route::get('/home', 'HomeController@index')->name('home');
});



Auth::routes();


