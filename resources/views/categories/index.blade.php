@extends('layouts.dashboard')

@section('title','| Categories')

@section('content')

  <!-- categories zone -->
  <div class="col-12 row mt-2">
    <!-- list zone -->
    <div class="col-8">
      <h1>All Categories</h1>
      <!-- categories list -->
      <table class="table">
        <thead class="thead-light">
          <th>#</th>
          <th>Name</th>
          <th style="white-space:nowrap;">Created At</th>
          <th></th>
        </thead>
        <tbody>
          @foreach ($categories as $category)
            <tr>
              <td>{{ $category->id }}</td>
              <td>
                <!-- title and link to view -->
                <!-- there isn't a reason to show single category -->
                {{ $category->name }}
              </td>
              <td style="white-space:nowrap;">
                <!-- create date -->
                {{ date("M d, y", strtotime($category->created_at)) }}
              </td>
              <td>
                <!-- operation buttons -->
                <div class="d-flex flex-row justify-content-end">
                  <a href="{{ route('categories.show', $category->id) }}" class="btn btn-sm btn-light">Show</a>
                  <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-light">Edit</a>
                  {{ Form::open(['route' => ['categories.destroy', $category->id], 'method' => 'DELETE']) }}
                    {{ Form::submit('Delete', ['class' => 'btn btn-sm btn-light'])}}
                  {{ Form::close() }}
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table> <!-- end of categories list -->

      <!-- pagination -->
      <div class="d-flex flex-row justify-content-center">
        {{ $categories->links() }}
      </div>
    </div>

    <!-- new category form -->
    <div class="col-4">
      <div class="jumbotron">
        <h3>Add New Category</h3>
        {{ Form::open(['route' => 'categories.store']) }}

        {{ Form::label('name', 'Name:') }}
        {{ Form::text('name', null, ['class' => 'form-control','required']) }}

        {{ Form::label('slug', 'Slug:') }}
        {{ Form::text('slug', null, ['class' => 'form-control','required']) }}

        {{ Form::submit('Save category', ['class' => 'btn btn-success btn-block mt-2'])}}

        {{ Form::close() }}
      </div>
    </div>
  </div>

@endsection
