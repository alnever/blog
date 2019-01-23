@extends('layouts.dashboard')

@section('title', '| Create post')

@section('content')
  <h1>Create post</h1>


  {{ Form::open(['route' => 'posts.store']) }}
    <div class="row">
      <!-- main panel -->
      <div class="col-md-8">
        {{ Form::label('title', 'Title:') }}
        {{ Form::text('title', null, ['class' => 'form-control','required']) }}

        {{ Form::label('slug', 'Slug:') }}
        {{ Form::text('slug', null, ['class' => 'form-control','required']) }}

        {{ Form::label('content', 'Content:') }}
        {{ Form::textarea('content', null, ['class' => 'form-control', 'rows' => '8','required']) }}
      </div> <!-- end of main panel -->

      <!-- service panel -->
      <div class="col-md-4">
        <div class="jumbotron bg-light">
          <div class="row">
            <div class="col-sm-6">
              {{ Form::submit('Save post', ['class' => 'btn btn-success btn-block'])}}
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
