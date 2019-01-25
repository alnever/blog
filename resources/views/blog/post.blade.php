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
        <a href="{{ route('category.single', $category->slug) }}" class="badge badge-primary">
          {{ $category->name }}
        </a>
      @endforeach
    </div>
  @endif

  @if (count($post->tags) > 0)
    <div class="">Tags:
      @foreach ($post->tags as $tag)
        <a href="{{ route('tag.single', $tag->name) }}" class="badge badge-secondary">
          {{ $tag->name }}
        </a>
      @endforeach
    </div>
  @endif

@endsection
