@include('admin/layouts.header')
@include('admin/layouts.menu')
<div class="content-sec">
    @if(session()->has('message'))
        <div class="alert alert-success" align="center">
            {{ session()->get('message') }}
        </div>
    @endif
    <div class="container">
        <div class="title-date-range">
            <div class="row">
                <div class="col-md-6">
                    <div class="main-title">
                        <h4 class="StepTitle">All bans for: <a
                                    href="{{Request::root()}}/profile?prf={{$profile->id}}">{{$profile->first_name . ' ' . $profile->second_name}}</a>
                        </h4>
                    </div>
                </div>
                <div class="col-md-6">
                </div>
            </div>
        </div><!-- title Date Range -->
        <div class="row">
            <div class="masonary-grids">
                <div class="col-md-12">
                    <div class="widget-area">
                        <div class="streaming-table">
                            <span id="found" class="label label-info"></span>
                            <button type="button">ADD BAN</button>
                            <form style="display: none" action="{{Route('addBan')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="profile_id" value="{{$profile->id}}">
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="inline-form">
                                            <label class="c-label">Reason for ban</label>
                                            <textarea class="input-style"
                                                      name="reason">{{old('reason')}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="inline-form">
                                            <label class="c-label">Duration (hours)</label>
                                            <input class="input-style" type="number" min="1" max="1000"
                                                   name="duration" value="{{old('duration')}}"/>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="inline-form">
                                            <button type="submit" {{--disabled--}} class="btn btn-success">SAVE</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <table id="stream_table" class='table table-striped table-bordered'>
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Reason</th>
                                    <th>Who set ban</th>
                                    <th>Duration, hr</th>
                                    <th>Ban end date</th>
                                    <th>Reason for amnesty</th>
                                    <th>Who set amnesty</th>
                                    <th>Created_at</th>
                                    <th>Updated_at</th>
                                    <th>Edit</th>
                                    {{--@if(Auth::user()->hasRole('admin'))--}}
                                    {{--<th>Delete</th>--}}
                                    {{--@endif--}}
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($bans as $ban)
                                    <tr>
                                        <td>
                                            {{$ban->id}}
                                        </td>
                                        <td>
                                            {{$ban->getShortDesc()}}
                                        </td>
                                        <td>
                                            {{$ban->userBeginner->name}}
                                        </td>
                                        <td>
                                            {{$ban->duration}}
                                        </td>
                                        <td>
                                            {{gmdate("d M Y H:i:s", $ban->ban_end_date)}}
                                        </td>
                                        <td>
                                            {{$ban->reason_amnesty}}
                                        </td>
                                        <td>
                                            {{$ban->userAmnesty->name ?? ''}}
                                        </td>
                                        <td>
                                            {{$ban->created_at}}
                                        </td>
                                        <td>
                                            {{$ban->updated_at}}
                                        </td>
                                        <td>
                                            <a href="editBan?ban={{$ban->id}}">+</a>
                                        </td>
                                        {{--@if(Auth::user()->hasRole('admin'))--}}
                                        {{--<td>--}}
                                        {{--{{ csrf_field()}}--}}
                                        {{--<a href="{{route('deleteAdminUser',$user->id)}}"--}}
                                        {{--onclick="return confirm('Are you sure you want to delete this User?');">-</a>--}}
                                        {{--</td>--}}
                                        {{--@endif--}}
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div><!-- Content Sec -->
        </div><!-- Page Container -->
    </div><!-- main -->
</div>
@include('admin/layouts.footer')