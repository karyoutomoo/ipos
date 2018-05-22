<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
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

    public function register_index(){
      $data['toko'] = Store::get();
      return view('store.register', $data);
    }

    public function edit_index($store_id){
      if(!empty(Auth::user()->toko_id)){
        if(Auth::user()->toko_id == $store_id){
          if($data['toko'] = Store::find($store_id)){
            return view('store.edit', $data);
          } else {
            return view('store.edit')->withErrors('Kedai tidak ditemukan..');
          }
        } else {
          return redirect('403')->withErrors('Anda tidak berhak mengakses Kedai orang lain!');
        }
      } else {
        return view('store.edit')->withErrors('Anda belum terdaftar pada Kedai manapun');
      }
    }

    public function validator(Request $request){
      $errorMessage = [
        'nama_toko.required' => 'Nama Kedai Diperlukan',
        'nama_toko.max' => 'Ukuran Maximum Nama Kedai adalah 255 Karakter',
        'lokasi.required' => 'Deskripsi / Lokasi Kedai Diperlukan',
        'lokasi.max' => 'Ukuran Maximum Deskripsi / Lokasi Kedai adalah 255 Karakter',
      ];
      
      $validator = Validator::make($request->all(), [
        'nama_toko' => 'required|string|max:255',
        'lokasi' => 'required|string|max:255',
      ], $errorMessage);
      
      return $validator;
    }

    public function set_store(Store $Store){
      $User = Auth::user();
      $User->toko_id = $Store->id;
      return $User->save();
    }

    public function save_store(Request $request, Store $Store){
      $Store->store_name = $request['nama_toko'];
      $Store->store_location = $request['lokasi'];
      return $Store->save();
    }

    public function create(Request $request){
      $this->validator($request)->validate();

      $store = new Store();
      $this->save_store($request, $store);
      $this->set_store($store);

      return redirect('toko/detail')->with('message', 'Berhasil membuat Kedai baru');
    }


    public function register(Request $request){
      $id_penjual = Auth::user()->id;
      $penjual = User::find($id_penjual);
      $penjual->toko_id = $request['toko_id'];
      $penjual->is_user_verified = false;
      $penjual->save();

      return redirect('toko/detail')->with('message', 'Berhasil mendaftar pada Kedai');
    }


    public function edit(Request $request, $store_id){
      if(!empty(Auth::user()->toko_id)){
        if(Auth::user()->toko_id == $store_id){
          if($data['toko'] = Store::find($store_id)){
            $this->validator($request)->validate();
            $store = Store::findOrFail($store_id);
            if ($this->save_store($request, $store)){
              $this->set_store($store);
              return redirect('toko/detail')->with('message', 'Berhasil mengubah informasi Kedai');
            } else {
              return redirect('toko/detail')->withErrors('Gagal mengubah informasi Kedai');
            }
          } else {
            return redirect('toko/detail')->withErrors('Kedai tidak ditemukan..');
          }
        } else {
          return redirect('403')->withErrors('Anda tidak berhak mengakses Kedai orang lain!');
        }
      } else {
        return view('store.edit')->withErrors('Anda belum terdaftar pada Kedai manapun');
      }

    }

    public function delete(Request $request){
      $toko_id = $request['toko_id'];

      $users = User::where('toko_id',$toko_id)->get();
      foreach ($users as $user) {
        $user->toko_id = NULL;
        $user->save();
      }

      $toko = Store::findOrFail($toko_id);
      if(!empty($toko)){
        $toko->delete();
        return redirect('toko/lihat')->with('message', 'Berhasil menghapus toko');
      } else {
        return redirect('toko/lihat')->withErrors('Gagal Menghapus Toko');
      }
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
      return redirect('toko/detail')->with('status', 'Berhasil mengubah status toko');
    }

    public function detail_index(){
      $data['user'] = Auth::user();
      $data['store'] = Store::find(Auth::user()->toko_id);
      return view('store.detail', $data);
    }
}
