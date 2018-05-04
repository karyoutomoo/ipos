@extends('adminlte::page')

@section('title', 'IPOS - Tambah Toko')

@section('content_header')
  <h1>Tambah Toko</h1>
@endsection

@section('content')
  <form method="POST" action="{{url('toko/buat')}}">
    {{csrf_field()}}
    <input type="text" name="nama_toko" placeholder="Nama Toko">
    <input type="text" name="lokasi" placeholder="Lokasi">
    <button type="submit">Submit</button>
  </form>
@endsection