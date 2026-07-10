<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $CoreCateory = ['Electronics', 'Clothing', 'Home & Kitchen', 'Books', 'Sports'];
        //
        foreach($CoreCateory as $Category){

            Tag::firstOrCreate([

                'name' => $Category,
                'slug' => Str::slug($Category)
            ]);
        }
    }
}
