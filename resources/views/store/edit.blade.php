@extends('adminlte::page')

@section('title', 'IPOS - Edit Toko')

@section('content_header')
  <h1>Edit Toko</h1>
@endsection

@section('content')
  <form class="form-horizontal" method="POST" action="{{url('toko/edit/'.$toko->id)}}">
    <div class="form-group">
      <label class="control-label col-sm-2">Nama Toko</label>
      <div class="col-sm-4">
        <input class="form-control" type="text" name="nama_toko" placeholder="Nama Toko" value="{{$toko->store_name}}">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2">Lokasi Toko</label>
      <div class="col-sm-6">
        <textarea class="form-control" rows="5" name="lokasi" placeholder="Lokasi Toko dan keterangan lainnya dapat disertakan di sini">{{$toko->store_location}}</textarea>
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <button class="btn btn-success" type="submit">Simpan</button>
      </div>
    </div>
  </form>
@endsection