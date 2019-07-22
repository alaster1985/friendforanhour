@include('layouts.header')

    <section id="new_people_servis">
        <div class="container">
            <div class="row new_people_servis_block">
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
        </div>
    </section>

    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                @guest
                    @include('auth.loginTest')
                @endguest
                <aside id="main-page-aside-news">
                    <div class="block_news">
                        @foreach($news as $val)
                        <div class="card border-light mb-3" style="max-width: 18rem;">
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
            <div class="col-lg-9">
                <section id="map-section">
                    <div class="map_container">
                        @include('map')
                    </div>
                </section>
            </div>
        </div>

        <section id="last-active-users">
            <div class="container">
                <div id="{{Auth::check() ? 'app2' : ''}}" class="row users_prew_block">
                    @foreach($profilesForLowerBlocks as $lProfile)                    
                    <div class="card">
                        <div class="row no-gutters" style="height: 100%;">
                            <div class="col-lg-6" style="overflow: hidden;">
                                <a class="profile-img-link" href="profile?prf={{$lProfile->id}}">
                                    <img class="user_image card-img" src="{{asset($lProfile->profilePhoto()->where([['main_photo_marker', '=', 1], ['is_deleted', '=', 0]])->first()->photo_path ?? 'profilepictures/' .$lProfile->gender_id . '.jpg')}}">
                                </a>
                            </div>
                            <div class="col-lg-6">
                                <div class="card-body">
                                    <div class="last-active-users-about">
                                        <h5 class="card-title">
                                            <a href="profile?prf={{$lProfile->id}}"><span class="name_user_cart">{{$lProfile->first_name}},<span> {{$lProfile->getAge($lProfile->date_of_birth)}}</span></span></a>
                                        </h5>
                                        <span class="city_user_cart">{{$lProfile->profileAddress->city->city_name}}</span>
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

                                    <div class="row" style="justify-content: space-between;margin:0;">
                                        <online v-bind:friend="{{ $lProfile }}" v-bind:onlineusers="onlineUsers"></online>
                                        <div class="bottom-card-section">
                                            <span class="name_serwise_cart name_serwise_cart_link">
                                                @if(isset(Auth::user()->profile_id) && Auth::user()->profile_id != $lProfile->id)
                                                    <form method="POST" action="{{Route('addToFriends')}}" enctype="multipart/form-data">
                                                        <input type="hidden" name="friend_id" value="{{$lProfile->id}}">
                                                    @csrf
                                                        <button class="btn btn-primary btn-sm btn-block" type="submit">Написать</button>
                                                    </form>
                                                @endif                                        
                                            </span>  
                                        </div>
                                    </div>

                                                                          
                                    @guest
                                        <div class="row" style="justify-content: space-between;margin:0;">
                                            @if($lProfile->profileOnline())
                                                <span class="online-color"><img style="height:13px;margin:auto 3px auto 0;" src="/images/monitor1.svg">Онлайн</span>
                                            @else
                                                <span class="offline-color"><img style="height:13px;margin:auto 3px auto 0;" src="/images/monitor0.svg">Офлайн</span>
                                            @endif
                                                <div class="bottom-card-section">
                                                    <button class="btn btn-primary btn-md btn-block offline-write-btn" type="submit">
                                                        <a class="forChat" href="javascript:void(0);">Написать</a>
                                                    </button>
                                                </div>
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

<!--Load the API from the specified URL
* The async attribute allows the browser to render the page while the API loads
* The key parameter will contain your own API key (which is not needed for this tutorial)
* The callback parameter executes the initMap() function
-->

@include('layouts.footer')