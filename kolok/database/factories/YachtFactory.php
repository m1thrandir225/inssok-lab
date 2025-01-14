<?php

namespace Database\Factories;

use App\Enums\YachtTypeEnum;
use App\Models\Yacht;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Yacht>
 */
class YachtFactory extends Factory
{
    protected $model = Yacht::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type' => $this->faker->randomElement([YachtTypeEnum::CLASSIC, YachtTypeEnum::SUPER]),
            'name' => $this->faker->name,
            'capacity' => $this->faker->numberBetween(1, 100),
            'hourly_rate' => $this->faker->randomFloat(2, 100, 1000),
        ];
    }
}
