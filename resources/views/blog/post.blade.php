@extends('layouts.page')

@section('title', '| Post')

@section('content')
  @if ($post->featured_image)
    <img src="{{ asset('images/' . $post->featured_image) }}" />
  @endif

  <h1 class="display-4 text-center">{{ $post->title }}</h1>

  <hr class="my-4" />
  <p>
    <small>Created At: {{ date('M d, Y', strtotime($post->created_at)) }} by {{ $post->user->name }}</small>
  </p>
  <p>{!! $post->content !!}</p>
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

  <hr class="my-4" />

  <p>
    <span class="h4">Comments</span>
    {{ count($post->comments) }} total
    @auth
      <a href="javascript:bois(0)" class="text-success post-comment-link">Write a comment</a>
    @endauth
  </p>

  <!-- Comment form -->
  @include('partials._messages')

  @guest
    <p>
      You have to <a href="{{ route('login') }}">Log in</a> or <a href="{{ route('register') }}">Register</a> before you'll be able to post comments.
    </p>
  @endguest

  @auth
    <div class="border border-secondary rounded p-2 post-comment-form" style="display: none;">
      {{ Form::open(['route' => 'comments.store', 'method' => 'POST']) }}
        {{ Form::label('content','Your comment:') }}
        {{ Form::textarea('content', null, ['class' => 'form-control', 'rows' => 5]) }}

        {{ Form::hidden('post_id', $post->id) }}
        {{ Form::hidden('user_id', Auth::user()->id) }}

        {{ Form::submit('Save comment', ['class' => 'btn btn-secondary mt-2']) }}
      {{ Form::close() }}
    </div>
  @endauth

  @if (count($comments) > 0)

    <!-- pass comment to the partial template -->
    @include('partials._comments',['comments' => $comments])

    <div class="d-flex flex-row justify-content-center">
      {{ $comments->links() }}
    </div>

  @endif

@endsection

@section('scripts')
  <script type="text/javascript">
    // make diffent margins for comments of differen level
    $('.comment').each(function() {
      $(this).css('margin-left',$(this).attr('data-level')+'em');
    });
    // open from for reply link
    $('.reply-link').on('click', function() {
      $(this).siblings('.comment-form').css('display','');
    });

    $('.post-comment-link').on('click', function() {
      $('.post-comment-form').css('display','');
    });
  </script>

@endsection
