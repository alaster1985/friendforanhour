@include('layouts.header')

<section id="view-profile">
    <div class="container">
        {{-- <h2>Профиль:</h2> --}}
        <div class="row justify-content-center">
            <div class="row col-lg-12 col-md-12 col-sm-12 col-12 view-profile-card mobile_shadow_off justify-content-center">

                <div class="col-lg-6 view-profile-photo">
                    <a data-fancybox="images" rel="group" href="{{asset($profile->profilePhoto()
                            ->where([['main_photo_marker', '=', 1], ['is_deleted', '=', 0]])
                            ->first()->photo_path ?? 'profilepictures/'
                            .$profile->gender_id . '.jpg')}}">
                        <img src="{{asset($profile->profilePhoto()
                                ->where([['main_photo_marker', '=', 1], ['is_deleted', '=', 0]])
                                ->first()->photo_path ?? 'profilepictures/'
                                .$profile->gender_id . '.jpg')}}">
                    </a>
                </div>

                <div class="col-lg-6 view-profile-character-container">
                    <div class="view-profile-character">
                        <div class="d-flex justify-content-between view-profile-character-container">
                            <div class="d-flex justify-content-start">
                                <p class="name_user ">
                                    {{$profile->first_name}}
                                </p>
                            </div>
                            <div class="col-lg-6 d-flex character_user_activity">
                                @if ($profile->last_activity)
                                <p id="last_activity" class="character_user online_user">{{$profile->lastActivity()}}</p>
                                @endif
                                <p class="character_user character_user_total_views"><i class="fas fa-users"></i>{{$total}}</p>
                                <p class="character_user character_user_week_views"><i class="fas fa-calendar-week"></i>{{$week}}</p>
                            </div>
                        </div>
                        
                        <div class="view-profile-short-info">
                            <p class="character_user">{{$profile->getAge()}}</p>
                            <p class="character_user">&nbsp<span style="color:#eaeaea;font-weight: 900;">/</span> Рост: {{$profile->height}} см</p>
                            <p class="character_user">&nbsp<span style="color:#eaeaea;font-weight: 900;">/</span> Вес: {{$profile->weight}} кг&nbsp<span style="color:#eaeaea;font-weight: 900;">/</span></p>
                        </div>
    
                        <p class="character_user">
                            {{$profile->profileAddress->city->country->country_name}}, 
                            {{$profile->profileAddress->city->city_name}}
                        </p>
    
                        @auth
                            @if(isset(Auth::user()->profile_id) && Auth::user()->profile_id != $profile->id)
                                <div class="links_user">
                                    <form method="POST" action="{{Route('addToFriends')}}" enctype="multipart/form-data">
                                        <input type="hidden" name="friend_id" value="{{$profile->id}}">
                                        @csrf
                                        <button id="write-link" class="btn btn-md" type="submit">Написать</button>
                                    </form>
                                    @if(!$checkFavorite)
                                        <button id="add-to-favorites" class="btn btn-md" type="button">В избранное</button>
                                    @endif
                                    @if(!$checkComplain)
                                        <button id="complainButton" class="btn btn-md" data-toggle="modal"
                                                data-target="#myModal">Пожаловаться
                                        </button>
                                    @endif
                                    @if(!$checkBlackList)
                                        <button id="to-blacklist" class="btn btn-md" type="button">В черный список</button>
                                    @endif
                                </div>
                            @endif
                        @endauth
    
                        @guest
                            <a class="forChat btn btn-md" href="javascript:void(0);">Написать</a>
                        @endguest
                        
                        @if($profile->profileAddress->city_id)
                            <div class="about_user_block">
                                <h4>Немного о себе:</h4>
                                <div>
                                    <p>{{$profile->about}}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-lg-12 d-flex view-profile-services-container">
                    <div class="service service_close view-profile-services">

                        <div class="table_mobile">
                            <table class="table_for_me">
                                <tr>
                                    <th class="table_title_service">
                                        <h4>Сделаю за деньги:</h4>
                                    </th>
                                </tr>
                                @foreach($friendsServices as $list)
                                <tr>
                                    <td>{{$list->service_description}}</td>
                                    <td>{{!$list->price ? 'Бесплатно' : $list->price}}</td>
                                </tr>
                                @endforeach
                            </table>
                            <button class="table_for_me_open">
                                <span class="open_table">Подробнее<i class="fas fa-chevron-down"></i></span>
                                <span class="close_table">Свернуть<i class="fas fa-chevron-up"></i></span>
                            </button>
                        </div>
    
                        <div class="table_mobile">
                            <table class="table_paid">
                                <tr>
                                    <th class="table_title_service">
                                        <h4>Заплачу за:</h4>
                                    </th>
                                </tr>
                                @foreach($sponsorsServices as $list)
                                <tr>
                                    <td>{{$list->service_description}}</td>
                                    <td>{{!$list->price ? 'Бесплатно' : $list->price}}</td>
                                </tr>
                                @endforeach
                            </table>
                            <button class="table_paid_open">
                                <span class="open_table">Подробнее<i class="fas fa-chevron-down"></i></span>
                                <span class="close_table">Свернуть<i class="fas fa-chevron-up"></i></span>
                            </button>
                        </div>
                    </div>
                </div>
                
                <div class="user_content col-lg-12">
                    <div class="photo_user">
                        @foreach($photos as $photo)
                            <a data-fancybox="images" rel="group" href="{{ asset($photo->photo_path) }}">
                                <img src="{{ asset($photo->photo_path) }}">
                            </a>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-12 map_mobile_padding" style="margin: 0 auto;">
                    <section id="map-section">
                        <div class="view_profile_map_container">
                            @include('map')
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
        {{-- MODAL --}}

        @auth
            <div class="container">
            {{--<h2>Modal Example</h2>--}}
            <!-- Trigger the modal with a button -->
            {{--<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>--}}

            <!-- Modal -->
                <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><i class="fas fa-times"></i></button>
                            </div>
                            <div class="modal-body">
                                <input id="profileIdAgainst" value="{{$profile->id}}"
                                    disabled style="display: none">
                                <input id="profileIdFrom" value="{{Auth::user()->profile_id}}"
                                    disabled style="display: none">
                                <textarea id="complain" class="form-control form-control-md"></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" id="sendComplain" class="btn btn-default btn btn-md" data-dismiss="modal">Отправить жалобу
                                </button>
                                <button type="button" class="btn btn-default btn btn-md" data-dismiss="modal">Закрыть</button>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        @endauth

        {{-- END MODAL --}}

    </div>
</section>
@include('layouts.footer')