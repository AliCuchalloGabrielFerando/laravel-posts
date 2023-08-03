<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::truncate();
        Role::truncate();
        Permission::truncate();

        $viewPostsPermission = Permission::create(['name'=>'View posts']);
        $createPostsPermission = Permission::create(['name'=>'Create posts']);
        $updatePostsPermission = Permission::create(['name'=>'Update posts']);
        $deletePostsPermission = Permission::create(['name'=>'Delete posts']);

        $viewUsersPermission = Permission::create(['name'=>'View users']);
        $createUsersPermission = Permission::create(['name'=>'Create users']);
        $updateUsersPermission = Permission::create(['name'=>'Update users']);
        $deleteUsersPermission = Permission::create(['name'=>'Delete users']);
        $updateRolesPermission = Permission::create(['name'=>'Update roles']);

        $permission = Permission::create(['name' => 'edit articles']);

        $adminRole = Role::create(['name' => 'Admin']);
        $writeRole = Role::create(['name' => 'Writer']);
        
        $adminRole->givePermissionTo(Permission::all());
        $writeRole->givePermissionTo(['View posts','Create posts','Update posts','Delete posts','edit articles']);


        $user = new User;
        $user->name = 'root';
        $user->email = 'root@root.com';
        $user->password = '12345678';
        $user->save();

        $user->assignRole($adminRole);

        $user = new User;
        $user->name = 'root2';
        $user->email = 'root2@root.com';
        $user->password = '12345678';
        $user->save();

        $user->assignRole($writeRole);
    }
}
