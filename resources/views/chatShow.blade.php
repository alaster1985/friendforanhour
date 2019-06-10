@include('layouts.header')
<div id="app2">
    <audio id="chatAudio">
        <source src="{{asset('sounds/sms_chat1.mp3')}}">
    </audio>
    <meta name="friendId" content="{{$friend->id}}">
    <div class="container">
        <div class="col-md-6 offset-2">
            <div class="panel">
                <div class="panel-heading" style="background: seashell">
                    {{$friend->first_name . ' ' . $friend->second_name}}
                </div>
                <chat v-bind:chats="chats" v-bind:profileid="{{Auth::user()->profile_id}}" v-bind:friendid="{{$friend->id}}"></chat>
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')