@extends('adminlte::page')

@section('title', 'IPOS - Food')

@section('content_header')
  <h1>Daftar Makanan</h1>
@endsection

@section('content')
  @if ($fx->count())
    @foreach ($fx as $f)
      {{ $f->id }}
      {{ $f->name }}
      {{ $f->outlet }}
      {{ $f->description }}
      {{ $f->price }}
      {{ $f->availability }}
      <br>
    @endforeach
  @else
    <div>
      Data Makanan Tidak Ditemukan
    </div>
  @endif
@endsection