<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderedPizza extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'pizza_id',
        'order_id',
        'size_id',
        'topping_id',
        'quantity',
    ];

    public function order()
    {
        return $this->belongsTo('App\Order');
    }

    public function pizza()
    {
        return $this->hasOne('App\Pizza');
    }
}