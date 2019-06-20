@include('layouts.header')
<div style="background: #1da1f2">YOU are BANNED</div>
<div>reason {{Auth::user()->profile->ban->last()->reason}}</div>
@if(Auth::user()->profile->ban->last()->ban_end_date >= strtotime('now'))
    <h1>Countdown ban time finish</h1>
    <p style="display: none" id="finish_time">{{Auth::user()->profile->ban->last()->ban_end_date}}</p>
    <div id="countdown">
        <div>
            <span class="days"></span>
            <div>Days</div>
        </div>
        <div>
            <span class="hours"></span>
            <div>Hours</div>
        </div>
        <div>
            <span class="minutes"></span>
            <div>Minutes</div>
        </div>
        <div>
            <span class="seconds"></span>
            <div>Seconds</div>
        </div>
    </div>
    <script type="text/javascript" src="{{asset('js/countdown.js')}}" defer></script>
@endif
@if(Auth::user()->profile->is_banned)
<div>It is manual permanent ban</div>
@endif
<div>You can contact to <a href="contactToSupport">support</a> or look to your <a href="{{Request::root()}}/mytickets">reports</a></div>
@include('layouts.footer')