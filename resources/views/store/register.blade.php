@extends('adminlte::page')

@section('title', 'IPOS - Daftar pada Kedai')

@section('content_header')
  <h1>Daftar pada Kedai</h1>
@endsection

@section('content')
  @if ($toko->count())
    <form class="form-horizontal" method="POST" action="{{url('toko/daftar')}}">
      {{csrf_field()}}
      <div class="form-group">
        <label class="control-label col-sm-2">Pilih Kedai:</label>
        <div class="col-sm-6">
          <select name="toko_id" required>
            @foreach ($toko as $t)
              <option value="{{$t->id}}">{{$t->store_name}}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <a href="{{url('toko/lihat')}}" class="btn btn-default">Kembali</a>
          <button class="btn btn-success" type="submit">Daftar</button>
        </div>
      </div>
    </form>
  @else
    <div>
      Belum ada kedai yang terdaftar
    </div>
  @endif
@endsection