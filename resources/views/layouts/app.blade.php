<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Dream Journal</title>
    </head>
    <body>

      <!-- Navigation -->
      <nav class="navbar navbar-default navbar-fixed-top"> 
      <div class="container-fluid"> <!-- Collapse nav on mobile -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/">Dream Journal</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav">
            <li><a href="/">Dreams</a></li>
            <li><a href="/add">Add Dream</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="/style">Style Guide</a></li>
            <li><a href="/credits">Credits</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <!--@yield('content')-->
    <div id="container">
        @yield('content')
    </div>

        <script>
            window.Laravel = {!! json_encode([
                'csrfToken' => csrf_token(),
            ]) !!};
        </script>
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>