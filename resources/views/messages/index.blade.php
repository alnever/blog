@extends('layouts.dashboard')

@section('title','| Messages')

@section('content')
  <div class="row">
    <div class="col-md-9">
        <h1>All Messages</h1>
    </div>
  </div>

  <div class="row mt-2">
    <div class="col-md-12">

      <!-- messages list -->
      <table class="table">
        <thead class="thead-light">
          <th>#</th>
          <th>Topic</th>
          <th>Email</th>
          <th style="white-space:nowrap;">Created At</th>
          <th></th>
        </thead>
        <tbody>
          @foreach ($messages as $message)
            <tr>
              <td>
                {{ $message->id }}
                @if ($message->read == 1)
                  @include('icons.read-email')
                @else
                  @include('icons.new-email')
                @endif

                @if (count($message->answers) > 0)
                  @include('icons.replied')
                @endif
              </td>
              <td>
                <!-- title and link to view -->
                <a href="{{ route('messages.show', $message->id) }}">
                  {{ $message->topic }}
                </a>
              </td>
              <td>
                {{ $message->email }}
              </td>
              <td style="white-space:nowrap;">
                <!-- create date -->
                {{ date("M d, y H:i:s", strtotime($message->created_at)) }}
              </td>
              <td>
                <!-- operation buttons -->
                <div class="d-flex flex-row justify-content-end">
                  <a href="{{ route('messages.show', $message->id) }}" class="btn btn-sm btn-light">View</a>
                  {{ Form::open(['route' => ['messages.destroy', $message->id], 'method' => 'DELETE']) }}
                    {{ Form::submit('Delete', ['class' => 'btn btn-sm btn-light'])}}
                  {{ Form::close() }}
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table> <!-- end of messages list -->

      <!-- pagination -->
      <div class="d-flex flex-row justify-content-center">
        {{ $messages->links() }}
      </div>
    </div>
  </div>

@endsection
