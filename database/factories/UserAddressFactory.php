<?php

namespace Database\Factories;

use App\Models\UserAddress;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<UserAddress>
 */
class UserAddressFactory extends Factory
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
                $user = \App\Models\User::inRandomOrder()->first();
                return $user ? $user->id :\App\Models\User::factory()->create()->id;
            },
            'country'=> 'india',
            'state'=> fake('en_IN')->state,
            'district'=>fake('en_IN')->city,
            'city'=> fake('en_IN')->locality,
            'address_line1'=> fake('en_IN')->streetAddress,
            'postal_code'=> fake('en_IN')->postcode
        ];
    }
}
