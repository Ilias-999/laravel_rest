<?php

namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;


class OrderProductFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

            'order_id' => $this->faker->numberBetween(1, 20),
            'product_id' => $this->faker->numberBetween(1, 50),
            'quantity' => $this->faker->numberBetween(1,10)

        ];
    }
}


