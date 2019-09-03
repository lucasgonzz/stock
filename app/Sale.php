<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{

    public function articles() {
        return $this->belongsToMany('App\Article');
    }

    // public function article(){
    // 	return $this->belongsTo('App\Article')->with('sales');
    // }
}
