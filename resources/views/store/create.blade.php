@extends('adminlte::page')

@section('title', 'IPOS - Buat Kedai Baru')

@section('content_header')
  <h1>Buat Kedai Baru</h1>
@endsection

@section('content')
  <form class="form-horizontal" method="POST" action="{{url('toko/buat')}}">
    {{csrf_field()}}
    <div class="form-group">
      <label class="control-label col-sm-2">Nama Kedai</label>
      <div class="col-sm-4">
        <input class="form-control" type="text" name="nama_toko" placeholder="Nama Toko" required>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2">Lokasi Kedai</label>
      <div class="col-sm-6">
        <textarea class="form-control" rows="5" name="lokasi" placeholder="Lokasi Kedai, Deskripsi, maupun Keterangan lainnya dapat disertakan di sini" required></textarea>
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <a href="{{url('toko/lihat')}}" class="btn btn-default">Kembali</a>
        <button class="btn btn-success" type="submit">Buat</button>
      </div>
    </div>
  </form>
@endsection