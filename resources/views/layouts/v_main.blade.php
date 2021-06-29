<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="ToDoList Project">
    <meta name="author" content="Rizqi Wahyudi">

    <title>@yield('title')</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('/assets/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{asset('/assets/css/starter-template.css')}}" rel="stylesheet">
  </head>

  <body>

    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
      <a class="navbar-brand" href="{{route('pages.home')}}">ToDoList</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="{{route('pages.home')}}">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('pages.about')}}">About</a>
          </li>
        </ul>
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="" class="nav-link">Login</a>
          </li>
          <li class="nav-item">
            <a href="" class="nav-link">Register</a>
          </li>
        </ul>
      </div>
    </nav>

    <main role="main" class="container">
      @yield('content')
    </main><!-- /.container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script type="text/javascript" src="{{asset('/assets/js/jquery-3.2.1.slim.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('/assets/js/popper.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('/assets/js/bootstrap.min.js')}}"></script>
  </body>
</html>
