@extends('adminlte::page')

@section('title', 'IPOS - Profile')

@section('content_header')
  <h1>Profile</h1>
@endsection

@section('content')
  <div>
    Your profile:
    <table class="table">
      <thead>
        <tr>
          <th>Name</th>
          <th>Email</th>
          <th>Role</th>
          {{-- If penjual, tampilkan toko --}}
          @if ($user->user_role == 1)
            <th>Toko</th>
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
            <td>
              @if ($user->toko_id)
                {{$store->store_name}}
              @else
                Belum ada toko
              @endif
            </td>
          @endif
        </tr>
      </tbody>
    </table>
  </div>
@endsection