@include('admin/layouts.header')
@include('admin/layouts.menu')
<div class="content-sec">
    <div class="container">
        <div class="title-date-range">
            <div class="row">
                <div class="col-md-6">
                    <div class="main-title">
                        <h1>ARTICLE EDIT</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <form action="{{Route('updateArticles')}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="masonary-grids">
                    <div class="col-md-12">
                        <div class="widget-area">
                            <div class="wizard-form-h">
                                <h2 class="StepTitle">ARTICLE ID: {{$article->id}}</h2>
                                @if ($errors)
                                    <div class="error" style="display: block">{{($errors->first())}}</div>
                                @endif
                                <input type="hidden" name="id" value="{{$article->id}}">
                                <div class="col-md-4">
                                    <div class="inline-form">
                                        <label class="c-label">Title</label>
                                        <input class="input-style" name="title" value="{{$article->title}}"/>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="inline-form">
                                        <label class="c-label">New Photo For This Article</label>
                                        <input class="input-style" name="photo" type="file"/>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="inline-form">
                                        <label class="c-label">Current Article Photo</label>
                                        <img style="height: 75px" src="{{asset($article->photo)}}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="inline-form">
                                        <label class="c-label">Article Disabled</label>
                                        <select name="disabled">
                                            <option id="yes" value="0" selected>NO</option>
                                            <option id="no" value="1">YES</option>
                                            @if($article->disabled === 1)
                                                <script>document.getElementById('no').selected = true</script>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="inline-form">
                                        <label class="c-label">Article Category</label>
                                        <select name="category_id">
                                            @foreach(ArticleCategory::all() as $ctg)
                                                <option id="ctg{{$ctg->id}}" value="{{$ctg->id}}">{{$ctg->display_name}}</option>
                                                @if($ctg->id === $article->category_id)
                                                    <script>document.getElementById('ctg{{$ctg->id}}').selected = true</script>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="inline-form">
                                        <label class="c-label">Created at</label>
                                        <input class="input-style" disabled
                                               name="created_at" value="{{$article->created_at}}"/>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="inline-form">
                                        <label class="c-label">Updated at</label>
                                        <input class="input-style" disabled
                                               name="updated_at" value="{{$article->updated_at}}"/>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="inline-form">
                                        <label class="c-label">Article Content</label>
                                        <textarea rows="4" class="input-style"
                                                  name="content">{{$article->content}}</textarea>
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