<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class stock extends Model
{
    public function articles(){
        return $this->hasMany(Article::class);
    }
}
