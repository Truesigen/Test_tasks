<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $genres = ['horror', 'drama', 'action', 'comedy', 'romance', 'adventure', 'western'];

        return [
            'genre' => $genres[rand(0, 6)],
        ];
    }
}
