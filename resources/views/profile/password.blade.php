@extends('adminlte::page')

@section('title', 'IPOS - Change Password')

@section('content_header')
  <h1>Change Password</h1>
@endsection

@section('content')
  <div>
    <form method="POST" action="{{url('/password')}}" class="form-horizontal">
      {{csrf_field()}}
      <div class="form-group">
        <label class="control-label col-sm-2">Old Password</label>
        <div class="col-sm-3">
          <input class="form-control" type="password" name="old_pass" placeholder="Enter old password">
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2">New Password</label>
        <div class="col-sm-3">
          <input class="form-control" type="password" name="new_pass" placeholder="Enter new password">
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2">Retype New Password</label>
        <div class="col-sm-3">
          <input class="form-control" type="password" name="new_pass_second" placeholder="Enter new password again">
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-primary">Change</button>
        </div>
      </div>
    </form>
  </div>
@endsection