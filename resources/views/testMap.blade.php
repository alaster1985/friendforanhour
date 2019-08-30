@include('layouts.header')

<div class="container">
    <div class="row">
        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-12" style="visibility: hidden; max-width: 5px;">
            <aside id="main-page-aside-news">
                <div class="block_news">
                    <div class="card border-light mb-3">
                        <a href="#">
                            <div class="card-body">
                                <h6 class="card-title">title</h6>
                                <p class="card-text">date</p>
                            </div>
                        </a>
                    </div>
                    <div class="card border-light mb-3">
                        <a href="#">
                            <div class="card-body">
                                <h6 class="card-title">title</h6>
                                <p class="card-text">date</p>
                            </div>
                        </a>
                    </div>
                </div>
            </aside>
        </div>
        <div class="col-xl-9 col-lg-9 col-md-8 col-sm-12">
            <section id="map-section">
                <div class="map_container">
                    <div class="map-card">
                        <p>Карта друзей, услуг и людей, у которых можно заработать деньги на 1-HF.com</p>
                        <div id="map"></div>
                        <script type="text/javascript" src="{{ asset('js/map.js') }}"></script>
                        <script type="text/javascript"
                                src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_MAPS_API_KEY')}}&callback=initMap"
                                async defer></script>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

</main>

<script type="text/javascript" src="{{ asset('js/jquery-3.4.1.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/slick.js')}}" defer></script>
<script type="text/javascript" src="{{asset('js/main.script.js')}}"></script>

</body>
</html>