<?php

namespace Database\Factories;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Tag>
 */
class TagFactory extends Factory
{
public function definition(): array
{
    return [
        'name' => fake()->unique()->word(), 
        'created_at' => now(),
        'updated_at' => now(),
    ];
}
}