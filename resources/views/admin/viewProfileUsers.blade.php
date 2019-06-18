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
                        <h1>Profile users</h1>
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
                                    <th>First Name</th>
                                    <th>Second Name</th>
                                    <th>DOB</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Is banned?</th>
                                    <th>Is locked?</th>
                                    <th>Subscription end date</th>
                                    <th>Subscription valid?</th>
                                    <th>Created_at</th>
                                    <th>Updated_at</th>
                                    <th>Edit</th>
                                    @if(Auth::user()->hasRole('admin'))
                                        <th>Delete</th>
                                    @endif
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($profiles as $profile)
                                    <tr>
                                        <td>
                                            {{$profile->id}}
                                        </td>
                                        <td>
                                            {{$profile->first_name}}
                                        </td>
                                        <td>
                                            {{$profile->second_name}}
                                        </td>
                                        <td>
                                            {{$profile->date_of_birth}}
                                        </td>
                                        <td>
                                            {{$profile->phone}}
                                        </td>
                                        <td>
                                            {{$profile->user()->where('profile_id','=', $profile->id)->first()->email}}
                                        </td>
                                        <td>
                                            {{$profile->is_banned ? 'BAN' : ''}}
                                        </td>
                                        <td>
                                            {{$profile->is_locked ? 'LOCKED' : ''}}
                                        </td>
                                        <td>
                                            {{gmdate("d M Y H:i:s", $profile->subscription_end_date)}}
                                        </td>
                                        <td>
                                            {{$profile->subscription_end_date >= strtotime('now') ? 'All is OK!' : 'Subscription Invalid'}}
                                        </td>
                                        <td>
                                            {{$profile->created_at}}
                                        </td>
                                        <td>
                                            {{$profile->updated_at}}
                                        </td>
                                        <td>
                                            <a href="editProfileUser?prf={{$profile->id}}">+</a>
                                        </td>
                                        @if(Auth::user()->hasRole('admin'))
                                            <td>
                                                {{ csrf_field()}}
                                                <a href="{{--{{route('deleteAdminUser',$profile->id)}}--}}"
                                                   onclick="return confirm('Are you sure you want to delete this User?');">-</a>
                                                {{ csrf_field()}}
                                            </td>
                                        @endif
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