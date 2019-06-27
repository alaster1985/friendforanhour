@include('layouts.header')
<div style="background: #2a9055">all ok</div>
<div>{{$messageOk}}</div>
<a href="{{Request::root()}}/edit">back to my page</a>
@include('layouts.footer')