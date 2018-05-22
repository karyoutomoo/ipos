@extends('adminlte::page')

@section('title', 'IPOS - Kedai Makanan')

@section('css')
  <style type="text/css">
    td {
      word-wrap: break-word;
      min-width: 160px;
      max-width: 160px;
    }
  </style>
@endsection

@section('content_header')
  <h1>Kedai Makanan</h1>
@endsection

@section('content')
  @if ($toko->count())
  <div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Kedai Makanan</th>
          <th>Lokasi</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($toko as $t)
          <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$t->store_name}}</td>
            <td>{{$t->store_location}}</td>
            <td>
              <h5>
                <strong>
                  @if ($t->store_status)
                    <div class="text-success">BUKA</div>
                  @else
                    <div>TUTUP</div>
                  @endif
                </strong>
              </h5>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  @else
    <div class="alert alert-danger">
      Belum ada Kedai yang terdaftar pada Kantin ini. <br>
      @if ($user_role)
        Anda dapat membuat Kedai baru pada halaman berikut: <a href="{{url('toko/buat')}}" class="btn btn-primary">Buat Kedai Baru</a>
      @endif
    </div>
  @endif

  @if ($user_role && empty($seller_id))
  <div>
    Anda belum terdaftar ke Kedai manapun. <br>
    Silahkan daftarkan diri Anda pada halaman berikut: <a href="{{url('toko/daftar')}}" class="btn btn-primary">Daftar ke Toko</a> <br><br>
    Atau buat Kedai baru pada halaman berikut: <a href="{{url('/toko/buat')}}" class="btn btn-primary">Buat Kedai Baru</a>
  </div>
  @endif
@endsection