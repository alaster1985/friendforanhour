@include('layouts.header')
<div style="background: #1da1f2">YOU are BANNED</div>
@if(Auth::user()->profile->is_banned)
    <div>It is manual permanent ban</div>
@elseif(isset(Auth::user()->profile->ban->first()->id) && Auth::user()->profile->ban->last()->ban_end_date >= strtotime('now'))
    <div>reason: {{Auth::user()->profile->ban->last()->reason}}</div>
    <h2>Countdown ban time finish</h2>
    <p style="display: none" id="finish_time">{{Auth::user()->profile->ban->last()->ban_end_date}}</p>
    <div id="countdown" class="col-md-6" style="display: inline-flex">
        <div>Days: <span class="days"></span></div>
        <div>Hours: <span class="hours"></span></div>
        <div>Minutes: <span class="minutes"></span></div>
        <div>Seconds: <span class="seconds"></span></div>
    </div>
    <script type="text/javascript" src="{{asset('js/countdown.js')}}" defer></script>
@endif
<div>You can contact to <a href="contactToSupport">support</a> or look to your <a href="{{Request::root()}}/mytickets">reports</a>
</div>
@include('layouts.footer')