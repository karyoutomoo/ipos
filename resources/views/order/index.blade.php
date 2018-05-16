@extends('adminlte::page')

@section('title', 'IPOS - Pemesanan')

@section('content_header')
  <h1>Pemesanan</h1>
@endsection

@section('content')

<link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.css">
    <!-- put first the jquery path, otherwise the bootstrap.js won't work-->
    <script src="js/jquery/jquery-3.1.0.js"></script>
    <script src="plugins/bootstrap/js/bootstrap.min.js"></script>

<h4>Makanan</h4>
<div class="row">
  @foreach ($foods as $food)
    <div class="col-sm-6 col-md-4">
      <div class="menu thumbnail" data-id="{{ $food->id }}" data-name="{{ $food->menu_name }}" data-price="{{ $food->menu_price }}">
        <a href="{{asset($food->menu_imagepath)}}">
          <img src="{{asset($food->menu_imagepath)}}" alt="{{ $food->name }}">
        </a>
        <div class="caption">
          <h4>
            {{ $food->menu_name }}
          </h4>
            @if(empty($food->rating()))
              <p>Belum ada rating</p>
            @else
              <p>Rating : 
                <strong>
                  {{ number_format($food->rating(), 2) }} / 5.00
                </strong> 
              </p>
            @endif

          <h3>Rp. {{ $food->menu_price }}</h3>

          <div class="form-group">
            <div class="input-group">
              <span class="input-group-btn">
                <button class="btn btn-default" type="button" onclick="change('{{'amountfood'.$food->id}}',false)"><b>-</b></button>
              </span>

              <input id="{{'amountfood'.$food->id}}" type="text" min="0" max="100" class="qty form-control" placeholder="0" readonly>

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
          <h4>
            {{ $beverage->menu_name }}
          </h4>
            @if(empty($beverage->rating()))
              <p>Belum ada rating</p>
            @else
              <p>Rating : 
                <strong>
                  {{ number_format($beverage->rating(), 2) }} / 5.00
                </strong> 
              </p>
            @endif

          <h3>Rp. {{ $beverage->menu_price }}</h3>

          <div class="form-group">
            <div class="input-group">
              <span class="input-group-btn">
                <button class="btn btn-default" type="button" onclick="change('{{'amountfood'.$beverage->menu_name}}',false)"><b>-</b></button>
              </span>

              <input type="text" min="0" class="qty form-control" placeholder="0" id="{{'amountfood'.$beverage->menu_name}}" readonly>

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
        <button id="orderButton" type="button" class="btn btn-success btn-lg btn-block" data-toggle="modal" data-target="#order-confirmation" onclick="order()" disabled>Pesan</button>
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
        <div align="center">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-success">Pesan</button>
        </div>  
      </div>
    </form>
  </div>
</div>
@endsection

@section('css')
  <style type="text/css">
    .footer{
      bottom:0;
      width:100%;
      text-align:center;
      color:#FFFFFF;
    }
  </style>
@endsection

@section('js')
  <script type="text/javascript">
    // to do: disable button when not ordering
    var item_selected = 0;
    
    function change(id, isPlus){
      var e = document.getElementById(id);
      if (isPlus){
        e.value = +e.value+1;
        item_selected++;
      } else if(e.value > 0){
        e.value = +e.value-1;
        item_selected--;
      } else {
        e.value = +0;
      }

      if (item_selected > 0) {
        document.getElementById('orderButton').disabled = false;
      } else {
        document.getElementById('orderButton').disabled = true;
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
            + '<td>Rp' + menu.dataset.price + '</td>'
            + '<td>Rp' + pricex + '.00</td>'
            + '</tr>';

          form.innerHTML += '<input name="items[' + menu.dataset.id + ']" type="hidden" value="' + qty + '">';
        }
      });

      document.getElementById('total').innerHTML = ('Rp' + total + '.00');      
    }
  </script>
@endsection