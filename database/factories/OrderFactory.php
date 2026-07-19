<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Order>
 */
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
            //
            'user_id' => function(){
                $user = \App\Models\User::inRandomOrder()->first();
                return $user ? $user->id :\App\Models\User::factory()->create()->id;
            },
            'total_amount'=>0,
            'order_status' => 'pending',
            'shipping_address'=> fake('en_IN')->streetAddress,
            'instruction'=> fake()->paragraph(3),
            'payment_method'=> fake()->randomElement(['cod','credit_card','upi','debit_card']),
            'payment_status'=> fake()->randomElement(['paid','pending','failed'])
        ];
    }
}
