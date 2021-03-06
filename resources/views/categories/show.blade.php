@extends('layouts.dashboard')

@section('title', '| View category')

@section('content')
  <div class="row">
    <!-- category area -->
    <div class="col-md-8">
      <h1>{{ $category->name }}: {{ count($category->posts) }} post(s) </h1>

      <table class="table">
        <thead>
          <th>#</th>
          <th>Title</th>
          <th></th>
        </thead>
        <tbody>
          @foreach ($category->posts as $post)
            <tr>
              <td>{{ $post->id }}</td>
              <td>{{ $post->title }}</td>
              <td>
                <div class="d-flex flex-row justify-content-end">
                  <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-light">Edit</a>
                  {{ Form::open(['route' => ['posts.destroy', $post->id], 'method' => 'DELETE']) }}
                    {{ Form::submit('Delete', ['class' => 'btn btn-sm btn-light'])}}
                  {{ Form::close() }}
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <!-- info and service area -->
    <div class="col-md-4">
      <div class="jumbotron bg-light">
        <dl class="col-12">
          <label>Url:</label>
          <p>
              <a href="{{  route('category.single', $category->slug)  }}" target="_blank">{{ url($category->slug) }}</a>
          </p>
        </dl>
        <dl class="col-12">
          <label>Created At:</label>
          <p>{{ date('Y-m-d H:i:s', strtotime($category->created_at)) }}</p>
        </dl>
        <dl class="col-12">
          <label>Updated At:</label>
          <p>{{ date('Y-m-d H:i:s', strtotime($category->created_at)) }}</p>
        </dl>

        <hr/>

        <div class="row">
          <div class="col-sm-6">
              {{ Html::linkRoute('categories.edit', 'Edit', [$category->id], ['class' => 'btn btn-primary btn-block']) }}
          </div>
          <div class="col-sm-6">
              {{ Form::open(['route' => ['categories.destroy', $category->id], 'method' => 'DELETE']) }}
                {{ Form::submit('Delete', ['class' => 'btn btn-danger btn-block'])}}
              {{ Form::close() }}
          </div>
        </div>
        <div class="row mt-1">
          <div class="col-sm-12">
              {{ Html::linkRoute('categories.index', '<< Back to Categories List', null, ['class' => 'btn btn-secondary btn-block']) }}
          </div>
        </div>

      </div>
    </div>

  </div>

@endsection
