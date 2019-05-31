<div id="map">
</div>
<div style="display: none">
{{$a = 'AIzaSyDubzSKVlBye9'}}
{{$b = 'tVxy2huOy046M2BOx1fR4'}}
{{$c = 'https://maps.googleapis.com/maps/api/js?key='}}
{{$d = '&callback=initMap'}}

</div>

<script async defer
    src="{{$c.$a.$b.$d}}">
    </script>
<script src="{{ asset('js/map.js') }}"></script>