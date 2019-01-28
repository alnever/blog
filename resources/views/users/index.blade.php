@extends('layouts.dashboard')

@section('title','| Users')

@section('content')
  <!-- header of the table -->
  <div class="row">
    <div class="col-md-9">
        <h1>All Users</h1>
    </div>
  </div>

  <!-- users zone -->
  <div class="row mt-2">
    <div class="col-md-12">

      <!-- users list -->
      <table class="table">
        <thead class="thead-light">
          <th>#</th>
          <th>Name</th>
          <th>Email</th>
          <th>Role</th>
          <th style="white-space:nowrap;">Created At</th>
          <th></th>
        </thead>
        <tbody>
          @foreach ($users as $user)
            <tr>
              <td>{{ $user->id }}</td>
              <td>{{ $user->name }}</td>
              <td>{{ $user->email }}</td>
              <td>
                @if ($user->role)
                  {{ $user->role->name }}
                @else
                  None
                @endif
              </td>
              </td>
              <td style="white-space:nowrap;">
                <!-- create date -->
                {{ date("M d, y", strtotime($user->created_at)) }}
              </td>
              <td>
                <!-- operation buttons -->
                <div class="d-flex flex-row justify-content-end">
                  <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-light">Edit</a>
                  {{ Form::open(['route' => ['users.destroy', $user->id], 'method' => 'DELETE']) }}
                    {{ Form::submit('Delete', ['class' => 'btn btn-sm btn-light'])}}
                  {{ Form::close() }}
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table> <!-- end of users list -->

      <!-- pagination -->
      <div class="d-flex flex-row justify-content-center">
        {{ $users->links() }}
      </div>
    </div>
  </div> <!-- end of users zone -->

@endsection
