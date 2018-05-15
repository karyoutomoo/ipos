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
        </tr>
      </thead>
      <tbody>
        @foreach ($reviews as $review)
          <tr>
            <td>{{ $review->menu->menu_name }}</td>
            <td>{{ $review->menu->store->store_name }}</td>
            <td>{{ $review->rating }}</td>
            <td>{{ $review->content }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <!-- Modal -->
  <div id="add-review" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <form class="modal-content form" method="POST" action="{{ action('ReviewsController@store') }}">
        {{ csrf_field() }}
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Beri ulasan</h4>
        </div>
        <div class="modal-body">
          <div id="menu-selected"></div>
          <div id="store-selected"></div>
          <input id="menu-selected-id" type="hidden" name="menu">
          <div class="form-group">
            <label for="rating">Nilai</label>
            <input id="rating" type="number" min="1" max="5" name="rating" placeholder="Nilai" required>
          </div>
          <div class="form-group">
            <label for="content">Ulasan</label>
            <textarea id="content" name="content" placeholder="Ulasan"></textarea>
          </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Batalkan</button>
            <button type="submit" class="btn btn-primary">Ulas</button>
          </form>
        </div>
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
      }
    })
  </script>
@endsection