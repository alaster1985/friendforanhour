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
        <link rel="stylesheet" type="text/css" href="{{asset('font-awesome-4.2.0/css/font-awesome.css')}}"/>
        <link rel="stylesheet" type="text/css" href="{{asset('css/fontawesome-free-5.6.3-web/css/all.css')}}"/>

        <!-- Styles -->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.fancybox.min.css') }}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/slick-theme.css') }}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/slick.css') }}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}"/>

    </head>


    @if (Route::has('login'))

    <header class="justify-content-between row">
        <div class="container">
            <div class="header-nav-container">

                <nav class="navbar navbar-expand-lg navbar-dark">
                    <a class="navbar-brand logotype" href="{{ route('index') }}"><span class="header_title">One Hour <span>Friend</span></span></a>
                    <div class="mobile_autorization"></div> 

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    
                    <div class="collapse navbar-collapse links_header" id="navbarNavAltMarkup">
                        <div class="navbar-nav">
                            @foreach(ArticleCategory::all() as $category)
                                <a class="nav-item nav-link" href="articles?ctg={{$category->category_name}}">{{$category->display_name}}</a>
                            @endforeach
                                {{--<a class="nav-item nav-link" href="javascript:void(0);">Знакомства</a>--}}
                                {{--<a class="nav-item nav-link" href="javascript:void(0);">Услуги</a>--}}
                                {{--<a class="nav-item nav-link" href="javascript:void(0);">Заработать</a>--}}
                                {{--<a class="nav-item nav-link" href="javascript:void(0);">Отдохнуть</a>--}}                                
                                <a class="nav-item nav-link" href="{{Request::root()}}/search">Найти друга</a>
                                @include('layouts.robokassaPayForm')
                        </div>                        
                    </div>
                </nav>
                <div id="navbarSupportedContent">
                    @guest
                        {{--  --}}
                    @endguest
                    <ul class="navbar-nav ml-auto">
                        @guest
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>{{ Auth::user()->name }} <span class="caret"></span></a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        @if(Auth::user()->hasRole('moderator|admin'))
                                            <a class="dropdown-item" href="admin/dashboard">Панель администратора</a>
                                        @else
                                            <a class="dropdown-item" href="{{Request::root() . '/profile?prf=' .Auth::user()->profile_id}}">Моя страница</a>
                                            <a class="dropdown-item" href="{{Request::root()}}/edit">Настройки</a>
                                            <a class="dropdown-item" href="{{Request::root()}}/chat">Чат</a>
                                            <a class="dropdown-item" href="{{Request::root()}}/mytickets">My support tickets</a>
                                            <a class="dropdown-item" href="{{Request::root()}}/contactToSupport">Тех потдержка</a>
                                        @endif
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><!-- {{ __('Logout') }} -->Выйти</a>
                                    </div>
                                </li>
                            @endguest
                    </ul>
                </div>
                @else
                {{--<div class="change">--}}
                {{--<a class="autorization " href="{{ route('login') }}">Войти</a>--}}
                {{--@if (Route::has('register'))--}}
                {{--<a class="registration " href="{{ route('register') }}">Регистрация</a>--}}
                {{--@endif--}}
                {{--</div>--}}
            </div>
        </div>
        @endif
    </header>
    <main>