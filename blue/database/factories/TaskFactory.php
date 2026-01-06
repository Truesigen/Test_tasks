<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = ['pending', 'in_progress', 'completed'];
        $priority = ['low', 'medium', 'high'];

        return [
            'title' => fake()->title(),
            'description' => fake()->text(),
            'status' => $status[fake()->numberBetween(0, 2)],
            'priority' => $priority[fake()->numberBetween(0, 2)],
            'project_id' => fake()->numberBetween(1, 20),
            'assigned_to' => fake()->numberBetween(1, 50),
            'created_by' => fake()->numberBetween(1, 50),
            'due_date' => fake()->date(),
        ];
    }
}
