@extends('adminlte::page')

@section('title', 'IPOS - Food')

@section('content_header')
  <h1>Daftar Makanan</h1>
@endsection

@section('content')  
  @if ($user_role)
    <a href="/makanan/buat" class="btn btn-primary">Buat Makanan</a>
  @endif
  @if ($makanans->count())
      <div class="row">
    @foreach ($makanans as $makanan)
        <div class="col-sm-6 col-md-4">
          <div class="thumbnail">
            <a href="{{asset($makanan->menu_imagepath)}}">
              <img src="{{asset($makanan->menu_imagepath)}}" alt="{{$makanan->menu_name}}">
            </a>
            <div class="caption">
              <h2>{{$makanan->menu_name}}</h2>
              <p>{{$makanan->menu_description}}</p>
              <p>
                @if ($makanan->menu_type)
                  Minuman
                @else
                  Makanan
                @endif 
                oleh {{$makanan->store_name}}
              </p>
              <p>
                <h3>
                  Rp. {{$makanan->menu_price}}
                </h3>
              </p>
              <p>
                <form method="POST" action="{{url('/makanan/toggle/')}}">
                  {{csrf_field()}}
                  <input type="hidden" name="menu_id" value="{{$makanan->id}}">
                  Status: 
                  @if ($makanan->menu_status)
                    <button class="btn btn-success">Ada</button>
                  @else
                    <button class="btn btn-warning">Habis</button>
                  @endif

                  @if ($user_role)
                    <button type="submit" class="btn btn-default">Ganti</button>
                  @endif
                </form>
              </p>
            </div>
            @if ($user_role)
            <div>
              <a href="{{url('/makanan/edit/'.$makanan->id)}}" role="button" class="btn btn-primary">Edit Makanan</a>
            </div>
            @endif
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
