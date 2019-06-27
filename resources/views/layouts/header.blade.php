<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="profile_Id" content="{{Auth::check() ? Auth::user()->profile_id : null}}">
    <title>1-hf</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->

    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/slick.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/slick-theme.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.fancybox.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('font-awesome-4.2.0/css/font-awesome.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('css/fontawesome-free-5.6.3-web/css/all.css')}}"/>
</head>
<div class="header_background">
    <div class="container">
        @if (Route::has('login'))
            <header class="justify-content-between row">
                <a class="Logo col-lg-2 col-xl-2 col-md-6 col-sm-4 col-6" href="{{ route('index') }}">
                    1-<span>hf</span>.com
                </a>
                <div class="mobile_autorization col-sm-6 col-6"></div>
                <span class="header_title col-lg-3 col-xl-3 col-md-6">One Hour
                <span>Friend</span> | Друг на час
            </span>
                <div class="col-lg-7 col-xl-7 col-md-12 row links_header">
                    <div class="col-lg-8 col-xl-8 col-md-8 col-sm-12">
                        <a class="heder_link" href="javascript:void(0);">Знакомства</a>
                        <a class="heder_link" href="javascript:void(0);">Услуги</a>
                        <a class="heder_link" href="javascript:void(0);">Заработать за час</a>
                        <a class="heder_link" href="javascript:void(0);">Отдохнуть</a>
                        <a class="heder_link" href="contactToSupport">ТП</a>
                        @auth
                        <a class="heder_link" href="{{Request::root()}}/search">search</a>
                        @endauth
                    </div>

                    <div class="navbar-collapse col-lg-4 col-md-4 col-12" id="navbarSupportedContent">
                        @guest
                            {{--<div class="text-center margin-bottom-20" id="uLogin2"--}}
                            {{--data-ulogin="display=panel;theme=classic;fields=first_name,last_name,email,nickname,photo,country,city,bdate,sex;--}}
                            {{--providers=facebook,vkontakte,odnoklassniki;hidden=;verify=1;--}}
                            {{--redirect_uri={{ urlencode('http://' . $_SERVER['HTTP_HOST']) . '/demo/friendforanhour/public' }}/ulogin;mobilebuttons=0;">--}}
                            {{--</div>--}}

                            <div class="text-center margin-bottom-20" id="uLogin2"
                                 data-ulogin="display=panel;theme=classic;fields=first_name,last_name,email,nickname,photo,city,country,bdate,sex;
                             providers=facebook,vkontakte,odnoklassniki;hidden=;
                             redirect_uri={{ urlencode('http://' . $_SERVER['HTTP_HOST'])}}/ulogin;mobilebuttons=0;">
                            </div>
                        @endguest
                        <ul class="navbar-nav ml-auto">
                            @guest
                                {{--<li class="nav-item">--}}
                                {{--<a class="nav-link autorization" href="{{ route('login') }}">Войти</a>--}}
                                {{--</li>--}}
                                {{--@if (Route::has('register'))--}}
                                {{--<li class="nav-item">--}}
                                {{--<a class="nav-link registration" href="{{ route('register') }}">Регистрация</a>--}}
                                {{--</li>--}}
                                {{--@endif--}}
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                        @if(Auth::user()->hasRole('moderator|admin'))
                                            <a class="dropdown-item" href="admin/dashboard">Панель администратора </a>
                                        @else
                                            <a class="dropdown-item"
                                               href="{{Request::root() . '/profile?prf=' .Auth::user()->profile_id}}">Моя
                                                страница</a>
                                            <a class="dropdown-item" href="{{Request::root()}}/edit">Настройки</a>
                                            <a class="dropdown-item" href="{{Request::root()}}/chat">Чат</a>
                                            <a class="dropdown-item" href="{{Request::root()}}/mytickets">My support tickets</a>
                                            <a class="dropdown-item" href="{{Request::root()}}/search">search</a>
                                        @endif
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                              style="display: none;">
                                            @csrf
                                        </form>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <!-- {{ __('Logout') }} -->
                                            Выйти
                                        </a>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                    @else
                        {{--<div class="col-lg-4 col-xl-4 col-md-4 col-sm-12 change">--}}
                        {{--<a class="autorization " href="{{ route('login') }}">Войти</a>--}}
                        {{--@if (Route::has('register'))--}}
                        {{--<a class="registration " href="{{ route('register') }}">Регистрация</a>--}}
                        {{--@endif--}}
                        {{--</div>--}}
                </div>
                @endif
            </header>

    </div>
</div>



            
