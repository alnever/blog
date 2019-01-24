@extends('layouts.dashboard')

@section('title','| Tags')

@section('content')
  <!-- header of the table -->
  <div class="row">
    <div class="col-md-8">
        <h1>All Tags</h1>
        <table class="table">
          <thead class="thead-light">
            <th>#</th>
            <th>Name</th>
            <th style="white-space:nowrap;">Created At</th>
            <th></th>
          </thead>
          <tbody>
            @foreach ($tags as $tag)
              <tr>
                <td>{{ $tag->id }}</td>
                <td>
                  <!-- title and link to view -->
                  <!-- there isn't a reason to show single tag -->
                  {{ $tag->name }}
                </td>
                <td style="white-space:nowrap;">
                  <!-- create date -->
                  {{ date("M d, y", strtotime($tag->created_at)) }}
                </td>
                <td>
                  <!-- operation buttons -->
                  <div class="d-flex flex-row justify-content-between">
                    <a href="{{ route('tags.edit', $tag->id) }}" class="btn btn-sm btn-light">Edit</a>
                    {{ Form::open(['route' => ['tags.destroy', $tag->id], 'method' => 'DELETE']) }}
                      {{ Form::submit('Delete', ['class' => 'btn btn-sm btn-light'])}}
                    {{ Form::close() }}
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table> <!-- end of tags list -->

        <!-- pagination -->
        <div class="d-flex flex-row justify-content-center">
          {{ $tags->links() }}
        </div>
    </div> <!-- end of col-md-8 -->

    <!-- add tag form -->
    <div class="col-md-4">
      <h3>Add New Tag</h3>
      {{ Form::open(['route' => 'tags.store']) }}
        {{ Form::label('name', 'Name:') }}
        {{ Form::text('name', null, ['class' => 'form-control','required']) }}
        {{ Form::submit('Save tag', ['class' => 'btn btn-success btn-block mt-2'])}}
      {{ Form::close() }}
    </div>

  </div> <!-- end of row -->

@endsection
