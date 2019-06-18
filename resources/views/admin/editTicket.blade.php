@include('admin/layouts.header')
@include('admin/layouts.menu')
<div class="content-sec">
    <div class="container">
        <div class="title-date-range">
            <div class="row">
                <div class="col-md-6">
                    <div class="main-title">
                        <h1>edit ticket</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <h2 class="StepTitle">Ticket, ID = {{$ticket->id}}</h2>
            @if($ticket->profile_id)
                <h4 class="StepTitle">From: <a
                            href="{{Request::root()}}/profile?prf={{$ticket->profile_id}}">{{$ticket->profile->first_name . ' ' . $ticket->profile->second_name}}</a>
                </h4>
            @else
                <h4 class="StepTitle">From: <a
                            href="mailto:{{$ticket->email}}">{{$ticket->name_from}}</a>
                </h4>
            @endif
            @if($ticket->moderator_id)
                <h3>Accepted by {{$ticket->user->name}}</h3>
            @else
            <form action="{{Route('acceptTicket')}}" type="GET" enctype="multipart/form-data">
                <input type="hidden" name="id" value="{{$ticket->id}}">
                <button type="submit">Accept</button>
            </form>
            @endif
            <form action="{{Route('updateTicket')}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="masonary-grids">
                    <div class="col-md-12">
                        <div class="widget-area">
                            <div class="wizard-form-h">
                                {{--<h2 class="StepTitle">Ticket, ID = {{$ticket->id}}</h2>--}}
                                {{--@if($ticket->profile_id)--}}
                                    {{--<h4 class="StepTitle">From: <a--}}
                                                {{--href="{{Request::root()}}/profile?prf={{$ticket->profile_id}}">{{$ticket->profile->first_name . ' ' . $ticket->profile->second_name}}</a>--}}
                                    {{--</h4>--}}
                                {{--@else--}}
                                    {{--<h4 class="StepTitle">From: <a--}}
                                                {{--href="mailto:{{$ticket->email}}">{{$ticket->name_from}}</a>--}}
                                    {{--</h4>--}}
                                {{--@endif--}}
                                @if ($errors)
                                    <div class="error" style="display: block">{{($errors->first())}}</div>
                                @endif
                                <input type="hidden" name="id" value="{{$ticket->id}}">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="inline-form">
                                            <label class="c-label">Title</label>
                                            <input class="input-style" disabled name="title"
                                                   value="{{$ticket->title}}"/>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="inline-form">
                                            <label class="c-label">Description</label>
                                            <input class="input-style" disabled name="description"
                                                   value="{{$ticket->description}}"/>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="inline-form">
                                            <label class="c-label">Status</label>
                                            <select name="status_id">
                                                @foreach(TicketStatus::all() as $status)
                                                    <option id="tst{{$status->id}}"
                                                            value="{{$status->id}}">{{$status->status}}</option>
                                                    @if($status->id === $ticket->status_id)
                                                        <script>document.getElementById('tst{{$status->id}}').selected = true</script>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-md-12">
                                    <div class="inline-form">
                                        <label class="c-label">Report</label>
                                        <textarea class="input-style"
                                                  name="report">{{old('report') ?? $ticket->report}}</textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="inline-form">
                                            <label class="c-label">Created at</label>
                                            <input class="input-style" disabled
                                                   name="created_at" value="{{$ticket->created_at}}"/>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="inline-form">
                                            <label class="c-label">Updated at</label>
                                            <input class="input-style" disabled
                                                   name="updated_at" value="{{$ticket->updated_at}}"/>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="inline-form">
                                            @if($ticket->moderator_id != Auth::id())
                                                <button type="submit" onclick="return confirm('You didn\'t accept this ticket. Confirm \'save\' button?');" {{--disabled--}} class="btn btn-success">SAVE</button>
                                            @else
                                                <button type="submit" {{--disabled--}} class="btn btn-success">SAVE</button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        @if(session()->has('message'))
            <div class="alert alert-success" align="center">
                {{ session()->get('message') }}
            </div>
        @endif
    </div>
</div>
@include('admin/layouts.footer')