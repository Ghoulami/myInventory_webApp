<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected static $unguarded= true;

    public function articles(){
        return $this->hasMany(Article::class);
    }

    public function allCategories(){
        return $this->withCount('articles')->latest()->paginate(5);
    }
}
