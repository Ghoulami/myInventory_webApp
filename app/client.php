<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected static $unguarded= true;

    public function allClient(){
        return $this->latest()->paginate(5);
    }
}
