@extends('adminlte::page')

@section('title', 'IPOS - Profile')

@section('content_header')
  <h1>Profil</h1>
@endsection

@section('content')
  <div class="table-responsive">

    <table class="table">
      <thead>
        <tr>
          <th>Nama</th>
          <th>Email</th>
          <th>Peran</th>
          @if ($user->user_role == 1)
            <th>Kedai</th>
            <th>Lainnya</th>
          @endif
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>{{$user->user_name}}</td>
          <td>{{$user->email}}</td>
          <td>
            @switch($user->user_role)
              @case(1)  
                Penjual
                @break
              @case(2)  
                Kasir
                @break
              @case(3)
                Admin
                @break
              @default
                Pembeli
            @endswitch
          </td>
          @if ($user->user_role == 1)
            @if($user->toko_id)
              <td>
                {{$store->store_name}}
              </td>
              <td>
                <form method="POST" action="{{url('profile')}}">
                  {{csrf_field()}}
                  <input type="hidden" name="_method" value="PUT">
                  <button type="submit" class="btn btn-danger">Tinggalkan Kedai</button>
                </form>
              </td>
            @else
              <td>
                Belum terdaftar pada Kedai manapun.
              </td>
              <td>
                <a href="{{url('toko/daftar')}}" role="button" class="btn btn-primary">Daftar pada Kedai</a>
              </td>
            @endif
          @endif
        </tr>
      </tbody>
    </table>
  </div>
@endsection