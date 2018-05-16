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
      $data['seller_id'] = Auth::user()->toko_id;
      $data['user_role'] = (Auth::user()->user_role == 1);
      $data['toko'] = Store::get();
      return view('store.index', $data);
    }

    public function create_index(){
      return view('store.create');
    }

    public function create(Request $request){
      $toko = new Store();
      $toko->store_name = $request['nama_toko'];
      $toko->store_location = $request['lokasi'];
      $toko->save();

      return redirect('toko')->with('status', 'Berhasil membuat toko baru');
    }

    public function register_index(){
      $data['toko'] = Store::get();
      return view('store.register', $data);
    }

    public function register(Request $request){
      $id_penjual = Auth::user()->id;
      $penjual = User::find($id_penjual);
      $penjual->toko_id = $request['toko_id'];
      $penjual->is_user_verified = false;
      $penjual->save();

      return redirect('toko')->with('status', 'Berhasil mendaftar pada toko');
    }

    public function register_button(Request $request){
      $id_penjual = Auth::user()->id;
      $penjual = User::find($id_penjual);
      $penjual->toko_id = $request['register_toko_id'];
      $penjual->is_user_verified = false;
      $penjual->save();

      return redirect('toko')->with('status', 'Berhasil mendaftar pada toko');
    }

    public function edit_index($store_id){
      if(Auth::user()->toko_id != $store_id){
        return redirect('403');
      }
      $data['toko'] = Store::find($store_id);
      return view('store.edit', $data);
    }

    public function edit(Request $request, $store_id){
      if(Auth::user()->toko_id != $store_id){
        return redirect('403');
      }
      $toko = Store::find($store_id);
      $toko->store_name = $request['nama_toko'];
      $toko->store_location = $request['lokasi'];
      $toko->save();

      return redirect('toko')->with('status', 'Berhasil mengupdate informasi toko');
    }

    public function delete(Request $request){
      $toko_id = $request['toko_id'];
      $users = User::where('toko_id',$toko_id)->get();

      foreach ($users as $user) {
        $user->toko_id = NULL;
        $user->save();
      }

      $toko = Store::find($toko_id);
      $toko->delete();
      return redirect('toko')->with('Berhasil menghapus toko');
    }

    public function toggle(Request $request){
      $toko_id = $request['status_toko_id'];
      $toko = Store::find($toko_id);
      if ($toko->store_status) {
        $toko->store_status = false;
      } else {
        $toko->store_status = true;
      }
      $toko->save();
      return redirect('toko')->with('Berhasil mengubah status toko');
    }
}
