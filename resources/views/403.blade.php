@extends('adminlte::page')

@section('title', 'Unauthorized Access')

@section('content_header')
  <h1>403</h1>
@endsection

@section('content')
  <p>
    Mohon Maaf, Anda tidak memiliki akses untuk halaman ini..
  </p>
  @if ($errors->any())
    <div class="alert alert-danger">
      @foreach ($errors->all() as $error)
        {{$error}}
      @endforeach
   </div>
  @endif
@endsection