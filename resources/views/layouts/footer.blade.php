<footer>

</footer>
@guest
<script type="text/javascript" src="http://ulogin.ru/js/ulogin.js"></script>
@endguest
<script type="text/javascript" src="{{asset('js/jquery-3.4.1.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/forInputData.js')}}"></script>
<script>
if ($(window).width() <= '768'){
            $('.change').appendTo('.mobile_autorization');
        } 
</script>
</html>