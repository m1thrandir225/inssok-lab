<?php

namespace Database\Factories;

use App\Models\Jet;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Jet>
 */
class JetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->word() . ' Jet',
            'model' => fake()->randomElement(['Boeing', 'Airbus', 'Gulfstream', 'Bombardier', 'Embraer']) . ' ' . fake()->bothify('???-###'),
            'capacity' => fake()->numberBetween(4, 20),
            'hourly_rate' => fake()->numberBetween(5000, 20000),
            'created_at' => fake()->dateTimeBetween('-1 year'),
            'updated_at' => function (array $attributes) {
                return fake()->dateTimeBetween($attributes['created_at']);
            },
        ];
    }

    /**
     * Indicate that the jet is a luxury model.
     */
    public function luxury(): static
    {
        return $this->state(fn(array $attributes) => [
            'model' => 'Gulfstream ' . fake()->bothify('G???'),
            'capacity' => fake()->numberBetween(12, 20),
            'hourly_rate' => fake()->numberBetween(15000, 30000),
        ]);
    }

    /**
     * Indicate that the jet is a small model.
     */
    public function small(): static
    {
        return $this->state(fn(array $attributes) => [
            'model' => 'Citation ' . fake()->bothify('CJ#'),
            'capacity' => fake()->numberBetween(4, 8),
            'hourly_rate' => fake()->numberBetween(3000, 8000),
        ]);
    }
}
