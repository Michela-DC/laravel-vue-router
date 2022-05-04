<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{   
    // Creo la relazione secondo cui una categoria può avere più post
    public function posts() {
        return $this->hasMany('App\Post');
    }
}
