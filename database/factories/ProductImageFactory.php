<?php

namespace Database\Factories;

use App\Models\ProductImage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ProductImage>
 */
class ProductImageFactory extends Factory
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
            'image_path'=> 'https://picsum.photos/seed/' . fake()->uuid . '/600/400',
            'product_id'=> function(){
                $product = \App\Models\Product::inRandomOrder()->first();
                return $product ? $product->id :\App\Models\Product::factory()->create()->id;
            }
        ];
    }
}
