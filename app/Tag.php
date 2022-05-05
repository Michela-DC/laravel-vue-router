<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{   
    //relazione many to many con posts
    public function posts() { 
        return $this->belongsToMany('App\Post');
    }
}
