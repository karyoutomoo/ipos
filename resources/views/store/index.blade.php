@extends('adminlte::page')

@section('title', 'IPOS - Toko')

@section('content_header')
  <h1>Toko</h1>
@endsection

@section('content')
  @if ($toko->count())
  <div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Toko</th>
          <th>Lokasi</th>
          <th>Status</th>
          @if ($user_role)
          <th>Action</th>
          @endif
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
                <button class="btn btn-success">Buka</button>
              @else
                <button class="btn btn-warning">Tutup</button>
              @endif
            </td>
            @if ($user_role)
            @if ($seller_id == $t->id)
            <td>
              <form method="POST" action="{{url('/toko/toggle')}}">
                {{csrf_field()}}
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="status_toko_id" value="{{$t->id}}"> 
                  <button type="submit" class="btn btn-default">
                    @if ($t->store_status)
                      Tutup Toko
                    @else 
                      Buka Toko
                    @endif
                  </button> 
              </form>
            </td>
            @elseif($seller_id)
            <td></td>
            @else
            <td>
              <form method="POST" action="{{url('/toko/register')}}">
                {{csrf_field()}}
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="register_toko_id" value="{{$t->id}}">
                <button type="submit" class="btn btn-default">Ikut Toko</button>
              </form>
            </td> 
            @endif

            @endif
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

    @if ($seller_id == $t->id)
    <p>
      <a href="{{url('/toko/edit/'.$t->id)}}" role="button" class="btn btn-default">Edit Toko</a>
      <button type="button" class="btn btn-danger delete-button" data-toggle="modal" data-target="#delete_confirmation" onclick="deleteStore('{{$t->id}}','{{$t->store_name}}','{{$t->store_location}}')">Hapus Toko</button>
    </p>
    @endif

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

  @if ($user_role)
  <p style="margin:10px 0;">
    <a href="{{url('toko/buat')}}" class="btn btn-primary">Buat Toko Baru</a>
    <a href="{{url('toko/daftar')}}" class="btn btn-primary">Daftar ke Toko</a>
  </p>
  @endif
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