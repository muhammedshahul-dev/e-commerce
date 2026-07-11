<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        if(!User::where('email','admin@email.com')->exists() || !User::where('email','admin@email.com')->exists() ){
            User::factory()->create(
                [
                    'name'=>'admin',
                    'email'=>'admin@email.com',
                    'role'=> 'admin'
                ],
            );
        }
        
        if(!User::where('email','staff@email.com')->exists()){
            [
                'name'=>'staff',
                'email'=>'staff@email.com',
                'role'=> 'staff'
            ];
        }
        User::factory()->count(10)->create();
    }
}
