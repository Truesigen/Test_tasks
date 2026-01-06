<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Role;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $roles = ['admin', 'manager', 'user'];

        foreach ($roles as $role) {
            Role::factory()->create([
                'slug' => $role,
                'name' => $role,
                'permissions' => '*',
                'is_active' => 1,
                'created_at' => now(),
            ]);
        }

        User::factory(50)->create();
        Project::factory(20)->create();
        Task::factory(50)->create();
    }
}
