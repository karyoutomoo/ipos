@extends('adminlte::page')

@section('title', 'IPOS - Ikut Toko')

@section('content_header')
  <h1>Ikut Toko</h1>
@endsection

@section('content')
  @if ($toko->count())
    <p>
      Silahkan pilih toko anda:
      <form method="POST" action="{{url('toko/daftar')}}">
        {{csrf_field()}}
        <select name="toko_id">
          @foreach ($toko as $t)
            <option value="{{$t->id}}">{{$t->store_name}}</option>
          @endforeach
        </select>
        <button type="submit">Pilih</button>
      </form>
    </p>
  @else
    <div>
      Belum ada toko yang terdaftar
    </div>
  @endif
@endsection