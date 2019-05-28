<footer>

</footer>
<script type="text/javascript" src="http://ulogin.ru/js/ulogin.js"></script>
<script type="text/javascript" src="{{asset('js/jquery-3.4.1.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/forInputData.js')}}"></script>
<script src="{{ asset('js/app.js') }}" defer></script>
 <script src="{{ asset('js/slick.js') }} "defer ></script>
 <script src="{{ asset('js/jquery.fancybox.min.js') }}" ></script>
 <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDubzSKVlBye9tVxy2huOy046M2BOx1fR4&callback=initMap">
 </script>
<script>
if ($(window).width() <= '768'){
            $('#navbarSupportedContent').appendTo('.mobile_autorization');
        } ;
      
</script>
<script>
  $(document).ready(function(){
      $('.photo_user').slick({
        slidesToShow: 8,
        arrows: true,
    
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