<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    
    /**
     * Get the order that owns the order item.
     */
    public function order()
    {
        return $this->belongsTo('App\Order');
    }

    /**
     * Get the ordered menu.
     */
    public function menu()
    {
        return $this->hasOne('App\Menu');
    }
}
