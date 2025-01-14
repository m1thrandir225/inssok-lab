<?php

namespace Database\Factories;

use App\Enums\ReservationStatusEnum;
use App\Models\Reservation;
use App\Models\Yacht;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    protected $model = Reservation::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'user_name' => $this->faker->name,
            'yacht_id' => Yacht::factory(),
            "reservation_date" => $this->faker->dateTimeBetween('tomorrow', "+1 month"),
            "duration_hours" => $this->faker->numberBetween(1, 24),
        ];
    }
}
