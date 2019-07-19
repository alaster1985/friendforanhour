@include('layouts.header')
<section id="single-news-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 single-news-card">
                <div class="all-news-link">
                    <a href="news"><i class="fas fa-chevron-left"></i>all news</a>
                </div>
                <div class="single-news-title">
                    <h2>{{$news->title}}</h2>
                </div>
                <div class="single-news-img">
                    <img src="{{asset($news->photo)}}" alt="">
                </div>
                <div class="">
                    <p>{!! nl2br($news->content) !!}</p>
                </div>
            </div>
        </div>
    </div>
</section>
@include('layouts.footer')