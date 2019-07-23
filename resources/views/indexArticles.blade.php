@include('layouts.header')
<section id="article-page">
    <div class="container">
    <h1>{{ArticleCategory::where('category_name', Request::get('ctg'))->first()->display_name ?? 'Все статьи'}}</h1>
        <div class="single-article">
            @forelse($articles as $article)
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-md-12 col-sm-12 col-12 justify-content-center article-card">
                        <div class="article-page-title">
                            <h2>
                                <a href="articlesView?art={{$article->id}}">{{$article->title}}</a>
                            </h2>
                        </div>
                        <div class="article-page-img">
                            <img src="{{asset($article->photo)}}" alt="">
                        </div>
                        <div class="article-page-txt">
                            <p>{{$article->getExcerpt()}}</p>
                        </div>
                    </div>
                </div>        
            @empty
                <p>There are no articles here yet</p>
            @endforelse
                {{$articles->links()}}
        </div>
    </div>
</section> 
@include('layouts.footer')