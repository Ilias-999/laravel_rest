<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;


class OrderFactory extends Factory
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
            'total_price' => 0,
            'order_date' => $this->faker->dateTime()
        ];
    }

    public function configure():static
    {
        return $this->afterCreating(function (Order $order) {
            $products = Product::all();
            $products_order = $products->random(random_int(1, 4));

            $total_price = 0;
            $products_order->each(function ($product) use ($order, &$total_price) {
                $random_quantity = random_int(1, 3);
                $total_price += $random_quantity * $product->price;
                $order->products()->attach($product->id, ['quantity' => $random_quantity]);
            });

            $order->update(['total_price' => $total_price]);
        });
    }

}


