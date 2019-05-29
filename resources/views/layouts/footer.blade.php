<footer>

</footer>
<script type="text/javascript" src="http://ulogin.ru/js/ulogin.js"></script>
<script type="text/javascript" src="{{asset('js/jquery-3.4.1.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/forInputData.js')}}"></script>
<script src="{{ asset('js/app.js') }}" defer></script>
 <script src="{{ asset('js/slick.js') }} "defer ></script>
 <script src="{{ asset('js/jquery.fancybox.min.js') }}" ></script>
 <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDubzSKVlBye9tVxy2huOy046M2BOx1fR4&callback=initMap">
        </script>
<script>
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

    </script>



<script>
if ($(window).width() <= '768'){
            $('#navbarSupportedContent').appendTo('.mobile_autorization');
        } ;
      
</script>
<script>
  $(document).ready(function () {
      $('.photo_user').slick({
        slidesToShow: 6,
        arrows: true,
        responsive: [
          {
            breakpoint: 998,
            settings: {
              slidesToShow: 4,
              slidesToScroll: 1,
              infinite: true,
              
            }
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 4,
              slidesToScroll: 2
            }
          },
          {
            breakpoint: 576,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 1
            }
          }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
      });
    });
</script>
    {{ asset('images/next.svg') }}

<script>
  $(document).ready(function() {
    $('.table_paid tr:gt(3)').addClass('dissable_block')
      
    });
    $('.table_paid_open').on('click', function(){
        $('.table_paid tr:gt(3)').toggleClass('dissable_block');
        $('.table_paid_open .open_table').toggleClass('dissable_block');
        $('.table_paid_open .close_table').toggleClass('active_table');
      });
      $(document).ready(function() {
    $('.table_for_me tr:gt(3)').addClass('dissable_block')  
    });
    $('.table_for_me_open').on('click', function(){
        $('.table_for_me tr:gt(3)').toggleClass('dissable_block');
        $('.table_for_me_open .open_table').toggleClass('dissable_block');
        $('.table_for_me_open .close_table').toggleClass('active_table');
      });

  //     $(document).ready(function() {
	// 	$(".fancybox").fancybox({
      

  //   });
	// }); 
  
</script>
</body>
</html>