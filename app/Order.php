<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
  protected $fillable = ['user_id', 'employee_id', 'food_id', 'food_status'];
}
