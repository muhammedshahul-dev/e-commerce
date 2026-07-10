<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name= fake()->sentence(2);
        return [
            //
            'name'=>$name,
            'description' => fake()->paragraph(3),
            'price' => fake()->randomFloat(2,0,100000),
            'stock' => fake()->numberBetween(0,100),
            'category_id'=> function(){
                return \App\Models\Category::inRandomOrder()->first()?->id ?? \App\Models\Category::factory()->create()->id;
            },
            'slug'=> Str::slug($name)
        ];
    }
}
