<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->unique()->sentence();
 
        return [
            'title' => $title,
            'slug' => Str::slug(
                title: $title,
            ),
            'content' => $this->faker->paragraph(),
            'published' => $this->faker->boolean(
                chanceOfGettingTrue: 85,
            ),
            'category_id' => Category::factory(),
        ];
    }
 
    public function published(): static
    {
        return $this->state(fn (array $attributes): array => [
            'published' => true,
        ]);
    }
 
    public function draft(): static
    {
        return $this->state(fn (array $attributes): array => [
            'published' => false,
        ]);
    }
}
