@extends('layouts.dashboard')

@section('title','| Categories')

@section('content')
  <!-- header of the table -->
  <div class="row">
    <div class="col-md-9">
        <h1>All Categories</h1>
    </div>
    <div class="col-md-3" style="white-space:nowrap;">
      <a href="{{ route('categories.create') }}" class="btn btn-lg btn-success btn-block">Add New Category</a>
    </div>
  </div>

  <!-- categories zone -->
  <div class="row mt-2">
    <div class="col-md-12">

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
                <div class="d-flex flex-row justify-content-between">
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
  </div> <!-- end of categories zone -->

@endsection
