<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>1-hf</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
   
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}" />
</head>
<div class="container">
    @if (Route::has('login'))
    <header class="justify-content-between">
            @auth
                <a href="{{ url('/home') }}">HOME</a>
            @else
            <a class="Logo" href="{{ url('/') }}">
                1-<span>hf</span>.com
            </a>
            <span class="header_title">One Hour <span>Friend</span> | Друг на час</span>
            <div>
            <a class="heder_link" href="{{ url('#') }}">Знакомства</a>
            <a class="heder_link" href="{{ url('#') }}">Услуги</a>
            <a class="heder_link" href="{{ url('#') }}">Заработать за час</a>
            <a class="heder_link" href="{{ url('#') }}">Отдохнуть</a>
                <a class="autorization" href="{{ route('login') }}">Войти</a>

                @if (Route::has('register'))
                    <a class="registration" href="{{ route('register') }}">Регистрация</a>
                @endif
            @endauth
        </div>
    </header>
    @endif
</div>