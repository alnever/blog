@extends('layouts.page')

@section('title', '| 404 - page not found')

@section('content')
  <div class="display-2 text-center">
    404
  </div>
  <hr/>
  <div class="text-center">
    <p>
      Page you asked is not found!
    </p>
    <p>
      <a href="{{ route('home') }}">Go to start page</a>
    </p>
  </div>
@endsection
