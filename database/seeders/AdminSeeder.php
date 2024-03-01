<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles; 


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       
        $user = User::create([
            'name' => 'Muhammad Umair',
            'email' => 'umair@gmail.com',
            'password' => bcrypt('password'),
        ]);

        $adminRole = Role::where('name', 'admin')->first();
        
       

        $permissions = [
            'create_user',
            'update_user',
            'delete_user',
            'view_user',
            'create_task',
            'update_task',
            'delete_task',
            'view_task',
        ];
            // Assign the permission to the admin role
            $adminRole->syncPermissions($permissions);
            $user->assignRole($adminRole);
        }
}
