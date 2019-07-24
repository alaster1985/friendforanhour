@include('layouts.header')
<div id="app2">
    <div class="container">
        <div class="col-lg-12">
            <div class="panel">
                <div class="panel-heading" style="background: #9fcdff">
                    Список ваших Друзей:
                </div>
                @forelse($friends as $friend)
                <div style="background: #fff">
                        <a href="{{Request::root()}}/chat/{{$friend->id}}">
                            <div style="font-weight: 500;">{{$friend->first_name . ' ' . $friend->second_name}}
                                <online v-bind:friend="{{ $friend }}" v-bind:onlineusers="onlineUsers"></online>
                                <span id="fromFrId_{{$friend->id}}"></span>
                                <span style="font-weight: 400; color: gray; font-size: 14px; margin-left: 30px" id="toFrId_{{$friend->id}}"></span>
                            </div>

                        </a>
                    </div>
                @empty
                    <div class="panel-content">
                        У вас нет Друзей.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{ asset('js/unreadMsg.js') }}" defer></script>
@include('layouts.footer')