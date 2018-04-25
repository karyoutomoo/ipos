@extends('adminlte::page')

@section('title', 'IPOS - Store')

@section('content_header')
  <h1>Toko</h1>
@endsection

@section('content')
  <table class="table">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama Toko</th>
        <th>Lokasi</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>1</td>
        <td>Soto Ayam Bu Kana</td>
        <td>Selatan</td>
      </tr>
      <tr>
        <td>2</td>
        <td>Teh Poci Bu Wahyu</td>
        <td>Timur</td>
      </tr>
    </tbody>
  </table>
@endsection