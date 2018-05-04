@extends('adminlte::page')

@section('title', 'IPOS - Food')

@section('content_header')
  <h1>Daftar Makanan</h1>
@endsection

@section('content')
  {{-- 
  @if ($makanan->count())
    @foreach ($makanan as $f)
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
  --}}
  
  <a href="/makanan/buat" class="btn btn-primary">Buat Makanan</a>
  @if ($makanans->count())
      <div class="row">
    @foreach ($makanans as $makanan)
        <div class="col-sm-6 col-md-4">
          <div class="thumbnail">
            <a href="{{asset('storage/makanan/'.$makanan->imagepath)}}">
              <img src="{{asset('storage/makanan/'.$makanan->imagepath)}}" alt="{{$makanan->name}}">
            </a>
            <div class="caption">
              <h3>{{$makanan->name}}</h3>
              <p>{{$makanan->description}}</p>
              <p>Harga: {{$makanan->price}}</p>
            </div>
          </div>
        </div>
      {{-- 
        {{$makanan->id}}
        {{$makanan->store_id}}
       --}}
        @if ($loop->iteration % 3 == 0)
          </div>
          <div class="row">
        @endif
    @endforeach
      </div>
  @else
    <div>
      Belum ada Makanan
    </div>
  @endif
{{--   
  Soto Ayam Lamongan Bu Kana
    Telah berdiri sejak 1983, Soto ayam bu Kana telah setia melayani civitas akademika dan terjamin kualitas rasanya
  Teh Poci Bu Wahyu
    Teh Poci Bu Wahyu: Sehat, Menyegarkan!
  Dream Waffle (Mbak Sri)
    Waffle murah enak mengenyangkan. Terdapat banyak rasa: Cokelat, Keju, Susu, Vanilla, Blueberry.
  Hayaku Sushi
    Irrashaimase! Hayaku Sushi wa daisuki! Hayaku Sushi wa oishiiii desuyo! murah meriah enak
--}}


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