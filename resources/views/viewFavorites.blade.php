@include('layouts.header')

<section id="favorites">
    <div class="container">
        {{-- <h2>Избранное:</h2> --}}
        <div class="row justify-content-center">
            <div class="col-lg-10 col-md-10 col-sm-10 col-11 favorites-card">
                <ul class="favorites-list">
                    @forelse($favorites as $favorite)
                        <li class="favorites-item">
                            <div class="favorites-user-image">
                                <a href="#">
                                    <img src="{{asset($favorite->profileFavorite->profilePhoto()
                              ->where([['main_photo_marker', '=', 1], ['is_deleted', '=', 0]])
                              ->first()->photo_path ?? 'profilepictures/'
                              .$favorite->profileFavorite->gender_id . '.jpg')}}">
                                </a>
                            </div>
                            <div class="favorites-user-name">
                                <a href="profile?prf={{$favorite->profileFavorite->id}}">{{$favorite->profileFavorite->first_name . ' ' . $favorite->profileFavorite->second_name}}</a>
                            </div>
                            <a href="{{route('deleteFromFavorite',$favorite->id)}}"  onclick="return confirm('Вы действительно хотите удалить пользователя?');">
                                <button type="button" class="btn btn-default btn btn-primary btn-md"><i
                                            class="fas fa-times"></i></button>
                            </a>

                        </li>
                    @empty
                        {{-- <li class="favorites-item">
                            Список избранных пользователей пуст
                        </li> --}}
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</section>

@include('layouts.footer')