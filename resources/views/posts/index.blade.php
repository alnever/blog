@extends('layouts.dashboard')

@section('title','| Posts')

@section('content')
  <!-- header of the table -->
  <div class="row">
    <div class="col-md-9">
        <h1>All Posts</h1>
    </div>
    <div class="col-md-3" style="white-space:nowrap;">
      <a href="{{ route('posts.create') }}" class="btn btn-lg btn-success btn-block">Add New Post</a>
    </div>
  </div>

  <!-- posts zone -->
  <div class="row mt-2">
    <div class="col-md-12">

      <!-- posts list -->
      <table class="table">
        <thead class="thead-light">
          <th>#</th>
          <th>Title</th>
          <th style="white-space:nowrap;">Created At</th>
          <th></th>
        </thead>
        <tbody>
          @foreach ($posts as $post)
            <tr>
              <td>{{ $post->id }}</td>
              <td>
                <!-- title and link to view -->
                <a href="{{ route('posts.show', $post->id) }}">
                  {{ $post->title }}
                </a>
                <!-- content excerpt -->
                <p>{{ Str::words($post->content,20) }}</p>
              </td>
              <td style="white-space:nowrap;">
                <!-- create date -->
                {{ date("M d, y", strtotime($post->created_at)) }}
              </td>
              <td>
                <!-- operation buttons -->
                <div class="d-flex flex-row justify-content-between">
                  <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-light">Edit</a>
                  {{ Form::open(['route' => ['posts.destroy', $post->id], 'method' => 'DELETE']) }}
                    {{ Form::submit('Delete', ['class' => 'btn btn-sm btn-light'])}}
                  {{ Form::close() }}
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table> <!-- end of posts list -->

      <!-- pagination -->
      <div class="d-flex flex-row justify-content-center">
        {{ $posts->links() }}
      </div>
    </div>
  </div> <!-- end of posts zone -->

@endsection
