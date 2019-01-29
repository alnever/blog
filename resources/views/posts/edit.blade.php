@extends('layouts.dashboard')

@section('title', '| Edit post')

@section('styles')
  <!-- for select 2 -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
  <!-- tinyMCE -->
  <script src='https://cloud.tinymce.com/stable/tinymce.min.js'></script>
  <script type="text/javascript">
    tinymce.init({
      selector: "textarea[name=content]",
      plugins: 'textcolor lists codesample link code',
      toolbar: 'undo redo |  formatselect | bold italic underline | forecolor backcolor | numlist bullist | code codesample | link',
      menubar: false
    });
  </script>
@endsection

@section('content')
  <h1>Edit post</h1>
  {{ Form::model($post, ['route' => ['posts.update', $post->id], 'method' => 'PUT', 'files' => true]) }}
  <div class="row">

    <!-- post area -->
    <div class="col-md-8">
      {{ Form::label('title', 'Title:') }}
      {{ Form::text('title', null, ['class' => 'form-control','required']) }}

      {{ Form::label('slug', 'Slug:') }}
      {{ Form::text('slug', null, ['class' => 'form-control','required']) }}

      {{ Form::label('categories', 'Category:') }}
      {{ Form::select('categories[]', $categories, null, ['class' => 'categories-select2-multi form-control', 'multiple' => 'multiple']) }}

      {{ Form::label('tags', 'Tags:') }}
      {{ Form::select('tags[]', $tags, null, ['class' => 'tags-select2-multi form-control', 'multiple' => 'multiple']) }}

      <div class="">
        {{ Form::label('featured_image','Featured image:')}}
        {{ Form::file('featured_image') }}
        @if ($post->featured_image)
          <img src="{{ asset('images/' . $post->featured_image) }}" />
        @endif
      </div>

      {{ Form::label('content', 'Content:') }}
      {{ Form::textarea('content', null, ['class' => 'form-control', 'rows' => '8']) }}
    </div>

    <!-- info and service area -->
    <div class="col-md-4">
      <div class="jumbotron bg-light">
        <dl class="col-12">
          <label>Url:</label>
          <p>
              <a href="{{ route('post.single', $post->slug) }}" target="_blank">{{ url($post->slug) }}</a>
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

@section('scripts')
  <!-- for select2 -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
  <script type="text/javascript">
    $('.categories-select2-multi').select2();
    $('.tags-select2-multi').select2();
  </script>
@endsection
