<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $CoreCateory = ['Electronics', 'Clothing', 'Home & Kitchen', 'Books', 'Sports'];
        //
        foreach($CoreCateory as $Category){

            Category::firstOrCreate([

                'name' => $Category,
                'slug' => Str::slug($Category)
            ]);
        }
        

    }
}
