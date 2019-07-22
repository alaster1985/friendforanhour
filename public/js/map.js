function initMap() {
    var element = document.getElementById('map');
    var options = {
        zoom: 10,
        center: { lat: 55.7, lng: 37.536 }
    };

    var map = new google.maps.Map(element, options);

    var goldStar = {
        path: 'M242.606,0C142.124,0,60.651,81.473,60.651,181.955c0,40.928,13.504,78.659,36.31,109.075l145.646,194.183L388.252,291.03c22.808-30.416,36.31-68.146,36.31-109.075C424.562,81.473,343.089,0,242.606,0z M242.606,303.257c-66.989,0-121.302-54.311-121.302-121.302c0-66.989,54.313-121.304,121.302-121.304c66.991,0,121.302,54.315,121.302,121.304C363.908,248.947,309.598,303.257,242.606,303.257z',
        fillColor: '#F68727',
        fillOpacity: 0.8,
        scale: 0.08,
        strokeColor: '#F68727',
        strokeWeight: 1,
    };

    var contentString = 
        '<div id="profile_map_marker">'+
        '<p>Some sample text here</p>' +
        '</div>';

    var infowindow = new google.maps.InfoWindow({
        content: contentString
    });

    var marker = new google.maps.Marker({
        coordinates: { lat: 55.7, lng: 37.536 },
        position: map.getCenter(),
        icon: goldStar,
        map: map,
    });

    marker.addListener('click', function() {
        infowindow.open(map, marker);
    });

}