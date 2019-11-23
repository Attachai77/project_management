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

    Route::resource('users','UsersController');
    Route::resource('roles','RolesController');
    Route::resource('permissions','PermissionsController');
    Route::resource('permission_groups','PermissionGroupsController');

    Route::resource('projects','ProjectsController');
    Route::resource('ms_project_roles','MasterProjectRolesController');


    Route::get('projects/afterCreated/{id}', 'ProjectsController@afterCreated')->name('projects.afterCreated')->where('id', '[0-9]+');

    
    Route::get('/', function () {
        $projects = \App\Project::all();
        $params = [
            'projects' => $projects
        ];
        return view('home_page' , $params);
    });

    Route::get('/lte', function () {
        return view('_blank');
    });

    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/users/delete/{id}', 'UsersController@delete')->name('users.delete');
    Route::get('/users/inactive/{id}', 'UsersController@inactive')->name('users.inactive');
    Route::get('/roles/delete/{id}', 'RolesController@delete')->name('roles.delete');
    Route::get('/permission_groups/delete/{id}', 'PermissionGroupsController@delete')->name('permission_groups.delete');
    Route::get('/permissions/delete/{id}', 'PermissionsController@delete')->name('permissions.delete');

    Route::get('/roles/assignPermission/{id}', 'RolesController@assignPermission')->name('roles.assignPermission');
    Route::post('/roles/assignPermission/{id}', 'RolesController@assignPermission')->name('roles.assignPermission');
    
});



Auth::routes();


