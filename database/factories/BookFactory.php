<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'author' => fake()->name(),
            'isbn' => fake()->unique()->isbn13(),
            'description' => fake()->paragraph(),
            'cover_image' => 'https://picsum.photos/seed/'.fake()->uuid().'/300/450',
            'category' => fake()->randomElement(['Clásicos', 'Ciencia Ficción', 'Realismo Mágico', 'Infantil', 'Fantasía']),
            'pages' => fake()->numberBetween(50, 1000),
            'published_year' => fake()->year(),
            'rating' => fake()->randomFloat(2, 1, 5),
            'price' => fake()->randomFloat(2, 5, 100),
            'stock' => fake()->numberBetween(0, 100),
        ];
    }
}
