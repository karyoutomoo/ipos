@extends('adminlte::page')

@section('title', 'IPOS - Toko')

@section('content_header')
  <h1>Toko</h1>
@endsection

@section('content')
  @if ($toko->count())
    <table class="table">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Toko</th>
          <th>Lokasi</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($toko as $t)
          <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$t->store_name}}</td>
            <td>{{$t->store_location}}</td>
            <td>
              @if ($t->store_status)
                Buka
              @else  
                Tutup
              @endif
            </td>          
          </tr>
        @endforeach
      </tbody>
    </table>
  @else
    Belum ada toko yang terdaftar
  @endif
  <p style="margin:10px 0;">
    <a href="{{url('toko/buat')}}" class="btn btn-primary">Buat Toko Baru</a>
    <a href="{{url('toko/daftar')}}" class="btn btn-primary">Daftar ke Toko</a>
  </p>
@endsection