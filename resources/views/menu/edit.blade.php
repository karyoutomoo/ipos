@extends('adminlte::page')

@section('title', 'IPOS - Edit Menu')

@section('content_header')
  <h1>Menu - Edit</h1>
@endsection

@section('content')
  @if ($toko_id)
  <div>
    <form method="POST" action="{{url('makanan/edit/'.$menu->id)}}" enctype="multipart/form-data">
      {{ csrf_field() }}
      <div>
        <label>Nama Makanan</label>
        <input type="text" name="nama_makanan" placeholder="Nama Makanan" value="{{$menu->menu_name}}">
      </div>
      <div>
        <label>Harga</label>
        <input type="number" name="harga" placeholder="Harga Makanan" value="{{$menu->menu_price}}">
      </div>
      <div>
        <label>Deskripsi</label>
        <input type="textarea" name="deskripsi" placeholder="Deskripsikan makanan semenarik mungkin" value="{{$menu->menu_description}}">
      </div>
      <div class="radio">
        @if ($menu->menu_type)
          <label class="radio-inline"><input type="radio" name="tipe_menu" value="0">Makanan</label>
          <label class="radio-inline"><input type="radio" name="tipe_menu" value="1" checked>Minuman</label>
        @else
          <label class="radio-inline"><input type="radio" name="tipe_menu" value="0" checked>Makanan</label>
          <label class="radio-inline"><input type="radio" name="tipe_menu" value="1">Minuman</label>
        @endif
      </div>
      <div>
        <label>Mohon upload ulang gambar anda</label>
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