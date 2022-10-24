<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Section>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'commentable_id' => rand(1,20),
            'commentable_type ' => ucwords($this->faker->words(1, true)),
            'comment' => ucwords($this->faker->words(4, true)),

        ];
    }
}
