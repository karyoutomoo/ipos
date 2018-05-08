@extends('adminlte::page')

@section('title', 'IPOS - Change Password')

@section('content_header')
  <h1>Change Password</h1>
@endsection

@section('content')
  <div>
    <form method="POST" action="{{url('/password')}}">
      {{csrf_field()}}
      <div class="form-group">
        <label>Old Password</label>
        <input type="password" name="old_pass">
      </div>
      <div class="form-group">
        <label>New Password</label>
        <input type="password" name="new_pass">
      </div>
      <div class="form-group">
        <label>Retype New Password</label>
        <input type="password" name="new_pass_second">
      </div>
      <button type="submit" class="btn btn-primary">Change</button>
    </form>
  </div>
@endsection