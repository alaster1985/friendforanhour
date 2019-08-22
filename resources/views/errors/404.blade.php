@include('layouts.header')
@extends('errors::minimal')

@section('title', __('Not Found'))
@section('code', '404')
<div class="flex-center position-ref">
    <a href="{{Request::root()}}">Страница не найдена. Вернуться на главную страницу</a>
</div>
@section('message', __('Not Found'))

