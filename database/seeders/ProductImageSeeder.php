<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductImage;
//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $products = Product::all();

        $products->each( function ($products, $key) {
            ProductImage::factory()->create([
                'product_id'=> $products->id,
                'is_primary' => true
            ]);
            ProductImage::factory(3)->create([
                'product_id'=> $products->id,
                'is_primary' => false
            ]);
        });
    }
}
