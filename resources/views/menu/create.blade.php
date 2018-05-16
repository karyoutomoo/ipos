@extends('adminlte::page')

@section('title', 'IPOS - Tambah Menu')

@section('content_header')
  <h1>Menu - Tambah</h1>
@endsection

@section('content')
  @if ($user->toko_id)
  <div>
    <form class="form-horizontal" method="POST" action="{{url('makanan/buat')}}" enctype="multipart/form-data">
      {{ csrf_field() }}
      <div class="form-group">
        <label class="control-label col-sm-2">Nama Menu</label>
        <div class="col-sm-4">
          <input class="form-control" type="text" name="nama_makanan" placeholder="Nama Menu">
        </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-2">Harga (Rp)</label>
        <div class="col-sm-4">
          <input class="form-control" type="number" name="harga" placeholder="Harga Menu">
        </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-2">Jenis</label>
        <div class="col-sm-6">
          <label class="radio-inline"><input type="radio" name="tipe_menu" value="1">Makanan</label>
          <label class="radio-inline"><input type="radio" name="tipe_menu" value="0">Minuman</label>
        </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-2">Deskripsi</label>
        <div class="col-sm-6">
          <textarea class="form-control" rows="5" name="deskripsi" placeholder="Deskripsikan menu semenarik mungkin"></textarea>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2">Gambar</label>
        <div class="col-sm-4">
          <input type="file" name="gambar_makanan">
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button class="btn btn-success" type="submit">Tambah</button>
        </div>
        
      </div>
    </form>
  </div>
  @else
  <div>
    Anda belum terdaftar toko. Silahkan coba lagi setelah terdaftar dalam toko:
    <a href="{{url('/toko/buat')}}" role="button" class="btn btn-primary">Buat Toko Baru</a>
    <a href="{{url('/toko/daftar')}}" role="button" class="btn btn-primary">Daftar ke Toko</a>
  </div>
  @endif
@endsection