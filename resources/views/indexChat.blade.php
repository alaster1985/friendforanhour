@include('layouts.header')
<div id="app2">
    <div class="container">
        <div class="col-md-6 offset-2">
            <div class="panel">
                <div class="panel-heading" style="background: #9fcdff">
                    List of all friends
                </div>
                @forelse($friends as $friend)
                    <div>
                        <a href="chat/{{$friend->id}}">
                            <div>{{$friend->first_name . ' ' . $friend->second_name}}<online v-bind:friend="{{ $friend }}" v-bind:onlineusers="onlineUsers"></online></div>

                        </a>
                    </div>
                @empty
                    <div class="panel-content">
                        You don't have any Friends
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')