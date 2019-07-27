@include('layouts.header')
<section id="view-profile">
    <div class="container">
        <h2>Анкета:</h2>
        <div class="row justify-content-center">
            <div class="row col-lg-10 col-md-10 col-sm-10 col-11 view-profile-card mobile_shadow_off justify-content-center">

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

                <div class="col-lg-6 view-profile-character">
                    <p class="name_user ">{{$profile->first_name}}
                        @auth
                            <span id="app2">
                                <online v-bind:friend="{{ $profile }}"
                                        v-bind:onlineusers="onlineUsers"></online>
                            </span>
                        @endauth
                    </p>
                    <p class="character_user">
                        Возраст: {{$profile->getAge()}}, 
                        рост {{$profile->height}}см, 
                        вес {{$profile->weight}} кг
                    </p>
                    @if($profile->profileAddress->city_id)
                    <p class="character_user">
                        {{$profile->profileAddress->city->country->country_name}}, 
                        {{$profile->profileAddress->city->city_name}}
                    </p>
                    <div class="about_user_block">
                        <h4>Немного о себе:</h4>
                        <div>
                            {{$profile->about}}
                        </div>
                    </div>
                    @endif
                    @auth
                        @if(isset(Auth::user()->profile_id) && Auth::user()->profile_id != $profile->id)
                            <div class="links_user">
                                <form method="POST" action="{{Route('addToFriends')}}" enctype="multipart/form-data">
                                    <input type="hidden" name="friend_id" value="{{$profile->id}}">
                                    @csrf
                                    <button type="submit">Написать сообщение</button>
                                </form>
                                @if(!$checkComplain)
                                    <button id="complainButton" class="btn btn-info btn-lg" data-toggle="modal"
                                            data-target="#myModal">Пожаловаться
                                    </button>
                                @endif
                            </div>
                        @endif
                    @endauth
                    @guest
                        <a class="forChat" href="javascript:void(0);">Написать</a>
                    @endguest
                </div>

                
                <div class="row col-lg-12 service service_close">

                    <div class="col-lg-6 table_mobile">
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

                    <div class="col-lg-6 table_mobile">
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
                                
                                <h2 class="modal-title">Пожаловаться</h2>
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
                                <button type="button" id="sendComplain" class="btn btn-default btn btn-primary btn-md" data-dismiss="modal">Отправить жалобу
                                </button>
                                <button type="button" class="btn btn-default btn btn-primary btn-md" data-dismiss="modal">Закрыть</button>
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