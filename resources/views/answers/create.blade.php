@extends('layouts.dashboard')

@section('title', '| Answer the message')


@section('content')

  {{ Form::open(['route' => 'answers.store']) }}
    <div class="row">
      <!-- main panel -->
      <div class="col-md-8">
        <h1>Write Answer</h1>
        {{ Form::label('content', 'Content:') }}
        {{ Form::textarea('content', null, ['class' => 'form-control', 'rows' => '8','required']) }}
        {{ Form::hidden('message_id', $message->id) }}

        <hr class="my-4" />

        <h3>Original message</h3>
        <p>Topic: <strong>{{ $message->topic }}</strong></p>
        <p>
          From: <a href="mailto:{{ $message->email }}">{{ $message->email }}</a> Created At: {{ date('M d, Y H:i:s', strtotime($message->created_at)) }}
        </p>
        <p>Message:</p>
        <p>{{ $message->content }}</p>
      </div> <!-- end of main panel -->


      <!-- service panel -->
      <div class="col-md-4">
        <div class="jumbotron bg-light">
          <div class="row">
            <div class="col-sm-6">
              {{ Form::submit('Send Answer', ['class' => 'btn btn-success btn-block'])}}
            </div>
            <div class="col-sm-6">
                <a href="{{ url()->previous() }}" class="btn btn-danger btn-block">Cancel</a>
            </div>
          </div>
        </div>
      </div> <!-- end of servic panel -->

    </div> <!-- end .row -->

  {{ Form::close() }}

@endsection
