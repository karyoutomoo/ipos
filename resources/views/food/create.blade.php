@extends('adminlte::page')

@section('title', 'IPOS - Tambah Makanan')

@section('content_header')
  <h1>Makanan - Tambah</h1>
@endsection

@section('content')
  <div>
    <form method="POST" action="{{url('makanan/buat')}}" enctype="multipart/form-data">
      {{ csrf_field() }}
      <div>
        <label>Nama Makanan</label>
        <input type="text" name="nama_makanan" placeholder="Nama Makanan">
      </div>
      <div>
        <label>Harga</label>
        <input type="number" name="harga" placeholder="Harga Makanan">
      </div>
      <div>
        <label>Deskripsi</label>
        <input type="textarea" name="deskripsi" placeholder="Deskripsikan makanan semenarik mungkin">
      </div>
      <div>
        <label>Gambar</label>
        <input type="file" name="gambar_makanan">
      </div>
      <button type="submit">Submit</button>
    </form>
  </div>
@endsection