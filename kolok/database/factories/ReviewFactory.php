<?php

namespace Database\Factories;

use App\Enums\ReviewStatusEnum;
use App\Models\Reservation;
use App\Models\Review;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    protected $model = Review::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            "reservation_id" => Reservation::factory(),
            "reviewer_name" => $this->faker->name,
            "text" => $this->faker->text,
            "rating" => $this->faker->randomFloat(1, 1, 5),
        ];
    }
}
