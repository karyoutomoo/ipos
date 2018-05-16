@extends('adminlte::page')

@section('title', 'IPOS - Tambah Toko')

@section('content_header')
  <h1>Tambah Toko</h1>
@endsection

@section('content')
  <form class="form-horizontal" method="POST" action="{{url('toko/buat')}}">
    {{csrf_field()}}
    <div class="form-group">
      <label class="control-label col-sm-2">Nama Toko</label>
      <div class="col-sm-4">
        <input class="form-control" type="text" name="nama_toko" placeholder="Nama Toko">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2">Lokasi Toko</label>
      <div class="col-sm-6">
        <textarea class="form-control" rows="5" name="lokasi" placeholder="Lokasi Toko dan keterangan lainnya dapat disertakan di sini"></textarea>
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <button class="btn btn-success" type="submit">Tambah</button>
      </div>
    </div>
  </form>
@endsection