<?php

namespace Database\Factories;

use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<OrderItem>
 */
class OrderItemFactory extends Factory
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
            'order_id' => function () {
                return \App\Models\Order::inRandomOrder()->first()?->id ?? \App\Models\Order::factory()->create()->id;
            },
            'product_id' => function () {
                return \App\Models\Product::inRandomOrder()->first()?->id ?? \App\Models\Product::factory()->create()->id;
            },
            'quantity' => fake()->numberBetween(1, 99),
            'price_at_purchase' => function (array $attributes) {
                return Product::find(value($attributes['product_id']))->price;
            }
        ];
    }
}
