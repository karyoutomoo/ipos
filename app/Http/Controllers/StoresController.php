<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Store;
use App\User;
use Auth;

class StoresController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
      $data['toko'] = Store::get();
      return view('store.index', $data);
    }

    public function create_index(){
      return view('store.create');
    }

    public function create(Request $request){
      $newStore = new Store();
      $newStore->store_name = $request['nama_toko'];
      $newStore->store_location = $request['lokasi'];
      $newStore->save();

      return redirect('toko')->with('status', '2');
    }

    public function register_index(){
      $data['toko'] = Store::get();
      return view('store.register', $data);
    }

    public function register(Request $request){
      $id_penjual = Auth::user()->id;
      $penjual = User::find($id_penjual);
      $penjual->toko_id = $request['toko_id'];
      $penjual->save();

      return redirect('toko')->with('status', '1');
    }
}
