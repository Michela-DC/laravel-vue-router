<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    protected $fillable = [
        'title',
        'content',
        'published_at',
        'slug',
        'category_id'
    ];

    // Funzione per specificare che più posts possono essere collegati a una unica categoria
    public function category() {
        return $this->belongsTo('App\Category');
    }
    

    public static function getUniqueSlug($title) { //uso static per specificare che è un metodo statico

        //genero lo slug partendo dal titolo, quindi all'helper Str::slug passo un parametro che, quando userò questa funzione,  sarà il titolo  
        $slug = Str::slug( $title ); //non c`è bisogno di passargli il trattino come altro parametro perchè lo aggiunge di default
        $slug_base = $slug;

        $counter = 1; //mi creo un contatore

        // Prendo il primo post che trova con lo stesso slug del post che sto creando
        $post_present = Post::where('slug',$slug)->first();

        // se lo trova allora nel while, finchè non genera uno slug che sia unico, ne crea uno nuovo concatenando lo slug già presente al contatore che incrementa ad ogni giro, poi ricontrolla nuovamente se ne trova uno con lo stesso nome.
        while( $post_present ) {

            $slug = $slug_base . '-' . $counter;
            $counter++;

            $post_present = Post::where('slug',$slug)->first();
        }

        return $slug;
    }
}

