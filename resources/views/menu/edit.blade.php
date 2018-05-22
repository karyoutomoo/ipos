@extends('adminlte::page')

@section('title', 'IPOS - Edit Menu')

@section('css')
  <style type="text/css">
    .has-error {
      margin:0.5em 0;
    }
  </style>
@endsection

@section('content_header')
  <h1>Menu - Edit</h1>
@endsection

@section('content')
  @if ($toko_id)
  <div>
    <form class="form-horizontal" method="POST" action="{{url('makanan/edit/'.$menu->id)}}" enctype="multipart/form-data">
      {{ csrf_field() }}
      <div class="form-group row">
        <label class="control-label col-sm-2 text-right">Nama Menu</label>
        <div class="col-sm-4">
          <input class="form-control" type="text" name="nama_makanan" placeholder="Nama Menu" value="{{$menu->menu_name}}" required>
          @if ($errors->has('nama_makanan'))
            <div class="alert alert-danger has-error">
              @foreach ($errors->get('nama_makanan') as $error)
                {{$error}}
              @endforeach
            </div>
          @endif
        </div>
      </div>

      <div class="form-group row">
        <label class="control-label col-sm-2 text-right">Harga (Rp)</label>
        <div class="col-sm-4">
          <input class="form-control" type="number" name="harga" min="1000" placeholder="Harga Menu" value="{{$menu->menu_price}}" required>
          @if ($errors->has('harga'))
            <div class="alert alert-danger has-error">
              @foreach ($errors->get('harga') as $error)
                {{$error}}
              @endforeach
            </div>
          @endif
        </div>
      </div>

      <div class="form-group row">
        <label class="control-label col-sm-2 text-right">Jenis</label>
        <div class="col-sm-6">
          @if ($menu->menu_type)
            <label class="radio-inline"><input type="radio" name="tipe_menu" value="0" required>Makanan</label>
            <label class="radio-inline"><input type="radio" name="tipe_menu" value="1" checked required>Minuman</label>
          @else
            <label class="radio-inline"><input type="radio" name="tipe_menu" value="0" checked required>Makanan</label>
            <label class="radio-inline"><input type="radio" name="tipe_menu" value="1" required>Minuman</label>
          @endif
          @if ($errors->has('tipe_menu'))
            <div class="alert alert-danger has-error">
              @foreach ($errors->get('tipe_menu') as $error)
                {{$error}}
              @endforeach
            </div>
          @endif
        </div>
      </div>

      <div class="form-group row">
        <label class="control-label col-sm-2 text-right">Deskripsi</label>
        <div class="col-sm-6">
          <textarea class="form-control" rows="5" name="deskripsi" placeholder="Deskripsikan menu semenarik mungkin" required>{{$menu->menu_description}}</textarea>
          @if ($errors->has('deskripsi'))
            <div class="alert alert-danger has-error">
              @foreach ($errors->get('deskripsi') as $error)
                {{$error}}
              @endforeach
            </div>
          @endif
        </div>
      </div>
      <div class="form-group row">
        <label class="control-label col-sm-2 text-right">Gambar</label>
        <strong class="text-danger">
          Mohon Upload Ulang Gambar
        </strong>
        <div class="col-sm-4">
          <input type="file" name="gambar_makanan" required>
          @if ($errors->has('gambar_makanan'))
            <div class="alert alert-danger has-error">
              @foreach ($errors->get('gambar_makanan') as $error)
                {{$error}}
              @endforeach
            </div>
          @endif
        </div>
      </div>
      <div class="form-group row">
        <div class="col-sm-offset-2 col-sm-1">
          <a href="{{url('/makanan')}}" class="btn btn-default">Kembali</a>
        </div>
        <div class="col-sm-9">
          <button class="btn btn-success" type="submit">Simpan</button>
        </div>
      </div>
    </form>
  </div>
  @else
  <div>
    Anda belum terdaftar toko. Silahkan coba lagi setelah terdaftar dalam toko:
    <a href="{{url('/toko/buat')}}" role="button" class="btn btn-primary">Buat Toko Baru</a>
    <a href="{{url('/toko/daftar')}}" role="button" class="btn btn-primary">Daftar ke Toko</a>
  </div>
  @endif
@endsection