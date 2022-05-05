<?php

use App\Post;
use App\Tag;
use App\Category;
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

        $categories = Category::all();
        $categoriesId = $categories->pluck('id')->all(); //The pluck method retrieves all of the values for a given key
        // questo pluck funziona se il seeder delle category viene lanciato prima del seeder dei post

        $tags = Tag::all();
        $tagsId = $tags->pluck('id')->all();

        for ($i=0; $i < 100; $i++) { 

            $post = new Post();

            $post->title = $faker->words(7,true); // con true restituisce la stringa composta da 7 parole
            $post->slug = Str::slug($post->title); //per generare lo slug a partire dal titolo posso usare l'helper Str::slug. Come parametro gli passo il titolo e non è necessario specificare il trattino come separatore perché lo è di default
            $post->content = $faker->paragraphs(10, true);
            $post->published_at = $faker->optional()->dateTime(); //gli dico di scegliere a caso tra un valore nullo e una data
            // altro modo $post->published_at = $faker->randomElement([null, $faker->dateTime()]); 
            $post->category_id = $faker->optional()->randomElement($categoriesId); 

            $randomTags = $faker->randomElements( $tagsId, 2); //recupero 2 id di tags

            $post->save();
            
            $post->tags()->attach($randomTags); //tags() è la relazione, quindi a post che ha la relazione con tag, gli attacco gli id che ho recuperato di tag -> in questo modo vado a popolare la tabella pivot
            //qui vado a collegare l'id dei tag all'id dei post, per questo va messo dopo il save, dato che solo dopo aver creato e salvato il post avrò il suo id
            //avendo usato randomTags, in cui recupero 2 id di tags, allora per ad ogni post saranno collegati 2 id di tags

        }
    }
}
