<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles; 


class LeaderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       
        $user = User::create([
            'name' => 'Hamza',
            'email' => 'hamza@gmail.com',
            'password' => bcrypt('password'),
        ]);

        $projectLeaderRole = Role::where('name', 'project-leader')->first();
        
       

        $permissions = [

            'create_task',
            'update_task',
            'delete_task',
            'view_task',
        ];
            // Assign the permission to the admin role
            $projectLeaderRole->syncPermissions($permissions);
            $user->assignRole($projectLeaderRole);
        }
}
