@extends('adminlte::page')

@section('title','IPOS - Pesanan Toko')

@section('content_header')
  <h1>Status Pesanan Toko {{$store_name}}</h1>
@endsection

@section('content')
  <div>
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
                <form method="POST" action="{{url('/pemesanan/toko/accept')}}">
                  {{csrf_field()}}  
                  <input type="hidden" name="order_item_id" value="{{$item->id}}">
                  <button type="submit" class="btn btn-default">Terima</button>  
                </form>
              @elseif($item->order_item_status == "MOHON TUKAR")
                <form method="POST" action="{{url('/pemesanan/toko/close')}}">
                  {{csrf_field()}}
                  <input type="hidden" name="order_item_id" value="{{$item->id}}">
                  <button type="submit" class="btn btn-default">Tukarkan</button>
                </form>
              @elseif($item->order_item_status == "DITERIMA")
                Pesanan Diterima, Tunggu Pembeli Melunasi Pesanan
              @elseif($item->order_item_status == "LUNAS")
                Pesanan Siap Ditukarkan, Tunggu Pembeli Mohon Tukar
              @elseif($item->order_item_status == "SUDAH DITUKARKAN")
                Pesanan Selesai, Jangan Lupa Ajak Pembeli untuk Mengulas Sajian Anda
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