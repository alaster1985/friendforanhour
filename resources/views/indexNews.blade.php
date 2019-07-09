@include('layouts.header')
@forelse($news as $post)
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
            <div class="col-sm-6">
                <a href="newsView?nws={{$post->id}}">{{$post->title}}</a>
            </div>
            <div class="col-sm-6">
                <img style="width: 200px" src="{{asset($post->photo)}}" alt="">
            </div>
            <div class="col-sm-6">
                <p>{{$post->getExcerpt()}}</p>
            </div>
        </div>
    </div>
@empty
    <p>there are no news here yet</p>
@endforelse
@include('layouts.footer')