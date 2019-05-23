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
                    <div id="map">
                         
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
    //   // The location of Uluru
      var uluru = {lat: 54.344, lng: 20.036};
      // The map, centered at Uluru
      var map = new google.maps.Map(
          document.getElementById('map'), {
              zoom: 12, 
              center: uluru,
              mapTypeId: 'satellite',
              heading: 90,
              tilt: 45
        });
      // The marker, positioned at Uluru
      var marker = new google.maps.Marker({position: uluru, map: map});
    }
          
        </script>
        

    
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDubzSKVlBye9tVxy2huOy046M2BOx1fR4&callback=initMap">
</script>
    @include('layouts.footer')
    
 
    