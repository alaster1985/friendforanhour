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
                        <h1>Tickets</h1>
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
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Report</th>
                                    <th>Created_at</th>
                                    <th>Updated_at</th>
                                    <th>Edit</th>
                                {{--@if(Auth::user()->hasRole('admin'))--}}
                                        {{--<th>Delete</th>--}}
                                    {{--@endif--}}
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tickets as $ticket)
                                    <tr>
                                        <td>
                                            {{$ticket->title}}
                                        </td>
                                        <td>
                                            {{$ticket->getShortDesc()}}
                                        </td>
                                        <td>
                                            {{$ticket->status->status}}
                                        </td>
                                        <td>
                                            {{$ticket->report}}
                                        </td>
                                        <td>
                                            {{$ticket->created_at}}
                                        </td>
                                        <td>
                                            {{$ticket->updated_at}}
                                        </td>
                                        <td>
                                            <a href="editTicket?ticket={{$ticket->id}}">+</a>
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