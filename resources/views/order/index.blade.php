@extends('adminlte::page')

@section('title', 'IPOS - Pemesanan')

@section('content_header')
  <h1>Pemesanan</h1>
@endsection

@section('content')
<h4>Makanan</h4>
<div class="row">
  @foreach ($foods as $food)
    <div class="col-sm-6 col-md-4">
      <div class="menu thumbnail" data-id="{{ $food->id }}" data-name="{{ $food->menu_name }}" data-price="{{ $food->menu_price }}">
        <a href="{{asset($food->menu_imagepath)}}">
          <img src="{{asset($food->menu_imagepath)}}" alt="{{ $food->name }}">
        </a>
        <div class="caption">
          <h5>{{ $food->menu_name }}</h5>
          <h3>Rp. {{ $food->menu_price }}</h3>

          @if(empty($food->rating()))
            <p>Belum ada rating</p>
          @else
            <p>Rating {{ number_format($food->rating(), 2) }}</p>
          @endif

          <div class="form-group">
            <div class="input-group">
              <span class="input-group-btn">
                <button class="btn btn-default" type="button" onclick="change('{{'amountfood'.$food->id}}',false)"><b>-</b></button>
              </span>
              <input id="{{'amountfood'.$food->id}}" type="number" min="0" class="qty form-control" placeholder="0">
              <span class="input-group-btn">
                <button class="btn btn-primary" type="button" onclick="change('{{'amountfood'.$food->id}}',true)"><b>+</b></button>
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
  @endforeach
</div>

<h4>Minuman</h4>
<div class="row">
  @foreach ($beverages as $beverage)
    <div class="col-sm-6 col-md-4">
      <div class="menu thumbnail" data-id="{{ $beverage->id }}" data-name="{{ $beverage->menu_name }}" data-price="{{ $beverage->menu_price }}">
        <a href="{{asset($beverage->menu_imagepath)}}">
          <img src="{{asset($beverage->menu_imagepath)}}" alt="{{ $beverage->name }}">
        </a>
        <div class="caption">
          <h5>{{ $beverage->menu_name }}</h5>
          <h3>Rp. {{ $beverage->menu_price }}</h3>

          @if(empty($beverage->rating()))
            <p>Belum ada rating</p>
          @else
            <p>Rating {{ number_format($beverage->rating(), 2) }}</p>
          @endif

          <div class="form-group">
            <div class="input-group">
              <span class="input-group-btn">
                <button class="btn btn-default" type="button" onclick="change('{{'amountfood'.$beverage->menu_name}}',false)"><b>-</b></button>
              </span>
              <input type="number" min="0" class="qty form-control" placeholder="0" id="{{'amountfood'.$beverage->menu_name}}">
              <span class="input-group-btn">
                <button class="btn btn-primary" type="button" onclick="change('{{'amountfood'.$beverage->menu_name}}',true)"><b>+</b></button>
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
  @endforeach
</div>

<div class="footer">
  <div class="container">
    <p>
      {{-- 
      <h3 class="left">
        Total Harga:
        <span id="totalAmount">0</span> 
      </h3>
       --}}
      <div class="form-group">
        <button id="orderButton" type="button" class="btn btn-primary" data-toggle="modal" data-target="#order-confirmation" onclick="order()">Pesan</button>
      </div>
    </p>
  </div>
</div>


<!-- Modal -->
<div id="order-confirmation" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <form class="modal-content" method="POST" action="{{url('pemesanan')}}">
      {{ csrf_field() }}
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Konfirmasi Pemesanan</h4>
      </div>
      <div class="modal-body">
        <table id="order-table" class="table fixed-layout">
          <thead>
            <tr>
              <th>Menu</th>
              <th>Jumlah</th>
              <th>Harga Satuan</th>
              <th>Harga</th>
            </tr>
          </thead>
          <tbody></tbody>
          <tfoot>
            <tr>
              <td colspan="3"><b>Total</b></td>
              <td id='total'></td>
            </tr>
          </tfoot>
        </table>
        <!-- Hidden inputs -->
        <div id="order-form"></div>
      </div>
      <div class="modal-footer">
          Apakah anda yakin ?
          <button type="button" class="btn btn-default" data-dismiss="modal">Batalkan</button>
          <button type="submit" class="btn btn-primary">Pesan</button>
        </form>
      </div>

  </div>
</div>
@endsection

@section('css')
  <style type="text/css">
    .footer{
      bottom:0;
      width:100%;
      text-align:center;
      background-color: orange;
      border-top:1px solid orange;
      color:#FFFFFF;
    }
  </style>
@endsection

@section('js')
  <script type="text/javascript">
    // to do: disable button when not ordering
    
    function change(id, isPlus){
      var e = document.getElementById(id);
      if (isPlus){
        e.value = +e.value+1;
      } else if(e.value > 0){
        e.value = +e.value-1;
      } else {
        e.value = +0;
      }
    }

    function order() {
      var menus = document.querySelectorAll('.menu');
      var table = document.querySelector('#order-table tbody');
      var form = document.getElementById('order-form');
      var total = 0;
      table.innerHTML = '';
      form.innerHTML = '';
      
      menus.forEach(function(menu) {
        var qty = menu.getElementsByClassName('qty')[0].value;

        if (Number(qty) > 0) {
          var pricex = Number(menu.dataset.price) * Number(qty);
          total += pricex;

          table.innerHTML += '<tr>'
            + '<td>' + menu.dataset.name + '</td>'
            + '<td>' + qty + '</td>'
            + '<td>' + menu.dataset.price + '</td>'
            + '<td>' + pricex + '</td>'
            + '</tr>';

          form.innerHTML += '<input name="items[' + menu.dataset.id + ']" type="hidden" value="' + qty + '">';
        }
      });

      document.getElementById('total').innerHTML = total;
    }
  </script>
@endsection