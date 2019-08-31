var map, marker, contentString, infoWindow, activeInfoWindow;

var markerIconRed = {
  url: 'https://img.icons8.com/office/40/000000/marker.png'
};

var markerIconBlue = {
  url: 'https://img.icons8.com/ultraviolet/40/000000/marker.png'
};

// ADD MARKER

function addMarker(location, map) {
  marker = new google.maps.Marker ({
    map: map,
    animation: google.maps.Animation.DROP,
    position: location,
    icon: markerIconRed,
    fillOpacity: 0.8,
    scale: 0.08,
    strokeWeight: 1
  });
};

function initialize() {
  $(document).ready(function () {

    var data = {
      longitude: 44.619724,
      latitude: 48.802045,
      radius: 25,
      _token: $('meta[name="csrf-token"]').attr('content'),
    };

    $.post('getProfilesByChordsAndRadius', data, function (data) {

      getProfilesByChords = JSON.parse(data);

      $.each(getProfilesByChords, function(id, obj) {

        console.log(obj);

        var loc = {
          lat : obj.profile_address.latitude, 
          lng : obj.profile_address.longitude 
        };

        contentString = 
          '<div id="profile_map_marker">'+
            '<div class="card">' +
              '<div class="column no-gutters" style="height: 100%;">' +
                '<div class="col-lg-12" style="overflow: hidden;">' +
                  '<a href="profile?prf=' + obj.id +'" class="profile-img-link">' +
                    '<img src="' + obj.profile_photo[0].photo_path +'" class="user_image card-img">' +
                  '</a>' +
                '</div>' + 
                '<div class="col-lg-12">' +
                  '<div class="card-body">' +
                    '<div class="last-active-users-about">' +

                      '<h6 class="card-title">' +
                        '<a href="profile?prf=' + obj.id +'">' +
                          '<span class="name_user_cart">' + obj.first_name + '</span>' +
                        '</a>' +
                      '</h6>' +

                      '<div id="pay_for" class="name_serwise_cart name_serwise">' +
                        '<span class="title_serwise">Заплачу за:</span>' +
                      '</div>' +

                      '<div id="for_cash" class="name_serwise_cart name_serwise">' +
                        '<span class="title_serwise">Сделаю за деньги:</span>' +
                      '</div>' + 

                    '</div>' +
                  '</div>' +
                '</div>' +
              '</div>' +
            '</div>' +
          '</div>';

        $.each(getProfilesByChords.service_list, function(id, obj) {

          var serwiseCart = document.createElement("div");

          serwiseCart.classList = "name_serwise_cart name_serwise"; 
        
          if (obj.service_type_id == 2) {

            this.serwiseCart.innerHTML = 
            '<div class="name_serwise_cart name_serwise">' +
              '<span>' + obj.service_list.service_name + ':</span> <span class="serwise_cart_price">' + obj.service_list.price + '</span>' +
            '</div>';    
  
            $('#pay_for').insertAfter(serwiseCart);
          } else if (obj.service_type_id == 1) {
  
            this.serwiseCart.innerHTML = 
            '<div class="name_serwise_cart name_serwise">' +
              '<span>' + obj.service_list.service_name + ':</span> <span class="serwise_cart_price">' + obj.service_list.price + '</span>' +
            '</div>';
  
            $('#for_cash').after(serwiseCart);
          }  

        });
          
        addMarker(loc, map);

        var infoWindow = new google.maps.InfoWindow ({
          content: contentString,
          maxWidth: 200
        });
      
        google.maps.event.addListener(marker, "click", function() {
          if (infoWindow) {infoWindow.close();}
          infoWindow.open(map, this);
        });

        google.maps.event.addListener(map, "click", function(event) {
          infoWindow.close();
        });

      });
    });
  });
};

