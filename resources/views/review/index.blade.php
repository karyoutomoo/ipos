@extends('adminlte::page')

@section('title', 'IPOS - Ulasan')

@section('css')
  {{-- expr --}}
@endsection

@section('content_header')
  <h1>Ulasan</h1>
@endsection

@section('content')
  <div class="table-responsive">
    <h4>Beri ulasan:</h4>
    <table class="table">
      <thead>
        <tr>
          <th>Menu</th>
          <th>Toko</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach ($new_menus as $menu)
          <tr>
            <td>{{ $menu->menu_name }}</td>
            <td>{{ $menu->store_name }}</td>
            <td>
              <button type="button" class="btn btn-primary btn-select-menu" data-toggle="modal" data-target="#add-review"  data-menu-id="{{ $menu->id }}" data-menu-name="{{ $menu->menu_name }}" data-store-name="{{ $menu->store_name }}">Ulas</button>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <div>
    <h4>Ulasanku:</h4>
    <table class="table">
      <thead>
        <tr>
          <th>Menu</th>
          <th>Toko</th>
          <th>Nilai</th>
          <th>Ulasan</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($reviews as $review)
          <tr>
            <td>{{ $review->menu->menu_name }}</td>
            <td>{{ $review->menu->store->store_name }}</td>
            <td>{{ $review->rating }}</td>
            <td>{{ $review->content }}</td>
            <td>
              <a href="{{url('/ulasan')}}" class="btn btn-default" role="button">Edit Ulasan</a>
              <a href="{{url('/ulasan')}}" class="btn btn-danger" role="button">Hapus Ulasan</a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

<!-- Modal -->
<div id="add-review" class="modal fade" role="dialog">
<div class="modal-dialog">
  <!-- Modal content-->
  <form name="form_ulas" class="modal-content form-horizontal" method="POST" action="{{ action('ReviewsController@store') }}">
    {{ csrf_field() }}
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Beri Rating</h4>
    </div>

    <div class="modal-body">
      <div class="form-group">
        <h3><div align="center" id="menu-selected"></div></h3>
        <div align="center" id="store-selected"></div>
        <input id="menu-selected-id" type="hidden" name="menu" required>
      </div>

      <div class="form-group" align="center">
        <button id="btn_rating_1" type="button" class="btn btn-default">1</button>
        <button id="btn_rating_2" type="button" class="btn btn-default">2</button>
        <button id="btn_rating_3" type="button" class="btn btn-default">3</button>
        <button id="btn_rating_4" type="button" class="btn btn-default">4</button>
        <button id="btn_rating_5" type="button" class="btn btn-default">5</button>
        <input id="rating" type="hidden" name="rating" required>
      </div>

      <div class="form-group">
          <div class="col-sm-12">
            <textarea class="form-control" rows="5" id="content" name="content" placeholder="Tuliskan ulasan Anda ..." required></textarea>
          </div>
      </div>
    </div>

    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Batalkan</button>
      <button type="submit" class="btn btn-success">Kirim</button>
    </div>
  </form>
</div>
</div>
@endsection

@section('js')
  <script type="text/javascript">
    var btns = document.getElementsByClassName('btn-select-menu');
    Array.prototype.forEach.call(btns, function(btn) {
      btn.onclick = function() {
        document.getElementById('menu-selected-id').value = this.dataset.menuId;
        document.getElementById('menu-selected').innerHTML = this.dataset.menuName;
        document.getElementById('store-selected').innerHTML = this.dataset.storeName;
        changeRating(0);
        document.getElementById('content').value = "";
      }
    })
  </script>

  <script type="text/javascript">
    var active_rating = 0;

    function changeRating(rating) {
      if (active_rating > 0) {
        var e = document.getElementById('btn_rating_' + active_rating);
        e.classList.remove('btn-success');
        e.classList.add('btn-default');
      }

      if (rating > 0) {
        var e = document.getElementById('btn_rating_' + rating);
        e.classList.remove('btn-default');
        e.classList.add('btn-success');
        active_rating = rating;
      }
    }

    $(document).ready( function() {
        function nilai1() {
            document.form_ulas.rating.value = '1';
            changeRating(1);
        }
        function nilai2() {
            document.form_ulas.rating.value = '2';
            changeRating(2);
        }
        function nilai3() {
            document.form_ulas.rating.value = '3';
            changeRating(3);
        }
        function nilai4() {
            document.form_ulas.rating.value = '4';
            changeRating(4);
        }
        function nilai5() {
            document.form_ulas.rating.value = '5';
            changeRating(5);
        }

        $('#btn_rating_1').click(nilai1);
        $('#btn_rating_2').click(nilai2);
        $('#btn_rating_3').click(nilai3);
        $('#btn_rating_4').click(nilai4);
        $('#btn_rating_5').click(nilai5);
    });
  </script>

@endsection