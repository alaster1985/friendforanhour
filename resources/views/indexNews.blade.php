@include('layouts.header')
<section id="all-news-section">
    <div class="container">
        {{-- <h2>Новости:</h2> --}}
        @forelse($news as $post)
            <div class="row justify-content-center">
                <div class="col-lg-10 col-md-10 col-sm-10 col-10 all-news-card">
                    <div class="all-news-title">
                        <h3><a href="newsView?nws={{$post->id}}">{{$post->title}}</a></h3>
                    </div>
                    <div class="article-page-img">
                        <img src="{{asset($post->photo)}}" alt="">
                    </div>
                    <div class="article-page-txt">
                        <p>{{$post->getExcerpt()}}</p>
                    </div>
                </div>
            </div>
        @empty
            <p>there are no news here yet</p>
        @endforelse
    </div>
</section>
@include('layouts.footer')