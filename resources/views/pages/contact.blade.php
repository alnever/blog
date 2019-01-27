@extends('layouts.page')

@section('title', '| Contact')

@section('content')
    <h1 class="display-2 text-center">Contact</h1>
    <hr class="my-4" />

    @include('partials._messages')
    
    <form class="" action="{{ url('contact') }}" method="POST">

      {{ csrf_field() }}

      <div class="form-group">
        <label for="email">Your email:</label>
        <input type="email" class="form-control" name="email" placeholder="Enter your email here">
      </div>

      <div class="form-group">
        <label for="topic">Topic:</label>
        <input type="text" class="form-control" name="topic" placeholder="Enter your topic here">
      </div>

      <div class="form-group">
        <label for="message">Message:</label>
        <textarea class="form-control" name="message" rows="7">
        </textarea>
      </div>

      <div class="form-group">
        <button type="submit" class="btn btn-primary">Send message</button>
      </div>

    </form>

@endsection
