<!DOCTYPE html>
<html lang="en" dir="ltr">
  @include('partials._head')

  <body>
    @include('partials._nav')

    <div class="container mt-1">

      @yield('content')

    </div>

    @include('partials._footer')

    @include('partials._scripts')
  </body>
</html>
