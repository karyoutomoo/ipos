<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    //
  protected $fillable = ['name', 'outlet', 'description', 'price', 'availability'];
}
