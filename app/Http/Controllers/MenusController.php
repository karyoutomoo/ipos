<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Menu;
use App\Store;
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
    $data['makanans'] = Menu::join('stores', 'menus.store_id','=','stores.id')
      ->select('menus.*', 'stores.store_name')
      ->get();
    $data['user_role'] = (Auth::user()->user_role == 1);
    $data['user_store'] = Auth::user()->toko_id;
    return view('menu.index', $data);
  }

  public function create_index(){
    $data['user'] = Auth::user();
    return view('menu.create', $data);
  }

  public function validator(Request $data){
    $errorMessage = [
      'nama_makanan.required' => 'Nama Makanan Diperlukan',
      'harga.required' => 'Harga Makanan Diperlukan',
      'harga.numeric' => 'Harga Makanan Harus Berupa Angka',
      'harga.min' => 'Harga Makanan Minimum 1000 Rupiah',
      'tipe_menu.required' => 'Tipe Menu Diperlukan',
      'tipe_menu.boolean' => 'Tipe Menu Hanya Berupa Makanan atau Minuman',
      'deskripsi.required' => 'Deskripsi Makanan Diperlukan',
      'gambar_makanan.required' => 'Gambar Makanan Diperlukan',
      'gambar_makanan.mimes' => 'Gambar Makanan Harus Berupa JPEG, BMP, atau PNG',
      'gambar_makanan.max' => 'Maksimum Ukuran Gambar Makanan adalah 5 MB'
    ];

    $validator = Validator::make($data->all(), [
      'nama_makanan' => 'required|string',
      'harga' => 'required|numeric|min:1000',
      'tipe_menu' => 'required|boolean',
      'deskripsi' => 'required|string',
      'gambar_makanan' => 'required|mimes:jpeg,bmp,png|max:5120',
    ], $errorMessage);
    
    return $validator;    
  }

  public function create(Request $request){
    $this->validator($request)->validate();
    $this->store($request, new Menu(), Auth::user());
    return redirect('makanan'); 
  }

  public function toggle(Request $request){
    $Menu = Menu::find($request['menu_id']);
    $Menu->menu_status = $Menu->menu_status? 0 : 1;
    $Menu->save();
    return redirect('makanan');
  }

  public function edit_index($menu_id){
    if(Auth::user()->toko_id != Menu::find($menu_id)->store_id){
      return redirect('403')->with('Bukan Makanan Toko Anda');
    }

    $data['toko_id'] = Auth::user()->toko_id;
    $data['menu'] = Menu::find($menu_id);
    return view('menu.edit', $data);
  }

  public function edit(Request $request, $menu_id){
    if(Auth::user()->toko_id != Menu::find($menu_id)->store_id){
      return redirect('403')->with('Bukan Makanan Toko Anda');
    }
    $this->validator($request)->validate();

    $Menu = Menu::find($menu_id);
    $this->store($request, $Menu, Auth::user());
    return redirect('makanan'); 
  }

  public function store(Request $request, Menu $Menu, User $User){
    $Menu->store_id = $User['toko_id'];

    $Menu->menu_name = $request['nama_makanan'];
    $Menu->menu_price = $request['harga'];
    $Menu->menu_description = $request['deskripsi'];
    $Menu->menu_type = $request['tipe_menu'];
    
    $image = $request->file('gambar_makanan');
    $image_name = $Menu->id.'.'.$image->getClientOriginalExtension();
    $image->storeAs('public/makanan', $image_name);
    
    $Menu->menu_imagepath= 'storage/makanan/'.$image_name;
    return $Menu->save();
  }

  // API Controllers:
  // public function show(Menu $Menu){
  //   return $Menu;
  // }

  // public function store(Request $request){
  //   $this->validate($request, [
  //     'name' => 'required|unique:Menus|max:127',
  //     'outlet' => 'required',
  //     'description' => 'required',
  //     'price' => 'integer',
  //   ]);

  //   $Menu = Menu::create($request->all());
  //   return response()->json($Menu,201);
  // }

  // public function update(Request $request, Menu $Menu){
  //   $Menu->update($request->all());
  //   return response()->json($Menu,200);
  // }

  // public function delete(Menu $Menu){
  //   $Menu->delete();
  //   return response()->json(null, 204);
  // }


}
