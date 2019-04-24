<?php

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

use \App\User;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            'admin' => [''], 
            'student' => [
                'view posts', 'create posts', 'edit post', 'delete post', 'create comments', 'edit comment', 'delete comment',
                'view assignments', 'view deliveries', 'create deliveries', 'edit delivery', 'view useful resources', 'view calendar'     
            ], 
            'user' => ['view posts', 'view assignments', 'view calendar']
        ];

        foreach ($roles as $role=>$permissions) {
            $role_i = Role::firstOrCreate(['name' => $role]);

            foreach ($permissions as $permission) {
                $permission_i = Permission::firstOrCreate(['name' => $permission]);

                $role_i->givePermissionTo($permission_i);
            }
        }
        
        $users = [
            'admin' => [
                'name' => 'Adrian Rodriguez',
                'account_number' => '317114270',
                'email' => 'adrian.rodriguez7109@gmail.com',
            ]
        ];

        foreach ($users as $role => $usr) {
            $user_i = User::updateOrCreate([
                ['name', $usr['name']],
                ['account_number', $usr['account_number']],
                ['email', $usr['email']],
            ]);

            $user_i->syncRoles($role);
            
        }

    }
}
