<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Section>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => rand(1,20),
            'title' => ucwords($this->faker->words(1, true)),
            'body' => ucwords($this->faker->words(3, true)),
            // 'comment' => ucwords($this->faker->words(1, true)),
            'created_at' => now(),
        ];
    }
}
