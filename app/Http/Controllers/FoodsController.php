<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Food;

class FoodsController extends Controller
{
    //
  public function index(){
    return Food::all();
  }

  public function show(Food $food){
    return $food;
  }

  public function store(Request $request){
    $this->validate($request, [
      'name' => 'required|unique:foods|max:127',
      'outlet' => 'required',
      'description' => 'required',
      'price' => 'integer',
      'availability' => 'boolean',
    ]);

    $food = Food::create($request->all());
    return response()->json($food,201);
  }

  public function update(Request $request, Food $food){
    $food->update($request->all());
    return response()->json($food,200);
  }

  public function delete(Food $food){
    $food->delete();
    return response()->json(null, 204);
  }

  public function boot(){
    $fx = Food::all();
    return view('food.index', ['fx'=>$fx]);
  }
}
