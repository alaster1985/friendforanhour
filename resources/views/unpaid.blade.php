@include('layouts.header')
<div style="background: #dd4b39">UNPAID</div>
<h1>Subscription is invalid</h1>
@if(Auth::user()->profile->is_locked)
    <div>It is manual locked</div>
    <div>You can contact to <a href="contactToSupport">support</a> or look to your <a
                href="{{Request::root()}}/mytickets">reports</a></div>
@endif
@include('layouts.footer')