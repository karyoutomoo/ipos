<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    /**
     * Get the user that makes the review.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the menu that is reviewed.
     */
    public function menu()
    {
        return $this->belongsTo('App\Menu');
    }
}
