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
                            <div class="favorites-user-card-ingo">
                                <a href="profile?prf={{$favorite->profileFavorite->id}}">{{$favorite->profileFavorite->first_name . ' ' . $favorite->profileFavorite->second_name}}</a>

                                <div class="d-flex favorites-short-info">
                                    <p class="character_user">{{$favorite->profileFavorite->getAge()}}</p>
                                    <p class="character_user">&nbsp<span style="color:#eaeaea;font-weight: 900;"> /</span>&nbsp Рост: {{$favorite->profileFavorite->height}} см</p>
                                    <p class="character_user">&nbsp<span style="color:#eaeaea;font-weight: 900;"> /</span>&nbsp Вес: {{$favorite->profileFavorite->weight}} кг&nbsp</p>
                                </div>

                                @if ($favorite->profileFavorite->last_activity)
                                    <p class="favorites-user-activity">{{$favorite->profileFavorite->lastActivity()}}</p>
                                @endif

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