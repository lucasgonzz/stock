<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    public function articles()
    {
        return $this->belongsToMany('App\Article');
    }
}
