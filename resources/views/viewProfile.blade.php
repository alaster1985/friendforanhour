
@include('layouts.header')
<div class="container">
     <div class="row information_user">
         <div class="col-3 user_avatar">
            <img src="{{ asset('images/animals.jpg') }}">
         </div>
         <div class="col-9">
            <p class="name_user ">Лисицин <span><span class="offline_user">Была вчера в <span>19:59</span></span><span class="overview"><img src="{{ asset('images/user_icon.png') }}">38</span></span></p>
            <p class="character_user" >23 года, рост 175 см, вес 57 кг</p>
            <p class="character_user" >Россия, Москва, <span class="distance">2 км от вас </span></p>
            <div class="links_user">
                <button>Написать сообщение</button>
                <a href="">В избранное</a>
                <a href="">Пожаловаться</a>
                <a href="">В черный список</a>
            </div>
            <div class="row service">
                <div class="col-8">
                        <table border="1">
                                <tr>
                                    <th>short service name</th>
                                    <th>description service</th>
                                    <th>price</th>
                                    <th>main marker</th>
                                </tr>
                                @foreach($friendsServices as $list)
                                    <tr>
                                        <td>{{$list->service_name}}</td>
                                        <td>{{$list->service_description}}</td>
                                        <td>{{!$list->price ? 'Бесплатно' : $list->price}}</td>
                                        <td>{{$list->main_service_marker ? 'основная' : ''}}</td>
                                    </tr>
                                @endforeach
                            </table>
                            <br>
                            <div>I wont give it to you for money:</div>
                            <table border="1">
                                <tr>
                                    <th>short service name</th>
                                    <th>description service</th>
                                    <th>price</th>
                                    <th>main marker</th>
                                </tr>
                                @foreach($sponsorsServices as $list)
                                    <tr>
                                        <td>{{$list->service_name}}</td>
                                        <td>{{$list->service_description}}</td>
                                        <td>{{!$list->price ? 'Бесплатно' : $list->price}}</td>
                                        <td>{{$list->main_service_marker ? 'основная' : ''}}</td>
                                    </tr>
                                @endforeach
                            </table>
                </div>
                <div class="col-4">
                    <p>Немного о себе</p>
                    <div>
                            {{$user->profile->about}}
                    </div>
                </div>
            </div>
        </div>
   
     </div>
    <div class="user_content">

            <div class="photo_user">
                     <img  src="{{ asset('images/animals.jpg') }}">
                     <img src="{{ asset('images/animals.jpg') }}">
                     <img src="{{ asset('images/animals.jpg') }}">
                     <img src="{{ asset('images/animals.jpg') }}">
                     <img src="{{ asset('images/animals.jpg') }}">
                     <img src="{{ asset('images/animals.jpg') }}">
                     <img src="{{ asset('images/animals.jpg') }}">
                     <img src="{{ asset('images/animals.jpg') }}">
                     <img src="{{ asset('images/animals.jpg') }}">
                     
            </div>
            
    </div>
<a href="edit">edit own profile</a>
<div>nickname = {{$user->name}}</div>
<div>first name = {{$user->profile->first_name}}</div>
<div>second name = {{$user->profile->second_name}}</div>
<div>date of birth = {{$user->profile->date_of_birth}}</div>
<div>age = {{$user->profile->getAge($user->profile->date_of_birth)}}</div>
<div>about me = {{$user->profile->about}}</div>
<div>gender = {{$user->profile->gender->gender}}</div>
<div>phone = {{$user->profile->phone}}</div>
<div>address = {{$user->profile->profileAddress->address}}</div>
<div>latitude = {{$user->profile->profileAddress->latitude}}</div>
<div>longitude = {{$user->profile->profileAddress->longitude}}</div>
<div>city = {{$user->profile->profileAddress->city->city_name}}</div>
<div>country = {{$user->profile->profileAddress->city->country->country_name}}</div>
<br>
<div>I wont pay for:</div>
<table border="1">
    <tr>
        <th>short service name</th>
        <th>description service</th>
        <th>price</th>
        <th>main marker</th>
    </tr>
    @foreach($friendsServices as $list)
        <tr>
            <td>{{$list->service_name}}</td>
            <td>{{$list->service_description}}</td>
            <td>{{!$list->price ? 'Бесплатно' : $list->price}}</td>
            <td>{{$list->main_service_marker ? 'основная' : ''}}</td>
        </tr>
    @endforeach
</table>
<br>
<div>I wont give it to you for money:</div>
<table border="1">
    <tr>
        <th>short service name</th>
        <th>description service</th>
        <th>price</th>
        <th>main marker</th>
    </tr>
    @foreach($sponsorsServices as $list)
        <tr>
            <td>{{$list->service_name}}</td>
            <td>{{$list->service_description}}</td>
            <td>{{!$list->price ? 'Бесплатно' : $list->price}}</td>
            <td>{{$list->main_service_marker ? 'основная' : ''}}</td>
        </tr>
    @endforeach
</table>
<br>
<div>My photo</div>

<table border="1" id="usersPhoto">
    <tr>
        <th>Photo</th>
        <th>main marker</th>
    </tr>
</table>
<br>
<br>
</div>
@include('layouts.footer')