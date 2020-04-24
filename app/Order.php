<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'customer_id',
        'open',
        'payment_id',
        'delivery_id',
        'comments',
    ];

    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }
    public function payment()
    {
        return $this->belongsTo('App\Payment');
    }
    public function delivery()
    {
        return $this->belongsTo('App\Delivery');
    }
    public function orderedPizzas()
    {
        return $this->hasMany('App\OrderedPizza');
    }
}