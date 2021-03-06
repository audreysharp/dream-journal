<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Dream Journal</title>
  @yield('styles')
</head>

<body v-cloak>
  <!-- Navigation -->
  <nav class="navbar navbar-default navbar-fixed-top"> 
  <div class="container-fluid"> <!-- Collapse nav on mobile -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/"><span class="glyphicon glyphicon-cloud"></span>&nbsp;&nbsp;Dream Journal</a>
    </div>
    <!-- Navigation links -->
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="/">Dreams</a></li>
        <li><a href="/add">Add Dream</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="/help">Instructions</a></li>
        <li><a href="https://audreysharp.gitbooks.io/dream-journal/content/">API Documentation</a></li>
        <li><a href="/styleguide">Style Guide</a></li>
        <li><a href="/credits">Credits</a></li>
      </ul>
    </div>
  </div>
  </nav>

    <!-- Where the actual application goes -->
    <div class="container">
        @yield('content')
    </div>

  <script>
    // for CSRF token to work properly
    window.Laravel = {!! json_encode([
        'csrfToken' => csrf_token(),
    ]) !!};
  </script>
  <link rel="stylesheet" href="{{ mix('css/app.css') }}">
  <script src="{{ mix('js/app.js') }}"></script>
</body>

</html>