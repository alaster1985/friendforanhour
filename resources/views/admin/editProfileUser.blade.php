@include('admin/layouts.header')
@include('admin/layouts.menu')
<div class="content-sec">
    <div class="container">
        <div class="title-date-range">
            <div class="row">
                <div class="col-md-6">
                    <div class="main-title">
                        <h1>edit profile user</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <form action="{{Route('updateProfileUser')}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="masonary-grids">
                    <div class="col-md-12">
                        <div class="widget-area">
                            <div class="wizard-form-h">
                                <h2 class="StepTitle">Profile</h2>
                                @if ($errors)
                                    <div class="error" style="display: block">{{($errors->first())}}</div>
                                @endif
                                <input type="hidden" name="user_id"
                                       value="{{$profile->user()->where('profile_id','=', $profile->id)->first()->id}}">
                                <input type="hidden" name="profile_id" value="{{$profile->id}}">
                                <div class="col-md-4">
                                    <div class="inline-form">
                                        <label class="c-label">nickname</label>
                                        <input class="input-style" type="text" name="nickname"
                                               value="{{$profile->user()->where('profile_id','=', $profile->id)->first()->name}}"/>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="inline-form">
                                        <label class="c-label">first name</label>
                                        <input class="input-style" type="text" name="first_name"
                                               value="{{$profile->first_name}}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="inline-form">
                                        <label class="c-label">first name</label>
                                        <input class="input-style" type="text" name="second_name"
                                               value="{{$profile->second_name}}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="inline-form">
                                        <label class="c-label">height</label>
                                        <input class="input-style" type="number" min="50" max="250" name="height"
                                               value="{{$profile->height}}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="inline-form">
                                        <label class="c-label">weight</label>
                                        <input class="input-style" type="number" min="20" max="380" name="weight"
                                               value="{{$profile->weight}}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="inline-form">
                                        <label class="c-label">date of birth</label>
                                        <input class="input-style" type="date"
                                               max="{{ date('Y-m-d', strtotime('- 18 years'))}}"
                                               min="{{ date('Y-m-d', strtotime('- 123 years'))}}" name="bdate"
                                               value="{{$profile->date_of_birth}}">
                                    </div>
                                </div>
                                <div class="inline-form">
                                    <label class="c-label">about</label>
                                    <textarea class="input-style" name="about" rows="5">{{$profile->about}}</textarea>
                                </div>

                                <div class="col-md-4">
                                    <div class="inline-form">
                                        <label class="c-label">gender</label>
                                        <select name="gender">
                                            @foreach(Gender::all() as $gender)
                                                <option id="g{{$gender->id}}"
                                                        value="{{$gender->id}}">{{$gender->gender}}</option>
                                                @if($gender->id === $profile->gender->id)
                                                    <script>document.getElementById("g{{$gender->id}}").selected = true</script>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="inline-form">
                                        <label class="c-label">phone</label>
                                        <input class="input-style" type="tel" placeholder="+_(___)___-____"
                                               maxlength="13"
                                               name="phone" value="{{$profile->phone}}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="inline-form">
                                        <label class="c-label">address</label>
                                        <input class="input-style" type="text" name="address"
                                               value="{{$profile->profileAddress->address}}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="inline-form">
                                            <label class="c-label">City</label>
                                            <select name="city">
                                                @foreach(City::all() as $city)
                                                    <option id="ct{{$city->id}}"
                                                            value="{{$city->id}}">{{$city->city_name}}</option>
                                                    @if($city->id === $profile->profileAddress->city->id)
                                                        <script>document.getElementById("ct{{$city->id}}").selected = true</script>
                                                    @endif
                                                @endforeach
                                                <option value="new">there is no city in this list</option>
                                            </select>
                                            <div class="newCity" style="display: none">add new city
                                                <input class="input-style" type="text" name="newCity"
                                                       placeholder="city_name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="inline-form">
                                            <label class="c-label">Country</label>
                                            <select name="country">
                                                @foreach(Country::all() as $country)
                                                    <option id="cnt{{$country->id}}"
                                                            value="{{$country->id}}">{{$country->country_name}}</option>
                                                    @if($country->id === $profile->profileAddress->city->country->id)
                                                        <script>document.getElementById("cnt{{$country->id}}").selected = true</script>
                                                    @endif
                                                @endforeach
                                                <option value="new">there is no country in this list</option>
                                            </select>
                                            <div class="newCountry" style="display: none">add new Country
                                                <input type="text" name="newCountry" placeholder="Country_name">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div>User wont pay for this services:</div>
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
                                                    <input type="text" maxlength="14"
                                                           name="service_name[1c{{$list->id}}]"
                                                           value="{{$list->service_name}}">
                                                </td>
                                                <td>
                                                    <input type="text" name="service_description[1c{{$list->id}}]"
                                                           value="{{$list->service_description}}">
                                                </td>
                                                <td>
                                                    <input type="number" min="0" max="100000"
                                                           name="price[1c{{$list->id}}]"
                                                           value="{{$list->price}}">
                                                </td>
                                                <td>
                                                    <input type="checkbox" class="main_service_marker1"
                                                           name="main_service_marker[1c{{$list->id}}]"{{$list->main_service_marker ? 'checked' : ''}}>
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
                                    <button type="button" id="new_service_as_sponsor">add new service as 'sponsor'
                                    </button>
                                    <br>
                                    <div>User wont give it for money:</div>
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
                                                    <input type="text" maxlength="14"
                                                           name="service_name[2c{{$list->id}}]"
                                                           value="{{$list->service_name}}">
                                                </td>
                                                <td>
                                                    <input type="text" name="service_description[2c{{$list->id}}]"
                                                           value="{{$list->service_description}}">
                                                </td>
                                                <td>
                                                    <input type="number" min="0" max="100000"
                                                           name="price[2c{{$list->id}}]"
                                                           value="{{$list->price}}">
                                                </td>
                                                <td>
                                                    <input type="checkbox" class="main_service_marker2"
                                                           name="main_service_marker[2c{{$list->id}}]"{{$list->main_service_marker ? 'checked' : ''}}>
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
                                    <button type="button" id="new_service_as_friend">add new service as 'friend'
                                    </button>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="inline-form">
                                            <label class="c-label">Created at</label>
                                            <input class="input-style" disabled
                                                   name="created_at" value="{{$profile->created_at}}"/>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="inline-form">
                                            <label class="c-label">Updated at</label>
                                            <input class="input-style" disabled
                                                   name="updated_at" value="{{$profile->updated_at}}"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="inline-form">
                                            <label class="c-label">is banned?</label>
                                            <select name="banned">
                                                <option id="unbanned" value="0">unbanned</option>
                                                <option id="banned" value="1">BANNED</option>
                                                @if($profile->is_banned === 1)
                                                    <script>document.getElementById('banned').selected = true</script>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="inline-form">
                                            <label class="c-label">is locked?</label>
                                            <select name="locked">
                                                <option id="unlocked" value="0">unlocked</option>
                                                <option id="locked" value="1">LOCKED</option>
                                                @if($profile->is_locked === 1)
                                                    <script>document.getElementById('locked').selected = true</script>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="inline-form">
                                    <button type="submit" {{--disabled--}} class="btn btn-success">SAVE</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div>Users photos</div>
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
        </div>
    </div>
    @if(session()->has('message'))
        <div class="alert alert-success" align="center">
            {{ session()->get('message') }}
        </div>
    @endif
</div>
</div>
@include('admin/layouts.footer')