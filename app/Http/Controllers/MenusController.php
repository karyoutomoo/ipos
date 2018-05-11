<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Menu;
use App\Stores;
use DB;
use Auth;

class MenusController extends Controller
{
    //

  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index(){
    // $data['makanans'] = Menu::get();
    $data['makanans'] = DB::table('menus')
      ->join('stores', 'menus.store_id','=','stores.id')
      ->select('menus.*', 'stores.store_name')
      ->get();
    return view('menu.index', $data);
  }

  public function create_index(){
    $id_user = Auth::user()->id;
    $data['user'] = User::find($id_user);
    return view('menu.create', $data);
  }

  public function create(Request $request){
    $user = Auth::user();
    $Menu = new Menu();
    
    $Menu->store_id = $user['toko_id'];
    $Menu->menu_name = $request['nama_makanan'];
    $Menu->menu_price = $request['harga'];
    $Menu->menu_description = $request['deskripsi'];
    $Menu->menu_type = $request['tipe_menu'];
    
    $image = $request->file('gambar_makanan');
    $image_name = $Menu->menu_name.'.'.$image->getClientOriginalExtension();
    // $image_name = time().'.'.$image->getClientOriginalExtension();
    $image->storeAs('public/makanan', $image_name);
    
    $Menu->menu_imagepath= 'storage/makanan/'.$image_name;
    $Menu->save();
    return redirect('makanan'); 
  }

  // API Controllers:
  public function show(Menu $Menu){
    return $Menu;
  }

  public function store(Request $request){
    $this->validate($request, [
      'name' => 'required|unique:Menus|max:127',
      'outlet' => 'required',
      'description' => 'required',
      'price' => 'integer',
    ]);

    $Menu = Menu::create($request->all());
    return response()->json($Menu,201);
  }

  public function update(Request $request, Menu $Menu){
    $Menu->update($request->all());
    return response()->json($Menu,200);
  }

  public function delete(Menu $Menu){
    $Menu->delete();
    return response()->json(null, 204);
  }


}
