@include('layouts.header')

@if ($errors)
    <div style="display: block; color: red">{{($errors->first())}}</div>
@endif
<form action="{{route('filter')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-2">
            <button type="submit">search1</button>
        </div>
        <div class="col-md-5">
            <p>min age</p>
            <input name="min_age" type="number" min="18" max="123" value="{{old('min_age')}}">
            <p>max age</p>
            <input name="max_age" type="number" min="18" max="123" value="{{old('max_age')}}">
            @if(Auth::check() && Auth::user()->hasRole('user'))
                <p>chords</p>
                <p>longitude</p>
                <input name="longitude" type="number" step="0.000001" min="-180" max="180"
                       value="{{Auth::user()->profile->profileAddress->longitude}}">
                <p>latitude</p>
                <input name="latitude" type="number" step="0.000001" min="-90" max="90"
                       value="{{Auth::user()->profile->profileAddress->latitude}}">
            @endif
            <p>sponsor or friend</p>
            <select name="friend_type">
                <option value="2">friend</option>
                <option value="1">sponsor</option>
            </select>
            <p>min $</p>
            <input name="min_money" type="number" min="0" max="10000" value="{{old('min_money')}}">
            <p>max $</p>
            <input name="max_money" type="number" min="0" max="10000" value="{{old('max_money')}}">
        </div>
        <div class="col-md-5">
            <p>RADIUS, km</p>
            <input name="radius" type="number" min="1" max="20" value="{{old('radius')}}">
            <p>city</p>
            <select name="city">
                @foreach(City::all() as $city)
                    <option value="{{$city->id}}">{{$city->city_name}}</option>
                @endforeach
            </select>
            <p>min height, sm</p>
            <input name="min_height" type="number" min="130" max="220" value="{{old('min_height')}}">
            <p>max height, sm</p>
            <input name="max_height" type="number" min="130" max="220" value="{{old('max_height')}}">
            <p>min weight, kg</p>
            <input name="min_weight" type="number" min="30" max="280" value="{{old('min_weight')}}">
            <p>max weight, kg</p>
            <input name="max_weight" type="number" min="30" max="280" value="{{old('max_weight')}}">
            <p>gender</p>
            <select name="gender">
                @foreach(Gender::all() as $gender)
                    <option value="{{$gender->id}}">{{$gender->gender}}</option>
                @endforeach
            </select>
        </div>
    </div>
</form>
@if(session()->has('message'))
    <div class="alert alert-success" align="center">
        {{ session()->get('message') }}
    </div>
@endif
@include('layouts.footer')