@extends('adminlte::page')

@section('title', 'IPOS - Profile')

@section('content_header')
  <h1>Profile</h1>
@endsection

@section('content')
  <div>
    Your profile:
    <table class="table">
      <thead>
        <tr>
          <th>Name</th>
          <th>Email</th>
          <th>Role</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Brian</td>
          <td>brian{{'@'}}gmail.com</td>
          <td>Customer</td>
        </tr>
      </tbody>
    </table>
  </div>
@endsection