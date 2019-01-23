@extends('layouts.page')

@section('title', '| Edit post')

@section('content')
  <h1>Edit post</h1>
  {{ Form::model($post, ['route' => ['posts.update', $post->id], 'method' => 'PUT']) }}
  <div class="row">

    <!-- post area -->
    <div class="col-md-8">
      {{ Form::label('title', 'Title:') }}
      {{ Form::text('title', null, ['class' => 'form-control','required']) }}

      {{ Form::label('content', 'Content:') }}
      {{ Form::textarea('content', null, ['class' => 'form-control', 'rows' => '8','required']) }}
    </div>

    <!-- info and service area -->
    <div class="col-md-4">
      <div class="jumbotron bg-light">
        <dl class="row">
          <dt class="col-sm-6">Created At:</dt>
          <dd class="col-sm-6">{{ date('Y-m-d H:i:s', strtotime($post->created_at)) }}</dd>
        </dl>
        <dl class="row">
          <dt class="col-sm-6">Updated At:</dt>
          <dd class="col-sm-6">{{ date('Y-m-d H:i:s', strtotime($post->created_at)) }}</dd>
        </dl>

        <hr/>

        <div class="row">
          <div class="col-sm-6">
              {{ Form::submit('Save', ['class' => 'btn btn-success btn-block']) }}
          </div>
          <div class="col-sm-6">
              <a href="{{ url()->previous() }}" class="btn btn-danger btn-block">Cancel</a>
          </div>
        </div>

        <div class="row mt-1">
          <div class="col-sm-12">
              {{ Html::linkRoute('posts.index', '<< Back to Posts List', null, ['class' => 'btn btn-secondary btn-block']) }}
          </div>
        </div>


      </div>
    </div> <!-- end of service area -->

  </div> <!-- end of .row -->
  {{ Form::close() }}

@endsection
