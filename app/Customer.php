<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'id'
    ];
    public function orders()
    {
        return $this->hasMany('App\Order');
    }
    public function order()
    {
        return $this->hasOne('App\Order');
    }
}