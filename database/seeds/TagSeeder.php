<?php

use App\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            'Meat',
            'Fish',
            'Vegetarian',
            'Vegan',
            'Gluten free',
            'Lactose free',
        ];

        foreach($tags as $tag_name) {

            Tag::create([
                'name' => $tag_name,
                'slug' => Str::slug($tag_name),
            ]);
        }
    }
}
