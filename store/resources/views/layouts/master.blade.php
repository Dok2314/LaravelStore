<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Интернет Магазин: @yield('title')</title>

    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/starter-template.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ route('index') }}">Интернет Магазин</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li @routeactive('index')><a href="{{ route('index') }}">Все товары</a></li>
                <li @routeactive('categor*')><a href="{{ route('categories') }}">Категории</a>
                </li>
                <li @routeactive('basket')><a href="{{ route('basket') }}">В корзину</a></li>
                <li ><a href="{{ route('reset_db') }}">Сбросить проект в начальное состояние</a></li>
                <li @routeactive('login')>

                    @guest
                        <a class="dropdown-item" href="{{ route('login') }}">
                            {{ __('Войти') }}
                        </a>
                    @endguest

                    @auth
                        @if(auth()->user()->isAdmin())
                            <li><a href="{{ route('home') }}">Панель администратора</a></li>
                        @else
                            <li><a href="{{ route('person.orders.index') }}">Мои заказы</a></li>
                        @endif
                    @endauth
                </li>
                <li>
                    @auth
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                            {{ __('Выйти') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    @endauth
                </li>
            </ul>

{{--            <ul class="nav navbar-nav navbar-right">--}}
{{--                <li><a href="">Панель администратора</a></li>--}}
{{--            </ul>--}}
        </div>
    </div>
</nav>


<div class="container">
    <div class="starter-template">
        @if(session()->has('success'))
            <p class="alert alert-success">{{ session()->get('success') }}</p>
        @endif
        @if(session()->has('warning'))
            <p class="alert alert-warning">{{ session()->get('warning') }}</p>
        @endif
        @yield('content')
    </div>
</div>
</body>
</html>
