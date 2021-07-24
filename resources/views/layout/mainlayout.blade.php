<!DOCTYPE html>
<html lang="en">
  <head>
    @include('layout.partials.head')
  </head>

  <body style="margin:0; height:100vh">
    @include('layout.partials.nav')
    @yield('content')
  </body>
</html>