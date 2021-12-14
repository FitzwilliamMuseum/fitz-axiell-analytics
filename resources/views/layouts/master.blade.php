<html>
<head>
  <title>Adlib - @yield('title')</title>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
  </head>
</head>
<body>
  @include('includes.nav')

  <div class="container">
    @yield('content')
  </div>
  <script src="{{ asset('js/app.js') }}" defer></script>

</body>
</html>
