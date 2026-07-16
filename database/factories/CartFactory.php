<?php

namespace Database\Factories;

use App\Models\Cart;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Cart>
 */
class CartFactory extends Factory
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
            'user_id'=> function(){
                return \App\Models\User::inRandomOrder()->first()?->id ?? \App\Models\User::factory()->create()->id;
            },
            'product_id'=> function(){
                return \App\Models\Product::inRandomOrder()->first()?->id ?? \App\Models\Product::factory()->create()->id;
            },
            'quantity'=> fake()->numberBetween(1,100)
        ];
    }
}
