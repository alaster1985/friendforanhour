@extends('errors::minimal')

@section('title', __('Not Found'))
@section('code', '404')

<div class="flex-center position-ref" style="padding: 1% 0">
    <a href="{{Request::root()}}" style="letter-spacing: 1;color:rgba(35, 135, 207, 0.66)">Вернуться на главную...</a>
</div>

@section('message', __('Not Found'))
