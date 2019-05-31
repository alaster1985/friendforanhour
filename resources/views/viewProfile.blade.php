@include('layouts.header')
<div class="container">
    <div class="row information_user">
        <div class="col-sm-3 col-12 user_avatar">
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
        <div class="col-sm-9 col-12">
            <p class="name_user ">{{$profile->first_name}}
                @auth
                    {{--<span>--}}
                    {{--<span class="offline_user">Была вчера в<span>19:59</span>--}}
                    {{--</span>--}}
                    {{--<span class="overview">--}}
                    {{--<img src="{{ asset('images/user_icon.png') }}">--}}{{--38--}}
                    {{--</span>--}}
                    {{--</span>--}}
                @endauth
            </p>
            <p class="character_user">Возраст: {{$profile->getAge($profile->date_of_birth)}}, рост {{$profile->height}} см, вес
                {{$profile->weight}} кг</p>
            <p class="character_user">{{$profile->profileAddress->city->country->country_name}}, {{$profile->profileAddress->city->city_name}}@auth, <span class="distance">2 км от вас </span>@endauth</p>
            @auth
                <div class="links_user">
                    <button>Написать сообщение</button>
                    {{--<a href="">В избранное</a>--}}
                    <a href="">Пожаловаться</a>
                    {{--<a href="">В черный список</a>--}}
                </div>
            @endauth
            <div class="row  service service_close">
                <div class="col-lg-8 col-12 ">
                    <table class="col-12 table_for_me">
                        <tr>
                            <th class="table_title_service">Я сделаю за деньги</th>
                            <th></th>
                        </tr>
                        @foreach($friendsServices as $list)
                            <tr>

                                <td>{{$list->service_description}}</td>
                                <td>{{!$list->price ? 'Бесплатно' : $list->price}}</td>
                            </tr>
                        @endforeach
                    </table>
                    <button class="table_for_me_open"><span class="open_table">Подробнее</span><span
                                class="close_table">Свернуть</span></button>

                    <table class="col-12 table_paid">
                        <tr>
                            <th class="table_title_service">Я заплачу за</th>
                            <th></th>
                        </tr>
                        @foreach($sponsorsServices as $list)
                            <tr>

                                <td>{{$list->service_description}}</td>
                                <td>{{!$list->price ? 'Бесплатно' : $list->price}}</td>

                            </tr>
                        @endforeach
                    </table>
                    <button class="table_paid_open"><span class="open_table">Подробнее</span><span
                                class="close_table">Свернуть</span></button>
                </div>
                <div class="col-lg-4 col-12 about_user_block">
                    <p>Немного о себе</p>
                    <div>
                        {{$profile->about}}
                    </div>
                </div>
            </div>

        </div>
        <div class="user_content col-12">
            <div class="photo_user">
                @foreach($photos as $photo)
                <a data-fancybox="images" rel="group" href="{{ asset($photo->photo_path) }}">
                    <img src="{{ asset($photo->photo_path) }}">
                </a>
                @endforeach
            </div>
        </div>
        <div class="map_container">
            <h6>{{$profile->first_name}} на карте</h6>
            <!-- <button id="i_am_here">мое текущее место положение</button>
            <button id="i_am_here_mouse">мое текущее место положение поставленное мышкой</button> -->
            @include('map')
        </div>

    </div>

    {{--<a href="edit">edit own profile</a>--}}

    {{--<div>nickname = {{$profile->user()->where('profile_id','=', $profile->id)->first()->name}}</div>--}}
    {{--<div>first name = {{$profile->first_name}}</div>--}}
    {{--<div>second name = {{$profile->second_name}}</div>--}}
    {{--<div>date of birth = {{$profile->date_of_birth}}</div>--}}
    {{--<div>age = {{$profile->getAge($profile->date_of_birth)}}</div>--}}
    {{--<div>about me = {{$profile->about}}</div>--}}
    {{--<div>gender = {{$profile->gender->gender}}</div>--}}
    {{--<div>phone = {{$profile->phone}}</div>--}}
    {{--<div>address = {{$profile->profileAddress->address}}</div>--}}
    {{--<div>latitude = {{$profile->profileAddress->latitude}}</div>--}}
    {{--<div>longitude = {{$profile->profileAddress->longitude}}</div>--}}
    {{--<div>city = {{$profile->profileAddress->city->city_name}}</div>--}}
    {{--<div>country = {{$profile->profileAddress->city->country->country_name}}</div>--}}
    {{--<br>--}}
    {{--<div>I wont pay for:</div>--}}
    {{--<table border="1">--}}
        {{--<tr>--}}
            {{--<th>short service name</th>--}}
            {{--<th>description service</th>--}}
            {{--<th>price</th>--}}
            {{--<th>main marker</th>--}}
        {{--</tr>--}}
        {{--@foreach($friendsServices as $list)--}}
            {{--<tr>--}}
                {{--<td>{{$list->service_name}}</td>--}}
                {{--<td>{{$list->service_description}}</td>--}}
                {{--<td>{{!$list->price ? 'Бесплатно' : $list->price}}</td>--}}
                {{--<td>{{$list->main_service_marker ? 'основная' : ''}}</td>--}}
            {{--</tr>--}}
        {{--@endforeach--}}
    {{--</table>--}}
    {{--<br>--}}
    {{--<div>I wont give it to you for money:</div>--}}
    {{--<table border="1">--}}
        {{--<tr>--}}
            {{--<th>short service name</th>--}}
            {{--<th>description service</th>--}}
            {{--<th>price</th>--}}
            {{--<th>main marker</th>--}}
        {{--</tr>--}}
        {{--@foreach($sponsorsServices as $list)--}}
            {{--<tr>--}}
                {{--<td>{{$list->service_name}}</td>--}}
                {{--<td>{{$list->service_description}}</td>--}}
                {{--<td>{{!$list->price ? 'Бесплатно' : $list->price}}</td>--}}
                {{--<td>{{$list->main_service_marker ? 'основная' : ''}}</td>--}}
            {{--</tr>--}}
        {{--@endforeach--}}
    {{--</table>--}}
    {{--<br>--}}
    {{--<div>My photo</div>--}}

    {{--<table border="1" id="usersPhoto">--}}
        {{--<tr>--}}
            {{--<th>Photo</th>--}}
            {{--<th>main marker</th>--}}
        {{--</tr>--}}
    {{--</table>--}}
    {{--<br>--}}
    {{--<br>--}}
</div>
@include('layouts.footer')