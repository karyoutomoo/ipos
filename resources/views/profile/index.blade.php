@extends('adminlte::page')

@section('title', 'IPOS - Profile')

@section('content_header')
  <h1>Profile</h1>
@endsection

@section('content')
  <div class="table-responsive">
    Your profile:
    <table class="table">
      <thead>
        <tr>
          <th>Name</th>
          <th>Email</th>
          <th>Role</th>
          {{-- If penjual, tampilkan toko --}}
          @if ($user->user_role)
            <th>Toko</th>
            <th>Action</th>
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
          @if ($user->user_role)
            @if ($user->toko_id)
              <td>
                {{$store->store_name}}
              </td>
              <td>
                <form method="POST" action="{{url('profile')}}">
                  {{csrf_field()}}
                  <input type="hidden" name="_method" value="PUT">
                  <button type="submit" class="btn btn-danger">Keluar Toko</button>
                </form>
              </td>
            @else
              <td>
                Belum ada toko
              </td>
              <td>
                <a href="{{url('toko')}}" role="button" class="btn btn-primary">Ikut Toko</a>
              </td>
            @endif
          @endif
        </tr>
      </tbody>
    </table>
  </div>
@endsection