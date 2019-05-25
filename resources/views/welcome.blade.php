@include('layouts.header')

<body>
    <div class="container">
        <div class="new_people_servis row">
            <div class="label_new_people col-1">
                <p>Новые друзья</p>
            </div>
            <ul class="col-11">
                <li style="width: 10%">
                    <a href="">
                        <img src="https://pp.userapi.com/_hHA3Vmnh97oA4_TT8Stxfim-J_rh8Fk4pr8pA/72Ox1NrQCk4.jpg?ava=1">

                    </a>
                </li>
                <li style="width: 10%">
                    <a href="">
                        <img src="https://pp.userapi.com/_hHA3Vmnh97oA4_TT8Stxfim-J_rh8Fk4pr8pA/72Ox1NrQCk4.jpg?ava=1">

                    </a>
                </li>
                <li style="width: 10%">
                    <a href="">
                        <img src="https://pp.userapi.com/_hHA3Vmnh97oA4_TT8Stxfim-J_rh8Fk4pr8pA/72Ox1NrQCk4.jpg?ava=1">

                    </a>
                </li>
                <li style="width: 10%">
                    <a href="">
                        <img src="https://pp.userapi.com/_hHA3Vmnh97oA4_TT8Stxfim-J_rh8Fk4pr8pA/72Ox1NrQCk4.jpg?ava=1">

                    </a>
                </li>
                <li style="width: 10%">
                    <a href="">
                        <img src="https://pp.userapi.com/_hHA3Vmnh97oA4_TT8Stxfim-J_rh8Fk4pr8pA/72Ox1NrQCk4.jpg?ava=1">

                    </a>
                </li>
                <li style="width: 10%">
                    <a href="">
                        <img src="https://pp.userapi.com/_hHA3Vmnh97oA4_TT8Stxfim-J_rh8Fk4pr8pA/72Ox1NrQCk4.jpg?ava=1">

                    </a>
                </li>
                <li style="width: 10%">
                    <a href="">
                        <img src="https://pp.userapi.com/_hHA3Vmnh97oA4_TT8Stxfim-J_rh8Fk4pr8pA/72Ox1NrQCk4.jpg?ava=1">

                    </a>
                </li>
                <li style="width: 10%">
                    <a href="">
                        <img src="https://pp.userapi.com/_hHA3Vmnh97oA4_TT8Stxfim-J_rh8Fk4pr8pA/72Ox1NrQCk4.jpg?ava=1">

                    </a>
                </li>
                <li style="width: 10%">
                    <a href="">
                        <img src="https://pp.userapi.com/_hHA3Vmnh97oA4_TT8Stxfim-J_rh8Fk4pr8pA/72Ox1NrQCk4.jpg?ava=1">

                    </a>
                </li>
                <li style="width: 10%">
                    <a href="">
                        <img src="https://pp.userapi.com/_hHA3Vmnh97oA4_TT8Stxfim-J_rh8Fk4pr8pA/72Ox1NrQCk4.jpg?ava=1">

                    </a>
                </li>

            </ul>

        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-3">
                @if (Route::has('login'))
                <!-- <div class="top-right links">
                            @auth
                                <a href="{{ url('home') }}">Home</a>
                            @else
                                <a href="{{ route('login') }}">Login</a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}">Register</a>
                                @endif
                            @endauth
                        </div> -->
                @include('auth.loginTest')
                @endif
                <div class="block_news">
                    <h5>Новости</h5>
                    <a href="" target="_blank">
                        <p>30 апреля</p>
                        <p>Всемирный дефицит женщин: ученые бьют тревогу</p>
                    </a>
                </div>
            </div>
            <div class="col-9">

                <div class="map_container">
                    <h6>Карта друзей, услуг и людей, у которых можно заработать деньги на 1-HF.com</h6>
                    <div id="map">

                    </div>
                </div>
                <!-- <div class="content">
                        <div class="title m-b-md">
                            First page
                        </div>

                        <div class="links">
                            <a href="lara2">second page just for example link</a>
                        </div>
                        <div class="links">
                            <a href="profile">personal profile page</a>
                        </div>
                    </div> -->
            </div>
        </div>
        <div class="container">
            <div class="row justify-content-between users_prew_block">
                <div class="col-4">
                    <table id="tablePreview" class="col-12 card_user_prev table table-borderless">
                        <tbody class="row ">
                            <tr class="col-5 block_image">
                                <td>
                                    <a href="">
                                        <img class="User_image"
                                            src="https://pp.userapi.com/_hHA3Vmnh97oA4_TT8Stxfim-J_rh8Fk4pr8pA/72Ox1NrQCk4.jpg?ava=1">
                                        <span><img src="{{ asset('images/camera.svg') }}"> 9</span>
                                    </a>
                                </td>
                            </tr>
                            <tr class="col-7 row mar">
                                <td class="user_description_cart col-12">
                                    <span class="name_user_cart">Павел,<span> 41</span></span>
                                    <span class="city_user_cart">Москва <br> <span>5км от вас</span></span>
                                    <span class="title_serwise">
                                        Заплачу за
                                    </span>
                                    <span class="name_serwise_cart name_serwise">
                                        <span>Массаж</span><span>1200р</span>
                                    </span>
                                    <span class="name_serwise_cart name_serwise">
                                        <span>Сходить в кафе</span><span>беспл.</span>
                                    </span>
                                    <span class="title_serwise name_serwise">
                                        Сделаю за деньги
                                    </span>
                                    <span class="name_serwise_cart name_serwise">
                                        <span>Дизайн сайта</span><span>5000р</span>
                                    </span>
                                    <span class="name_serwise_cart name_serwise">
                                        <span>Маникюр</span><span>500р</span>
                                    </span>
                                    <span class="name_serwise_cart name_serwise_cart_link">
                                        <a href="">Написать</a><span><img
                                                src="{{ asset('images/monitor.svg') }}">Онлайн</span>
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-4">
                    <table id="tablePreview" class="col-12 card_user_prev table table-borderless">
                        <tbody class="row ">
                            <tr class="col-5 block_image">
                                <td>
                                    <a href="">
                                        <img class="User_image"
                                            src="https://pp.userapi.com/_hHA3Vmnh97oA4_TT8Stxfim-J_rh8Fk4pr8pA/72Ox1NrQCk4.jpg?ava=1">
                                        <span><img src="{{ asset('images/camera.svg') }}"> 9</span>
                                    </a>
                                </td>
                            </tr>
                            <tr class="col-7 row mar">
                                <td class="user_description_cart col-12">
                                    <span class="name_user_cart">Павел,<span> 41</span></span>
                                    <span class="city_user_cart">Москва <br> <span>5км от вас</span></span>
                                    <span class="title_serwise">
                                        Заплачу за
                                    </span>
                                    <span class="name_serwise_cart name_serwise">
                                        <span>Массаж</span><span>1200р</span>
                                    </span>
                                    <span class="name_serwise_cart name_serwise">
                                        <span>Сходить в кафе</span><span>беспл.</span>
                                    </span>
                                    <span class="name_serwise_cart name_serwise">
                                        <span>Дизайн сайта</span><span>5000р</span>
                                    </span>
                                    <span class="name_serwise_cart name_serwise">
                                        <span>Дизайн сайта</span><span>5000р</span>
                                    </span>

                                    <span class="name_serwise_cart name_serwise">
                                        <span>Маникюр</span><span>500р</span>
                                    </span>
                                    <span class="name_serwise_cart name_serwise_cart_link">
                                        <a href="">Написать</a><span><img
                                                src="{{ asset('images/monitor.svg') }}">Онлайн</span>
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-4">
                    <table id="tablePreview" class="col-12 card_user_prev table table-borderless">
                        <tbody class="row ">
                            <tr class="col-5 block_image">
                                <td>
                                    <a href="">
                                        <img class="User_image"
                                            src="https://pp.userapi.com/_hHA3Vmnh97oA4_TT8Stxfim-J_rh8Fk4pr8pA/72Ox1NrQCk4.jpg?ava=1">
                                        <span><img src="{{ asset('images/camera.svg') }}"> 9</span>
                                    </a>
                                </td>
                            </tr>
                            <tr class="col-7 row mar">
                                <td class="user_description_cart col-12">
                                    <span class="name_user_cart">Павел,<span> 41</span></span>
                                    <span class="city_user_cart">Москва <br> <span>5км от вас</span></span>
                                    <span class="title_serwise name_serwise">
                                        Сделаю за деньги
                                    </span>
                                    <span class="name_serwise_cart name_serwise">
                                        <span>Массаж</span><span>1200р</span>
                                    </span>
                                    <span class="name_serwise_cart name_serwise">
                                        <span>Сходить в кафе</span><span>беспл.</span>
                                    </span>
                                    <span class="name_serwise_cart name_serwise">
                                        <span>Сходить в кафе</span><span>1000</span>
                                    </span>
                                    <span class="name_serwise_cart name_serwise">
                                        <span>Дизайн сайта</span><span>5000р</span>
                                    </span>
                                    <span class="name_serwise_cart name_serwise">
                                        <span>Маникюр</span><span>500р</span>
                                    </span>
                                    <span class="name_serwise_cart name_serwise_cart_link">
                                        <a href="">Написать</a><span><img
                                                src="{{ asset('images/monitor.svg') }}">Онлайн</span>
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-4">
                    <table id="tablePreview" class="col-12 card_user_prev table table-borderless">
                        <tbody class="row ">
                            <tr class="col-5 block_image">
                                <td>
                                    <a href="">
                                        <img class="User_image"
                                            src="https://pp.userapi.com/_hHA3Vmnh97oA4_TT8Stxfim-J_rh8Fk4pr8pA/72Ox1NrQCk4.jpg?ava=1">
                                        <span><img src="{{ asset('images/camera.svg') }}"> 9</span>
                                    </a>
                                </td>
                            </tr>
                            <tr class="col-7 row mar">
                                <td class="user_description_cart col-12">
                                    <span class="name_user_cart">Павел,<span> 41</span></span>
                                    <span class="city_user_cart">Москва <br> <span>5км от вас</span></span>
                                    <span class="title_serwise">
                                        Заплачу за
                                    </span>
                                    <span class="name_serwise_cart name_serwise">
                                        <span>Массаж</span><span>1200р</span>
                                    </span>
                                    <span class="name_serwise_cart name_serwise">
                                        <span>Сходить в кафе</span><span>беспл.</span>
                                    </span>
                                    <span class="title_serwise name_serwise">
                                        Сделаю за деньги
                                    </span>
                                    <span class="name_serwise_cart name_serwise">
                                        <span>Дизайн сайта</span><span>5000р</span>
                                    </span>
                                    <span class="name_serwise_cart name_serwise">
                                        <span>Маникюр</span><span>500р</span>
                                    </span>
                                    <span class="name_serwise_cart name_serwise_cart_link">
                                        <a href="">Написать</a><span><img
                                                src="{{ asset('images/monitor.svg') }}">Онлайн</span>
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-4">
                    <table id="tablePreview" class="col-12 card_user_prev table table-borderless">
                        <tbody class="row ">
                            <tr class="col-5 block_image">
                                <td>
                                    <a href="">
                                        <img class="User_image"
                                            src="https://pp.userapi.com/_hHA3Vmnh97oA4_TT8Stxfim-J_rh8Fk4pr8pA/72Ox1NrQCk4.jpg?ava=1">
                                        <span><img src="{{ asset('images/camera.svg') }}"> 9</span>
                                    </a>
                                </td>
                            </tr>
                            <tr class="col-7 row mar">
                                <td class="user_description_cart col-12">
                                    <span class="name_user_cart">Павел,<span> 41</span></span>
                                    <span class="city_user_cart">Москва <br> <span>5км от вас</span></span>
                                    <span class="title_serwise">
                                        Заплачу за
                                    </span>
                                    <span class="name_serwise_cart name_serwise">
                                        <span>Массаж</span><span>1200р</span>
                                    </span>
                                    <span class="name_serwise_cart name_serwise">
                                        <span>Сходить в кафе</span><span>беспл.</span>
                                    </span>
                                    <span class="name_serwise_cart name_serwise">
                                        <span>Дизайн сайта</span><span>5000р</span>
                                    </span>
                                    <span class="name_serwise_cart name_serwise">
                                        <span>Дизайн сайта</span><span>5000р</span>
                                    </span>

                                    <span class="name_serwise_cart name_serwise">
                                        <span>Маникюр</span><span>500р</span>
                                    </span>
                                    <span class="name_serwise_cart name_serwise_cart_link">
                                        <a href="">Написать</a><span><img
                                                src="{{ asset('images/monitor.svg') }}">Онлайн</span>
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-4">
                    <table id="tablePreview" class="col-12 card_user_prev table table-borderless">
                        <tbody class="row ">
                            <tr class="col-5 block_image">
                                <td>
                                    <a href="">
                                        <img class="User_image"
                                            src="https://pp.userapi.com/_hHA3Vmnh97oA4_TT8Stxfim-J_rh8Fk4pr8pA/72Ox1NrQCk4.jpg?ava=1">
                                        <span><img src="{{ asset('images/camera.svg') }}"> 9</span>
                                    </a>
                                </td>
                            </tr>
                            <tr class="col-7 row mar">
                                <td class="user_description_cart col-12">
                                    <span class="name_user_cart">Павел,<span> 41</span></span>
                                    <span class="city_user_cart">Москва <br> <span>5км от вас</span></span>
                                    <span class="title_serwise name_serwise">
                                        Сделаю за деньги
                                    </span>
                                    <span class="name_serwise_cart name_serwise">
                                        <span>Массаж</span><span>1200р</span>
                                    </span>
                                    <span class="name_serwise_cart name_serwise">
                                        <span>Сходить в кафе</span><span>беспл.</span>
                                    </span>
                                    <span class="name_serwise_cart name_serwise">
                                        <span>Сходить в кафе</span><span>1000</span>
                                    </span>
                                    <span class="name_serwise_cart name_serwise">
                                        <span>Дизайн сайта</span><span>5000р</span>
                                    </span>
                                    <span class="name_serwise_cart name_serwise">
                                        <span>Маникюр</span><span>500р</span>
                                    </span>
                                    <span class="name_serwise_cart name_serwise_cart_link">
                                        <a href="">Написать</a><span><img
                                                src="{{ asset('images/monitor.svg') }}">Онлайн</span>
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <script>
        function initMap() {
            var element = document.getElementById('map');
            var options = {
                zoom: 12,

                center: { lat: 55.7, lng: 37.536 }
            };
            var map = new google.maps.Map(element, options);
            var Markers = [
                {
                    coordinates: { lat: 55.7, lng: 37.536 },
                    image: 'https://cdn.iconscout.com/icon/premium/png-256-thumb/destination-flag-3-739390.png',

                    info: '<h1> Hey there!</h1>',
                },
                {
                    coordinates: { lat: 55.9, lng: 37.636 },
                    info: '<h1> Hey there!</h1>',
                }
            ];
            for (var i = 0; i < Markers.length; i++) {
                addMarker(Markers[i])
            };
            function addMarker(properties) {
                var marker = new google.maps.Marker({
                    position: properties.coordinates,
                    map: map,
                });
                if (properties.image) {
                    marker.setIcon(properties.image)

                }

                if (properties.info) {
                    var InfoWindow = new google.maps.InfoWindow({
                        content: properties.info
                    });
                    marker.addListener('click', function () {
                        InfoWindow.open(map, marker);
                    })
                }
            }

        };

    </script>



    <!--Load the API from the specified URL
    * The async attribute allows the browser to render the page while the API loads
    * The key parameter will contain your own API key (which is not needed for this tutorial)
    * The callback parameter executes the initMap() function
    -->
    
    @include('layouts.footer')