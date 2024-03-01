<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
             // Create admin role
             Role::create(['name' => 'admin', 'guard_name'=>'web']);
    
             // Create project-leader role
             Role::create(['name' => 'project-leader', 'guard_name'=>'web']);
     
             // Create developer role
             Role::create(['name' => 'developer', 'guard_name'=>'web']);
    }
}
