// function initMap() {
//     var element = document.getElementById('map');
//     var options = {
//         zoom: 12,

//         center: { lat: 55.7, lng: 37.536 }
//     };
//     var map = new google.maps.Map(element, options);

//     //    


//     var goldStar = {
//         path: 'M 125,5 155,90 245,90 175,145 200,230 125,180 50,230 75,145 5,90 95,90 z',
//         fillColor: 'yellow',
//         fillOpacity: 0.8,
//         scale: 1,
//         strokeColor: 'gold',
//         strokeWeight: 14
//     };

//     var Markers = [
//         {
//             coordinates: { lat: 55.7, lng: 37.536 },
//             icon: goldStar,
//             position: map.getCenter(),
//         },
//         {
//             coordinates: { lat: 55.9, lng: 37.636 },
//             icon: goldStar,
//         }
//     ];
//     for (var i = 0; i < Markers.length; i++) {
//         addMarker(Markers[i])
//     };
//     function addMarker(properties) {
//         var marker = new google.maps.Marker({
//             position: properties.coordinates,
//             map: map,
//         });
//         if (properties.image) {
//             marker.setIcon(properties.image)

//         }

//         if (properties.info) {
//             var InfoWindow = new google.maps.InfoWindow({
//                 content: properties.info
//             });
//             marker.addListener('click', function () {
//                 InfoWindow.open(map, marker);
//             })
//         }
//     }

// };
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

    // var marker = new google.maps.Marker({
    //   position: map.getCenter(),
    //   icon: goldStar,
    //   map: map
    // });
    var Markers = [
        {
            info: "вот что я умею",
            coordinates: { lat: 55.7, lng: 37.536 },
            position: map.getCenter(),
            image: goldStar,
            map: map,


        },
        {
            coordinates: { lat: 55.75, lng: 37.538 },
            position: map.getCenter(),
            image: goldStar,
            map: map,
            info: "вот что я хочу уметь",
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



    // var myEl = document.getElementById('i_am_here');
    //
    // myEl.addEventListener('click', function () {
    //     var geocoder = new google.maps.Geocoder();
    //     var address = 'London, UK';
    //     if (geocoder) {
    //         geocoder.geocode({ 'address': address }, function (results, status) {
    //             if (status == google.maps.GeocoderStatus.OK) {
    //                 console.log(results[0].geometry.location.lng());
    //             }
    //             else {
    //                 console.log("Geocoding failed: " + status);
    //             }
    //         });
    //     }
    // }, false);

    // еще один вариант проверки текущего места положения при клике \
    // navigator.geolocation.getCurrentPosition(
    //     function( position ){ // все в порядке
    //         console.log( position );
    //     },
    //     function(){ // ошибка
    //     }
    // );




    // var marker_coursore;
    //
    // google.maps.event.addListener(map, 'click', function (event) {
    //
    //     placeMarker(event.latLng);
    //
    // });
    //
    // function placeMarker(location) {
    //
    //     if (marker_coursore == null) {
    //         marker_coursore = new google.maps.Marker({
    //             position: location,
    //             map: map
    //         });
    //     } else { marker_coursore.setPosition(location); }
    // }
    // var myEls = document.getElementById('i_am_here_mouse');
    // myEls.addEventListener('click', function () {
    //
    //     console.log(marker_coursore.position.lng());
    //
    // });
}




// 
