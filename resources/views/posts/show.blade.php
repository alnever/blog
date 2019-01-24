@extends('layouts.dashboard')

@section('title', '| View post')

@section('content')
  <div class="row">
    <!-- post area -->
    <div class="col-md-8">
      <h1 class="text-center">{{ $post->title }}</h1>
      <hr class="my-4" />
      <p>{{ $post->content }}</p>
    </div>

    <!-- info and service area -->
    <div class="col-md-4">
      <div class="jumbotron bg-light">
        <dl class="col-12">
          <label>Url:</label>
          <p>
              <a href="{{  route('post.single', $post->slug)  }}" target="_blank">{{ url($post->slug) }}</a>
          </p>
        </dl>
        <dl class="col-12">
          <label>Created At:</label>
          <p>{{ date('Y-m-d H:i:s', strtotime($post->created_at)) }}</p>
        </dl>
        <dl class="col-12">
          <label>Updated At:</label>
          <p>{{ date('Y-m-d H:i:s', strtotime($post->created_at)) }}</p>
        </dl>
        @if ($post->category)
          <dl class="col-12">
            <label>Posted In:</label>
            <p>{{ $post->category->name }}</p>
          </dl>
        @endif

        @if (count($post->tags) > 0)
          <dl class="col-12">
            <label>Marked With:</label>
            @foreach ($post->tags as $tag)
              <span class="badge badge-secondary">
                {{ $tag->name }}
              </span>
            @endforeach
          </dl>
        @endif

        <hr/>

        <div class="row">
          <div class="col-sm-6">
              {{ Html::linkRoute('posts.edit', 'Edit', [$post->id], ['class' => 'btn btn-primary btn-block']) }}
          </div>
          <div class="col-sm-6">
              {{ Form::open(['route' => ['posts.destroy', $post->id], 'method' => 'DELETE']) }}
                {{ Form::submit('Delete', ['class' => 'btn btn-danger btn-block'])}}
              {{ Form::close() }}
          </div>
        </div>
        <div class="row mt-1">
          <div class="col-sm-12">
              {{ Html::linkRoute('posts.index', '<< Back to Posts List', null, ['class' => 'btn btn-secondary btn-block']) }}
          </div>
        </div>

      </div>
    </div>

  </div>

@endsection
