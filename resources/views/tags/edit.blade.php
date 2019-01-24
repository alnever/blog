@extends('layouts.dashboard')

@section('title', '| Edit tag')

@section('content')
  <h1>Edit tag</h1>
  {{ Form::model($tag, ['route' => ['tags.update', $tag->id], 'method' => 'PUT']) }}
  <div class="row">

    <!-- tag area -->
    <div class="col-md-8">
      {{ Form::label('name', 'Name:') }}
      {{ Form::text('name', null, ['class' => 'form-control','required']) }}
    </div>

    <!-- info and service area -->
    <div class="col-md-4">
      <div class="jumbotron bg-light">
        <dl class="col-12">
          <label>Created At:</label>
          <p>{{ date('Y-m-d H:i:s', strtotime($tag->created_at)) }}</p>
        </dl>
        <dl class="col-12">
          <label>Updated At:</label>
          <p>{{ date('Y-m-d H:i:s', strtotime($tag->created_at)) }}</p>
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
            {{ Html::linkRoute('tags.index', '<< Back to Tags List', null, ['class' => 'btn btn-secondary btn-block']) }}
          </div>
        </div>


      </div>
    </div> <!-- end of service area -->

  </div> <!-- end of .row -->
  {{ Form::close() }}

@endsection
