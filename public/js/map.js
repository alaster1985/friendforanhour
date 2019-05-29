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
