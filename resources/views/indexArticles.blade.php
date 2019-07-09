@include('layouts.header')
@forelse($articles as $article)
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
            <div class="col-sm-6">
                <a href="articlesView?art={{$article->id}}">{{$article->title}}</a>
            </div>
            <div class="col-sm-6">
                <img style="width: 200px" src="{{asset($article->photo)}}" alt="">
            </div>
            <div class="col-sm-6">
                <p>{{$article->getExcerpt()}}</p>
            </div>
        </div>
    </div>
@empty
    <p>there are no articles here yet</p>
@endforelse
{{$articles->links()}}
@include('layouts.footer')