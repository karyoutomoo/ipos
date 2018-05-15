@extends('adminlte::page')

@section('title', 'IPOS - Status')

@section('css')
  {{-- expr --}}
@endsection

@section('content_header')
  <h1>Status Pemesanan</h1>
@endsection

@section('content')
  <div>
    Status Pemesanan:
    <table class="table">
      <thead>
        <tr>
          <th>Nomor Pemesanan</th>
          <th>Item</th>
          <th>Qty</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($orders as $item)
          <tr>
            <td>{{ $item->order_id }}</td>
            <td>{{ $item->menu_name }}</td>
            <td>{{ $item->qty }}</td>
            <td>{{ $item->order_item_status }}</td>
            <td>
            @if ($user_role == 0)
              @if ($item->order_item_status == "MENUNGGU")
                <form method="POST" action="{{url('/pemesanan/status/cancel')}}">
                  {{csrf_field()}}
                  <input type="hidden" name="order_item_id" value="{{$item->order_id}}">
                  <button type="submit" class="btn btn-danger">Batalkan</button>
                </form>
              @elseif($item->order_item_status == "LUNAS")
                <form method="POST" action="{{url('/pemesanan/status/ask')}}">
                  {{csrf_field()}}
                  <input type="hidden" name="order_item_id" value="{{$item->order_id}}">
                  <button type="submit" class="btn btn-default">Minta Tukar</button>
                </form>
              @else
                ----
              @endif
            @elseif ($user_role == 1)
              @if ($item->order_item_status == "MENUNGGU")
                <form method="POST" action="{{url('/pemesanan/status/accept')}}">
                  {{csrf_field()}}
                  <input type="hidden" name="order_item_id" value="{{$item->order_id}}">
                  <button type="submit" class="btn btn-default">Terima</button>
                </form>
              @elseif($item->order_item_status == "MOHON TUKAR")
                <form method="POST" action="{{url('/pemesanan/status/close')}}">
                  {{csrf_field()}}
                  <input type="hidden" name="order_item_id" value="{{$item->order_id}}">
                  <button type="submit" class="btn btn-default">Tukarkan</button>
                </form>
              @else
                ----
              @endif
            @elseif($user_role == 2)
              @if ($item->order_item_status == "DITERIMA")
                <form method="POST" action="{{url('/pemesanan/status/pay')}}">
                  {{csrf_field()}}
                  <input type="hidden" name="order_item_id" value="{{$item->order_id}}">
                  <button type="submit" class="btn btn-default">Lunasi</button>
                </form>
              @else
                ----
              @endif
            @endif
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection