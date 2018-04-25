@extends('adminlte::page')

@section('title', 'IPOS - Status')

@section('css')
  {{-- expr --}}
@endsection

@section('content_header')
  <h1>Status Pemesanan</h1>
@endsection

@section('content')
  <div>
    Status Pemesanan:
    <table class="table">
      <thead>
        <tr>
          <th>Nomor Pemesanan</th>
          <th>Item</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1</td>
          <td>Soto Ayam Lamongan Bu Kana</td>
          <td>PAID</td>
        </tr>
        <tr>
          <td>2</td>
          <td>Hayaku Sushi</td>
          <td>PAID</td>
        </tr>
        <tr>
          <td>44</td>
          <td>Teh Poci</td>
          <td>REJECTED (HABIS)</td>
        </tr>
        <tr>
          <td>44</td>
          <td>Dream Waffle</td>
          <td>ACCEPTED</td>
        </tr>
      </tbody>
    </table>
  </div>
@endsection