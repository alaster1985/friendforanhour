@include('layouts.header')

<body>
<div class="container">
    <div class="new_people_servis row">
        <div class="label_new_people col-sm-2 col-md-1">
            <p>Новые друзья</p>
        </div>
        <ul class="col-sm-10 col-md-11">
            @foreach($newProfiles as $profile)
                <li>
                    <a href="profile?prf={{$profile->id}}">
                        <img src="{{asset($profile->profilePhoto()
                        ->where([['main_photo_marker', '=', 1], ['is_deleted', '=', 0]])
                        ->first()->photo_path ?? 'profilepictures/'
                        .$profile->gender_id . '.jpg')}}">
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

        <div class="row">
            <div class="col-3 left-column">
                @guest
                    @include('auth.loginTest')
                @endguest
                <div class="block_news">
                    <h5>Новости</h5>
                    <a href="" target="_blank">
                        <p>30 апреля</p>
                        <p>Всемирный дефицит женщин: ученые бьют тревогу</p>
                    </a>
                    @auth
                        <a href="" target="_blank">
                            <p>30 апреля</p>
                            <p>Всемирный дефицит женщин: ученые бьют тревогу</p>
                        </a>
                        <a href="" target="_blank">
                            <p>30 апреля</p>
                            <p>Всемирный дефицит женщин: ученые бьют тревогу</p>
                        </a>
                        <a href="" target="_blank">
                            <p>30 апреля</p>
                            <p>Всемирный дефицит женщин!</p>
                        </a>
                    @endauth
                </div>
            </div>
            <div class="col-lg-9 col-12">
                <div class="map_container">
                    <h6>Карта друзей, услуг и людей, у которых можно заработать деньги на 1-HF.com</h6>
                    @include('map')
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row justify-content-between users_prew_block">
                @foreach($profilesForLowerBlocks as $lProfile)
                    <div class="col-lg-4 col-md-6">
                        <table id="tablePreview" class="col-12 card_user_prev table table-borderless">
                            <tbody class="row ">
                            <tr class="col-5 block_image">
                                <td>
                                    <a href="profile?prf={{$lProfile->id}}">
                                        <img class="User_image"
                                             src="{{asset($lProfile->profilePhoto()
                                             ->where([['main_photo_marker', '=', 1], ['is_deleted', '=', 0]])
                                             ->first()->photo_path ?? 'profilepictures/'
                                             .$lProfile->gender_id . '.jpg')}}">
                                        <span><img src="{{ asset('images/camera.svg') }}"> {{$lProfile->profilePhoto()
                                        ->where('is_deleted', '=', 0)->get()->count()}}</span>
                                    </a>
                                </td>
                            </tr>
                            <tr class="col-7 row mar">
                                <td class="user_description_cart col-12">
                                    <a href="profile?prf={{$lProfile->id}}"><span class="name_user_cart">{{$lProfile->first_name}}
                                        ,<span> {{$lProfile->getAge($lProfile->date_of_birth)}}</span></span></a>
                                    <span class="city_user_cart">{{$lProfile->profileAddress->city->city_name}}
                                        <br> <span>5км от вас</span></span>
                                    <span class="title_serwise">
                                        Заплачу за
                                    </span>
                                    @foreach(ServiceList::getServiceListByProfileIdForSponsor($lProfile->id)
                                    ->where('main_service_marker', '=', 1) as $service)
                                        <span class="name_serwise_cart name_serwise">
                                        <span>{{$service->service_name}}</span>
                                            <span>{{(!$service->price ? 'беспл.' : $service->price)
                                        .($service->price ?'р':'')}}</span>
                                    </span>
                                    @endforeach
                                    <span class="title_serwise name_serwise">
                                        Сделаю за деньги
                                    </span>
                                    @foreach(ServiceList::getServiceListByProfileIdForFriend($lProfile->id)
                                    ->where('main_service_marker', '=', 1) as $service)
                                        <span class="name_serwise_cart name_serwise">
                                        <span>{{$service->service_name}}</span>
                                            <span>{{(!$service->price ? 'беспл.' : $service->price)
                                        .($service->price ?'р':'')}}</span>
                                    </span>
                                    @endforeach
                                    @auth
                                        <span class="name_serwise_cart name_serwise_cart_link">
                                        <a href="">Написать</a><span><img
                                                        src="{{ asset('images/monitor.svg') }}">Онлайн</span>
                                    </span>
                                    @endauth
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>


<!--Load the API from the specified URL
* The async attribute allows the browser to render the page while the API loads
* The key parameter will contain your own API key (which is not needed for this tutorial)
* The callback parameter executes the initMap() function
-->

@include('layouts.footer')