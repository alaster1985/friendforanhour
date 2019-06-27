@include('layouts.header')
<div style="background: #dd4b39">all bad</div>
<div>{{$messageOk}}</div>
<a href="{{Request::root()}}/edit">back to my page</a>
@include('layouts.footer')