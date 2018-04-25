@extends('adminlte::page')

@section('title', 'IPOS - Food')

@section('content_header')
  <h1>Daftar Makanan</h1>
@endsection

@section('content')
  {{-- 
  @if ($fx->count())
    @foreach ($fx as $f)
      {{ $f->id }}
      {{ $f->name }}
      {{ $f->outlet }}
      {{ $f->description }}
      {{ $f->price }}
      {{ $f->availability }}
      <br>
    @endforeach
  @else
    <div>
      Data Makanan Tidak Ditemukan
    </div>
  @endif

  <div class="card">
    <img class="card-img-top" src="image/soto.jpg" alt="Soto Ayam Lamongan">
    <div class="card-body">
      <h5 class="card-title">Soto Ayam Lamongan Bu Kana</h5>
      <p class="card-text">Telah berdiri sejak 1983, selalu setia melayani civitas ITS</p>
    </div>
  </div>
  
  <div class="card">
    <img class="card-img-top" src="image/tehpoci.jpg" alt="Teh Poci">
    <div class="card-body">
      <h5 class="card-title">Teh Poci</h5>
      <p class="card-text">Rasakan kesegarannya!</p>
    </div>
  </div>
  --}}

  <div class="row">
    <div class="col-sm-6 col-md-4">
      <div class="thumbnail">
        <img src="image/soto.jpg" alt="Soto Ayam Bu Kana">
        <div class="caption">
          <h3>Soto Ayam Lamongan</h3>
          <p>Telah berdiri sejak 1983, Soto ayam bu Kana telah setia melayani civitas akademika dan terjamin kualitas rasanya</p>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-md-4">
      <div class="thumbnail">
        <img src="image/tehpoci.jpg" alt="Teh Poci Bu Wahyu">
        <div class="caption">
          <h3>Teh Poci</h3>
          <p>Teh Poci Bu Wahyu: Sehat, Menyegarkan!</p>
        </div>
      </div>
    </div>
  </div>


@endsection

@section('css')
  {{-- 
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"> 

  <style type="text/css">
    .card-img-top{
      width:20rem;
    }
  </style>
  --}}
@endsection

@section('js')
  {{-- 
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script> 
  --}}
@endsection