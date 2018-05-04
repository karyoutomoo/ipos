@extends('adminlte::page')

@section('title', 'IPOS - Pemesanan')

@section('content_header')
  <h1>Pemesanan</h1>
@endsection

@section('content')
  <div class="row">
    <div class="col-sm-6 col-md-4">
      
    </div>
  </div>
{{--
<form role="form">
  <h4>Makanan</h4>
  <div class="row">
    <div class="col-sm-6 col-md-4">
      <div class="thumbnail">
        <a href="{{url('makanan')}}">
          <img src="image/soto.jpg" alt="Soto Ayam Bu Kana">
        </a>
        <div class="caption">
          <h5>Soto Ayam Lamongan</h5>
          <h3>Rp. 10.000,-</h3>
          <div class="form-group">
            <label class="sr-only" for="sotoAmount"></label>
            <div class="input-group">
              <span class="input-group-btn">
                <button class="btn btn-default" type="button" onclick="change('sotoAmount',false)"><b>-</b></button>
              </span>
              <input type="number" min="0" class="form-control" id="sotoAmount" placeholder="Soto">
              <span class="input-group-btn">
                <button class="btn btn-primary" type="button" onclick="change('sotoAmount',true)"><b>+</b></button>
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-md-4">
      <div class="thumbnail">
        <a href="{{url('makanan')}}">
          <img src="image/waffle.jpg" alt="Dream Waffle Mbak Sri">
        </a>
        <div class="caption">
          <h5>Dream Waffle Mbak Sri</h5>
          <h3>Rp. 6.000,-</h3>
          <div class="form-group">
            <label class="sr-only" for="waffleAmount"></label>
            <div class="input-group">
              <span class="input-group-btn">
                <button class="btn btn-default" type="button" onclick="change('waffleAmount',false)"><b>-</b></button>
              </span>
              <input type="number" min="0" class="form-control" id="waffleAmount" placeholder="Waffle">
              <span class="input-group-btn">
                <button class="btn btn-primary" type="button" onclick="change('waffleAmount',true)"><b>+</b></button>
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-md-4">
      <div class="thumbnail">
        <a href="{{url('makanan')}}">
          <img src="image/sushi.jpg" alt="Hayaku Sushi">
        </a>
        <div class="caption">
          <h5>Hayaku Sushi</h5>
          <h3>Rp. 14.000,-</h3>
          <div class="form-group">
            <label class="sr-only" for="sushiAmount"></label>
            <div class="input-group">
              <span class="input-group-btn">
                <button class="btn btn-default" type="button" onclick="change('sushiAmount',false)"><b>-</b></button>
              </span>
              <input type="number" min="0" class="form-control" id="sushiAmount" placeholder="Waffle">
              <span class="input-group-btn">
                <button class="btn btn-primary" type="button" onclick="change('sushiAmount',true)"><b>+</b></button>
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <h4>Minuman</h4>
  <div class="row">
    <div class="col-sm-6 col-md-4">
      <div class="thumbnail">
        <a href="{{url('makanan')}}">
          <img src="image/tehpoci.jpg" alt="Teh Poci Bu Wahyu">
        </a>
        <div class="caption">
          <h5>Teh Poci</h5>
          <h3>Rp. 3.500,-</h3>
          <div class="form-group">
            <label class="sr-only" for="tehPociAmount"></label>
            <div class="input-group">
              <span class="input-group-btn">
                <button class="btn btn-default" type="button" onclick="change('tehPociAmount',false)"><b>-</b></button>
              </span>
              <input type="number" min="0" class="form-control" id="tehPociAmount" placeholder="Teh Poci">
              <span class="input-group-btn">
                <button class="btn btn-primary" type="button" onclick="change('tehPociAmount',true)"><b>+</b></button>
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="footer">
    <div class="container">
      <p>
        <h3 class="left">
          Total Harga:
          <span id="totalAmount">0</span> 
        </h3>
        <div class="form-group">
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Pesan</button>
        </div>
      </p>
    </div>
  </div>


  <!-- Modal -->
  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Order Confirmation</h4>
        </div>
        <div class="modal-body">
          <p>Nomor Pemesanan: 44</p>
          <table class="table fixed-layout">
            <thead>
              <tr>
                <th>Item</th>
                <th>Quantity</th>
                <th>Price</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Waffle</td>
                <td>1</td>
                <td>6000</td>
              </tr>
              <tr>
                <td>Teh Poci</td>
                <td>1</td>
                <td>3500</td>
              </tr>
              <tr>
                <td colspan="2"><b>Total Harga</b></td>
                <td>9500</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          Are You Sure ?
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          <a href="{{route('status')}}" class="btn btn-primary">Yes</a>
        </div>
      </div>

    </div>
  </div>

</form>
--}}

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
    function  change(id, plus){
      var e = document.getElementById(id);
      if (plus){
        e.value = +e.value + 1;
      } else if (e.value > 0) {
        e.value = +e.value - 1;
      } else {
        e.value = +0;
      }
    }
  </script>
@endsection