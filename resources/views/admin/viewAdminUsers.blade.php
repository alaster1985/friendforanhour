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
                        <h1>Admin users</h1>
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
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Created_at</th>
                                    <th>Updated_at</th>
                                    @if(Auth::user()->hasRole('admin'))
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    @endif
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>
                                            {{$user->name}}
                                        </td>
                                        <td>
                                            {{$user->email}}
                                        </td>
                                        <td>
                                            {{$user->roles->first()->name}}
                                        </td>
                                        <td>
                                            {{$user->created_at}}
                                        </td>
                                        <td>
                                            {{$user->updated_at}}
                                        </td>
                                        @if(Auth::user()->hasRole('admin'))
                                            <td>
                                                <a href="editAdminUser?user={{$user->id}}">+</a>
                                            </td>
                                            <td>
                                                {{ csrf_field()}}
                                                <a href="{{route('deleteAdminUser',$user->id)}}"
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