@extends('layouts.dashboard')

@section('title', '| Edit user')

@section('content')
  <h1>Edit User</h1>
  {{ Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'PUT']) }}
  <div class="row">

    <!-- user area -->
    <div class="col-md-8">
      <table class="table">
        <tr>
          <td>User name:</td>
          <td>{{ $user->name }}</td>
        </tr>
        <tr>
          <td>User email:</td>
          <td><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
        </tr>
        <tr>
          <td>User role:</td>
          <td>
            {{ Form::select('role_id', $roles, null, ['class' => 'form-control']) }}
          </td>
        </tr>
      </table>
    </div>

    <!-- info and service area -->
    <div class="col-md-4">
      <div class="jumbotron bg-light">
        <dl class="col-12">
          <label>Created At:</label>
          <p>{{ date('Y-m-d H:i:s', strtotime($user->created_at)) }}</p>
        </dl>
        <dl class="col-12">
          <label>Updated At:</label>
          <p>{{ date('Y-m-d H:i:s', strtotime($user->created_at)) }}</p>
        </dl>

        <hr/>

        <div class="row">
          <div class="col-sm-6">
              {{ Form::submit('Save', ['class' => 'btn btn-success btn-block']) }}
          </div>
          <div class="col-sm-6">
              <a href="{{ url()->previous() }}" class="btn btn-danger btn-block">Cancel</a>
          </div>
        </div>

        <div class="row mt-1">
          <div class="col-sm-12">
            {{ Html::linkRoute('users.index', '<< Back to Users List', null, ['class' => 'btn btn-secondary btn-block']) }}
          </div>
        </div>


      </div>
    </div> <!-- end of service area -->

  </div> <!-- end of .row -->
  {{ Form::close() }}

@endsection
