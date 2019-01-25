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

  @if (count($post->categories) > 0)
    <div class="">Categories:
      @foreach ($post->categories as $category)
        <span class="badge badge-primary badge-lg">
          {{ $category->name }}
        </span>
      @endforeach
    </div>
  @endif

  @if (count($post->tags) > 0)
    <div class="">Tags:
      @foreach ($post->tags as $tag)
        <span class="badge badge-secondary badge-lg">
          {{ $tag->name }}
        </span>
      @endforeach
    </div>
  @endif

@endsection
