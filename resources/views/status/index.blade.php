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
    Pemesanan Atas Nama: {{$user_name}}
    <table class="table">
      <thead>
        <tr>
          <th>No.</th>
          <th>Pesanan</th>
          <th>Jumlah</th>
          <th>Status</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($orders as $item)
          <tr>
            <td>{{ $item->order_id }}</td>
            <td>{{ $item->menu_name }}</td>
            <td>{{ $item->qty }}</td>
            <td>{{ $item->order_item_status }}</td>
            <td>
            @if ($item->order_item_status == "MENUNGGU")
              <form method="POST" action="{{url('/pemesanan/status/cancel')}}">
                {{csrf_field()}}
                <input type="hidden" name="order_item_id" value="{{$item->id}}">
                <button type="submit" class="btn btn-danger">Batalkan</button>
              </form>
            @elseif($item->order_item_status == "LUNAS")
              <form method="POST" action="{{url('/pemesanan/status/ask')}}">
                {{csrf_field()}}
                <input type="hidden" name="order_item_id" value="{{$item->id}}">
                <button type="submit" class="btn btn-default">Minta Tukar</button>
              </form>
            @elseif($item->order_item_status == "DITERIMA")
              Pesanan diterima, Silahkan lunasi pesanan di kasir
            @elseif($item->order_item_status == "MOHON TUKAR")
              Pesanan sudah dapat ditukarkan, Silahkan tukarkan dengan hidangan
            @elseif($item->order_item_status == "SUDAH DITUKARKAN")
              Pesanan Selesai
            @elseif($item->order_item_status == "DIBATALKAN")
              Pesanan Dibatalkan
            @endif
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection