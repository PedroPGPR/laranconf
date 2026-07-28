<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SpeakerFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->safeEmail(),
            'bio' => fake()->text(),
            'qualifications' => fake()->randomElements([
                'business-leader',
                'charisma',
                'first-time',
                'hometown-hero',
                'industry-expert',
                'inspirational',
                'humanitarian',
                'laracasts-contributor',
                'mentor',
                'open-source-contributor',
                'podcaster',
                'public-speaker',
                'social-media-influencer',
                'thought-leader',
                'unique-perspective',
            ]),
            'twitter_handle' => fake()->word(),
        ];
    }
}
