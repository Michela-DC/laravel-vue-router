<?php

use App\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $categories = [
           'Starters', 
           'First courses', 
           'Second courses', 
           'Side dishes', 
           'Desserts',
        ];

        foreach($categories as $category_name){

            $category = new Category;

            $category->name = $category_name;
            $category->slug = Str::slug($category_name);

            $category->save();
        }

    }
}
