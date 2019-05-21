@include('layouts.app')
@include('layouts.header')
{{--{{dd($services[0]->serviceList->service_type_id)}}--}}
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
    @foreach($services as $list)
        @if($list->serviceList->service_type_id === 1)
            <tr>
                <td>{{$list->serviceList->service_name}}</td>
                <td>{{$list->serviceList->service_description}}</td>
                @if(!$list->serviceList->price)
                    <td>Бесплатно</td>
                @else
                    <td>{{$list->serviceList->price}}</td>
                @endif
                <td>{{$list->main_service_mark ? 'основная' : ''}}</td>
            </tr>
        @endif
    @endforeach
</table>
<br>
<div>I wont get for money:</div>
<table border="1">
    <tr>
        <th>short service name</th>
        <th>description service</th>
        <th>price</th>
        <th>main marker</th>
    </tr>
    @foreach($services as $list)
        @if($list->serviceList->service_type_id === 2)
            <tr>
                <td>{{$list->serviceList->service_name}}</td>
                <td>{{$list->serviceList->service_description}}</td>
                @if(!$list->serviceList->price)
                    <td>Бесплатно</td>
                @else
                    <td>{{$list->serviceList->price}}</td>
                @endif
                <td>{{$list->main_service_mark ? 'основная' : ''}}</td>
            </tr>
        @endif
    @endforeach
</table>
<br>
<div>My photo</div>
<table border="1">
    <tr>
        <th>Photo</th>
        <th>main marker</th>
    </tr>
    @foreach($photos as $photo)
        <tr>
            <td><img src="{{asset($photo->photo_path)}}"></td>
            <td>{{$photo->main_photo_marker ? 'основная' : ''}}</td>
        </tr>
    @endforeach
</table>
<br>

@include('layouts.footer')