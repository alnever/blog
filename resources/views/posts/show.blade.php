@extends('layouts.dashboard')

@section('title', '| View post')

@section('content')
  <div class="row">
    <!-- post area -->
    <div class="col-md-8">
      <h1 class="text-center">{{ $post->title }}</h1>
      <hr class="my-4" />
      <p>{!! $post->content !!}</p>
      <hr>

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

      <!-- comments -->
      @if (count($comments) > 0)
        <h3>Comments:</h3>
        <table class="table">
          <thead>
            <th>#</th>
            <th>Author</th>
            <th>Text</th>
            <th>Posted At</th>
            <th></th>
          </thead>
          <tbody>
            @foreach ($comments as $comment)
              <tr class="align-top {{ $comment->approved == 1 ? 'bg-light' : '' }}">
                <td>
                  {{ $comment->id }}
                  @if ( $comment->approved )
                    @include('icons.approved')
                  @endif
                </td>
                <td>{{ $comment->user->name }}</td>
                <td>{{ $comment->content }}</td>
                <td style="white-space:nowrap;">{{ date('M d, y H:i:s', strtotime($comment->created_at)) }}</td>
                <td class="d-flex flex-row justify-content-end">
                  {{ Form::open(['route' => ['comments.update',$comment->id], 'method' => 'PUT'])}}
                  @if ($comment->approved == 1)
                    {{ Form::hidden('approved', 0)}}
                    {{ Form::submit('Disapprove',['class' => 'btn btn-outline-danger'])}}
                  @else
                    {{ Form::hidden('approved', 1)}}
                    {{ Form::submit('Approve',['class' => 'btn btn-outline-success'])}}
                  @endif

                  {{ Form::close() }}
                  {{ Form::open(['route' => ['comments.destroy',$comment->id], 'method' => 'DELETE'])}}
                    {{ Form::submit('Delete',['class' => 'btn btn-outline-danger'])}}
                  {{ Form::close() }}
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
        <div class="d-flex flex-row justify-content-center">
          {{ $comments->links() }}
        </div>
      @endif
      <!-- comments end -->
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
