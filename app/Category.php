<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{   
    // Per creare la relazione secondo cui un post può avere tante categorie:
    // uso il metodo posts() nel quale restituiamo il tipo di relazione hasMany('name space del model principale')
    public function posts() {
        return $this->hasMany('App\Post');
    }
}
