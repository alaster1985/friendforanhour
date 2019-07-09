@include('layouts.header')
<div class="row">
    <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
        <div class="col-sm-6">
            <p>{{$article->title}}</p> <a href="articles?ctg=all">all of articles</a>
        </div>
        <div class="col-sm-6">
            <img src="{{asset($article->photo)}}" alt="">
        </div>
        <div class="col-sm-6">
            <p>{{$article->content}}</p>
        </div>
    </div>
</div>
@include('layouts.footer')