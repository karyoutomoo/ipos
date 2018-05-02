<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    /**
     * Get the store workers.
     */
    public function workers()
    {
        return $this->hasMany('App\User');
    }

    /**
     * Get menus from the store.
     */
    public function menus()
    {
        return $this->hasMany('App\Menu');
    }
}
