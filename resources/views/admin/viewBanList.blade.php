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
                        <h4 class="StepTitle">BAN LIST</h4>
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
                            <table id="stream_table" class='table table-striped table-bordered'>
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Profile</th>
                                    <th>Reason</th>
                                    <th>Who set ban</th>
                                    <th>Duration, hr</th>
                                    <th>Ban end date</th>
                                    <th>Reason for amnesty</th>
                                    <th>Who set amnesty</th>
                                    <th>Created_at</th>
                                    <th>Updated_at</th>
                                    <th>Edit</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($bans as $ban)
                                    <tr>
                                        <td>
                                            <a href="editProfileUser?prf={{$ban->profile_id}}">{{$ban->profile->first_name . ' ' . $ban->profile->second_name}}</a>
                                        </td>
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
