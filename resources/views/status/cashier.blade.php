@extends('adminlte::page')

@section('title','IPOS - Pemesanan Kasir')

@section('content_header')
  <h1>Status Pesanan Kasir</h1>
@endsection

@section('content')
  <div>
    Melayani Pemesanan:
    <table class="table">
      <thead>
        <tr>
          <th>No.</th>
          <th>Pemesan</th>
          <th>Pesanan</th>
          <th>Jumlah</th>
          <th>Status</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($items as $item)
          <tr>
            <td>{{$item->order_id}}</td>
            <td>{{$item->user_name}}</td>
            <td>{{$item->menu_name}}</td>
            <td>{{$item->qty}}</td>
            <td>{{$item->order_item_status}}</td>
            <td>
              @if ($item->order_item_status == 
                "MENUNGGU")
                Pesanan Dibuat, Tunggu Penjual Menerima Pesanan
              @elseif($item->order_item_status == "MOHON TUKAR")
                Pembeli Siap Ditukarkan
              @elseif($item->order_item_status == "DITERIMA")
                <form method="POST" action="{{url('/pemesanan/kasir/pay')}}">
                  {{csrf_field()}}  
                  <input type="hidden" name="order_item_id" value="{{$item->id}}">
                  <button type="submit" class="btn btn-default">Lunasi</button>  
                </form>
              @elseif($item->order_item_status == "LUNAS")
                Pesanan Siap Ditukarkan
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