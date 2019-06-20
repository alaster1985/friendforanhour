@include('admin/layouts.header')
@include('admin/layouts.menu')
<div class="content-sec">
    <div class="container">
        <div class="title-date-range">
            <div class="row">
                <div class="col-md-6">
                    <div class="main-title">
                        <h1>edit ban (ID = {{$ban->id}}) for <a
                                    href="{{Request::root()}}/profile?prf={{$ban->profile_id}}">{{$ban->profile->first_name . ' ' . $ban->profile->second_name}}</a></h1>
                    </div>
                    <a href="viewProfileBans?prf={{$ban->profile_id}}">ban section</a>
                </div>
            </div>
        </div>
        <div class="row">
            <form action="{{Route('updateBan')}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="masonary-grids">
                    <div class="col-md-12">
                        <div class="widget-area">
                            <div class="wizard-form-h">
                                <h2 class="StepTitle">admin user</h2>
                                @if ($errors)
                                    <div class="error" style="display: block">{{($errors->first())}}</div>
                                @endif
                                <input type="hidden" name="id" value="{{$ban->id}}">
                                <input type="hidden" name="profile_id" value="{{$ban->profile_id}}">
                                <div class="col-md-4">
                                    <div class="inline-form">
                                        <label class="c-label">Reason for ban</label>
                                        <input class="input-style" name="reason" value="{{$ban->reason}}"/>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="inline-form">
                                        <label class="c-label">Duration (hours)</label>
                                        <input class="input-style" disabled name="duration" value="{{$ban->duration}}"/>
                                        <input type="hidden" class="input-style" name="duration" value="{{$ban->duration}}"/>
                                    </div>
                                </div>
                                @if($ban->id === $ban->profile->ban->last()->id)
                                <div type="button">amnesty</div>
                                <div id="amnesty" style="display: none" class="col-md-9">
                                    <div class="inline-form">
                                        <label class="c-label">Reason for amnesty</label>
                                        <textarea class="input-style"
                                                  name="amnesty">{{old('reason_amnesty')}}</textarea>
                                    </div>
                                </div>
                                @endif
                                <div class="col-md-4">
                                    <div class="inline-form">
                                        <label class="c-label">Created at</label>
                                        <input class="input-style" disabled
                                               name="created_at" value="{{$ban->created_at}}"/>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="inline-form">
                                        <label class="c-label">Updated at</label>
                                        <input class="input-style" disabled
                                               name="updated_at" value="{{$ban->updated_at}}"/>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="inline-form">
                                        <button type="submit" {{--disabled--}} class="btn btn-success">SAVE</button>
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