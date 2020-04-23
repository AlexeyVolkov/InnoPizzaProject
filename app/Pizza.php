<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pizza extends Model
{
    public function orderedPizza()
    {
        $this->belongsTo('App\OrderedPizza');
    }
}