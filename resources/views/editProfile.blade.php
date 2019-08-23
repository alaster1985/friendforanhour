@include('layouts.header')
<section id="edit-profile">
    <div class="container">
        {{-- Your Current Position --}}
        <div id="userLat" style="display:none">
            {{$profile->profileAddress->latitude}}
        </div>
        <div id="userLng" style="display:none">
            {{$profile->profileAddress->longitude}}
        </div>
        <div class="subscription">
            <div class="row justify-content-center">
                @if(session()->has('message'))
                    <div class="alert alert-success" align="center">
                        {{ session()->get('message') }}
                    </div>
                @endif
                @if ($errors)
                    <div style="display: block; color: red">{{($errors->first())}}</div>
                @endif
                <div id="chat-vue" style="display: none">
                    <online v-bind:friend="{{ $profile }}" v-bind:onlineusers="onlineUsers"></online>
                </div>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <div class="row justify-content-center">
                        @if($profile->subscription_end_date >= strtotime('now'))
                            <label>Подписка действительна:&nbsp;</label>
                            <p style="display: none" id="finish_time">{{$profile->subscription_end_date}}</p>
                            <div id="countdown" style="display: inline-flex">
                                <div>&nbsp;Дней:&nbsp;<span class="days"></span></div>
                                <div>&nbsp;Часов:&nbsp;<span class="hours"></span></div>
                                <div>&nbsp;Минут:&nbsp;<span class="minutes"></span></div>
                                <div>&nbsp;Секунд:&nbsp;<span class="seconds"></span></div>
                            </div>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <script type="text/javascript" src="{{asset('js/countdown.js')}}" defer></script>
                        @else
                            <label><strong>Обновите подписку!</strong></label>
                        @endif
                    </div>
                </div>
                @if ($profile->is_locked)
                    <div class="col-md-6">It is manual locked</div>
                    <div class="col-md-6">You can contact to <a href="contactToSupport">support</a> or look to your <a
                                href="{{Request::root()}}/mytickets">reports</a></div>
                @endif
            </div>
        </div>

        <div class="alert-danger" style="display:none; color: red;"></div>

        <form action="{{Route('updateProfile')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row edit_profile_general_block">
                <div class="row">

                    {{-- Set User Location Field --}}
                    <div class="col-lg-12 acc-settings-textfield">
                        <label>Мое местоположени:</label>
                        <button class="btn btn-primary btn-md btn-block set-location" type="button" data-toggle="modal" data-target="#myModal">Указать на карте</button>
                    </div>

                    {{-- Nickname Field --}}
                    <div class="col-lg-12 acc-settings-textfield">
                        <label>Никнейм:</label>
                        <input class="form-control form-control-sm" type="text" name="nickname" value="{{$profile->user()->where('profile_id','=', $profile->id)->first()->name}}">
                    </div>

                    {{-- First Name Field --}}
                    <div class="col-lg-12 acc-settings-textfield">
                        <label>Имя:</label>
                        <input class="form-control form-control-sm" type="text" name="first_name" value="{{$profile->first_name}}">
                    </div>

                    {{-- Second Name Field --}}
                    <div class="col-lg-12 acc-settings-textfield">
                        <label>Фамилия:</label>
                        <input class="form-control form-control-sm" type="text" name="second_name" value="{{$profile->second_name}}">
                    </div>

                    {{-- Height Field --}}
                    <div class="col-lg-12 acc-settings-textfield">
                        <label>Рост:</label>
                        <input class="form-control form-control-sm" type="number" min="130" max="220" name="height" value="{{$profile->height}}">
                    </div>

                    {{-- Weight Field --}}
                    <div class="col-lg-12 acc-settings-textfield">
                        <label>Вес:</label>
                        <input class="form-control form-control-sm" type="number" min="30" max="280" name="weight" value="{{$profile->weight}}">
                    </div>

                    {{-- Birth Date Field --}}
                    <div class="col-lg-12 acc-settings-textfield">
                        <label>Дата рождения:</label>
                        <input class="form-control form-control-sm" type="date" max="{{ date('Y-m-d', strtotime('- 18 years'))}}" min="{{ date('Y-m-d', strtotime('- 123 years'))}}" name="bdate" value="{{$profile->date_of_birth}}">
                    </div>

                    {{-- Genge Field --}}
                    <div class="col-lg-12 acc-settings-textfield">
                        <label>Пол:</label>
                        <select class="form-control form-control-sm" name="gender">
                            @foreach($genders as $gender)
                                <option id="g{{$gender->id}}" value="{{$gender->id}}">{{$gender->gender}}</option>
                                @if($gender->id === $profile->gender->id)
                                    <script>document.getElementById("g{{$gender->id}}").selected = true</script>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    {{-- Phone Number Field --}}
                    <div class="col-lg-12 acc-settings-textfield">
                        <label>Номер телефона:</label>
                        <input id="phone" class="form-control form-control-sm" type="tel" placeholder="+_(___)___-____" maxlength="13" name="phone"
                            value="{{$profile->phone}}">
                    </div>

                    {{-- Contry Field --}}
                    <div class="col-lg-12 acc-settings-textfield">
                        <label>Страна:</label>
                        <select class="form-control form-control-sm" name="country">
                            <option id="new_cnt" value="new">Добавить другую страну</option>
                            @foreach($countries as $country)
                                <option id="cnt{{$country->id}}"
                                        value="{{$country->id}}">{{$country->country_name}}</option>
                                @if($profile->profileAddress->city_id && $country->id === $profile->profileAddress->city->country->id)
                                    <script>document.getElementById("cnt{{$country->id}}").selected = true</script>
                                @elseif(!$profile->profileAddress->city_id)
                                    <script>document.getElementById("new_cnt").selected = true</script>
                                @endif
                            @endforeach
                        </select>
                        <div class="newCountry" style="display: {{$profile->profileAddress->city_id ? 'none' : 'block'}}">
                            <input type="text" name="newCountry" placeholder="Другая страна">
                        </div>
                    </div>

                    {{-- City Field --}}
                    <div class="col-lg-12 acc-settings-textfield">
                        <label>Город:</label>
                        <select class="form-control form-control-sm" name="city">
                            <option id="new_ct" value="new">Добавить другой город</option>
                            @foreach($cities as $city)
                                <option id="ct{{$city->id}}" value="{{$city->id}}">{{$city->city_name}}</option>
                                @if($profile->profileAddress->city_id && $city->id === $profile->profileAddress->city->id)
                                    <script>document.getElementById("ct{{$city->id}}").selected = true</script>
                                @elseif(!$profile->profileAddress->city_id)
                                    <script>document.getElementById("new_ct").selected = true</script>
                                @endif
                            @endforeach
                        </select>
                        <div class="newCity" style="display: {{$profile->profileAddress->city_id ? 'none' : 'block'}}">
                            <input class="form-control form-control-sm" type="text" name="newCity" placeholder="Другой город">
                        </div>
                    </div>

                    {{-- Address Field --}}
                    <div class="col-lg-12 acc-settings-textfield">
                        <label>Адрес:</label>
                        <input class="form-control form-control-sm" type="text" name="address" value="{{$profile->profileAddress->address}}">
                    </div>

                    {{-- About Field --}}
                    <div class="col-lg-12 acc-settings-textfield">
                            <label>Немного о себе:</label>
                        <textarea class="form-control form-control-sm" name="about" rows="10">{{$profile->about}}</textarea>
                    </div>

                </div>
                
            </div>
            <div class="table_services_as_sponsor row">
                <h2>Заплачу за:</h2>
                <table border="1" class="services_as_sponsor col-lg-12">
                    {{-- <tr>
                        <th><label>Название:</label></th>
                        <th><label>Описание:</label></th>
                        <th><label>Цена:</label></th>
                        <th><label>Главная:</label></th>
                        <th><label></label></th>
                        <th><label></label></th>
                    </tr> --}}
                    @foreach($friendsServices as $list)
                        <tr>
                            <td style="width:15%">
                                <input class="form-control form-control-sm" type="text" maxlength="14" name="service_name[1c{{$list->id}}]"
                                    value="{{$list->service_name}}">
                            </td>
                            <td>
                                <input class="form-control form-control-sm" type="text" name="service_description[1c{{$list->id}}]"
                                    value="{{$list->service_description}}">
                            </td>
                            <td class="prise_service">
                                <input class="form-control form-control-sm" type="number" min="0" max="100000"
                                    name="price[1c{{$list->id}}]" value="{{$list->price}}">
                            </td>
                            <td>
                                <input class="form-control form-control-sm main_service_marker1" type="checkbox"
                                    name="main_service_marker[1c{{$list->id}}]"
                                        {{$list->main_service_marker ? 'checked' : ''}}>
                            </td>
                            <td class="select_status_service">
                                <select class="form-control form-control-sm" name="is_disabled[1c{{$list->id}}]">
                                    <option id="enabled{{$list->id}}" value="0">Активная</option>
                                    <option id="disabled{{$list->id}}" value="1">Отключить</option>
                                    @if($list->is_disabled === 1)
                                        <script>document.getElementById('disabled{{$list->id}}').selected = true</script>
                                    @endif
                                </select>
                            </td>
                            <td class="delete_service">
                                <div>
                                    <a class="btn btn-primary btn-md btn-block shadow-none delete-btn" href="{{route('deleteService',$list->id)}}" onclick="return confirm('Are you sure you want to delete this service?');">Удалить</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </table>
                <button id="new_service_as_sponsor" class="col-lg-3 btn btn-primary btn-md btn-block" type="button">Добавить услугу</button>
            </div>
            <div class="table_services_as_sponsor row">
                <h2>Сделаю за деньги:</h2>
                <table border="1" class="services_as_friend col-lg-12">
                    {{-- <tr>
                        <th><label>Название:</label></th>
                        <th><label>Описание:</label></th>
                        <th><label>Цена:</label></th>
                        <th><label>Главная:</label></th>
                        <th><label></label></th>
                        <th><label></label></th>
                    </tr> --}}
                    @foreach($sponsorsServices as $list)
                        <tr>
                            <td style="width:15%">
                                <input class="form-control form-control-sm" type="text" maxlength="14" name="service_name[2c{{$list->id}}]"
                                    value="{{$list->service_name}}">
                            </td>
                            <td>
                                <input class="form-control form-control-sm" type="text" name="service_description[2c{{$list->id}}]"
                                    value="{{$list->service_description}}">
                            </td>
                            <td class="prise_service">
                                <input class="form-control form-control-sm" type="number" min="0" max="100000"
                                    name="price[2c{{$list->id}}]" value="{{$list->price}}">
                            </td>
                            <td>
                                <input type="checkbox" class="form-control form-control-sm main_service_marker2"
                                    name="main_service_marker[2c{{$list->id}}]"
                                        {{$list->main_service_marker ? 'checked' : ''}}>
                            </td>
                            <td class="select_status_service">
                                <select class="form-control form-control-sm" name="is_disabled[2c{{$list->id}}]">
                                    <option id="enabled{{$list->id}}" value="0">Активная</option>
                                    <option id="disabled{{$list->id}}" value="1">Не активная</option>
                                    @if($list->is_disabled === 1)
                                        <script>document.getElementById('disabled{{$list->id}}').selected = true</script>
                                    @endif
                                </select>
                            </td>
                            <td class="delete_service">
                                <div>
                                    <a class="btn btn-primary btn-md btn-block shadow-none delete-btn" href="{{route('deleteService',$list->id)}}" onclick="return confirm('Are you sure you want to delete this service?');">Удалить</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </table>
                <button id="new_service_as_friend" class="col-lg-3 btn btn-primary btn-md btn-block" type="button">Добавить услугу</button>
            </div>
            <button class="col-lg-3 btn btn-primary btn-md btn-block shadow-none btn-save" type="submit">Сохранить настройки</button>
        </form>
        <form id="updatePhotoForm">
            <table border="1" id="usersPhoto">
                <tr>
                    <th>Photo</th>
                    <th>main marker</th>
                    <th>remove</th>
                </tr>
            </table>
            <div id="usersPhoto1"></div>
            <div id="addNewPhoto" style="display: block;text-align:center;">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="imgInput">
                    <label class="custom-file-label" for="customFile">Выберите изображение</label>
                </div>
                <div class="preview-img-upload">
                    <img id="preview" height="300px" src="{{asset('images/preview.png')}}" alt="your new photo">
                </div>
                <div class="cancel-img-upload">
                    <button class="col-lg-3 btn btn-primary btn-md btn-block" id="cancelPreview" type="button">Отмена</button>
                </div>                
            </div>
            <button class="col-lg-3 btn btn-primary btn-md btn-block shadow-none btn-save" type="submit">Сохранить галерею</button>
        </form>
        <div class="alert-danger" style="display:none; color: red;"></div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" style="margin: 10% auto 0 auto" role="document">
            <div class="modal-content" style="padding:1rem">
                <div class="modal-header" style="padding:0">
                    {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Modal title</h4> --}}
                </div>
                <div class="row">
                    <div class="col-md-12 modal_body_map">
                        <div class="location-map" id="location-map">
                            <div style="width: 100%; height: 450px;" id="map_canvas">
                                @include('mapSetLocation')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('layouts.footer')
