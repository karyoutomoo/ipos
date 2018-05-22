@extends('adminlte::page')

@section('title', 'IPOS - Edit Kedai')

@section('content_header')
  <h1>Edit Kedai</h1>
@endsection

@section('content')
  @if ($errors->any())
    <div class="alert alert-danger">
      @foreach ($errors->all() as $error)
        {{$error}}
      @endforeach
    </div>
  @else
    <form class="form-horizontal" method="POST" action="{{url('toko/edit/'.$toko->id)}}">
      {{csrf_field()}}
      <input type="hidden" name="_method" value="PUT"> 
      <div class="form-group">
        <label class="control-label col-sm-2">Nama Kedai</label>
        <div class="col-sm-4">
          <input class="form-control" type="text" name="nama_toko" placeholder="Nama Toko" value="{{$toko->store_name}}" required>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2">Lokasi Kedai</label>
        <div class="col-sm-6">
          <textarea class="form-control" rows="5" name="lokasi" placeholder="Lokasi Toko dan keterangan lainnya dapat disertakan di sini" required>{{$toko->store_location}}</textarea>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <a href="{{url('/toko/detail')}}" class="btn btn-default">Kembali</a>
          <button class="btn btn-success" type="submit">Simpan</button>
        </div>
      </div>
    </form>
  @endif
@endsection