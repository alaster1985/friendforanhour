</main>
<div class="modal-error">Please, register first
    <div class="text-center margin-bottom-20" id="uLogin3"
         data-ulogin="display=panel;theme=classic;fields=first_name,last_name,email,nickname,photo,city,country,bdate,sex;
                             providers=facebook,vkontakte,odnoklassniki;hidden=;
                             redirect_uri={{ urlencode('http://' . $_SERVER['HTTP_HOST'])}}/ulogin;mobilebuttons=0;">
    </div>
    <span class="modal-error__close-btn fa fa-times"></span>
</div>
@auth
    @if(Auth::user()->profile_id)
        <span id="app2" style="display: none">
                        <online v-bind:friend="{{ Auth::user()->profile }}"
                                v-bind:onlineusers="onlineUsers"></online>
                    </span>
    @endif
@endauth
<footer>

</footer>
<script type="text/javascript" src="{{ asset('js/jquery-3.4.1.min.js')}}"></script>
@guest
    <script type="text/javascript" src="http://ulogin.ru/js/ulogin.js"></script>
@endguest
<script type="text/javascript" src="{{ asset('js/forInputData.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/forComplain.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/app.js') }}" defer></script>
<script type="text/javascript" src="{{ asset('js/slick.js') }} " defer></script>
<script type="text/javascript" src="{{ asset('js/jquery.fancybox.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/main.script.js') }}"></script>
</body>
</html>