<?php

use App\Post;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 100; $i++) { 

            $post = new Post();

            $post->title = $faker->words(7,true); // con true restituisce la stringa composta da 7 parole
            $post->slug = Str::slug($post->title); //per generare lo slug a partire dal titolo posso usare l'helper Str::slug. Come parametro gli passo il titolo e non è necessario specificare il trattino come separatore perché lo è di default
            $post->content = $faker->paragraphs(10, true);
            $post->published_at = $faker->randomElement([null, $faker->dateTime()]); //gli dico di scegliere a caso tra un valore nullo e una data

            $post->save();
            
        }
    }
}
