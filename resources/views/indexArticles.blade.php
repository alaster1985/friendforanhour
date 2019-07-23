@include('layouts.header')
<section id="article-page">
    <div class="container">
    <h2>{{ArticleCategory::where('category_name', Request::get('ctg'))->first()->display_name ?? 'Все статьи'}}:</h2>
        <div class="single-article">
            @forelse($articles as $article)
                <div class="row justify-content-center">
                    <div class="col-lg-10 col-md-10 col-sm-10 col-11 justify-content-center article-card">
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