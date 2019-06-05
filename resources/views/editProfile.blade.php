@include('layouts.header')
<div class="container">
    @if(session()->has('message'))
    <div class="alert alert-success" align="center">
        {{ session()->get('message') }}
    </div>
    @endif
    @if ($errors)
    <div style="display: block; color: red">{{($errors->first())}}</div>
    @endif
    <form action="{{Route('updateProfile')}}" method="POST" enctype="multipart/form-data">
    <div class="row edit_profile_general_block justify-content-between">
        <div class=" row col-md-6 about_edit_input ">
            <div class="col-12">
                <label>Nickname</label>
                <input type="text" name="nickname"
                    value="{{$profile->user()->where('profile_id','=', $profile->id)->first()->name}}">
            </div>

            <div class="col-6">
                <label>Имя</label>
                <input type="text" name="first_name" value="{{$profile->first_name}}">
            </div>
            <div class="col-6">
                <label>Фамилия</label>
                <input type="text" name="second_name" value="{{$profile->second_name}}">
            </div>
            <div class="col-4">
                <label>Высота</label>
                <input type="number" min="130" max="220" name="height" value="{{$profile->height}}">
            </div>
            <div class="col-4">
                <label>Вес</label>
                <input type="number" min="30" max="280" name="weight" value="{{$profile->weight}}">
            </div>
            <div class="col-4">
                <label>Дата рождения</label>
                <input type="date" max="{{ date('Y-m-d', strtotime('- 18 years'))}}"
                    min="{{ date('Y-m-d', strtotime('- 123 years'))}}" name="bdate" value="{{$profile->date_of_birth}}">
            </div>
            <div class="col-6 gender_select">
                <label>Пол</label>
                <select name="gender">
                    @foreach($genders as $gender)
                    <option id="g{{$gender->id}}" value="{{$gender->id}}">{{$gender->gender}}</option>
                    @if($gender->id === $profile->gender->id)
                    <script>document.getElementById("g{{$gender->id}}").selected = true</script>
                    @endif
                    @endforeach
                </select>

            </div>
            <div class="col-6">
                <label>Номер телефона</label>
                <input id="phone" type="tel" placeholder="+_(___)___-____" maxlength="13" name="phone"
                    value="{{$profile->phone}}">
            </div>
            <div class="col-6 gender_select">
                <label>Страна</label>
                <select name="country">
                    @foreach($countries as $country)
                    <option id="cnt{{$country->id}}" value="{{$country->id}}">{{$country->country_name}}</option>
                    @if($country->id === $profile->profileAddress->city->country->id)
                    <script>document.getElementById("cnt{{$country->id}}").selected = true</script>
                    @endif
                    @endforeach
                    <option value="new">Добавить другую страну</option>
                </select>
                <div class="newCountry" style="display: none">
                    <input type="text" name="newCountry" placeholder="Другая страна">
                </div>
            </div>
            <div class="col-6 gender_select">
                <label>Город</label>
                <select name="city">
                    @foreach($cities as $city)
                    <option id="ct{{$city->id}}" value="{{$city->id}}">{{$city->city_name}}</option>
                    @if($city->id === $profile->profileAddress->city->id)
                    <script>document.getElementById("ct{{$city->id}}").selected = true</script>
                    @endif
                    @endforeach
                    <option value="new">Добавить другой город</option>
                </select>
                <div class="newCity" style="display: none">
                    <input type="text" name="newCity" placeholder="Другой город">
                </div>
            </div>
            <div class="col-12">
                <label>Адрес</label>
                <input type="text" name="address" value="{{$profile->profileAddress->address}}">
            </div>
        </div>
        <div class="col-6 about_user_block about_user_block_edit">
            <p>Немного о себе</p>
            <textarea name="about" rows="10">{{$profile->about}}</textarea>
        </div>
    </div>
    <div class="table_services_as_sponsor row">
            <p>Я заплачу за</p>
    <table border="1" class="services_as_sponsor col-12">
            <tr>
                <th>Краткое описание</th>
                <th>Описание услуги</th>
                <th>Цена</th>
                <th>Главная услуга</th>
                <th>Активная</th>
                <th>Удалить</th>
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
                    <input class="prise_service" type="number" min="0" max="100000" name="price[1c{{$list->id}}]" value="{{$list->price}}">
                </td>
                <td>
                    <input type="checkbox" class="main_service_marker1" name="main_service_marker[1c{{$list->id}}]"
                        {{$list->main_service_marker ? 'checked' : ''}}>
                </td>
                <td class="select_status_service" >
                    <select name="is_disabled[1c{{$list->id}}]">
                        <option id="enabled{{$list->id}}" value="0">Активная</option>
                        <option id="disabled{{$list->id}}" value="1">Отключить</option>
                        @if($list->is_disabled === 1)
                        <script>document.getElementById('disabled{{$list->id}}').selected = true</script>
                        @endif
                    </select>
                </td>
                <td class="delete_service">
                    <div>
                        {{ csrf_field()}}
                        <a href="{{route('deleteService',$list->id)}}"
                            onclick="return confirm('Are you sure you want to delete this service?');">Удалить</a>
                        {{ csrf_field()}}
                    </div>
                </td>
            </tr>
            @endforeach
        </table>
        <button type="button" id="new_service_as_sponsor">Добавить услугу</button>
    </div>
    <div class="table_services_as_sponsor row">
            <p>Я сделаю за деньги</p>
            <table border="1" class="services_as_friend">
                    <tr>
                            <th>Краткое описание</th>
                            <th>Описание услуги</th>
                            <th>Цена</th>
                            <th>Главная услуга</th>
                            <th>Активная</th>
                            <th>Удалить</th>
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
                            <input class="prise_service" type="number" min="0" max="100000" name="price[2c{{$list->id}}]" value="{{$list->price}}">
                        </td>
                        <td>
                            <input type="checkbox" class="main_service_marker2" name="main_service_marker[2c{{$list->id}}]"
                                {{$list->main_service_marker ? 'checked' : ''}}>
                        </td>
                        <td class="select_status_service">
                            <select name="is_disabled[2c{{$list->id}}]">
                                <option id="enabled{{$list->id}}" value="0">Активная</option>
                                <option id="disabled{{$list->id}}" value="1">Не активная</option>
                                @if($list->is_disabled === 1)
                                <script>document.getElementById('disabled{{$list->id}}').selected = true</script>
                                @endif
                            </select>
                        </td>
                        <td class="delete_service">
                            <div>
                                {{ csrf_field()}}
                                <a href="{{route('deleteService',$list->id)}}"
                                    onclick="return confirm('Are you sure you want to delete this service?');">Удалить</a>
                                {{ csrf_field()}}
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </table>
                <button type="button" id="new_service_as_friend">Добавить услугу</button>
    </div>
    <button type="submit">SAVE</button>
    </form>
    <form id="updatePhotoForm">
        <table border="1" id="usersPhoto">
            <!-- <tr>
                <th>Photo</th>
                <th>main marker</th>
                <th>remove</th>
            </tr> -->
        </table>

        <div id="addNewPhoto" style="display: block">
            <input type='file' id="imgInput">
            <button id="cancelPreview" type="button">cancel</button>
            <img id="preview" height="100px" src="{{asset('images/preview.png')}}" alt="your new photo">
        </div>
        <br>
        <button type="submit">SAVE</button>
    </form>

    <!-- --------------------------------------------------------------------------------------------------------- -->
    <!-- --------------------------------------------------------------------------------------------------------- -->
    <!-- --------------------------------------------------------------------------------------------------------- -->
    <form action="{{Route('updateProfile')}}" method="POST" enctype="multipart/form-data">
        <button type="submit">SAVE</button> 
        {{csrf_field()}}
        <div>nickname
            <input type="text" name="nickname"
                value="{{$profile->user()->where('profile_id','=', $profile->id)->first()->name}}">
        </div>
        <div>first name
            <input type="text" name="first_name" value="{{$profile->first_name}}">
        </div>
        <div>second name
            <input type="text" name="second_name" value="{{$profile->second_name}}">
        </div>
        <div>height
            <input type="number" min="130" max="220" name="height" value="{{$profile->height}}">
        </div>
        <div>weight
            <input type="number" min="30" max="280" name="weight" value="{{$profile->weight}}">
        </div>
        <div>date of birth
            <input type="date" max="{{ date('Y-m-d', strtotime('- 18 years'))}}"
                min="{{ date('Y-m-d', strtotime('- 123 years'))}}" name="bdate" value="{{$profile->date_of_birth}}">
        </div>
        <div>about me
            <textarea name="about" rows="5">{{$profile->about}}</textarea>
        </div>
        <div>gender
            <select name="gender">
                @foreach($genders as $gender)
                <option id="g{{$gender->id}}" value="{{$gender->id}}">{{$gender->gender}}</option>
                @if($gender->id === $profile->gender->id)
                <script>document.getElementById("g{{$gender->id}}").selected = true</script>
                @endif
                @endforeach
            </select>
        </div>

        <div>phone
            <input id="phone" type="tel" placeholder="+_(___)___-____" maxlength="13" name="phone"
                value="{{$profile->phone}}">
        </div>
        <div>address
            <input type="text" name="address" value="{{$profile->profileAddress->address}}">
        </div>
        <div>city
            <select name="city">
                @foreach($cities as $city)
                <option id="ct{{$city->id}}" value="{{$city->id}}">{{$city->city_name}}</option>
                @if($city->id === $profile->profileAddress->city->id)
                <script>document.getElementById("ct{{$city->id}}").selected = true</script>
                @endif
                @endforeach
                <option value="new">there is no my city in this list</option>
            </select>
        </div>
        <div class="newCity" style="display: none">add new city
            <input type="text" name="newCity" placeholder="city_name">
        </div>
        <div>country
            <select name="country">
                @foreach($countries as $country)
                <option id="cnt{{$country->id}}" value="{{$country->id}}">{{$country->country_name}}</option>
                @if($country->id === $profile->profileAddress->city->country->id)
                <script>document.getElementById("cnt{{$country->id}}").selected = true</script>
                @endif
                @endforeach
                <option value="new">there is no my country in this list</option>
            </select>
        </div>
        <div class="newCountry" style="display: none">add new Country
            <input type="text" name="newCountry" placeholder="Country_name">
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
                    <input type="number" min="0" max="100000" name="price[1c{{$list->id}}]" value="{{$list->price}}">
                </td>
                <td>
                    <input type="checkbox" class="main_service_marker1" name="main_service_marker[1c{{$list->id}}]"
                        {{$list->main_service_marker ? 'checked' : ''}}>
                </td>
                <td>
                    <select name="is_disabled[1c{{$list->id}}]">
                        <option id="enabled{{$list->id}}" value="0">Enabled</option>
                        <option id="disabled{{$list->id}}" value="1">Disabled</option>
                        @if($list->is_disabled === 1)
                        <script>document.getElementById('disabled{{$list->id}}').selected = true</script>
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
                    <input type="number" min="0" max="100000" name="price[2c{{$list->id}}]" value="{{$list->price}}">
                </td>
                <td>
                    <input type="checkbox" class="main_service_marker2" name="main_service_marker[2c{{$list->id}}]"
                        {{$list->main_service_marker ? 'checked' : ''}}>
                </td>
                <td>
                    <select name="is_disabled[2c{{$list->id}}]">
                        <option id="enabled{{$list->id}}" value="0">Enabled</option>
                        <option id="disabled{{$list->id}}" value="1">Disabled</option>
                        @if($list->is_disabled === 1)
                        <script>document.getElementById('disabled{{$list->id}}').selected = true</script>
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
    </form>
    <br>
    <div>My photo</div>
    <div class="alert-danger" style="display:none; color: red;"></div>
    <form id="updatePhotoForm">
        <table border="1" id="usersPhoto">
            <tr>
                <th>Photo</th>
                <th>main marker</th>
                <th>remove</th>
            </tr>
        </table>

        <div id="addNewPhoto" style="display: block">
            <input type='file' id="imgInput">
            <button id="cancelPreview" type="button">cancel</button>
            <img id="preview" height="100px" src="{{asset('images/preview.png')}}" alt="your new photo">
        </div>
        <br>
        <button type="submit">SAVE</button>
    </form>
    <br><br><br>
</div>
@include('layouts.footer')





</div>