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
    <header class="justify-content-between row">
            @auth
                <a href="{{ url('/home') }}">HOME</a>
            @else
            <a class="Logo col-lg-2 col-xl-2 col-md-6 col-sm-6" href="{{ url('/') }}">
                1-<span>hf</span>.com
            </a>
            <div class="mobile_autorization col-sm-6"></div>
            <span class="header_title col-lg-3 col-xl-3 col-md-6">One Hour <span>Friend</span> | Друг на час</span>
            <div class="col-lg-7 col-xl-7 col-md-12 row links_header">
                <div  class="col-lg-8 col-xl-8 col-md-8 col-sm-12">
                <a class="heder_link" href="{{ url('#') }}">Знакомства</a>
                <a class="heder_link" href="{{ url('#') }}">Услуги</a>
                <a class="heder_link" href="{{ url('#') }}">Заработать за час</a>
                 <a class="heder_link" href="{{ url('#') }}">Отдохнуть</a>
                 </div>
                 <div class="col-lg-4 col-xl-4 col-md-4 col-sm-12 change">
                <a class="autorization " href="{{ route('login') }}">Войти</a> 

                @if (Route::has('register'))
                    <a class="registration " href="{{ route('register') }}">Регистрация</a>
                @endif
            </div>
            @endauth
        </div>
    </header>
    @endif
</div>