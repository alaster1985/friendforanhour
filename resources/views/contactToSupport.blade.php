@include('layouts.header')
@if ($errors)
    <div class="error" style="display: block; color: red">{{($errors->first())}}</div>
@endif
<form method="POST" enctype="multipart/form-data" action="{{Route('sendTicket')}}">
    @csrf
    <p>Title</p>
    <input name="title" type="text" value="{{old('title')}}">
    <p>Description</p>
    <textarea name="description" rows="15">{{old('description')}}</textarea>
    @guest
        <p>Email for feedback</p>
        <input name="email" type="email" value="{{old('email')}}">
        <p>Enter your name</p>
        <input name="name_from" type="text" value="{{old('name_from')}}">
    @endguest
    @auth
        <input type="hidden" name="profile_id" value="{{Auth::user()->profile_id}}">
    @endauth
    <button type="submit">SEND to support</button>
</form>
@if(session()->has('message'))
    <div class="alert alert-success" align="center">
        {{ session()->get('message') }}
    </div>
@endif
@include('layouts.footer')