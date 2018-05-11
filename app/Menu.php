<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = ['menu_name', 'store_id', 'menu_description', 'menu_price', 'menu_imagepath', 'menu_status'];
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

    /**
     * Get reviews.
     */
    public function reviews()
    {
        return $this->hasMany('App\Review');
    }

    /**
     * Get avg rating.
     */
    public function rating()
    {
        return $this->reviews()->select('rating')->avg('rating');
    }
}
