<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class RatingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 2,
            'product_id' => function (array $attributes) {
                return $this->faker->unique()->numberBetween(1, 49);
            },
            'rating_value' => $this->faker->numberBetween(1, 5)
        ];
    }
}