function initUserMap() {

  var pos;

  // HTML5 GEOLOCATION
  if (navigator.geolocation) {    
    navigator.geolocation.getCurrentPosition(function(position) {

      pos = {
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
        styles: [
          { "elementType": "geometry", "stylers": [{"color": "#ebe3cd"}] },
          { "elementType": "labels.text.fill", "stylers": [{"color": "#523735"}] },
          { "elementType": "labels.text.stroke", "stylers": [{"color": "#f5f1e6"}] },
          { "featureType": "administrative", "elementType": "geometry.stroke", "stylers": [{"color": "#c9b2a6"}] },
          { "featureType": "administrative.land_parcel", "elementType": "geometry.stroke", "stylers": [{"color": "#dcd2be"}] },
          { "featureType": "administrative.land_parcel", "elementType": "labels.text.fill","stylers": [{"color": "#ae9e90"}] },
          { "featureType": "landscape.natural", "elementType": "geometry", "stylers": [{"color": "#dfd2ae"}] },
          { "featureType": "poi", "elementType": "geometry", "stylers": [{"color": "#dfd2ae"}] },
          { "featureType": "poi", "elementType": "labels.text.fill", "stylers": [{"color": "#93817c"}] },
          { "featureType": "poi.park", "elementType": "geometry.fill", "stylers": [{"color": "#a5b076"}] },
          { "featureType": "poi.park", "elementType": "labels.text.fill", "stylers": [{"color": "#447530"}] },
          { "featureType": "road", "elementType": "geometry", "stylers": [{"color": "#f5f1e6"}] },
          { "featureType": "road.arterial", "elementType": "geometry", "stylers": [{"color": "#fdfcf8"}] },
          { "featureType": "road.highway", "elementType": "geometry", "stylers": [{"color": "#f8c967"}] },
          { "featureType": "road.highway", "elementType": "geometry.stroke", "stylers": [{"color": "#e9bc62"}] },
          { "featureType": "road.highway.controlled_access", "elementType": "geometry", "stylers": [{"color": "#e98d58"}] },
          { "featureType": "road.highway.controlled_access", "elementType": "geometry.stroke", "stylers": [{"color": "#db8555"}] },
          { "featureType": "road.local", "elementType": "labels.text.fill", "stylers": [{"color": "#806b63"}] },
          { "featureType": "transit.line", "elementType": "geometry", "stylers": [{"color": "#dfd2ae"}] },
          { "featureType": "transit.line", "elementType": "labels.text.fill", "stylers": [{"color": "#8f7d77"}] },
          { "featureType": "transit.line", "elementType": "labels.text.stroke", "stylers": [{"color": "#ebe3cd"}] },
          { "featureType": "transit.station", "elementType": "geometry", "stylers": [{"color": "#dfd2ae"}] },
          { "featureType": "water", "elementType": "geometry.fill", "stylers": [{"color": "#b9d3c2"}] },
          { "featureType": "water", "elementType": "labels.text.fill", "stylers": [{"color": "#92998d"}] }
        ]   
      });

      window.google.maps.event.addDomListener(window, 'load', initialize);

      // contentString = 
      //   '<div id="profile_map_marker">'+
      //     '<div class="card">' +
      //       '<div class="column no-gutters" style="height: 100%;">' +
      //         '<div class="col-lg-12" style="overflow: hidden;">' +
      //           '<a href="profile?prf=' + '" class="profile-img-link">' +
      //             '<img src="' + '" class="user_image card-img">' +
      //           '</a>' +
      //         '</div>' + 
      //         '<div class="col-lg-12">' +
      //           '<div class="card-body">' +
      //             '<div class="last-active-users-about">' +

      //               '<h6 class="card-title">' +
      //                 '<a href="profile?prf=' + '">' +
      //                   '<span class="name_user_cart">' + '</span>' +
      //                 '</a>' +
      //               '</h6>' +

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

      // var myInfoWindow = new google.maps.InfoWindow ({
      //   content: contentString,
      //   maxWidth: 200
      // });
    
      // google.maps.event.addListener(marker, "click", function() {
      //   if (myInfoWindow) {myInfoWindow.close();}
      //   myInfoWindow.open(map, this);
      // });

      // google.maps.event.addListener(map, "click", function(event) {
      //   myInfoWindow.close();
      // });

      addMarker(pos, map);  
    }
  )};
};

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
  infoWindow.setPosition(pos);
  infoWindow.setContent(browserHasGeolocation ?
    'Error: The Geolocation service failed.' :
    'Error: Your browser doesn\'t support geolocation.');
  infoWindow.open(map);
}