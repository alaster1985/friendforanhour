@include('admin/layouts.header')
@include('admin/layouts.menu')
<div class="content-sec">
    <div class="container">
        <div class="title-date-range">
            <div class="row">
                <div class="col-md-6">
                    <div class="main-title">
                        <h1>All articles for {{$ctg->category_name ?? 'all '}} category</h1>
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
                                    {{--<th>Article ID</th>--}}
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
                                @foreach($articles as $article)
                                    <tr id="trId">
                                        {{--<td>--}}
                                            {{--{{$article->id}}--}}
                                        {{--</td>--}}
                                        <td>
                                            {{$article->title}}
                                        </td>
                                        <td>
                                            <img style="height: 75px" src="{{asset($article->photo)}}">
                                        </td>
                                        <td>
                                            {{$article->disabled ? 'YES' : 'NO'}}
                                        </td>
                                        <td>
                                            {{$article->getExcerpt()}}
                                        </td>
                                        <td>
                                            {{$article->created_at}}
                                        </td>
                                        <td>
                                            {{$article->updated_at}}
                                        </td>
                                        <td>
                                            <a href="editArticles?id={{$article->id}}">+</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{$articles->links()}}
                        </div>
                    </div>
                </div>
            </div><!-- Content Sec -->
        </div><!-- Page Container -->
    </div><!-- main -->
</div>
@include('admin/layouts.footer')