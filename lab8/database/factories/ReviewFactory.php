<?php

namespace Database\Factories;

use App\Models\Jet;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'jet_id' => Jet::factory(),
            'reviewer_name' => fake()->name(),
            'description' => fake()->paragraph(3),
            'rating' => fake()->numberBetween(1, 5),
            'status' => fake()->randomElement(['pending', 'approved', 'rejected']),
            'created_at' => fake()->dateTimeBetween('-1 year'),
            'updated_at' => function (array $attributes) {
                return fake()->dateTimeBetween($attributes['created_at']);
            },
        ];
    }
    public function approved(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'approved',
            'rating' => fake()->numberBetween(4, 5),
            'description' => fake()->paragraph(3) . "\n\nHighly recommended!",
        ]);
    }

    public function rejected(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'rejected',
            'rating' => fake()->numberBetween(1, 2),
            'description' => fake()->paragraph(2) . "\n\nNot recommended.",
        ]);
    }

    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'pending',
        ]);
    }
}
