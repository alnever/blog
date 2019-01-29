<!-- comment list -->
@if (count($comments) > 0)
  @foreach ($comments as $comment)
    @if ($comment->approved && $comment->approved == 1)
      <div class="border border-light rounded p-2 mt-2 comment" data-level="{{ $comment->level }}">
        <p>{{ $comment->content }}</p>
        <div class="small">
          Posted By: {{ $comment->user->name }}
          Posted At: {{ $comment->created_at }}
          @auth
            <a class="text-success reply-link" href="javascript:void(0)">Reply</a>
            <div class="comment-form" style="display: none;">
              {{ Form::open(['route' => 'comments.store', 'method' => 'POST']) }}
                {{ Form::label('content','Your comment:') }}
                {{ Form::textarea('content', null, ['class' => 'form-control', 'rows' => 3]) }}

                {{ Form::hidden('post_id', $post->id) }}
                {{ Form::hidden('user_id', Auth::user()->id) }}
                {{ Form::hidden('comment_id', $comment->id) }}
                {{ Form::hidden('level', $comment->level) }}

                {{ Form::submit('Save comment', ['class' => 'btn btn-secondary mt-2']) }}

              {{ Form::close() }}
            </div>
          @endauth
        </div>
      </div>

      <!-- include this template recursive to show child comments -->
      @if (count($comment->comments) > 0)
          @include('partials._comments', ['comments' => $comment->comments])
      @endif
    @endif
  @endforeach
@endif
