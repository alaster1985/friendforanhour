<div class="text-center margin-bottom-20" id="uLogin"
     data-ulogin="display=panel;theme=classic;fields=first_name,last_name,email,nickname,photo,country,city,bdate;
                             providers=facebook,vkontakte,odnoklassniki;hidden=;{{--verify=1;--}}
                             redirect_uri={{ urlencode('http://' . $_SERVER['HTTP_HOST']) }}/ulogin;mobilebuttons=0;">
</div>
@if (Session::has('flash_message_error'))
    <div class="alert alert-info">{{ Session::get('flash_message_error') }}</div>
@endif