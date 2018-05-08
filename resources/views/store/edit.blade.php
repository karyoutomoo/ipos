@extends('adminlte::page')

@section('title', 'IPOS - Edit Toko')

@section('content_header')
  <h1>Edit Toko</h1>
@endsection

@section('content')
  <form method="POST" action="{{url('toko/edit/'.$toko->id)}}">
    <input type="hidden" name="_method" value="PUT">
    {{csrf_field()}}
    <input type="text" name="nama_toko" placeholder="Nama Toko" value="{{$toko->store_name}}">
    <input type="text" name="lokasi" placeholder="Lokasi" value="{{$toko->store_location}}">
    <button type="submit">Submit</button>
  </form>
@endsection