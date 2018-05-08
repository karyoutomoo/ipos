@extends('adminlte::page')

@section('title', 'IPOS - Toko')

@section('content_header')
  <h1>Toko</h1>
@endsection

@section('content')
  @if ($toko->count())
    <table class="table">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Toko</th>
          <th>Lokasi</th>
          <th>Status</th>
          <th colspan="2">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($toko as $t)
          <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$t->store_name}}</td>
            <td>{{$t->store_location}}</td>
            <td>
              @if ($t->store_status)
                Buka
              @else  
                Tutup
              @endif
            </td>          
            <td><a href="{{url('/toko/edit/'.$t->id)}}" role="button" class="btn btn-primary">Edit Toko</a></td> 
            <td><button type="button" class="btn btn-danger delete-button" data-toggle="modal" data-target="#delete_confirmation" onclick="deleteStore('{{$t->id}}','{{$t->store_name}}','{{$t->store_location}}')">Hapus Toko</button></td>
          </tr>
        @endforeach
      </tbody>
    </table>

    {{-- Modal starts here --}}
    <div id="delete_confirmation" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Konfirmasi Penghapusan</h4>
          </div>
          <div class="modal-body">
            <p>
              Data toko berikut:
              <span id="detail_toko"></span>
              Maupun segala data pemesanan dan makanan yang berhubungan dengan toko akan dihapus. Anda yakin ?  
            </p>
          </div>
          <div class="modal-footer">
            <form method="POST" action="{{url('/toko/delete')}}">
              {{csrf_field()}}
              <button type="button" class="btn btn-default" data-dismiss="modal">Batalkan</button>
              <input type="hidden" name="_method" value="DELETE">
              <input id="delete_toko_id" type="hidden" name="toko_id" value="">
              <button type="submit" class="btn btn-danger">Hapus Toko</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  @else
    Belum ada toko yang terdaftar
  @endif
  <p style="margin:10px 0;">
    <a href="{{url('toko/buat')}}" class="btn btn-primary">Buat Toko Baru</a>
    <a href="{{url('toko/daftar')}}" class="btn btn-primary">Daftar ke Toko</a>
  </p>
@endsection

@section('js')
  <script type="text/javascript">
    function deleteStore(id_toko,nama_toko, lokasi_toko){
      var span_detail_toko = document.getElementById('detail_toko');
      var link_hapus = document.getElementById('delete_toko_id');
      span_detail_toko.innerHTML = '<h4>Toko: '+nama_toko+'<br>'+'Lokasi: '+lokasi_toko+'<br></h4>';
      link_hapus.value = id_toko;
    }

  </script>
@endsection