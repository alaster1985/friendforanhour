@include('layouts.header')

    <section id="new_people_servis">
        <div class="container">
            <div class="row new_people_servis_block">
                <div class="label_new_people col-xl-1 col-lg-1 col-md-2 col-sm-2 col-3">
                    <p>Новые друзья</p>
                </div>                
                <ul class="col-xl-11 col-lg-11 col-md-10 col-sm-10 col-9">
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
        </div>
    </section>

    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-12">
                @guest
                    @include('auth.loginTest')
                @endguest
                <aside id="main-page-aside-news">
                    <div class="block_news">
                        @foreach($news as $val)
                        <div class="card border-light mb-3">
                            <a href="newsView?nws={{$val->id}}">
                                {{-- <div class="card-header">Header</div> --}}
                                <div class="card-body">
                                    <h6 class="card-title">{{$val->title}}</h6>
                                    <p class="card-text">{{$val->getDate()}}</p>
                                </div>
                            </a>
                        </div>
                            {{-- <a href="newsView?nws={{$val->id}}">
                                <p>{{$val->getDate()}}</p>
                                <p>{{$val->title}}</p>
                            </a> --}}
                        @endforeach
                    </div>
                </aside>
            </div>
            <div class="col-xl-9 col-lg-9 col-md-8 col-sm-12">
                <section id="map-section">
                    <div class="map_container">
                        <div class="map-card">
                            <p>Карта друзей, услуг и людей, у которых можно заработать деньги на 1-HF.com</p>
                            @include('map')
                        </div>
                    </div>
                </section>
            </div>
        </div>

        <section id="last-active-users">
            <div class="container"
            @guest
                style="padding-right:15px;padding-left:15px;"
            @endguest
            >
                <div id="{{Auth::check() ? 'chat-vue' : ''}}" class="row users_prew_block">
                    @foreach($profilesForLowerBlocks as $lProfile)                    
                    <div class="card">
                        <div class="row no-gutters" style="height: 100%;">
                            <div class="col-lg-7" style="overflow: hidden;">
                                <a class="profile-img-link" href="profile?prf={{$lProfile->id}}">
                                    <img class="user_image card-img" src="{{asset($lProfile->profilePhoto()->where([['main_photo_marker', '=', 1], ['is_deleted', '=', 0]])->first()->photo_path ?? 'profilepictures/' .$lProfile->gender_id . '.jpg')}}">
                                </a>
                            </div>
                            <div class="col-lg-5">
                                <div class="card-body">
                                    <div class="last-active-users-about">
                                        <div class="d-flex justify-content-between last-active-users-about-title">
                                            <h5 class="card-title">
                                                <a href="profile?prf={{$lProfile->id}}"><span class="name_user_cart">{{$lProfile->first_name}},<span> {{$lProfile->getAge($lProfile->date_of_birth)}}</span></span></a>
                                            </h5>
                                            <div class="users-online-indicator">
                                                <online v-bind:friend="{{ $lProfile }}" v-bind:onlineusers="onlineUsers"></online>
                                            </div>
                                            @guest
                                                @if($lProfile->profileOnline())
                                                    <span class="online-color"><img style="height:13px" src="/images/monitor1.svg"></span>
                                                @else
                                                    <span class="offline-color"><img style="height:13px" src="/images/monitor0.svg"></span>
                                                @endif
                                            @endguest
                                        </div>
                                        <span class="city_user_cart">{{isset($lProfile->profileAddress->city_id) ? $lProfile->profileAddress->city->city_name : 'unknown'}}</span>
                                        <span class="title_serwise">Заплачу за:</span>
                                        @foreach(ServiceList::getServiceListByProfileIdForSponsor($lProfile->id)->where('main_service_marker', '=', 1) as $service)
                                            <span class="name_serwise_cart name_serwise">
                                                <span>{{$service->service_name}}</span>
                                                <span>{{(!$service->price ? 'беспл.' : $service->price).($service->price ?'р':'')}}</span>
                                            </span>
                                        @endforeach
                                        <span class="title_serwise name_serwise">Сделаю за деньги:</span>
                                        @foreach(ServiceList::getServiceListByProfileIdForFriend($lProfile->id)->where('main_service_marker', '=', 1) as $service)
                                            <span class="name_serwise_cart name_serwise">
                                                <span>{{$service->service_name}}</span>
                                                <span>{{(!$service->price ? 'беспл.' : $service->price).($service->price ?'р':'')}}</span>
                                            </span>
                                        @endforeach
                                    </div>
                                        
                                    <div class="bottom-card-section">
                                        <span class="name_serwise_cart name_serwise_cart_link">
                                            @if(isset(Auth::user()->profile_id) && Auth::user()->profile_id != $lProfile->id)
                                                <form method="POST" action="{{Route('addToFriends')}}" enctype="multipart/form-data">
                                                    <input type="hidden" name="friend_id" value="{{$lProfile->id}}">
                                                @csrf
                                                    <button class="btn btn-sm btn-block" type="submit">Написать сообщение</button>
                                                </form>
                                            @endif                                        
                                        </span>  
                                    </div>
                                                                          
                                    @guest                                           
                                        <div class="bottom-card-section">
                                            <button class="btn btn-md btn-block offline-write-btn" type="submit">
                                                <a class="forChat" href="javascript:void(0);">Написать сообщение</a>
                                            </button>
                                        </div>
                                    @endguest
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach                    
                    {{-- <div class="col-lg-4 col-md-6">
                        <table id="tablePreview" class="col-12 card_user_prev table table-borderless">
                            <tbody class="row ">
                                <tr class="col-5 block_image">
                                    <td>
                                        <a href="profile?prf={{$lProfile->id}}">
                                            <img class="User_image" src="{{asset($lProfile->profilePhoto()->where([['main_photo_marker', '=', 1], ['is_deleted', '=', 0]])->first()->photo_path ?? 'profilepictures/' .$lProfile->gender_id . '.jpg')}}">
                                            <span><img src="{{ asset('images/camera.svg') }}"> {{$lProfile->profilePhoto()->where('is_deleted', '=', 0)->get()->count()}}</span>
                                        </a>
                                    </td>
                                </tr>
                                <tr class="row">
                                    <td class="user_description_cart col-12">
                                        <a href="profile?prf={{$lProfile->id}}"><span class="name_user_cart">{{$lProfile->first_name}},<span> {{$lProfile->getAge($lProfile->date_of_birth)}}</span></span></a>
                                        <span class="city_user_cart">{{$lProfile->profileAddress->city->city_name}}</span>
                                        <span class="title_serwise">Заплачу за</span>
                                        @foreach(ServiceList::getServiceListByProfileIdForSponsor($lProfile->id)->where('main_service_marker', '=', 1) as $service)
                                            <span class="name_serwise_cart name_serwise">
                                                <span>{{$service->service_name}}</span>
                                                <span>{{(!$service->price ? 'беспл.' : $service->price).($service->price ?'р':'')}}</span>
                                            </span>
                                        @endforeach
                                        <span class="title_serwise name_serwise">Сделаю за деньги</span>
                                        @foreach(ServiceList::getServiceListByProfileIdForFriend($lProfile->id)->where('main_service_marker', '=', 1) as $service)
                                            <span class="name_serwise_cart name_serwise">
                                                <span>{{$service->service_name}}</span>
                                                <span>{{(!$service->price ? 'беспл.' : $service->price).($service->price ?'р':'')}}</span>
                                            </span>
                                        @endforeach
                                            <span class="name_serwise_cart name_serwise_cart_link">
                                                @if(isset(Auth::user()->profile_id) && Auth::user()->profile_id != $lProfile->id)
                                                    <form method="POST" action="{{Route('addToFriends')}}" enctype="multipart/form-data">
                                                        <input type="hidden" name="friend_id" value="{{$lProfile->id}}">
                                                        @csrf
                                                        <button type="submit">Написать</button>
                                                    </form>
                                                @endif
                                                <online v-bind:friend="{{ $lProfile }}" v-bind:onlineusers="onlineUsers"></online>
                                            </span>
                                        @guest
                                        @if($lProfile->profileOnline())
                                            <span><img style="height: 15px;" src="/images/monitor1.svg">Онлайн</span>
                                            @else
                                            <span><img style="height: 15px;" src="/images/monitor0.svg">Офлайн</span>
                                        @endif
                                            <a class="forChat" href="javascript:void(0);">Написать</a>
                                        @endguest
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div> --}}
                </div>
            </div>
        </section>
    </div>

@include('layouts.footer')