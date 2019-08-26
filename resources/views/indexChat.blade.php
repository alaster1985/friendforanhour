@include('layouts.header')
<div id="chat-vue">
    <div class="container">
        <div class="col-lg-12">
            <div class="panel">
                <div class="panel-heading">
                    <h3>Мои сообщения:</h3>
                </div>
                @forelse($friends as $friend)
                <div class="panel-contact">
                        <a href="{{Request::root()}}/chat/{{$friend->id}}">
                            <div class="panel-contact-username">{{$friend->first_name . ' ' . $friend->second_name}}
                                <online v-bind:friend="{{ $friend }}" v-bind:onlineusers="onlineUsers"></online>
                                <span id="fromFrId_{{$friend->id}}"></span>
                                <span class="massage-status" id="toFrId_{{$friend->id}}"></span>
                            </div>

                        </a>
                    </div>
                @empty
                    <div class="panel-content">
                        Нет сообщений.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{ asset('js/unreadMsg.js') }}" defer></script>
@include('layouts.footer')
