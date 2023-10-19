<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            ['name' => 'Employee Create', 'slug' => 'employee-create'],
            ['name' => 'Employee Listing', 'slug' => 'employee-listing'],
            ['name' => 'Employee Delete', 'slug' => 'employee-delete'],
            ['name' => 'Employee Edit', 'slug' => 'employee-edit'],
            ['name' => 'Role Create', 'slug' => 'role-create'],
            ['name' => 'Role Listing', 'slug' => 'role-listing'],
            ['name' => 'Role Delete', 'slug' => 'role-delete'],
            ['name' => 'Role Edit', 'slug' => 'role-edit'],
            ['name' => 'Task Create', 'slug' => 'task-create'],
            ['name' => 'Task Listing', 'slug' => 'task-listing'],
            ['name' => 'Task Delete', 'slug' => 'task-delete'],
            ['name' => 'Task Edit', 'slug' => 'task-edit'],
            ['name' => 'Task Assign', 'slug' => 'task-assign'],
        ];

        foreach ($permissions as $permission) {
            Permission::updateOrInsert(
                ['slug' => $permission['slug']],
                $permission
            );
        }
    }
}
