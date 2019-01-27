@extends('layouts.dashboard')

@section('title', '| View message')

@section('content')
  <div class="row">
    <!-- message area -->
    <div class="col-md-8">
      <h1 class="text-center">{{ $message->topic }}</h1>
      <p>From: <a href="mailto:{{ $message->email }}">{{ $message->email }}</a></p>
      <hr class="my-4" />
      <p>{{ $message->content }}</p>
      <hr>

      <!-- answers list -->
      @if (count($answers) > 0)
        <h3>Answers:</h3>
        <table class="table">
          <thead>
            <th>#</th>
            <th>Text</th>
            <th>Sent At</th>
            <th></th>
          </thead>
          <tbody>
            @foreach($answers as $answer)
              <tr>
                <td>{{ $answer->id }}</td>
                <td>{{ $answer->content }}</td>
                <td>{{ date('M d, Y H:i:s', strtotime($answer->created_at)) }}</td>
                <td>
                  {{ Form::open(['route' => ['answers.destroy', $answer->id], 'method' => 'DELETE']) }}
                    {{ Form::submit('Delete', ['class' => 'btn btn-light btn-block']) }}
                  {{ Form::close() }}
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
        <div class="d-flex flex-row justify-content-center">
          {{ $answers->links() }}
        </div>
      @else
        <div class="alert alert-primary">
          There is no answers for this message yet.
        </div>
      @endif
    </div>

    <!-- info and service area -->
    <div class="col-md-4">
      <div class="jumbotron bg-light">
        <dl class="col-12">
          <label>Created At:</label>
          <p>{{ date('Y-m-d H:i:s', strtotime($message->created_at)) }}</p>
        </dl>
        <dl class="col-12">
          <label>Updated At:</label>
          <p>{{ date('Y-m-d H:i:s', strtotime($message->created_at)) }}</p>
        </dl>

        <hr/>

        <div class="row">
          <div class="col-sm-6">
              {{ Html::linkRoute('messages.edit', 'Answer', [$message->id], ['class' => 'btn btn-primary btn-block']) }}
          </div>
          <div class="col-sm-6">
              {{ Form::open(['route' => ['messages.destroy', $message->id], 'method' => 'DELETE']) }}
                {{ Form::submit('Delete', ['class' => 'btn btn-danger btn-block'])}}
              {{ Form::close() }}
          </div>
        </div>
        <div class="row mt-1">
          <div class="col-sm-12">
              {{ Html::linkRoute('messages.index', '<< Back to Messages List', null, ['class' => 'btn btn-secondary btn-block']) }}
          </div>
        </div>

      </div>
    </div>

  </div>

@endsection
