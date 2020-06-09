<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ 'GamingTec' }}</title>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"  crossorigin="anonymous"></script>

    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body style="background-image: url({{'../storage/backpostlogin.jpg'}});background-size: cover;
            background-repeat: no-repeat;width: 100%; max-width: 100%; height: auto; opacity: 0.8;overflow-x: hidden;">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}" style="font-weight: bold; color: blue; font-family: cursive;">
                    {{ 'GamingTec'}}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @if(@Auth::user()->tipo_usuario == 'AUTOR')
                        <li class="nav-item" style="font-family: sans-serif;">
                            <a href="{{route('contents.index')}}" class="btn btn-outline-secondary btn-sm">Contenidos</a>
                        </li>
                        @else
                        @if(@Auth::user()->tipo_usuario == 'DIFUSOR')
                        <li class="nav-item" style="font-family: sans-serif;">
                            <a href="{{route('contents_difusor')}}" class="btn btn-outline-secondary btn-sm">Contenidos</a>
                        </li>
                        &nbsp;&nbsp;
                        <li class="nav-item" style="font-family: sans-serif;">
                            <a href="{{route('autores.index')}}" class="btn btn-outline-secondary btn-sm">Autores</a>
                        </li>
                        &nbsp;&nbsp;
                        <li class="nav-item" style="font-family: sans-serif;">
                            <a href="{{route('subscripcions.index')}}" class="btn btn-outline-secondary btn-sm">Subscriptores</a>
                        </li>
                        @else
                        @endif
                        @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" style="font-weight: bold; color: blue" href="{{ route('login') }}">{{ __('Entrar') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" style="font-weight: bold; color: blue" href="{{ route('register') }}">{{ __('Registrarse') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="font-weight: bold; color: blue">
                                    {{ @Auth::user()->name }} ({{@Auth::user()->tipo_usuario}}) <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a style="font-weight: bold; color: blue" class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Cerrar sesión') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    @yield('script')
</body>
</html>
