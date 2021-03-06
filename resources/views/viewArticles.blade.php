@include('layouts.header')

<section id="single-article-page">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-8 col-sm-8 col-11 justify-content-center article-card">
                <div class="single-article-page-title">
                    <h3>{{$article->title}}</h3>
                </div>
                <div class="single-article-page-img">
                    <img src="{{asset($article->photo)}}" alt="">
                </div>
                <div class="single-article-page-txt">
                    <p>{!! nl2br($article->content) !!}</p>
                </div>
            </div>
        </div>
    </div>
</section>

@include('layouts.footer')