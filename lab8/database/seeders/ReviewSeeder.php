<?php

namespace Database\Seeders;

use App\Models\Review;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Review::factory()
            ->count(20)
            ->approved()
            ->create();

        Review::factory()
            ->count(10)
            ->rejected()
            ->create();

        Review::factory()
            ->count(15)
            ->pending()
            ->create();
    }
}
