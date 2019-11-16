<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;

class UsersTableSeeder extends Seeder
{

    public function run()
    {
        $this->permissionSeeder();
        $this->roleSeeder();
        $this->userSeeder();

        $this->assignRoleToUser();
        // $this->assignPermissionToRoleSeeder();
    }

    public function permissionSeeder(){
        $permissionSeeder = [
            [
                'name'          =>      'create permission',
                'guard_name'    =>      'web',
                'description'   =>      'Create Permission',
                'created_at'    =>      date('Y-m-d H:i:s'),
            ],[
                'name'          =>      'permission list',
                'guard_name'    =>      'web',
                'description'   =>      'Permission List',
                'created_at'    =>      date('Y-m-d H:i:s'),
            ],[
                'name'          =>      'edit permission',
                'guard_name'    =>      'web',
                'description'   =>      'Edit Permission',
                'created_at'    =>      date('Y-m-d H:i:s'),
            ],[
                'name'          =>      'view permission',
                'guard_name'    =>      'web',
                'description'   =>      'View Permission',
                'created_at'    =>      date('Y-m-d H:i:s'),
            ],[
                'name'          =>      'delete permission',
                'guard_name'    =>      'web',
                'description'   =>      'Delete Permission',
                'created_at'    =>      date('Y-m-d H:i:s'),
            ],
            // Role
            [
                'name'          =>      'create role',
                'guard_name'    =>      'web',
                'description'   =>      'Create Role',
                'created_at'    =>      date('Y-m-d H:i:s'),
            ],[
                'name'          =>      'role list',
                'guard_name'    =>      'web',
                'description'   =>      'Role List',
                'created_at'    =>      date('Y-m-d H:i:s'),
            ],[
                'name'          =>      'edit role',
                'guard_name'    =>      'web',
                'description'   =>      'Edit Role',
                'created_at'    =>      date('Y-m-d H:i:s'),
            ],[
                'name'          =>      'view role',
                'guard_name'    =>      'web',
                'description'   =>      'View Role',
                'created_at'    =>      date('Y-m-d H:i:s'),
            ],[
                'name'          =>      'delete role',
                'guard_name'    =>      'web',
                'description'   =>      'Delete Role',
                'created_at'    =>      date('Y-m-d H:i:s'),
            ],
            // User
            [
                'name'          =>      'create user',
                'guard_name'    =>      'web',
                'description'   =>      'Create User',
                'created_at'    =>      date('Y-m-d H:i:s'),
            ],[
                'name'          =>      'user list',
                'guard_name'    =>      'web',
                'description'   =>      'User List',
                'created_at'    =>      date('Y-m-d H:i:s'),
            ],[
                'name'          =>      'edit user',
                'guard_name'    =>      'web',
                'description'   =>      'Edit User',
                'created_at'    =>      date('Y-m-d H:i:s'),
            ],[
                'name'          =>      'view user',
                'guard_name'    =>      'web',
                'description'   =>      'View User',
                'created_at'    =>      date('Y-m-d H:i:s'),
            ],[
                'name'          =>      'delete user',
                'guard_name'    =>      'web',
                'description'   =>      'Delete User',
                'created_at'    =>      date('Y-m-d H:i:s'),
            ],
        ];

        foreach($permissionSeeder as $permission):
            DB::table('permissions')->insert($permission);
        endforeach;
    }

    public function roleSeeder(){

        $roleSeeder = [
            [
                'name'          =>      'master',
                'guard_name'    =>      'web',
                'display_name'  =>      'Web Master',
                'description'  =>       'Web Master is master role',
                'created_at'    =>      date('Y-m-d H:i:s'),
            ],[
                'name'          =>      'admin',
                'guard_name'    =>      'web',
                'display_name'  =>      'Admin',
                'description'  =>       'System Management',
                'created_at'    =>      date('Y-m-d H:i:s'),
            ],[
                'name'          =>      'writer',
                'guard_name'    =>      'web',
                'display_name'  =>      'Writer',
                'description'  =>       'Writing',                
                'created_at'    =>      date('Y-m-d H:i:s'),
            ],
        ];

        foreach($roleSeeder as $role):
            DB::table('roles')->insert($role);
        endforeach;
    }

    public function userSeeder(){
        $userSeeder = [
            [
                'first_name'        =>      'Web',
                'last_name'         =>      'Master',
                'username'          =>      'master',
                'email'             =>      'master@mail.com',
                'password'          =>      bcrypt('secret'),
                'created_at'        =>      date('Y-m-d H:i:s'),
            ],[
                'first_name'        =>      'Admin',
                'last_name'         =>      '',
                'username'          =>      'admin',
                'email'             =>      'admin@mail.com',
                'password'          =>      bcrypt('secret'),
                'created_at'        =>      date('Y-m-d H:i:s'),
            ],[
                'first_name'        =>      'Writer',
                'last_name'         =>      '',
                'username'          =>      'writer',
                'email'             =>      'writer@mail.com',
                'password'          =>      bcrypt('secret'),
                'created_at'        =>      date('Y-m-d H:i:s'),
            ]
        ];

        foreach($userSeeder as $user):
            DB::table('users')->insert($user);
        endforeach;
    }

    public function assignRoleToUser(){
        $userMaster = User::find(1);
        $userMaster->assignRole('master');
    }



}
