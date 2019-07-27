@include('layouts.header')

<section id="search-section">
    <div class="container">
        <h2>Поиск:</h2>
        <div class="container">
            @if ($errors)
                <div style="display: block; color: red">{{($errors->first())}}</div>
            @endif
            <form id="user_search" action="" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <label>Минимальный Возраст:</label>
                        <input class="form-control form-control-md" name="min_age" type="number" min="18" max="123" value="{{old('min_age')}}">
                        <label>Максимальный Возраст:</label>
                        <input class="form-control form-control-md" name="max_age" type="number" min="18" max="123" value="{{old('max_age')}}">
                        @if(Auth::check() && Auth::user()->hasRole('user'))
                            <div style="display: none">
                                <label>longitude</label>
                                <input class="form-control form-control-md" name="longitude" type="number" step="0.000001" min="-180" max="180"
                                    value="{{Auth::user()->profile->profileAddress->longitude}}">
                                <label>latitude</label>
                                <input class="form-control form-control-md" name="latitude" type="number" step="0.000001" min="-90" max="90"
                                    value="{{Auth::user()->profile->profileAddress->latitude}}">
                            </div>
                        @endif
                        <label>Спонсор / Друг:</label>
                        <select class="form-control form-control-md" name="friend_type">
                            <option value="2">Друг</option>
                            <option value="1">Спонсор</option>
                        </select>
                        <label>Минимальная Цена:</label>
                        <input class="form-control form-control-md" name="min_money" type="number" min="0" max="10000" value="{{old('min_money')}}">
                        <label>Максимальная Цена:</label>
                        <input class="form-control form-control-md" name="max_money" type="number" min="0" max="10000" value="{{old('max_money')}}">
                        <label>Онлайн:</label>
                        <select class="form-control form-control-md" name="online">
                            <option value="0">Все</option>
                            <option value="1">Онлайн</option>
                        </select>
                    </div>
                    <div class="col-lg-6">
                        <label>Радиус (км):</label>
                        <input class="form-control form-control-md" name="radius" type="number" min="1" max="20" value="{{old('radius')}}">
                        <label>Город:</label>
                        <select class="form-control form-control-md" name="city">
                            @foreach(City::all() as $city)
                                <option value="{{$city->id}}">{{$city->city_name}}</option>
                            @endforeach
                        </select>
                        <label>Миннимальный Рост (см):</label>
                        <input class="form-control form-control-md" name="min_height" type="number" min="130" max="220" value="{{old('min_height')}}">
                        <label>Максимальный Рост (см):</label>
                        <input class="form-control form-control-md" name="max_height" type="number" min="130" max="220" value="{{old('max_height')}}">
                        <label>Минимальный Вес (кг):</label>
                        <input class="form-control form-control-md" name="min_weight" type="number" min="30" max="280" value="{{old('min_weight')}}">
                        <label>Максимальный Вес (кг):</label>
                        <input class="form-control form-control-md" name="max_weight" type="number" min="30" max="280" value="{{old('max_weight')}}">
                        <label>Пол:</label>
                        <select class="form-control form-control-md" name="gender">
                            @foreach(Gender::all() as $gender)
                                <option value="{{$gender->id}}">{{$gender->gender}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-2 find-btn">
                        <button class="btn btn-primary btn-md btn-block" type="submit">Искать</button>
                    </div>
                </div>
            </form>
            @if(session()->has('message'))
                <div class="alert alert-success" align="center">
                    {{ session()->get('message') }}
                </div>
            @endif
        </div>
    </div>
</section>

<section id="user_search_result" class="none">

    <div class="stage">
        <div id="stacked-cards-block" class="stackedcards stackedcards--animatable init">
            <div class="stackedcards-container">

                <div class="card">
                    <div class="card-content">
                        <div class="card-image"><img src="https://image.ibb.co/gQsq07/Adventure_and_Outdoor.png" width="100%" height="100%"/></div>
                        <div class="card-titles">
                            <h1>Username, Age</h1>
                            <h3>City</h3>
                        </div>  
                    </div>
                    <div class="card-footer">
                        <div class="popular-destinations-text">Short <br/> Information</div>
                        <div class="popular-destinations-images">
                            <p>Sample text.</p>
                        </div>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-content">
                        <div class="card-image"><img src="https://image.ibb.co/bXTXV7/Far_and_Away_2x.png" width="100%" height="100%"/></div>
                        <div class="card-titles">
                            <h1>Username, Age</h1>
                            <h3>City</h3>
                        </div>  
                    </div>
                    <div class="card-footer">
                        <div class="popular-destinations-text">Short <br/> Information</div>
                        <div class="popular-destinations-images">
                            <p>Sample text.</p>
                        </div>
                    </div>
                </div>

            </div>
            <div class="stackedcards--animatable stackedcards-overlay top"><i class="fas fa-user"></i></div>
            <div class="stackedcards--animatable stackedcards-overlay right"><i class="fas fa-angle-right"></i></div>
            <div class="stackedcards--animatable stackedcards-overlay left"><i class="fas fa-angle-left"></i></div>
        </div>
        <div class="global-actions">
            <div class="left-action"><i class="fas fa-angle-left"></i></div>
            <div class="top-action"><i class="fas fa-user"></i></div>
            <div class="right-action"><i class="fas fa-angle-right"></i></div>
        </div>
    </div>
              
</section>

@include('layouts.footer')