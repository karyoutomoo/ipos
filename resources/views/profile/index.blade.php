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
          @if ($user->role == 2)
            <th>Toko</th>
          @endif
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>{{$user->name}}</td>
          <td>{{$user->email}}</td>
          <td>
            @switch($user->role)
              @case(2)  
                Penjual
                @break
              @case(3)  
                Kasir
                @break
              @default
                Pembeli
            @endswitch
          </td>
          @if ($user->role == 2)
            <td>
              @if ($user->toko_id == 0)
                Belum ada toko
              @else
                {{$user->toko_id}}
              @endif
            </td>
          @endif
        </tr>
{{--         <tr>
          <td>Brian</td>
          <td>brian{{'@'}}gmail.com</td>
          <td>Customer</td>
        </tr> --}}
      </tbody>
    </table>
  </div>
@endsection