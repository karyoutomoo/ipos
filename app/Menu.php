<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    /**
     * Get the store that owns the menu.
     */
    public function store()
    {
        return $this->belongsTo('App\Store');
    }

    /**
     * Get order items that have the menu ordered.
     */
    public function orderItems()
    {
        return $this->hasMany('App\OrderItem');
    }
}
