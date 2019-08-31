@include('layouts.header')

<section id="blacklist">
    <div class="container">
        {{-- <h2>Черный список:</h2> --}}
        <div class="row justify-content-center">
            <div class="col-lg-10 col-md-10 col-sm-10 col-11 blacklist-card">
                <ul class="blacklist-list">
                    @forelse($blacklist as $nonGrata)
                        <li class="blacklist-item">
                            <div class="blacklist-user-image">
                                <a href="#">
                                    <img src="{{asset($nonGrata->profileNonGrata->profilePhoto()
                              ->where([['main_photo_marker', '=', 1], ['is_deleted', '=', 0]])
                              ->first()->photo_path ?? 'profilepictures/'
                              .$nonGrata->profileNonGrata->gender_id . '.jpg')}}">
                                </a>
                            </div>
                            <div class="blacklist-user-name">
                                <a href="profile?prf={{$nonGrata->profileNonGrata->id}}">{{$nonGrata->profileNonGrata->first_name . ' ' . $nonGrata->profileNonGrata->second_name}}</a>
                                
                                <div class="d-flex blacklist-short-info">
                                    
                                </div>

                                @if ($nonGrata->profileNonGrata->last_activity)
                                    <p class="blacklist-user-activity">{{$nonGrata->profileNonGrata->lastActivity()}}</p>
                                @endif

                            </div>
                            <a href="{{route('deleteFromBlackList',$nonGrata->id)}}"  onclick="return confirm('Вы действительно хотите удалить пользователя?');">
                                <button type="button" class="btn btn-default btn btn-md"><i
                                            class="fas fa-times"></i></button>
                            </a>

                        </li>
                    @empty
                        {{-- <li class="blacklist-item">
                            Ваш черный список пуст.
                        </li> --}}
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</section>

@include('layouts.footer')