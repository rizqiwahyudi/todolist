<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="ToDoList Project">
    <meta name="author" content="Rizqi Wahyudi">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ToDoList') }} - @yield('title')</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('/assets/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{asset('/assets/css/starter-template.css')}}" rel="stylesheet">
    <link href="{{asset('/assets/css/sticky-footer.css')}}" rel="stylesheet">
  </head>

  <body>
        <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
          <a class="navbar-brand" href="{{route('home')}}">ToDoList</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('home') ? 'active' : ''}}" href="{{route('home')}}">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('about') ? 'active' : ''}}" href="{{route('about')}}">About</a>
              </li>
                @auth
                    @if (Route::has('dashboard'))
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : ''}}" href="{{route('dashboard')}}">Dashboard</a>
                        </li>
                    @endif
                @endauth
            </ul>
            <ul class="navbar-nav">
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="nav-link {{ request()->routeIs('login') ? 'active' : ''}}">Login</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a href="{{ route('register') }}" class="nav-link {{ request()->routeIs('register') ? 'active' : ''}}">Register</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>{{ Auth::user()->name }}</a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                 <a class="dropdown-item" href="">{{ __('Profile') }}</a>

                                <a class="dropdown-item" href="{{ route('logout') }}"onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                            </div>
                    </li>
                @endguest
            </ul>
          </div>
        </nav>

    <main role="main" class="container">
      @yield('content')
    </main><!-- /.container -->

    <footer class="footer">
        <div class="text-center">
            <span class="text-muted">Developed By <a class="link" href="https://github.com/rizqiwahyudi">Rizqi Wahyudi</a></span>
        </div>
    </footer>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script type="text/javascript" src="{{asset('/assets/js/jquery-3.2.1.slim.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('/assets/js/popper.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('/assets/js/bootstrap.min.js')}}"></script>
  </body>
</html>