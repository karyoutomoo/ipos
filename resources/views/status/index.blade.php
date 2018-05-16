@extends('adminlte::page')

@section('title', 'IPOS - Status')

@section('css')
  <style type="text/css">
    .new {
      background: white;
    }
  </style>
@endsection

@section('content_header')
  <h1>Status Pemesanan</h1>
@endsection

@section('content')
  <div class="table-responsive">
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
          <tr class="{{ (($last_order_id == $item->order_id)) ? 'new' : ''}}">
            <td>{{ $item->order_id }}</td>
            <td>{{ $item->menu_name }}</td>
            <td>{{ $item->qty }}</td>
            <td>{{ $item->order_item_status }}</td>
            <td>
            @if ($item->order_item_status == "MENUNGGU")
              <button id="cancelButton" type="button" class="btn btn-danger" data-toggle="modal" data-target="#cancel-confirmation" onclick="batalkan('{{$item->id}}')">Batalkan</button>
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
            @elseif($item->order_item_status == "DITOLAK")
              Pesanan Ditolak            
            @endif
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>


<!-- Modal -->
<div id="cancel-confirmation" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <!-- Modal content-->
    <form class="modal-content" method="POST" action="{{url('/pemesanan/status/cancel')}}">
      {{ csrf_field() }}
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Konfirmasi Pembatalan</h4>
      </div>

      <div class="modal-body">
        <h4>Apakah Anda ingin membatalkan pemesanan berikut?</h4>
      </div>

      <div id="order-form"></div>
    
      <div class="modal-footer">
        <div align="center">
          <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
          <button type="submit" class="btn btn-danger">Batalkan</button>
        </div>  
      </div>
    </form>
  </div>
</div>
@endsection

@section('js')
  <script type="text/javascript">
    function batalkan(item_id){
      var form = document.getElementById('order-form');

      form.innerHTML = 
      '<input type="hidden" name="order_item_id" value="' + item_id + '">';
    }
    
  </script>
@endsection