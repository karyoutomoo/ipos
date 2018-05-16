@extends('adminlte::page')

@section('title','IPOS - Pesanan Toko')

@section('content_header')
  <h1>Status Pesanan Toko {{$store_name}}</h1>
@endsection

@section('content')
  <div class="table-responsive">
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
                  <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#reject-confirmation" onclick="cancel('{{$item->id}}', '{{$item->order_id}}', '{{$item->user_name}}', '{{$item->menu_name}}', '{{$item->qty}}', '{{$item->order_item_status}}')">Tolak</button>
                  <input type="hidden" name="order_item_id" value="{{$item->id}}">
                  <button type="submit" class="btn btn-success">Terima</button>  
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
              @elseif($item->order_item_status == "DITOLAK")
                Pesanan Ditolak
              @endif
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <div id="reject-confirmation" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <form class="modal-content" method="POST" action="{{url('/pemesanan/toko/reject')}}">
        {{csrf_field()}}
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Konfirmasi Penolakan</h4>
        </div>
        <div class="modal-body">
          <div id="order-table" class="table fixed-layout">
          </div>
          {{-- hidden input --}}
          <div id="order-form"></div>
          Apakah Anda yakin ingin menolak pesanan ini ?
        </div>

        <div class="modal-footer">
          <div align="center">
            <button type="button" class="btn btn-default">Batal</button>
            <button type="submit" class="btn btn-danger">Tolak Pesanan</button>
          </div>
        </div>
      </form>
    </div>
  </div>
@endsection

@section('js')
  <script type="text/javascript">
    function cancel(order_item_id, order_id, user_name, menu_name, qty, status){
      console.log(order_item_id);
      console.log(order_id);

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