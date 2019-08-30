var map, infoWindow;

function initUserMap() {

  infoWindow = new google.maps.InfoWindow;
 
  // Try HTML5 geolocation.
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var pos = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };

      map = new google.maps.Map(document.getElementById('map'), {
        center: pos,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        scrollwheel:false,
        streetViewControl: false,
        mapTypeControl: false,
        panControl: false,
        zoomControlOptions: { position: google.maps.ControlPosition.LEFT_BOTTOM},
        zoom: 10,
      });
      
      // Adds a marker to the map.
      function addMarker(location, map) {
        var marker = new google.maps.Marker({
          position: location,
          map: map
        });
      } 
      
      addMarker(pos, map);

    }, function() {
      handleLocationError(true, infoWindow);
    });
  } else {
    // Browser doesn't support Geolocation
    handleLocationError(false, infoWindow);
  }  
};

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
  infoWindow.setPosition(pos);
  infoWindow.setContent(browserHasGeolocation ?
    'Error: The Geolocation service failed.' :
    'Error: Your browser doesn\'t support geolocation.');
  infoWindow.open(map);
}

function initMap(userLat, userlng) {
  
};




// function initMap() {

//   map = new google.maps.Map(document.getElementById('map'), {
//     center: { lat: 37.61556, lng: 55.75222 },
//     mapTypeId: google.maps.MapTypeId.ROADMAP,
//     scrollwheel:false,
//     streetViewControl: false,
//     mapTypeControl: false,
//     panControl: false,
//     zoomControlOptions: { position: google.maps.ControlPosition.LEFT_BOTTOM},
//     zoom: 10,
//     styles: [
//       {
//         "elementType": "geometry",
//         "stylers": [{"color": "#ebe3cd"}]
//       },
//       {
//         "elementType": "labels.text.fill",
//         "stylers": [{"color": "#523735"}]
//       },
//       {
//         "elementType": "labels.text.stroke",
//         "stylers": [{"color": "#f5f1e6"}]
//       },
//       {
//         "featureType": "administrative",
//         "elementType": "geometry.stroke",
//         "stylers": [{"color": "#c9b2a6"}]
//       },
//       {
//         "featureType": "administrative.land_parcel",
//         "elementType": "geometry.stroke",
//         "stylers": [{"color": "#dcd2be"}]
//       },
//       {
//         "featureType": "administrative.land_parcel",
//         "elementType": "labels.text.fill",
//         "stylers": [{"color": "#ae9e90"}]
//       },
//       {
//         "featureType": "landscape.natural",
//         "elementType": "geometry",
//         "stylers": [{"color": "#dfd2ae"}]
//       },
//       {
//         "featureType": "poi",
//         "elementType": "geometry",
//         "stylers": [{"color": "#dfd2ae"}]
//       },
//       {
//         "featureType": "poi",
//         "elementType": "labels.text.fill",
//         "stylers": [{"color": "#93817c"}]
//       },
//       {
//         "featureType": "poi.park",
//         "elementType": "geometry.fill",
//         "stylers": [{"color": "#a5b076"}]
//       },
//       {
//         "featureType": "poi.park",
//         "elementType": "labels.text.fill",
//         "stylers": [{"color": "#447530"}]
//       },
//       {
//         "featureType": "road",
//         "elementType": "geometry",
//         "stylers": [{"color": "#f5f1e6"}]
//       },
//       {
//         "featureType": "road.arterial",
//         "elementType": "geometry",
//         "stylers": [{"color": "#fdfcf8"}]
//       },
//       {
//         "featureType": "road.highway",
//         "elementType": "geometry",
//         "stylers": [{"color": "#f8c967"}]
//       },
//       {
//         "featureType": "road.highway",
//         "elementType": "geometry.stroke",
//         "stylers": [{"color": "#e9bc62"}]
//       },
//       {
//         "featureType": "road.highway.controlled_access",
//         "elementType": "geometry",
//         "stylers": [{"color": "#e98d58"}]
//       },
//       {
//         "featureType": "road.highway.controlled_access",
//         "elementType": "geometry.stroke",
//         "stylers": [{"color": "#db8555"}]
//       },
//       {
//         "featureType": "road.local",
//         "elementType": "labels.text.fill",
//         "stylers": [{"color": "#806b63"}]
//       },
//       {
//         "featureType": "transit.line",
//         "elementType": "geometry",
//         "stylers": [{"color": "#dfd2ae"}]
//       },
//       {
//         "featureType": "transit.line",
//         "elementType": "labels.text.fill",
//         "stylers": [{"color": "#8f7d77"}]
//       },
//       {
//         "featureType": "transit.line",
//         "elementType": "labels.text.stroke",
//         "stylers": [{"color": "#ebe3cd"}]
//       },
//       {
//         "featureType": "transit.station",
//         "elementType": "geometry",
//         "stylers": [{"color": "#dfd2ae"}]
//       },
//       {
//         "featureType": "water",
//         "elementType": "geometry.fill",
//         "stylers": [{"color": "#b9d3c2"}]
//       },
//       {
//         "featureType": "water",
//         "elementType": "labels.text.fill",
//         "stylers": [{"color": "#92998d"}]
//       }
//     ]
//   });

