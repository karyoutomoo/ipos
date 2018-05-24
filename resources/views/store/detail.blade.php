@extends('adminlte::page')

@section('title','IPOS - Detail Kedai')

@section('css')
  <style type="text/css">
    .nama_kedai {
      font-size: 3em;
    }
  </style>
@endsection

@section('content_header')
  <h1>Detail Kedai</h1>
@endsection

@section('content')
  @if (!empty($user->toko_id))


  <div class="table-responsive">
    <strong class="nama_kedai">
      {{$store->store_name}}
    </strong>

    @if (session('status'))
      @if ($store->store_status)
      <div class="alert alert-success">
        <i class="fa fa-check-circle"></i>
        {{session('status')}} menjadi Buka
      </div>
      @else
      <div class="alert alert-danger">
        <i class="fa fa-warning"></i>
        {{session('status')}} menjadi Tutup
      </div>
      @endif
    @endif

    @if (session('message'))
      <div class="alert alert-success">
        <i class="fa fa-check-circle"></i>
        {{session('message')}}
      </div>
    @endif

    <p>
      Deskripsi / Lokasi : 
      {{$store->store_location}}
    </p>
    <table class="table">
      <thead>
        <tr>
          <th>Status Kedai : 
            <strong>
              @if ($store->store_status)
                <span class="text-success">
                  BUKA
                  <i class="fa fa-check-circle"></i>
                </span>
              @else
                <span class="text-warning">
                  TUTUP
                  <i class="fa fa-warning"></i>
                </span>
              @endif
            </strong>
          </th>
          <th>Kelola Kedai</th>
          <th>Lainnya</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
            <form method="POST" action="{{url('/toko/toggle')}}">
              {{csrf_field()}}
              <input type="hidden" name="_method" value="PUT">
              <input type="hidden" name="status_toko_id" value="{{$store->id}}"> 
                @if ($store->store_status)
                  <button type="submit" class="btn btn-danger">
                    Tutup Toko
                  </button> 
                @else 
                  <button type="submit" class="btn btn-success">
                    Buka Toko
                  </button> 
                @endif
            </form>
          </td>
          <td>
            <p>
              <a href="{{url('/toko/edit/'.$store->id)}}" class="btn btn-primary">
                <i class="fa fa-pencil"></i>
                Edit Kedai
              </a>
              <button type="button" class="btn btn-danger delete-button" data-toggle="modal" data-target="#delete_confirmation">
                <i class="fa fa-warning"></i>
                Hapus Kedai
              </button>
            </p>
          </td>
          <td>
            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#left_confirmation">
              Tinggalkan Kedai
            </button>
          </td>
        </tr>
      </tbody>
      <tfoot></tfoot>
    </table>
  </div>
  @else
    <div>
      Anda belum terdaftar pada Kedai manapun. <br>
      Silahkan daftarkan diri anda pada salah satu kedai di halaman berikut: 
      <a href="{{url('/toko/daftar')}}" class="btn btn-primary">Daftar pada Kedai</a>
    </div>
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
          <div>
            <div>
              Data Kedai ini:
            </div>
            <div>
              <strong class="nama_kedai">
                {{$store->store_name}}
              </strong>
              <p>
                {{$store->store_location}}
              </p>
              <p>
                Maupun <strong class="text-warning"><i class="fa fa-warning"></i> segala data pemesanan dan makanan<i class="fa fa-warning"></i></strong> yang berhubungan dengan toko akan dihapus.
                Apakah Anda Yakin ?  
              </p>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <form method="POST" action="{{url('/toko/delete')}}">
            {{csrf_field()}}
            <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
            <input type="hidden" name="_method" value="DELETE">
            <input id="delete_toko_id" type="hidden" name="toko_id" value="{{$store->id}}">
            <button type="submit" class="btn btn-danger">
              <i class="fa fa-warning"></i>
              Hapus Toko
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div id="left_confirmation" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Konfirmasi Tinggalkan Kedai</h4>
        </div>
        <div class="modal-body">
          <div>
            <p>
              Apakah Anda Yakin Ingin meninggalkan Kedai ini? <br>Anda dapat selalu mendaftar pada kedai ini lagi.
            </p>
          </div>
        </div>
        <div class="modal-footer">
          <form method="POST" action="{{url('/profile')}}">
            {{csrf_field()}}
            <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
            <input type="hidden" name="_method" value="PUT">
            <button type="submit" class="btn btn-danger">Tinggalkan</button>
          </form>
        </div>
      </div>
    </div>
  </div>

@endsection