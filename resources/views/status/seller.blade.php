@extends('adminlte::page')

@section('title','IPOS - Pesanan Kedai')

@section('content_header')
  <h1>Status Pesanan Kedai</h1>
@endsection

@section('content')
  @if (empty($toko_id))
    @if ($errors->any())
      <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
          {{$error}}
        @endforeach
      </div>
    @endif
  @else
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
                  <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#reject-confirmation" onclick="cancel('{{$item->id}}', '{{$item->order_id}}', '{{$item->user_name}}', '{{$item->menu_name}}', '{{$item->qty}}', '{{$item->order_item_status}}')">Tolak</button>
                  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#accept-confirmation" onclick="accept('{{$item->id}}', '{{$item->order_id}}', '{{$item->user_name}}', '{{$item->menu_name}}', '{{$item->qty}}', '{{$item->order_item_status}}')">Terima</button>  
              @elseif($item->order_item_status == "MOHON TUKAR")
                  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exchange-confirmation" onclick="exchange('{{$item->id}}', '{{$item->order_id}}', '{{$item->user_name}}', '{{$item->menu_name}}', '{{$item->qty}}', '{{$item->order_item_status}}')">Tukarkan</button>  
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
          <div id="reject-table" class="table fixed-layout">
          </div>
          {{-- hidden input --}}
          <div id="reject-form"></div>
          Apakah Anda yakin ingin menolak pesanan ini ? <br>
          Status Pesanan akan berubah dari 'MENUNGGU' menjadi 'DITOLAK' dan tidak dapat diubah lagi.
        </div>
        <div class="modal-footer">
          <div align="center">
            <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
            <button type="submit" class="btn btn-danger">Tolak Pesanan</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  
  <div id="accept-confirmation" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <form class="modal-content" method="POST" action="{{url('/pemesanan/toko/accept')}}">
        {{csrf_field()}}
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Konfirmasi Penerimaan</h4>
        </div>
        <div class="modal-body">
          <div id="accept-table" class="table fixed-layout">
          </div>
          {{-- hidden input --}}
          <div id="accept-form"></div>
          Apakah Anda yakin ingin menerima pesanan ini ? <br>
          Status Pesanan akan berubah dari 'MENUNGGU' menjadi 'DITERIMA' dan hanya dapat dilanjutkan oleh Kasir.
        </div>
        <div class="modal-footer">
          <div align="center">
            <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
            <button type="submit" class="btn btn-success">Terima Pesanan</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <div id="exchange-confirmation" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <form class="modal-content" method="POST" action="{{url('/pemesanan/toko/close')}}">
        {{csrf_field()}}
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Konfirmasi Tukar Makanan</h4>
        </div>
        <div class="modal-body">
          <div id="exchange-table" class="table fixed-layout">
          </div>
          {{-- hidden input --}}
          <div id="exchange-form"></div>
          <p>
            Apakah Anda yakin ingin menutup transaksi dengan menukarkan makanan ? <br>
            Status Pesanan akan berubah dari 'MOHON TUKAR' menjadi 'SUDAH DITUKARKAN' dan tidak dapat diubah lagi.
          </p>
        </div>
        <div class="modal-footer">
          <div align="center">
            <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
            <button type="submit" class="btn btn-success">Terima Pesanan</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  @endif
@endsection

@section('js')
  <script type="text/javascript">
    function cancel(order_item_id, order_id, user_name, menu_name, qty, status){
      var table = document.getElementById('reject-table');
      var form = document.getElementById('reject-form');
      table.innerHTML = 
        '<div> No.     :  ' + order_id + '</div>' + 
        '<div> Pemesan : ' + user_name + '</div>' + 
        '<div> Pesanan : ' + menu_name + '</div>' + 
        '<div> Jumlah  : ' + qty + '</div>' + 
        '<div> Status  : ' + status + '</div>';
      form.innerHTML = '<input type="hidden" name="order_item_id" value="'+order_item_id+'">';
    }

    function accept(order_item_id, order_id, user_name, menu_name, qty, status){
      var table = document.getElementById('accept-table');
      var form = document.getElementById('accept-form');
      table.innerHTML = 
        '<div> No.     :  ' + order_id + '</div>' + 
        '<div> Pemesan : ' + user_name + '</div>' + 
        '<div> Pesanan : ' + menu_name + '</div>' + 
        '<div> Jumlah  : ' + qty + '</div>' + 
        '<div> Status  : ' + status + '</div>';
      form.innerHTML = '<input type="hidden" name="order_item_id" value="'+order_item_id+'">';
    }

    function exchange(order_item_id, order_id, user_name, menu_name, qty, status){
      var table = document.getElementById('exchange-table');
      var form = document.getElementById('exchange-form');
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