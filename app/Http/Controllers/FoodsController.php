<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Food;
use Auth;

class FoodsController extends Controller
{
    //

  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index(){
    $data['makanans'] = Food::get();
    return view('food.index', $data);
  }

  public function create_index(){
    return view('food.create');
  }

  public function create(Request $request){
    $user = Auth::user();
    $food = new Food();
    $food->name = $request['nama_makanan'];
    $food->store_id = $user['toko_id'];
    $food->price = $request['harga'];
    $food->description = $request['deskripsi'];
    
    $image = $request->file('gambar_makanan');
    $image_name = time().'.'.$image->getClientOriginalExtension();
    $image->storeAs('public/makanan', $image_name);
    
    $food->imagepath= $image_name;
    $food->save();
    return redirect('makanan'); 
  }

  // API Controllers:
  public function show(Food $food){
    return $food;
  }

  public function store(Request $request){
    $this->validate($request, [
      'name' => 'required|unique:foods|max:127',
      'outlet' => 'required',
      'description' => 'required',
      'price' => 'integer',
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


}
