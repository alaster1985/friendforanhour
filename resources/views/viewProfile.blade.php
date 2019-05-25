@include('layouts.app')
@include('layouts.header')
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

@include('layouts.footer')