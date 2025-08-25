<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>
      @yield('title', 'Art Gallery')
    </title>
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

    @stack('styles')
  </head>

  <body>
    @include('components.promo-banner')
    @include('layouts.header')
    @include('components.navigation')

    <!-- Main Content Area -->
    <main class="main-content">
      @yield('breadcrumb')
      @yield('content')
    </main>

    @include('layouts.footer')
    @stack('scripts')
  </body>

</html>
