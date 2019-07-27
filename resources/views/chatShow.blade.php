@include('layouts.header')
<div id="chat-vue">
    <audio id="chatAudio">
        <source src="{{asset('sounds/sms_chat1.mp3')}}">
    </audio>
    <meta name="friendId" content="{{$friend->id}}">
    <div class="container">
        <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="panel">
                <div class="panel-heading">
                    <h3>{{$friend->first_name . ' ' . $friend->second_name}}</h3>
                </div>
                <chat v-bind:chats="chats" v-bind:profileid="{{Auth::user()->profile_id}}" v-bind:friendid="{{$friend->id}}"></chat>
            </div>
        </div>
        </div>
    </div>
</div>
@include('layouts.footer')