@include('layouts.header')

<section id="single-article-page">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-md-10 col-sm-10 col-11 single-article-card">
                <div class="single-article-page-title">
                    <h2>{{$article->title}}</h2>
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