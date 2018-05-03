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
          <th>Qty</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($orders as $order)
          @foreach ($order->orderItems as $item)
            <tr>
              <td>{{ $item->order_id }}</td>
              <td>{{ $item->menu->name }}</td>
              <td>{{ $item->qty }}</td>
              <td>{{ $item->status }}</td>
            </tr>
          @endforeach
        @endforeach
      </tbody>
    </table>
  </div>
@endsection