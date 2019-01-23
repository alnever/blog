@extends('layouts.page')

@section('title', '| Home')

@section('content')
  <div class="col-md-12">
    <h1 class="display-2 text-center">Laravel Blog</h1>
    <hr class="my-4" />
    <p class="lead text-center">Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
  </div>

  <div class="row">
    <!-- main region -->
    <div class="col-md-8">
      @foreach ($posts as $post)
        <div class="jumbotron bg-light">
          <h3 class="text-primary">{{ $post->title }}</h3>
          <p>
            {{ Str::words($post->content, 30) }}
          </p>
          <p class="text-right">
            <a class="btn btn-primary" href="{{ route('post.view', $post->id) }}">Read more...</a>
          </p>
        </div>
     @endforeach

     <div class="d-flex flex-row justify-content-center">
       {{ $posts->links() }}
     </div>
    </div>

    <!-- sidebar -->
    <div class="col-md-4">

    </div>
  </div>
@endsection
