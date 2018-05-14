@extends('adminlte::page')

@section('title', 'IPOS - Tambah Menu')

@section('content_header')
  <h1>Menu - Tambah</h1>
@endsection

@section('content')
  @if ($user->toko_id)
  <div>
    <form method="POST" action="{{url('makanan/buat')}}" enctype="multipart/form-data">
      {{ csrf_field() }}
      <div>
        <label>Nama Menu</label>
        <input type="text" name="nama_makanan" placeholder="Nama Menu">
      </div>
      <div>
        <label>Harga</label>
        <input type="number" name="harga" placeholder="Harga Menu">
      </div>
      <div>
        <label>Deskripsi</label>
        <input type="textarea" name="deskripsi" placeholder="Deskripsikan menu semenarik mungkin">
      </div>
      <div class="radio">
        <label class="radio-inline"><input type="radio" name="tipe_menu" value="0">Makanan</label>
        <label class="radio-inline"><input type="radio" name="tipe_menu" value="1">Minuman</label>
      </div>
      <div>
        <label>Gambar</label>
        <input type="file" name="gambar_makanan">
      </div>
      <button type="submit">Submit</button>
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