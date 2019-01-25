@extends('layouts.dashboard')

@section('title', '| Create post')

@section('styles')
  <!-- for select 2 -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@endsection

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

        <!-- category select -->
        <div class="">
          {{ Form::label('categories', 'Category:') }}
          <select class="form-control categories-select2-multi" name="categories[]" multiple="multiple">
            @foreach ($categories as $category)
              <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
          </select>
        </div>

        <div class="">
          {{ Form::label('tags', 'Tags:')}}
          <select class="form-control tags-select2-multi" name="tags[]" multiple="multiple">
            @foreach ($tags as $tag)
              <option value="{{ $tag->id }}">{{ $tag->name }}</option>
            @endforeach
          </select>
        </div>

        {{ Form::label('content', 'Content:') }}
        {{ Form::textarea('content', null, ['class' => 'form-control', 'rows' => '8','required']) }}

        {{ Form::label('') }}
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

@section('scripts')
  <!-- for select2 -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
  <script type="text/javascript">
    $('.categories-select2-multi').select2();
    $('.tags-select2-multi').select2();
  </script>
@endsection
