<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles; 

class DeveloperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Retrieve the "developer" role
        $developerRole = Role::where('name', 'developer')->first();
    
        // Define permissions to be synced
        $permissions = [
            'update_task',
            'view_task',
        ];
    
        // Sync permissions to the "developer" role
        $developerRole->syncPermissions($permissions);
    
        // Create and assign roles to users
        for ($i = 1; $i <= 5; $i++) {
            // Create a new user
            $user = User::create([
                'name' => 'User' . $i,
                'email' => 'user' . $i . '@gmail.com',
                'password' => bcrypt('password'),
            ]);
    
            // Assign the "developer" role to the user
            $user->assignRole($developerRole);
        }
    }
}
