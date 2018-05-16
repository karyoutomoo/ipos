@extends('adminlte::page')

@section('title', 'IPOS - Food')

@section('content_header')
  <h1>Daftar Menu</h1>
@endsection

@section('content')
  <div class="form-group">
    {{-- Silahkan lakukan pemesanan di halaman berikut:  --}}
    <a href="{{url('pemesanan')}}" class="btn btn-primary">Pesan Menu</a>
    @if ($user_role)
      {{-- Anda Dapat mendaftarkan makanan outlet anda di halaman berikut: --}}
      <a href="{{url('/makanan/buat')}}" class="btn btn-primary">Daftarkan Menu</a>
    @endif
  </div>

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
              <h5>
                @if ($makanan->rating())
                  Rating:
                  <strong>
                    {{ number_format($makanan->rating(),2)}} / 5.00
                  </strong>
                @else 
                  Belum ada rating
                @endif
              </h5>
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
                  <strong>
                    Rp. {{$makanan->menu_price}}
                  </strong>
                </h3>
              </p>
              <p>
                <form method="POST" action="{{url('/makanan/toggle/')}}">
                  {{csrf_field()}}
                  <input type="hidden" name="menu_id" value="{{$makanan->id}}">
                  <h4>
                    Status:   
                    <strong>
                      @if ($makanan->menu_status)
                        <span class="text-success">ADA</span>
                      @else
                        HABIS
                      @endif
                    </strong>
                    @if ($user_role && $user_store == $makanan->store_id)
                      @if ($makanan->menu_status)
                        <button type="submit" class="btn btn-default">Ganti Habis</button>
                      @else
                        <button type="submit" class="btn btn-default">Ganti Ada</button>
                      @endif
                    @endif
                  </h4>
                </form>
              </p>
              @if ($user_role && $user_store == $makanan->store_id)
              <div>
                <a href="{{url('/makanan/edit/'.$makanan->id)}}" role="button" class="btn btn-primary">Edit Makanan</a>
              </div>
              @endif
            </div>
          </div>
        </div>
      @endforeach
    </div>
  @else
    <div>
      Belum ada Makanan
    </div>
  @endif
@endsection
