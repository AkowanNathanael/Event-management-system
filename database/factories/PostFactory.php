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
            "title" => $this->faker->sentence(3),
            "description" => $this->faker->paragraph(5),
            // "image" => $this->faker->imageUrl(640, 480, "animals"),
            "category_id" => $this->faker->numberBetween(1, 10),
            "user_id" => $this->faker->numberBetween(1, 10),
        ];
    }
}
