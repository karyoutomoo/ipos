@extends('adminlte::page')

@section('title', 'IPOS - Order')

@section('content_header')
  <h1>Pemesanan</h1>
@endsection

@section('content')
<form role="form">
  <h4>Makanan</h4>
  <div class="row">
    <div class="col-sm-6 col-md-4">
      <div class="thumbnail">
        <a href="{{route('viewfood')}}">
          <img src="image/soto.jpg" alt="Soto Ayam Bu Kana">
        </a>
        <div class="caption">
          <h5>Soto Ayam Lamongan</h5>
          <h3>Rp. 10.000,-</h3>
          <div class="form-group">
            <label class="sr-only" for="sotoAmount"></label>
            <div class="input-group">
              <span class="input-group-btn">
                <button class="btn btn-default" type="button"><b>-</b></button>
              </span>
              <input type="number" min="0" class="form-control" id="sotoAmount" placeholder="Soto">
              <span class="input-group-btn">
                <button class="btn btn-primary" type="button"><b>+</b></button>
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
        <a href="{{route('viewfood')}}">
          <img src="image/tehpoci.jpg" alt="Teh Poci Bu Wahyu">
        </a>
        <div class="caption">
          <h5>Teh Poci</h5>
          <h3>Rp. 3.500,-</h3>
          <div class="form-group">
            <label class="sr-only" for="tehPociAmount"></label>
            <div class="input-group">
              <span class="input-group-btn">
                <button class="btn btn-default" type="button"><b>-</b></button>
              </span>
              <input type="number" min="0" class="form-control" id="tehPociAmount" placeholder="Teh Poci">
              <span class="input-group-btn">
                <button class="btn btn-primary" type="button"><b>+</b></button>
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
          <button type="submit" class="btn btn-primary">Pesan</button>
        </div>
      </p>
    </div>
  </div>
</form>
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