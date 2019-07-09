@include('layouts.header')
<div class="row">
    <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
        <div class="col-sm-6">
            <p>{{$news->title}}</p> <a href="news">all news</a>
        </div>
        <div class="col-sm-6">
            <img src="{{asset($news->photo)}}" alt="">
        </div>
        <div class="col-sm-6">
            <p>{{$news->content}}</p>
        </div>
    </div>
</div>
@include('layouts.footer')