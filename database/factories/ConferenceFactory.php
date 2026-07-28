<?php

namespace Database\Factories;

use App\Enums\Region;
use Illuminate\Database\Eloquent\Factories\Factory;

class ConferenceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @throws \DateMalformedStringException
     */
    public function definition(): array
    {
        $beginDate = now()->addDays(fake()->numberBetween(30, 365 * 3));
        $endDate = $beginDate
            ->copy()
            ->addDays(fake()->numberBetween(1, 7));

        return [
            'name' => fake()->name(),
            'description' => fake()->text(),
            'start_date' => $beginDate,
            'end_date' => $endDate,
            'status' => fake()->randomElement([
                'draft',
                'published',
                'archived',
            ]),
            'region' => fake()->randomElement(Region::cases()),
            'venue_id' => null,
        ];
    }
}
