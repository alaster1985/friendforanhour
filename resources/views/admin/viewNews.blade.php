@include('admin/layouts.header')
@include('admin/layouts.menu')
<div class="content-sec">
    <div class="container">
        <div class="title-date-range">
            <div class="row">
                <div class="col-md-6">
                    <div class="main-title">
                        <h1>NEWS</h1>
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
                            @if(session()->has('message'))
                                <div class="alert alert-success" align="center">
                                    {{ session()->get('message') }}
                                </div>
                            @endif
                            <span id="found" class="label label-info"></span>
                            <table id="stream_table" class='table table-striped table-bordered'>
                                <thead>
                                <tr>
                                    <th>News ID</th>
                                    <th>Title</th>
                                    <th>Photo</th>
                                    <th>Disabled</th>
                                    <th>Content</th>
                                    <th>Created_at</th>
                                    <th>Updated_at</th>
                                    <th>Edit</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($news as $val)
                                    <tr id="trId">
                                        <td>
                                            {{$val->id}}
                                        </td>
                                        <td>
                                            {{$val->title}}
                                        </td>
                                        <td>
                                            <img style="height: 75px" src="{{asset($val->photo)}}">
                                        </td>
                                        <td>
                                            {{$val->disabled ? 'YES' : 'NO'}}
                                        </td>
                                        <td>
                                            {{$val->getExcerpt()}}
                                        </td>
                                        <td>
                                            {{$val->created_at}}
                                        </td>
                                        <td>
                                            {{$val->updated_at}}
                                        </td>
                                        <td>
                                            <a href="editNews?id={{$val->id}}">+</a>
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