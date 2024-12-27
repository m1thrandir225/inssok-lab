<?php

namespace Database\Seeders;

use App\Models\Jet;
use App\Models\Review;
use Illuminate\Database\Seeder;

class JetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Jet::factory()
            ->luxury()
            ->count(5)
            ->has(
                Review::factory()
                    ->approved()
                    ->count(fake()->numberBetween(3, 8))
            )
            ->create();

        Jet::factory()
            ->small()
            ->count(8)
            ->has(
                Review::factory()
                    ->count(fake()->numberBetween(2, 6))
            )
            ->create();

        Jet::factory()
            ->count(12)
            ->has(
                Review::factory()
                    ->count(fake()->numberBetween(0, 10))
            )
            ->create();
    }
}
