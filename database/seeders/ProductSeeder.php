<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $tags=Tag::all();

        $products = Product::factory(10)->create();

        foreach($products as $product){
            $randomTag= $tags->random(rand(1,5))->pluck('id');
            $product->tags()->attach($randomTag);
        }
    }
}
