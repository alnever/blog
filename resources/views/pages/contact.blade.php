@extends('layouts.page')

@section('title', '| Contact')

@section('content')
    <h1 class="display-2 text-center">Contact</h1>
    <hr class="my-4" />
    <form class="" action="#" method="post">
      <div class="form-group">
        <label for="inputTopic">Topic</label>
        <input type="text" class="form-control" id="inputTopic" name="inputTopic" placeholder="Enter your topic here">
      </div>

      <div class="form-group">
        <label for="inputEmail">Topic</label>
        <input type="email" class="form-control" id="inputEmail" name="inputEmail" placeholder="Enter your email here">
      </div>

      <div class="form-group">
        <label for="inputText">Topic</label>
        <textarea class="form-control" id="inputText" name="inputText" rows="7">
        </textarea>
      </div>

      <div class="form-group">
        <button type="submit" class="btn btn-primary">Send message</button>
      </div>

    </form>

@endsection
