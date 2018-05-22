@extends('adminlte::page')

@section('title','IPOS - Pemesanan Kasir')

@section('content_header')
  <h1>Status Pesanan Kasir</h1>
@endsection

@section('content')
  <div class="table-responsive">
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
                Pembeli Ingin Menukarkan Pesanan dengan Makanan
              @elseif($item->order_item_status == "DITERIMA")
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#pay-confirmation" onclick="pay('{{$item->id}}', '{{$item->order_id}}', '{{$item->user_name}}', '{{$item->menu_name}}', '{{$item->qty}}', '{{$item->order_item_status}}')">Lunasi</button>
              @elseif($item->order_item_status == "LUNAS")
                Pesanan Siap Ditukarkan
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

  <div id="pay-confirmation" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <form class="modal-content" method="POST" action="{{url('/pemesanan/kasir/pay')}}">
        {{csrf_field()}}
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Konfirmasi Pembayaran</h4>
        </div>
        <div class="modal-body">
          <div id="order-table" class="table fixed-layout">
          </div>
          {{-- hidden input --}}
          <div id="order-form"></div>
          <p>
            Apakah Anda yakin ingin mengubah status pesanan menjadi LUNAS ? <br>
            Status Pesanan akan berubah dari 'DITERIMA' menjadi 'LUNAS' dan hanya dapat dilanjutkan oleh Pembeli.
          </p>
        </div>

        <div class="modal-footer">
          <div align="center">
            <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
            <button type="submit" class="btn btn-success">Lunasi Pesanan</button>
          </div>
        </div>
      </form>
    </div>
  </div>
@endsection

@section('js')
  <script type="text/javascript">
    function pay(order_item_id, order_id, user_name, menu_name, qty, status){
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