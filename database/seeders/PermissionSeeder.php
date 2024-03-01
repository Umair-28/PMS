<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create([
            "name"=>"create_task",
            "guard_name"=>"web"
        ]);
        Permission::create([
            "name"=>"view_task",
            "guard_name"=>"web"
        ]);
        Permission::create([
            "name"=>"delete_task",
            "guard_name"=>"web"
        ]);
        Permission::create([
            "name"=>"update_task",
            "guard_name"=>"web"
        ]);

        Permission::create([
            "name"=>"create_user",
            "guard_name"=>"web"
        ]);
        Permission::create([
            "name"=>"view_user",
            "guard_name"=>"web"
        ]);
        Permission::create([
            "name"=>"delete_user",
            "guard_name"=>"web"
        ]);
        Permission::create([
            "name"=>"update_user",
            "guard_name"=>"web"
        ]);
    }
}
