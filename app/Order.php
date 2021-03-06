<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * Get the user that makes the order.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get order items from the order.
     */
    public function orderItems()
    {
        return $this->hasMany('App\OrderItem');
    }
}
