<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'luciferblog') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav>
            <div class="container">
                <h1><a href="/" class="brand">lucifer blog</a></h1>
                <ul>
                    <li class="nav-link"><a href="/about">About</a></li>
                    <li class="nav-link"><a href="/blogs">Blogs</a></li>

                    @guest
                    @if (Route::has('login'))
                    <li class="nav-link">
                        <a href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @endif

                    @if (Route::has('register'))
                    <li class="nav-link">
                        <a href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                    @endif
                    @else
                    <li class="nav-link">
                        <a href="/home">
                            {{ Auth::user()->name }}
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                        </div>
                    </li>
                    @endguest
                </ul>
            </div>
        </nav>

        @yield('content')

        @include('partials.message')
    </div>
</body>

</html>