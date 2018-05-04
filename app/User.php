<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role', 'toko_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get the store where the user works.
     * Not all users work in a store.
     */
    public function store()
    {
        return $this->belongsTo('App\Store');
    }

    /**
     * Get orders from the user.
     */
    public function orders()
    {
        return $this->hasMany('App\Order');
    }
}
