<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OtherController extends Controller
{
    //
  public function welcome(){
    return view('welcome');
  }

  public function unauthorized(){
    return view('403');
  }
}
