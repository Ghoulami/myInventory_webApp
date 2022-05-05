<?php

namespace App;

use Illuminate\Http\UploadedFile;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected static $unguarded= true;

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function stock(){
        return $this->belongsTo(Stock::class);
    }

    public function allArticles(){
        return $this->with("category")->latest()->paginate(5);
    }

    public function articleCount(){

    }
}
