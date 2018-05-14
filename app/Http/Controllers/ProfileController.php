<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Store;
use App\Order;
use DB;
use Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id_user = Auth::user()->id;
        $data['user'] = User::find($id_user); 
        $toko_user = Auth::user()->toko_id;
        if ($toko_user) {
            $data['store'] = Store::find($toko_user);
        }
        return view('profile.index', $data);
    }

    public function password_index()
    {
        return view('profile.password');
    }

    public function password(Request $request)
    {
        $user = Auth::user();
        $old_pass = bcrypt($request['old_pass']);
        $new_pass = bcrypt($request['new_pass']);
        $new_pass2 = bcrypt($request['new_pass_second']);
        // validasi: cek pass lama harus sama dengan db, harus beda dgn pass baru

        // validasi: cek pass baru harus sama dgn pass baru2

        // ganti password
        $user->password = $new_pass;
        $user->save();

        // success message
        return redirect('password');
    }

    public function left(){
        $user = Auth::user();
        $user->toko_id = NULL;
        $user->save();

        return redirect('profile')->with('Berhasill meninggalkan toko');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
