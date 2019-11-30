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
    Route::resource('project_positions','ProjectPositionsController');
    Route::resource('project_members','ProjectMembersController');
    Route::resource('tasks','TasksController');

    Route::get('projects/afterCreated/{id}', 'ProjectsController@afterCreated')->name('projects.afterCreated')->where('id', '[0-9]+');

    
    Route::get('/', 'HomeController@dashboard')->name('dashboard');
    Route::get('/home', 'HomeController@dashboard')->name('dashboard');

    Route::get('/lte', function () {
        return view('_blank');
    });

    

    Route::get('/users/delete/{id}', 'UsersController@delete')->name('users.delete');
    Route::get('/users/inactive/{id}', 'UsersController@inactive')->name('users.inactive');
    Route::get('/users/reset_password/{id}', 'UsersController@resetPassword')->name('users.reset_password');
    Route::get('/users/assign_permission/{id}', 'UsersController@assignPermission')->name('users.assign_permission');
    Route::post('/users/assign_permission/{id}', 'UsersController@assignPermission')->name('users.assign_permission');
    
    Route::get('/permission_groups/delete/{id}', 'PermissionGroupsController@delete')->name('permission_groups.delete');
    Route::get('/permissions/delete/{id}', 'PermissionsController@delete')->name('permissions.delete');

    Route::get('/roles/delete/{id}', 'RolesController@delete')->name('roles.delete');
    Route::get('/roles/assignPermission/{id}', 'RolesController@assignPermission')->name('roles.assignPermission');
    Route::post('/roles/assignPermission/{id}', 'RolesController@assignPermission')->name('roles.assignPermission');
    
    Route::get('/projects/delete/{id}', 'ProjectsController@delete')->name('projects.delete');
    Route::get('/projects/projectMember/{id}', 'ProjectsController@projectMember')->name('projects.projectMember');
    Route::post('/projects/projectMember/{id}', 'ProjectsController@projectMember')->name('projects.projectMember');
    Route::get('/projects/deleteProjectMember/{id}', 'ProjectsController@deleteProjectMember')->name('projects.deleteProjectMember');
    Route::get('/projects/projectTask/{id}', 'ProjectsController@projectTask')->name('projects.projectTask');
    Route::post('/projects/projectTask/{id}', 'ProjectsController@projectTask')->name('projects.projectTask');

    Route::get('/project_positions/delete/{id}', 'ProjectPositionsController@delete')->name('project_positions.delete');

    Route::get('/project_members/delete/{id}', 'ProjectMembersController@delete')->name('project_members.delete');
    
    
    Route::get('/my_projects', 'MyController@myProject')->name('my_projects');
    Route::get('/my_projects/{id}', 'MyController@myProjectShow')->name('myProjectShow');

    Route::get('/my_tasks', 'MyController@myTask')->name('my_tasks');
    Route::get('/my_tasks/{id}', 'MyController@myTaskShow')->name('myTaskShow');

    Route::get('/tasks/create/{project_id}', 'TasksController@create')->name('tasks.create');
    Route::get('/tasks/delete/{task_id}', 'TasksController@delete')->name('tasks.delete');
    Route::post('/tasks/addMember/{task_id}', 'TasksController@addMember')->name('tasks.addMember');
});



Auth::routes();


