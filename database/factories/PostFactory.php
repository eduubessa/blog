<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'author_id' => 1,
            'title' => $this->faker->title(),
            'description' => $this->faker->sentence(),
            'body' => $this->faker->text(),
            'is_published' => $this->faker->boolean(),
        ];
    }
}
