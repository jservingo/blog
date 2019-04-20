<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Crear roles
        $adminRole = Role::create(['name'=>'Admin']);
        $managerRole = Role::create(['name'=>'Manager']);	
        $supervisorRole = Role::create(['name'=>'Supervisor']);
        $monitorRole = Role::create(['name'=>'Monitor']);
        $userRole = Role::create(['name'=>'User']);
        $companyRole = Role::create(['name'=>'Company']);

        //Crear permisos
        $view_posts = Permission::create(['name'=>'view_posts']);
        $edit_posts = Permission::create(['name'=>'edit_posts']);
        $update_posts = Permission::create(['name'=>'update_posts']);
        $delete_posts = Permission::create(['name'=>'delete_posts']);

        $view_users = Permission::create(['name'=>'view_users']);
        $edit_users = Permission::create(['name'=>'edit_users']);
        $update_users = Permission::create(['name'=>'update_users']);
        $delete_users = Permission::create(['name'=>'delete_users']);

        //Dar permisos a los roles
        $adminRole->givePermissionTo($view_posts);
        $managerRole->givePermissionTo($view_posts);
        $supervisorRole->givePermissionTo($view_posts);
        $monitorRole->givePermissionTo($view_posts);

        $adminRole->givePermissionTo($edit_posts);
        $managerRole->givePermissionTo($edit_posts);

        $adminRole->givePermissionTo($update_posts);
        $managerRole->givePermissionTo($update_posts);

        $adminRole->givePermissionTo($delete_posts);

        //users
        $adminRole->givePermissionTo($view_users);
        $managerRole->givePermissionTo($view_users);
        $supervisorRole->givePermissionTo($view_users);
        $monitorRole->givePermissionTo($view_users);

        $adminRole->givePermissionTo($edit_users);
        $managerRole->givePermissionTo($edit_users);

        $adminRole->givePermissionTo($update_users);
        $managerRole->givePermissionTo($update_users);

        $adminRole->givePermissionTo($delete_users);
        
        //Asignar roles a usuarios
        $user = User::find(1);
        $user->assignRole($adminRole);

        $user = User::find(2);
        $user->assignRole($managerRole);

        $user = User::find(3);
        $user->assignRole($supervisorRole);

        $user = User::find(4);
        $user->assignRole($monitorRole);

        $user = User::find(5);
        $user->assignRole($userRole);

        $user = User::find(6);
        $user->assignRole($companyRole);
    }
}
