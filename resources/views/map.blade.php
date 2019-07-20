<div id="map"></div>
<div style="display: none">
    {{$a = 'AIzaSyDubzSKVlBye9t'}}
    {{$b = 'Vxy2huOy046M2BOx1fR4'}}
    {{$c = 'https://maps.googleapis.com/maps/api/js?key='}}
    {{$d = '&callback=initMap'}}
</div>

<script type="text/javascript" src="{{$c.$a.$b.$d}}" async defer></script>
<script type="text/javascript" src="{{ asset('js/map.js') }}"></script>



