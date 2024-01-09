<?php

namespace Database\Factories;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [

            'user_id' => 3,
            'name' => $this->faker->words(3, true),
            'slug' => Str::slug($this->faker->name()),
            'description' => $this->faker->text(),
            'price' => $this->faker->numberBetween(100, 2000),
            'category_id' => $this->faker->randomElement([1,2,3,4,5,6,7])

        ];

    }
}
