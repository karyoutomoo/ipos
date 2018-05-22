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
  <h1>Historis Pemesanan</h1>
@endsection

@section('content')
  @if ($orders->count())
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
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#cancel-confirmation" onclick="cancel('{{$item->id}}', '{{$item->order_id}}', '{{$item->user_name}}', '{{$item->menu_name}}', '{{$item->qty}}', '{{$item->order_item_status}}')">
                  <i class="fa-warning fa"></i>
                  Batalkan
                </button>
            @elseif($item->order_item_status == "LUNAS")
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#ask-exchange-confirmation" onclick="ask_exchange('{{$item->id}}', '{{$item->order_id}}', '{{$item->user_name}}', '{{$item->menu_name}}', '{{$item->qty}}', '{{$item->order_item_status}}')">Mohon Tukar</button>
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
  @else
    <div>
      Anda belum pernah melakukan pemesanan. <br>
      Silahkan lakukan pemesanan di halaman berikut: <a href="{{url('/pemesanan')}}" class="btn btn-primary">Pesan Baru</a>
    </div>
  @endif


  <div id="ask-exchange-confirmation" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <form class="modal-content" method="POST" action="{{url('/pemesanan/status/ask')}}">
        {{csrf_field()}}
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Konfirmasi Tukar Makanan</h4>
        </div>
        <div class="modal-body">
          <div id="order-table" class="table fixed-layout">
          </div>
          {{-- hidden input --}}
          <div id="order-form"></div>
          <p>
            Apakah Anda yakin ingin menukarkan pesanan dengan makanan ? <br>
            Status Pesanan akan berubah dari 'LUNAS' menjadi 'MOHON TUKAR' dan hanya dapat dilanjutkan oleh Penjual. <br>
            Silahkan minta tolong kepada Penjual yang bersangkutan untuk Menukarkan Pesanan.
          </p>
        </div>

        <div class="modal-footer">
          <div align="center">
            <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
            <button type="submit" class="btn btn-success">Mohon Tukar</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <div id="cancel-confirmation" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <form class="modal-content" method="POST" action="{{url('/pemesanan/status/cancel')}}">
        {{csrf_field()}}
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Konfirmasi Pembatalan</h4>
        </div>
        <div class="modal-body">
          <div id="cancel-table" class="table fixed-layout">
          </div>
          {{-- hidden input --}}
          <div id="cancel-form"></div>
          <p>
            Apakah Anda yakin ingin membatalkan pesanan ? <br>
            Status Pesanan akan berubah dari 'MENUNGGU' menjadi 'DIBATALKAN' dan tidak dapat diubah lagi. <br>
          </p>
        </div>

        <div class="modal-footer">
          <div align="center">
            <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
            <button type="submit" class="btn btn-danger">
              <i class="fa-warning fa"></i>
              Batalkan
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
@endsection

@section('js')
  <script type="text/javascript">
    function cancel(order_item_id, order_id, user_name, menu_name, qty, status){
      var table = document.getElementById('cancel-table');
      var form = document.getElementById('cancel-form');
      table.innerHTML = 
        '<div> No.     :  ' + order_id + '</div>' + 
        '<div> Pemesan : ' + user_name + '</div>' + 
        '<div> Pesanan : ' + menu_name + '</div>' + 
        '<div> Jumlah  : ' + qty + '</div>' + 
        '<div> Status  : ' + status + '</div>';
      form.innerHTML = '<input type="hidden" name="order_item_id" value="'+order_item_id+'">';
    }
    
    function ask_exchange(order_item_id, order_id, user_name, menu_name, qty, status){
      var table = document.getElementById('order-table');
      var form = document.getElementById('order-form');
      table.innerHTML = 
        '<div> No.     :  ' + order_id + '</div>' + 
        '<div> Pemesan : ' + user_name + '</div>' + 
        '<div> Pesanan : ' + menu_name + '</div>' + 
        '<div> Jumlah  : ' + qty + '</div>' + 
        '<div> Status  : ' + status + '</div>';
      form.innerHTML = '<input type="hidden" name="order_item_id" value="'+order_item_id+'">';
    }
  </script>
@endsection