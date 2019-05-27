<footer>

</footer>
{{--<script type="text/javascript" src="http://ulogin.ru/js/ulogin.js"></script>--}}
<script type="text/javascript" src="{{asset('js/jquery-3.4.1.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/forInputData.js')}}"></script>
<script src="{{ asset('js/app.js') }}" defer></script>
 <script src="{{ asset('js/slick.js') }}" defer></script>
<script>
if ($(window).width() <= '768'){
            $('#navbarSupportedContent').appendTo('.mobile_autorization');
        } ;
      
</script>
<script>
  $(document).ready(function(){
      $('.photo_user').slick({
        slidesToShow: 8,
        focusOnSelect: true,
      });
    });
</script>
</html>