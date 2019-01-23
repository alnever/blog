<!DOCTYPE html>
<html lang="en" dir="ltr">
  @include('partials._head')

  <body>
    @include('partials._nav')

    <div class="fluid-container mt-1">
      <div class="row justify-content-md-center">
        <!-- admin menu -->
        <div class="col-lg-2">
          @include('partials._manage')
        </div>

        <!-- admin panel -->
        <div class="col-lg-9">
          @include('partials._messages')

          @yield('content')

        </div>
      </div>
    </div>

    @include('partials._footer')

    @include('partials._scripts')
  </body>
</html>
