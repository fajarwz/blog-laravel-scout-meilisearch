<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

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
    public function definition(): array
    {
        $name = $this->faker->unique()->word();
 
        return [
            'name' => $name,
            'slug' => Str::slug(
                title: $name,
            ),
            'searchable' => $this->faker->boolean(
                chanceOfGettingTrue: 85,
            ),
        ];
    }

    public function searchable(): static
    {
        return $this->state(fn (array $attributes): array => [
            'searchable' => true,
        ]);
    }
 
    public function nonsearchable(): static
    {
        return $this->state(fn (array $attributes): array => [
            'searchable' => false,
        ]);
    }
}
