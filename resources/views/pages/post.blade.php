@extends('layouts.page')

@section('title', '| Post')

@section('content')
  <h1 class="display-4 text-center">{{ $post->title }}</h1>
  <hr class="my-4" />
  <p>
    <small>Created At: {{ date('M d, y', strtotime($post->created_at)) }}</small>
  </p>
  <p>{{ $post->content }}</p>
  <hr />
  @if ($post->category)
    <p>Posted In: {{ $post->category->name }}</p>
  @endif

  @if (count($post->tags) > 0)
    <p>
      Tags:
      @foreach ($post->tags as $tag)
        <span class="badge badge-secondary">
          {{ $tag->name }}
        </span>
      @endforeach
    </p>
  @endif
@endsection
