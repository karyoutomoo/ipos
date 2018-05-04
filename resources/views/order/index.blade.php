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
      <div class="menu thumbnail" data-id="{{ $food->id }}" data-name="{{ $food->name }}" data-price="{{ $food->price }}">
        <a href="{{route('viewfood')}}">
          <img src="image/soto.jpg" alt="{{ $food->name }}">
        </a>
        <div class="caption">
          <h5>{{ $food->name }}</h5>
          <h3>Rp. {{ $food->price }}</h3>
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-btn">
                <button class="btn btn-default" type="button" onclick="change('sotoAmount',false)"><b>-</b></button>
              </span>
              <input type="number" min="0" class="qty form-control" placeholder="0">
              <span class="input-group-btn">
                <button class="btn btn-primary" type="button" onclick="change('sotoAmount',true)"><b>+</b></button>
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
      <div class="menu thumbnail" data-id="{{ $beverage->id }}" data-name="{{ $beverage->name }}" data-price="{{ $beverage->price }}">
        <a href="{{route('viewfood')}}">
          <img src="image/soto.jpg" alt="{{ $beverage->name }}">
        </a>
        <div class="caption">
          <h5>{{ $beverage->name }}</h5>
          <h3>Rp. {{ $beverage->price }}</h3>
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-btn">
                <button class="btn btn-default" type="button" onclick="change('tehPociAmount',false)"><b>-</b></button>
              </span>
              <input type="number" min="0" class="qty form-control" placeholder="0">
              <span class="input-group-btn">
                <button class="btn btn-primary" type="button" onclick="change('tehPociAmount',true)"><b>+</b></button>
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
{{--         <h3 class="left">
        Total Harga:
        <span id="totalAmount">0</span> 
      </h3>
--}}        <div class="form-group">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#order-confirmation" onclick="order()">Pesan</button>
      </div>
    </p>
  </div>
</div>


<!-- Modal -->
<div id="order-confirmation" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <form class="modal-content" method="post">
      {{ csrf_field() }}
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Order Confirmation</h4>
      </div>
      <div class="modal-body">
        <!-- <p>Nomor Pemesanan: 44</p> -->
        <table id="order-table" class="table fixed-layout">
          <thead>
            <tr>
              <th>Item</th>
              <th>Qty</th>
              <th>Price</th>
              <th>Qty*Price</th>
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
          Are You Sure ?
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Yes</button>
          <!-- <a href="{{route('status')}}" class="btn btn-primary">Yes</a> -->
        </form>
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
      background-color: orange;
      border-top:1px solid orange;
      color:#FFFFFF;
    }
  </style>
@endsection

@section('js')
  <script type="text/javascript">
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