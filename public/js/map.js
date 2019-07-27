function initMap() {
    var element = document.getElementById('map');
    var options = {
        zoom: 10,
        center: { lat: 55.7, lng: 37.536 }
    };

    var map = new google.maps.Map(element, options);

    var markerIcon = {
        path: 'M242.606,0C142.124,0,60.651,81.473,60.651,181.955c0,40.928,13.504,78.659,36.31,109.075l145.646,194.183L388.252,291.03c22.808-30.416,36.31-68.146,36.31-109.075C424.562,81.473,343.089,0,242.606,0z M242.606,303.257c-66.989,0-121.302-54.311-121.302-121.302c0-66.989,54.313-121.304,121.302-121.304c66.991,0,121.302,54.315,121.302,121.304C363.908,248.947,309.598,303.257,242.606,303.257z',
        fillColor: '#F68727',
        fillOpacity: 0.8,
        scale: 0.08,
        strokeColor: '#F68727',
        strokeWeight: 1,
    };

    var contentString = 
        '<div id="profile_map_marker">'+
            '<div class="card">' +
                '<div class="column no-gutters" style="height: 100%;">' +
                    '<div class="col-lg-12" style="overflow: hidden;">' +
                        '<a href="profile?prf=1" class="profile-img-link">' +
                            '<img src="http://friendforanhour/profilepictures/1/fennec1.jpg" class="user_image card-img">' +
                        '</a>' +
                    '</div>' + 
                    '<div class="col-lg-12">' +
                        '<div class="card-body">' +
                            '<div class="last-active-users-about">' +

                                '<h6 class="card-title">' +
                                    '<a href="profile?prf=1">' +
                                        '<span class="name_user_cart">Спиридон,<span> 19</span></span>' +
                                    '</a>' +
                                '</h6>' +

                                '<div class="name_serwise_cart name_serwise">' +
                                    '<span class="city_user_cart">Волгоград</span>' +
                                '</div>' +

                                '<div class="name_serwise_cart name_serwise">' +
                                    '<span class="title_serwise">Заплачу за:</span>' +
                                '</div>' +
                                
                                    '<div class="name_serwise_cart name_serwise">' +
                                        '<span>хочу массаж1:</span> <span class="serwise_cart_price">900р</span>' +
                                    '</div>' +

                                    '<div class="name_serwise_cart name_serwise">' +
                                        '<span>угощусь пивом1:</span> <span class="serwise_cart_price">беспл.</span>' +
                                    '</div>' +

                                '<div class="name_serwise_cart name_serwise">' +
                                    '<span class="title_serwise">Сделаю за деньги:</span>' +
                                '</div>' +
                                
                                    '<div class="name_serwise_cart name_serwise">' +
                                        '<span>сделаю массаж1:</span> <span class="serwise_cart_price">600р</span>' +
                                    '</div>' +

                                    '<div class="name_serwise_cart name_serwise">' +
                                        '<span>сделаю массаж1:</span> <span class="serwise_cart_price">600р</span>' +
                                    '</div>' +

                                    '<div class="name_serwise_cart name_serwise">' +
                                        '<span>угощу пивом1:</span> <span class="serwise_cart_price">беспл.</span>' +
                                    '</div>' +                                
                                
                            '</div>' +
                        '</div>' +
                    '</div>' +
                '</div>' +
            '</div>' +
        '</div>';

    var infowindow = new google.maps.InfoWindow({
        content: contentString
    });

    var marker = new google.maps.Marker({
        coordinates: { lat: 55.7, lng: 37.536 },
        position: map.getCenter(),
        icon: markerIcon,
        map: map,
    });

    marker.addListener('click', function() {
        infowindow.open(map, marker);
    });

}