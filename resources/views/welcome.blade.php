@include('layouts.header')
    <body>
        <div class="container">
            <div class="new_people_servis row">
                <div class="label_new_people col-1">
                    <p>Новые друзья</p>
                </div>
                <ul class="col-11 row justify-content-between">
                   <li class="col-2">
                        <a href="">
                            <img src="{{ asset('profilepictures/male.jpg') }}">
                            <div>
                                <span class="prew_card_name col-12">
                                    Герхард,
                                    <span class="prew_card_age">
                                            23г.
                                     </span>
                                     <span class="prew_card_city">Москва</span>
                                </span>
                                <p class="prew_card_titl">Заплачу за:</p>
                                <p>Maccaж <span>5050p.</span></p>
                                <p class="prew_card_titl">Сделаю за деньги:</p>
                                <p>Массаж <span>5050p.</span></p>
                            </div>
                        </a> 
                    </li>
                    <li class="col-2">
                        <a href="">
                            <img src="{{ asset('profilepictures/male.jpg') }}">
                            <div>
                                    <span class="prew_card_name col-12">
                                        Герхард,
                                        <span class="prew_card_age">
                                                23г.
                                         </span>
                                         <span class="prew_card_city">Москва</span>
                                    </span>
                                    <p class="prew_card_titl">Заплачу за:</p>
                                    <p>Maccaж <span>5050p.</span></p>
                                    <p class="prew_card_titl">Сделаю за деньги:</p>
                                    <p>Массаж <span>5050p.</span></p>
                                </div>
                        </a> 
                    </li>
                    <li class="col-2">
                            <a href="">
                                <img src="{{ asset('profilepictures/male.jpg') }}">
                                <div>
                                        <span class="prew_card_name col-12">
                                            Герхард,
                                            <span class="prew_card_age">
                                                    23г.
                                             </span>
                                             <span class="prew_card_city">Москва</span>
                                        </span>
                                        <p class="prew_card_titl">Заплачу за:</p>
                                        <p>Maccaж <span>5050p.</span></p>
                                        <p class="prew_card_titl">Сделаю за деньги:</p>
                                        <p>Массаж <span>5050p.</span></p>
                                    </div>
                            </a> 
                        </li>
                        <li class="col-2">
                            <a href="">
                                <img src="{{ asset('profilepictures/male.jpg') }}">
                                <div>
                                        <span class="prew_card_name col-12">
                                            Герхард,
                                            <span class="prew_card_age">
                                                    23г.
                                             </span>
                                             <span class="prew_card_city">Москва</span>
                                        </span>
                                        <p class="prew_card_titl">Заплачу за:</p>
                                        <p>Maccaж <span>5050p.</span></p>
                                        <p class="prew_card_titl">Сделаю за деньги:</p>
                                        <p>Массаж <span>5050p.</span></p>
                                    </div>
                            </a> 
                        </li>
                        <li class="col-2">
                            <a href="">
                                <img src="{{ asset('profilepictures/male.jpg') }}">
                                <div>
                                        <span class="prew_card_name col-12">
                                            Герхард,
                                            <span class="prew_card_age">
                                                    23г.
                                             </span>
                                             <span class="prew_card_city">Москва</span>
                                        </span>
                                        <p class="prew_card_titl">Заплачу за:</p>
                                        <p>Maccaж <span>5050p.</span></p>
                                        <p class="prew_card_titl">Сделаю за деньги:</p>
                                        <p>Массаж <span>5050p.</span></p>
                                </div>
                            </a> 
                        </li>
                        <li class="col-2">
                            <a href="">
                                <img src="{{ asset('profilepictures/male.jpg') }}">
                                <div>
                                        <span class="prew_card_name col-12">
                                            Герхард,
                                            <span class="prew_card_age">
                                                    23г.
                                             </span>
                                             <span class="prew_card_city">Москва</span>
                                        </span>
                                        <p class="prew_card_titl">Заплачу за:</p>
                                        <p>Maccaж <span>5050p.</span></p>
                                        <p class="prew_card_titl">Сделаю за деньги:</p>
                                        <p>Массаж <span>5050p.</span></p>
                                </div>
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
       </div>
<script>
    function initMap() {
        var element = document.getElementById('map');
        var options = {
            zoom: 12,
          
            center: {lat: 55.7, lng: 37.536}
        };
        var map = new google.maps.Map(element, options);
        var Markers =[
            {
                coordinates: {lat: 55.7, lng: 37.536},
                image: 'https://cdn.iconscout.com/icon/premium/png-256-thumb/destination-flag-3-739390.png',
                
                info: '<h1> Hey there!</h1>',
            },
            {
                coordinates: {lat: 55.9, lng: 37.636},
                info: '<h1> Hey there!</h1>',
            }
        ];
        for( var i = 0; i < Markers.length; i++){
            addMarker(Markers[i])
        };
        function addMarker(properties) {
            var marker = new google.maps.Marker({
                position: properties.coordinates,
                map: map,
            });
            if(properties.image){
                marker.setIcon(properties.image).Size(20, 32);
                
            }
            
            if(properties.info){
                var InfoWindow = new google.maps.InfoWindow({
                    content: properties.info
                });
                marker.addListener('click', function(){
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
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDubzSKVlBye9tVxy2huOy046M2BOx1fR4&callback=initMap">
</script>
    @include('layouts.footer')
    
 
    