//   // Adds a marker to the map.
//   function addMarker(location, map) {
//     var marker = new google.maps.Marker({
//       path: 'M242.606,0C142.124,0,60.651,81.473,60.651,181.955c0,40.928,13.504,78.659,36.31,109.075l145.646,194.183L388.252,291.03c22.808-30.416,36.31-68.146,36.31-109.075C424.562,81.473,343.089,0,242.606,0z M242.606,303.257c-66.989,0-121.302-54.311-121.302-121.302c0-66.989,54.313-121.304,121.302-121.304c66.991,0,121.302,54.315,121.302,121.304C363.908,248.947,309.598,303.257,242.606,303.257z',
//       fillColor: '#F68727',
//       fillOpacity: 0.8,
//       scale: 0.08,
//       strokeColor: '#F68727',
//       strokeWeight: 1,
//       position: location,
//       label: labels[labelIndex++ % labels.length],
//       map: map
//     });
//   }

//   // infoWindow = new google.maps.InfoWindow;

//   // // Try HTML5 geolocation.
//   // if (navigator.geolocation) {
//   //   navigator.geolocation.getCurrentPosition(function(position) {
//   //     var pos = {
//   //       lat: position.coords.latitude,
//   //       lng: position.coords.longitude
//   //     };

//   //     infoWindow.setPosition(pos);
//   //     infoWindow.setContent('Location found.');
//   //     infoWindow.open(map);
//   //     map.setCenter(pos);
//   //   }, function() {
//   //     handleLocationError(true, infoWindow, map.getCenter());
//   //   });
//   // } else {
//   //   // Browser doesn't support Geolocation
//   //   handleLocationError(false, infoWindow, map.getCenter());
//   // }

// }

// function handleLocationError(browserHasGeolocation, infoWindow, pos) {
//   infoWindow.setPosition(pos);
//   infoWindow.setContent(browserHasGeolocation ?
//     'Error: The Geolocation service failed.' :
//     'Error: Your browser doesn\'t support geolocation.');
//   infoWindow.open(map);
// }

// var contentString = 
//   '<div id="profile_map_marker">'+
//     '<div class="card">' +
//       '<div class="column no-gutters" style="height: 100%;">' +
//         '<div class="col-lg-12" style="overflow: hidden;">' +
//           '<a href="profile?prf=1" class="profile-img-link">' +
//             '<img src="http://friendforanhour/profilepictures/1/fennec1.jpg" class="user_image card-img">' +
//           '</a>' +
//         '</div>' + 
//         '<div class="col-lg-12">' +
//           '<div class="card-body">' +
//             '<div class="last-active-users-about">' +

//               '<h6 class="card-title">' +
//                 '<a href="profile?prf=1">' +
//                   '<span class="name_user_cart">Спиридон,<span> 19</span></span>' +
//                 '</a>' +
//               '</h6>' +

//               '<div class="name_serwise_cart name_serwise">' +
//                 '<span class="city_user_cart">Волгоград</span>' +
//               '</div>' +

//               '<div class="name_serwise_cart name_serwise">' +
//                 '<span class="title_serwise">Заплачу за:</span>' +
//               '</div>' +
                
//               '<div class="name_serwise_cart name_serwise">' +
//                 '<span>хочу массаж1:</span> <span class="serwise_cart_price">900р</span>' +
//               '</div>' +

//               '<div class="name_serwise_cart name_serwise">' +
//                 '<span>угощусь пивом1:</span> <span class="serwise_cart_price">беспл.</span>' +
//               '</div>' +

//               '<div class="name_serwise_cart name_serwise">' +
//                 '<span class="title_serwise">Сделаю за деньги:</span>' +
//               '</div>' +
                
//               '<div class="name_serwise_cart name_serwise">' +
//                 '<span>сделаю массаж1:</span> <span class="serwise_cart_price">600р</span>' +
//               '</div>' +

//               '<div class="name_serwise_cart name_serwise">' +
//                 '<span>сделаю массаж1:</span> <span class="serwise_cart_price">600р</span>' +
//               '</div>' +

//               '<div class="name_serwise_cart name_serwise">' +
//                 '<span>угощу пивом1:</span> <span class="serwise_cart_price">беспл.</span>' +
//               '</div>' +                                
                
//             '</div>' +
//           '</div>' +
//         '</div>' +
//       '</div>' +
//     '</div>' +
//   '</div>';