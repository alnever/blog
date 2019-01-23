@extends('layouts.page')

@section('title', '| Home')

@section('content')
  <div class="col-md-12">
    <h1 class="display-2 text-center">Laravel Blog</h1>
    <hr class="my-4" />
    <p class="lead text-center">Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
  </div>

  <div class="row">

    <!-- main region -->
    <div class="col-md-8">

      <div class="jumbotron">
        <h3 class="text-primary">Post title</h3>
        <p>
          Mauris dui lectus, fermentum non quam ut, scelerisque dapibus tortor.
          Donec fermentum, erat vitae rhoncus blandit, ante lacus laoreet turpis,
          eu tempus sapien lorem ut massa.
        </p>
        <p class="text-right">
          <a class="btn btn-primary" href="#">Read more...</a>
        </p>
      </div>

      <div class="jumbotron">
        <h3 class="text-primary">Post title</h3>
        <p>
          Mauris dui lectus, fermentum non quam ut, scelerisque dapibus tortor.
          Donec fermentum, erat vitae rhoncus blandit, ante lacus laoreet turpis,
          eu tempus sapien lorem ut massa.
        </p>
        <p class="text-right">
          <a class="btn btn-primary" href="#">Read more...</a>
        </p>
      </div>

      <div class="jumbotron">
        <h3 class="text-primary">Post title</h3>
        <p>
          Mauris dui lectus, fermentum non quam ut, scelerisque dapibus tortor.
          Donec fermentum, erat vitae rhoncus blandit, ante lacus laoreet turpis,
          eu tempus sapien lorem ut massa.
        </p>
        <p class="text-right">
          <a class="btn btn-primary" href="#">Read more...</a>
        </p>
      </div>

    </div>

    <!-- sidebar -->
    <div class="col-md-4">

    </div>
  </div>
@endsection
