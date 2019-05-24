@include('layouts.app')
@include('layouts.header')
@if(session()->has('message'))
    <div class="alert alert-success" align="center">
        {{ session()->get('message') }}
    </div>
@endif
<form action="{{Route('updateProfile')}}" method="POST" enctype="multipart/form-data">
    <button type="submit">SAVE</button>
    {{csrf_field()}}
    <div>nickname
        <input type="text" name="nickname" value="{{$user->name}}">
    </div>
    <div>first name
        <input type="text" name="first_name" value="{{$user->profile->first_name}}">
    </div>
    <div>second name
        <input type="text" name="second_name" value="{{$user->profile->second_name}}">
    </div>
    <div>date of birth
        <input type="date" max="{{ date('Y-m-d', strtotime('- 18 years'))}}"
               min="{{ date('Y-m-d', strtotime('- 123 years'))}}" name="bdate"
               value="{{$user->profile->date_of_birth}}">
    </div>
    <div>about me
        <textarea name="about" rows="5">{{$user->profile->about}}</textarea>
    </div>
    <div>gender
        <select name="gender">
            @foreach($genders as $gender)
                <option id="g{{$gender->id}}"
                        value="{{$gender->id}}">{{$gender->gender}}</option>
                @if($gender->id === $user->profile->gender->id)
                    <script>document.getElementById("g{{$gender->id}}").selected = true</script>
                @endif
            @endforeach
        </select>
    </div>

    <div>phone
        <input id="phone" type="tel" placeholder="+_(___)___-____" maxlength="13"
               name="phone" value="{{$user->profile->phone}}">
    </div>
    <div>address
        <input type="text" name="address" value="{{$user->profile->profileAddress->address}}">
    </div>
    <div>city
        <select name="city">
            @foreach($cities as $city)
                <option id="ct{{$city->id}}"
                        value="{{$city->id}}">{{$city->city_name}}</option>
                @if($city->id === $user->profile->profileAddress->city->id)
                    <script>document.getElementById("ct{{$city->id}}").selected = true</script>
                @endif
            @endforeach
        </select>
    </div>
    <div>country
        <select name="country">
            @foreach($countries as $country)
                <option id="cnt{{$country->id}}"
                        value="{{$country->id}}">{{$country->country_name}}</option>
                @if($country->id === $user->profile->profileAddress->city->country->country_name)
                    <script>document.getElementById("cnt{{$country->id}}").selected = true</script>
                @endif
            @endforeach
        </select>
    </div>
    <br>
    <div>I wont pay for:</div>
    <table border="1" class="services_as_sponsor">
        <tr>
            <th>short service name</th>
            <th>description service</th>
            <th>price</th>
            <th>main marker</th>
            <th>hide</th>
            <th>remove</th>
        </tr>
        @foreach($friendsServices as $list)
            <tr>
                <td>
                    <input type="text" maxlength="14" name="service_name[1c{{$list->id}}]"
                           value="{{$list->service_name}}">
                </td>
                <td>
                    <input type="text" name="service_description[1c{{$list->id}}]"
                           value="{{$list->service_description}}">
                </td>
                <td>
                    <input type="number" min="0" max="100000" name="price[1c{{$list->id}}]"
                           value="{{$list->price}}">
                </td>
                <td>
                    <input type="checkbox" class="main_service_marker1"
                           name="main_service_marker[1c{{$list->id}}]"{{$list->main_service_marker ? 'checked' : ''}}>
                </td>
                <td>
                    <select name="is_disabled[1c{{$list->id}}]">
                        <option id="enabled" value="0">Enabled</option>
                        <option id="disabled" value="1">Disabled</option>
                        @if($list->is_disabled === 1)
                            <script>document.getElementById('disabled').selected = true</script>
                        @endif
                    </select>
                </td>
                <td>
                    <div>
                        {{ csrf_field()}}
                        <a href="{{route('deleteService',$list->id)}}"
                           onclick="return confirm('Are you sure you want to delete this service?');">remove</a>
                        {{ csrf_field()}}
                    </div>
                </td>
            </tr>
        @endforeach
    </table>
    <button type="button" id="new_service_as_sponsor">add new service as 'sponsor'</button>
    <br>
    <div>I wont give it to you for money:</div>
    <table border="1" class="services_as_friend">
        <tr>
            <th>short service name</th>
            <th>description service</th>
            <th>price</th>
            <th>main marker</th>
            <th>hide</th>
            <th>remove</th>
        </tr>
        @foreach($sponsorsServices as $list)
            <tr>
                <td>
                    <input type="text" maxlength="14" name="service_name[2c{{$list->id}}]"
                           value="{{$list->service_name}}">
                </td>
                <td>
                    <input type="text" name="service_description[2c{{$list->id}}]"
                           value="{{$list->service_description}}">
                </td>
                <td>
                    <input type="number" min="0" max="100000" name="price[2c{{$list->id}}]"
                           value="{{$list->price}}">
                </td>
                <td>
                    <input type="checkbox" class="main_service_marker2"
                           name="main_service_marker[2c{{$list->id}}]"{{$list->main_service_marker ? 'checked' : ''}}>
                </td>
                <td>
                    <select name="is_disabled[2c{{$list->id}}]">
                        <option id="enabled" value="0">Enabled</option>
                        <option id="disabled" value="1">Disabled</option>
                        @if($list->is_disabled === 1)
                            <script>document.getElementById('disabled').selected = true</script>
                        @endif
                    </select>
                </td>
                <td>
                    <div>
                        {{ csrf_field()}}
                        <a href="{{route('deleteService',$list->id)}}"
                           onclick="return confirm('Are you sure you want to delete this service?');">remove</a>
                        {{ csrf_field()}}
                    </div>
                </td>
            </tr>
        @endforeach
    </table>
    <button type="button" id="new_service_as_friend">add new service as 'friend'</button>
    <br>
    <div>My photo</div>
    <table border="1">
        <tr>
            <th>Photo</th>
            <th>main marker</th>
        </tr>
        @foreach($photos as $photo)
            <tr>
                <td><img height="20%" src="{{asset($photo->photo_path)}}"></td>
                <td><input type="radio" name="qwe" value="{{$photo->id}}" {{$photo->main_photo_marker ? 'checked' : ''}}></td>
            </tr>
        @endforeach
    </table>
    <br>
</form>


@include('layouts.footer')